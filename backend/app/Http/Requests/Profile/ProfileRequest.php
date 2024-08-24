<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:2048|',
            'email' => 'required|email|max:255|' . Rule::unique('users')->ignore(Auth::id()),
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
        ];
    }
}
