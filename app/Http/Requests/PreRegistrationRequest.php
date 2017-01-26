<?php

namespace Aska\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreRegistrationRequest extends FormRequest
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
            'user_type'=>'required|in:student,phdstudent,graduate,guardian'
        ];
    }
}
