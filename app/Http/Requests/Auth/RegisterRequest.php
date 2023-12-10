<?php

namespace App\Http\Requests\Auth;

use App\Enums\Gender;
use App\Rules\Pesel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'max:25', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'firstname' => ['required'],
            'lastname' => ['required'],
            'birth_date' => ['required', 'date'],
            'pesel' => ['required', new Pesel()],
            'gender' => ['required', Rule::enum(Gender::class)],
            'address' => ['required', 'string'],
            'zip_code' => ['required'],
            'city' => ['required'],
            'phone' => ['required'],
        ];
    }
}
