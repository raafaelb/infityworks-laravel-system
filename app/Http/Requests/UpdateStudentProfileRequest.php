<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isStudent();
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'birth_date' => 'nullable|date',
            'password'   => 'nullable|min:6|confirmed',
        ];
    }
}
