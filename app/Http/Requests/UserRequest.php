<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()//: array
    {
        $id = request()->id; 
        $password = 'required';
        if($id > 0){
            $password = '';
        }
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'number' => 'required',
            'role_id' => 'required',
            'password' => $password,
        ];
    }
}
