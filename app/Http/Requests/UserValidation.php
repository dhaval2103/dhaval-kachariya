<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidation extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id;
        if ($id == "") {
            return [
                'uname' => 'required',
                'email' => 'required|unique:users,email',
            ];
        } else {
            return [
                'uname' => 'required',
                'email' => 'required|unique:users,email,' . $id,
            ];
        }
    }
    public function messages()
    {
        return [
            'uname.required' => 'Please Enter UserName',
            'email.required' => 'Please Enter EmailID',
        ];
    }
}
