<?php

namespace Aska\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        return [
            'name' => 'required|max:30',
            'surname' => 'required|max:30',
            'phone' => 'required|min:9|max:11|regex:/^[0-9]+$/',
            'school' => 'required|max:100',
            'accompanying_person'=>'required|in:1,0',
            'accompanying_person_name' => 'min:3|max:30',
            'accompanying_person_surname' => 'min:3|max:30',
            'accompanying_person_email' => 'email|max:255',
            'school_field_of_study' => 'min:3|max:30',
            'refer_theme' => 'required|min:3|max:50',
            'school_degree'=>'min:3|max:30',
            'science_club'=>'in:1,0',
            'science_club_name' => 'min:1|max:50',
            'science_club_email' => 'email|max:255',
            'science_club_page' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/|max:255',
            'science_club_function'=>'in:member,board_member,chairman',
            'science_club_guardian' => 'min:1|max:70',
            'science_club_information' => 'min:1|max:100',
            'employee_universities'=>'in:1,0',
            'facture'=>'in:1,0',
            'facture_information'=>'min:3|max:255',
            'company'=>'in:1,0',
            'company_profile' => 'min:1|max:50',
            'company_name' => 'min:1|max:50',
            'company_nip' => 'size:10|numeric',
            'school_institute' => 'min:1|max:50',
            'school_establishment' => 'min:1|max:50',
        ];
    }
}
