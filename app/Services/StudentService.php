<?php
namespace App\Services;

use App\Enums\UserRole;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StudentService
{
    public function list(array $filters = []): LengthAwarePaginator
    {
        return Student::query()
            ->filter($filters)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function create(array $data): Student
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => UserRole::STUDENT,
        ]);

        return Student::create([
            'birth_date' => $data['birth_date'] ?? null,
            'user_id' => $user->id,
        ]);
    }

    public function update(Student $student, array $data): Student
    {
        $student->update([
            'birth_date' => $data['birth_date'] ?? $student->birth_date,
        ]);

        $userData = [
            'name'  => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $userData['password'] = Hash::make($data['password']);
        }

        $student->user->update($userData);

        return $student;
    }

    public function getDashboardData(User $user): Student
    {
        return $user->student()
            ->with([
                'user',
                'enrollments.course.subjects.teacher',
            ])
            ->first();
    }

    public function delete(Student $student): void
    {
        $student->user()->delete();
    }
}
