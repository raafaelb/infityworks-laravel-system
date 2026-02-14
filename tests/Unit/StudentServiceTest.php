<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Student;
use App\Models\User;
use App\Services\StudentService;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class StudentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_student_and_user()
    {
        $service = new StudentService();

        $student = $service->create([
            'name' => 'João',
            'email' => 'joao@test.com',
            'password' => '123456',
            'birth_date' => now()->subYears(20),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'joao@test.com',
            'role' => UserRole::STUDENT,
        ]);

        $this->assertDatabaseHas('students', [
            'user_id' => $student->user_id,
        ]);

        $this->assertInstanceOf(Student::class, $student);
    }

    public function test_it_updates_name_and_email()
    {
        $service = new StudentService();

        $student = Student::factory()->create();

        $service->update($student, [
            'name' => 'Novo Nome',
            'email' => 'novo@email.com',
        ]);

        $this->assertEquals('Novo Nome', $student->refresh()->name);
        $this->assertEquals('novo@email.com', $student->email);
    }

    public function test_password_is_updated_only_when_provided()
    {
        $service = new StudentService();

        $student = Student::factory()->create();
        $originalPassword = $student->user->password;

        $service->update($student, [
            'name' => 'Teste',
            'email' => $student->email,
        ]);

        $this->assertEquals($originalPassword, $student->refresh()->user->password);

        $service->update($student, [
            'name' => 'Teste',
            'email' => $student->email,
            'password' => 'nova-senha',
        ]);

        $this->assertTrue(
            Hash::check('nova-senha', $student->refresh()->user->password)
        );
    }

    public function test_delete_removes_user_and_student()
    {
        $service = new StudentService();

        $student = Student::factory()->create();
        $userId = $student->user_id;

        $service->delete($student);

        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $userId,
        ]);
    }
}
