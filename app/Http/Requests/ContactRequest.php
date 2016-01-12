<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'birthday'  =>  'size:0|max:0',  // Honeypot
          'name'      =>  'required',
          'email'     =>  'required|email',
          'msg'       =>  'required'
        ];
    }

    public function messages()
    {
        return [
          'required'  =>  'Please complete this field',
          'email'     =>  'Please enter an email address'
        ];
    }

}
