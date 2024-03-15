<?php

namespace App\Http\Requests\User;

use App\Rules\User\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password'=>['required', new MatchOldPassword],
            'new_password'=>[
                        'required',
                        'min:8',
                        'confirmed',
                        'regex:/[a-z]/',
                        'regex:/[A-Z]/',
                        'regex:/[0-9]/',
                        'regex:/[@$!%*#?&]/', 
                        ],
            'new_password_confirmation'=>['required', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required'=>':attribute must be fill.',

            'new_password' => [
                'required' => ':attribute must be fill.',
                'min'      => ':attribute must more than 8 characters.',
                'confirmed'=> ':attribute must match the confirmation password',
                'regex'=> ':attribute must include numbers, lowercase and uppercase letters, and special characters.',
            ],

            'new_password_confirmation' => [
                'required' => ':attribute must be fill.',
                'min'      => ':attribute must more than 8 characters.',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'current_password'=> 'Current password',
            'new_password'=> 'New password',
            'new_password_confirmation'=> 'New password confirmation',
        ];
    }
}
