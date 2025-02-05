<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCsvRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:csv,txt|max:2048',
            'message'=>'required'
        ];
    }


    public function messages(): array
    {
        return [
            'file.required' => 'Please upload a file.',
            'file.file' => 'File must be valid.',
            'file.mimes' => 'The file field must be a file of type: csv, txt. File must not be empty.',
            'file.max' => 'The file must not exceed 2mb in size.',
            'message.required' => 'Please enter a message',
        ];
    }
    
}
