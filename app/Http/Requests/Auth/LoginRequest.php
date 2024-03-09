<?php

namespace App\Http\Requests\auth;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class LoginRequest extends FormRequest
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
            'role'=>[
                'required',
                ValidationRule::in([
                    UserRole::Author,
                ])
            ],
            'password'=>[
                'required',
            ],
            'email'=>[
                'required',
            ],
        ];
    }
}
