<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_routes()
    {
        $admin = User::factory()->create([
            'role' => UserRole::ADMIN
        ]);

        $response = $this->actingAs($admin)
            ->get('/admin/courses');

        $response->assertStatus(200);
    }

    public function test_student_cannot_access_admin_routes()
    {
        $student = User::factory()->create([
            'role' => UserRole::STUDENT
        ]);

        $response = $this->actingAs($student)
            ->get('/admin/courses');

        $response->assertStatus(403);
    }
}
