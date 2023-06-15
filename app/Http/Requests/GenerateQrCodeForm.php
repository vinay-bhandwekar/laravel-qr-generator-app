<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
class GenerateQrCodeForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'email' => 'required|email|max:255|unique:'.User::class,
            'title' => 'required|max:255',
            'uuid' => 'required',
            'type' => 'required',
            'resource' => 'required',
            'resource_body' => 'required',
            'is_locked' => 'required',
            'owner' => 'required',
            'owner_details' => 'required',
        ];
    }
   
}
