<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class EmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->role_id==1 && Auth::user()->uname==env('ADMIN_USERNAME', null)){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email_group_id' => ['sometimes', 'required', 'numberic'],
            'type' => ['sometimes', 'required', 'string'],
            'name' => ['sometimes', 'nullable', 'string'],
            'email' => ['sometimes', 'required', 'email'],
        ];
    }
}
