<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|unique:users|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => [
                'required',
                Password::min(8)->letters()
            ],
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     $errors = $validator->errors()->all();
    //     $response = response()->json([
    //         'message' => implode(' ', $errors),
    //         'errors' => true
    //     ], 422);

    //     throw new HttpResponseException($response);
    // }
}
