<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LecturerRegistrationTest extends TestCase
{
    use WithoutMiddleware;

    public function test_lecturer_registration_creates_a_lecturer_account()
    {
        $email = 'lecturer-' . uniqid() . '@example.com';

        $response = $this->post('/register', [
            'first_name' => 'Test',
            'last_name' => 'Lecturer',
            'email' => $email,
            'index_number' => '',
            'role' => 'lecturer',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'terms' => 'on',
        ]);

        $response->assertRedirect(route('lecturer'));
        $this->assertDatabaseHas('lecturers', ['email' => $email]);
        $this->assertTrue(session()->has('lecturer_id'));
    }

    public function test_student_registration_redirects_to_dashboard_with_success_message()
    {
        $email = 'student-' . uniqid() . '@example.com';

        $response = $this->post('/register', [
            'first_name' => 'Test',
            'last_name' => 'Student',
            'email' => $email,
            'index_number' => 'ST12345',
            'role' => 'student',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'terms' => 'on',
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Registration successful! Welcome to your dashboard.');
        $this->assertDatabaseHas('students', ['email' => $email]);
    }

    public function test_lecturer_login_redirects_to_the_lecturer_dashboard()
    {
        $email = 'lecturer-login-' . uniqid() . '@example.com';

        $lecturerId = DB::table('lecturers')->insertGetId([
            'name' => 'Test Lecturer',
            'email' => $email,
            'password_hash' => Hash::make('secret123'),
            'role' => 'lecturer',
            'created_at' => now(),
        ]);

        $response = $this->post('/login', [
            'email' => $email,
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('lecturer'));
        $this->assertTrue(session()->has('lecturer_id'));
        $this->assertSame($lecturerId, session('lecturer_id'));
    }
}
