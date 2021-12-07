<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationValidation extends FormRequest
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
        $id = $this->userid;
        if ($id == "") {
            return [
                'education' => 'required|alpha_num',
                'startyear' => 'required',
                'endyear' => 'required',
            ];
        } else {
            return [
                'education' => 'required|alpha_num                                                                                                      ',
                'startyear' => 'required',
                'endyear' => 'required,' . $id,
            ];
        }
    }
    public function messages()
    {
        return [
            'education.required' => 'Please Enter Education',
            'startyear.required' => 'Please Select StartYear',
            'endyear.required' => 'Please Select EndYear',
        ];
    }
}
