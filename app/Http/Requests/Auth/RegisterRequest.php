<?php

namespace App\Http\Requests\Auth;

use App\Enums\Gender;
use App\Rules\Email;
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
            'username' => ['required', 'alpha_dash', 'max:50', 'min:5', 'unique:users'],
            'email' => ['required', 'unique:users', new Email()],
            'password' => ['required'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'birth_date' => ['required', 'date'],
            'pesel' => ['required', new Pesel()],
            'gender' => ['required', Rule::enum(Gender::class)],
            'address' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
        ];
    }
}
