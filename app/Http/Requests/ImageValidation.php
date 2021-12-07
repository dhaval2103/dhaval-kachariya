<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageValidation extends FormRequest
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
        $id = $this->frmid;
        if ($id == "") {
            return [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',
            ];
        } else {
            return [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required,' . $id,
            ];
        }
    }
    public function messages()
    {
        return [
            'title.required' => 'Please Enter Title',
            'description.required' => 'Please Enter Description',
            'image.required' => 'Please Choose Image',
        ];
    }
}
