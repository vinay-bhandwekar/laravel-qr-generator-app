<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\GenerateQrCodeForm;
use App\Models\User_qr_code;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Mail;
use App\Mail\QRMail;

class GenerateQrCodeController extends Controller
{
    //
    protected $logs_file_name;
   
    public function __construct()
    {
        //
        $this->logs_file_name = date("Y-m-d").'-system.log';
    }
    public function index() {
        $user = auth()->user();
        if(!empty($user)){
            $qr_details=User_qr_code::where('user_id',$user->id)->first();
            if (!empty($qr_details)){
                return redirect('/show')->with('message','');
            }
        }
        $uuid = Str::uuid();
        return view('home',['uuid'=>$uuid]);
    }
     public function show($uuid=null)
    {
         if(empty($uuid)){
             $user = auth()->user();
             if(empty($user)){
                return redirect('/')->with('message',trans("message.invalid_uuid"));
             }
              $qr_details=User_qr_code::where('user_id',$user->id)->first();
         }else{
            $qr_details=User_qr_code::where('UUID',$uuid)->first();
         }
        if(empty($qr_details)){
             return redirect('/')->with('message',trans("message.invalid_uuid"));
        }
        $user=User::where('id',$qr_details->user_id)->first();
        $QrCode =  QrCode::size(200)
        ->style('dot')
        ->eye('circle')
        ->color(0, 0, 255)
        ->margin(1)
        ->generate(
            url('/view',$uuid),
        );
        
        return view("view_qr_details",['details'=>$qr_details,"qr_code"=>$QrCode,"user"=>$user]);
    }
    public function saveDetails(GenerateQrCodeForm $request){
     
        $user_data = [
            'name'=>$request->title,
            'email'=>$request->email,
            'password'=> Hash::make("admin@1234")
        ];
        $user = User::create($user_data);
        
        $user_qr_code_details = [
            'user_id'=>$user->id,
            'title'=>$request->title,
            'UUID'=>$request->uuid,
            'type'=>$request->type,
            'resource_type'=>$request->resource,
            'resource'=>$request->resource_body,
            'is_locked'=>$request->is_locked=="true"?1:0,
            'owner'=>$request->owner,
            'owner_details'=>$request->owner_details,
        ];
        
        $qr=User_qr_code::create($user_qr_code_details);
        
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/'.$this->logs_file_name),
          ])->info('Qr code generated for '.$request->title);
        $QrCode =  QrCode::size(200)
        ->style('dot')
        ->eye('circle')
        ->color(0, 0, 255)
        ->margin(1)
        ->generate(
            url('/view',$request->uuid),
        );
        $maildata = [            
            'title'=>$request->title,
            'UUID'=>$request->uuid,
            'type'=>$request->type,
            'resource_type'=>$request->type=="resource"?$request->resource:"",
            'resource'=>$request->resource_body,
            'is_locked'=>$request->is_locked=="true"?'True':'False',
            'owner'=>$request->owner,
            'owner_details'=>$request->owner_details,
            'QR_CODE'=>$QrCode,
        ];
        
          Mail::to(env("ADMIN_EMAIL"))->send(new QRMail($maildata));
          Mail::to($request->email)->send(new QRMail($maildata));
        
        return redirect('show/'.$qr->UUID)->with('message',trans("message.insert_success_message"));
    }
     public function delete($uuid=0){  
        $qr_details=User_qr_code::where('UUID',$uuid)->first();
        if(empty($qr_details)){
             return redirect('/');
        }
        $data = User::destroy($qr_details->user_id);
        $data = User_qr_code::destroy($qr_details->id);
         Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/'.$this->logs_file_name),
          ])->info('Qr code removed for '.$qr_details->title);
        return redirect('/')->with('message', trans("message.delete_success_message"));
    }
    public function updateDetails(Request $request){
        
         $request->validate([
            'type' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->user_id],
            'resource' => ['required'],
            'resource_body' => ['required'],
            'is_locked' => ['required'],
            'owner' => ['required'],
            'owner_details'=>['required']
        ]);
        
        $user_data = [
            'name'=>$request->title,
            'email'=>$request->email,            
        ];
        $user = User::where('id', (string) $request->user_id)->update($user_data);
         $user_qr_code_details = [
            'title'=>$request->title,
            'type'=>$request->type,
            'resource_type'=>$request->resource,
            'resource'=>$request->resource_body,
            'is_locked'=>$request->is_locked=="true"?1:0,
            'owner'=>$request->owner,
            'owner_details'=>$request->owner_details,
        ];
          Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/'.$this->logs_file_name),
          ])->info('Qr code updated for '.$request->title);
        $qrDetails = User_qr_code::where('id', (string) $request->id)->update($user_qr_code_details);
        return redirect('show/'.$request->uuid)->with('message',trans("message.update_success_message"));
    }
    public function editDetails($uuid=0){
        $qr_details=User_qr_code::where('UUID',$uuid)->first();
        if(empty($qr_details)){
             return redirect('/');
        }
         $user=User::where('id',$qr_details->user_id)->first();
        return view("edit_qr_details",['details'=>$qr_details,'user'=>$user]);
    }
    public function view($uuid)
    {
        $qr_details=User_qr_code::where('UUID',$uuid)->first();
        $user=User::where('id',$qr_details->user_id)->first();
         $user_qr_code_details = [            
            'access_count'=>$qr_details->access_count + 1,
        ];
          Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/'.$this->logs_file_name),
          ])->info('Access count updated for '.$qr_details->title." (UUID: ".$qr_details->UUID.")");
        $qrDetails = User_qr_code::where('id', (string) $qr_details->id)->update($user_qr_code_details);
        $qr_details=User_qr_code::where('UUID',$uuid)->first();
        return view("view_only",['details'=>$qr_details,"user"=>$user]);
    }
}
