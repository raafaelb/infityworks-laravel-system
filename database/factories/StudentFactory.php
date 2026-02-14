<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $user = User::factory()->create([
            'role' => UserRole::STUDENT,
            'password' => Hash::make('123456')
        ]);

        return [
            'birth_date' => $this->faker->date(),
            'user_id' => $user->id,
        ];
    }
}
