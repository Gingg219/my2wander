<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:30',
            ],
            'email' => [
                'required',
                'max:50',
                Rule::unique('users', 'email')->ignore(auth()->user()->id)->whereNull('deleted_at'),
                'regex:/[\w.-]+@([\w-]+\.)+[\w-]{2,4}$/i'
            ],
            'mobile' => [
                'required',
                'numeric',
            ],
        ];
    }

    public function messages()
    {
        return [
             'name' => [
                'required' => 'This field must be fill',
                'max' => 'Please enter less than 30 characters',
            ],
            'email' => [
                'required' => 'This field must be fill',
                'max' => 'Please enter less than 50 characters',
                'unique' => 'This email already exists',
                'regex' => 'Please enter the correct email format',
            ],
            'mobile' => [
                'required' => 'This field must be fill',
                'numeric' => 'Please fill in the number format',
            ],
        ];
    }
}
