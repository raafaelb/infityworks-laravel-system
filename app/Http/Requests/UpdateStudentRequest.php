<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $student = $this->route('student');

        return [
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($student->user_id),
            ],

            'birth_date' => 'nullable|date',

            'password' => 'nullable|min:6|confirmed',
        ];
    }

}
