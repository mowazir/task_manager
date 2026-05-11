<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
     public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:200', 'unique:users,email'],
            'password' => ['required', 'string', 'confrimed', Password::defaults()],
        ];
    }

    public function messages(): array
        {
            return [
            'name.required' =>'Please enter a name',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Email entered not valid',
            'email.unique' => 'Email already taken ',
            'password.required' => 'Kindly input password',
            'passowrd.confirmed' => 'password does not match'
            ];
    }
    
}
