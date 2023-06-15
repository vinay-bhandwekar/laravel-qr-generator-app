<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App;
  

class LangController extends Controller
{
    //
     public function change($lang='en')
    {
        if (! in_array($lang, ['en', 'es'])) {
             return redirect('/');
        } 
 
         App::setLocale($lang);
        session()->put('locale', $lang);
  
        return redirect()->back();
        
    }
    
}
