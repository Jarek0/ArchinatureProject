<?php

namespace Aska\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
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
            'presentation' => 'max:25600|mimes:rar,zip,txt,doc,pdf,docx,dotx,ptt,pptx,pptm,potx,potm',
            'summary' => 'max:25600|mimes:rar,zip,txt,doc,pdf,docx,dotx,ptt,pptx,pptm,potx,potm',
            'poliforum' => 'max:25600|mimes:rar,zip,txt,doc,pdf,docx,dotx,ptt,pptx,pptm,potx,potm'
        ];
    }
}
