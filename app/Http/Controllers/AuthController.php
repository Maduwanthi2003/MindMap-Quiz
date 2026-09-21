<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showRegister()
    {
        $adminExists = DB::table('admins')->exists() || DB::table('students')->where('role','admin')->exists();

        return view('register', compact('adminExists'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => ['required', 'email', Rule::unique('students', 'email'), Rule::unique('lecturers', 'email'), Rule::unique('admins', 'email')],
            'index_number' => $request->role === 'lecturer' ? 'nullable|string|max:50' : 'nullable|string|max:50',
            'role'         => 'required|in:student,lecturer,admin',
            'password'     => 'required|min:6|confirmed',
            'terms'        => 'accepted',
        ], [
            'email.unique' => 'This email is already in use.',
            'email.required' => 'Email is required.',
            'terms.accepted' => 'You must accept the terms to register.',
        ]);

        if ($request->role === 'admin') {
            if (DB::table('admins')->exists()) {
                return back()
                    ->withErrors(['role' => 'An admin account already exists. Please sign in.'])
                    ->withInput();
            }
        }

        $indexNumber = $request->role === 'lecturer'
            ? 'LEC-' . strtoupper(substr($request->first_name, 0, 2)) . '-' . date('Y') . '-' . rand(100, 999)
            : $request->index_number;

        if ($request->role === 'lecturer') {
            $existingLecturer = DB::table('lecturers')
                                   ->where('email', $request->email)
                                   ->first();

            if ($existingLecturer) {
                return redirect()->route('login')
                                 ->with('success', 'This lecturer account already exists. Please sign in.');
            }

            $lecturerId = DB::table('lecturers')->insertGetId([
                'name'          => $request->first_name . ' ' . $request->last_name,
                'email'         => $request->email,
                'password_hash' => Hash::make($request->password),
                'role'          => 'lecturer',
                'created_at'    => now(),
            ]);

            session()->flush();
            session([
                'lecturer_id'   => $lecturerId,
                'lecturer_name' => $request->first_name . ' ' . $request->last_name,
                'role'          => 'lecturer',
            ]);

            return redirect()->route('lecturer');
        }

        if ($request->role === 'admin') {
            $adminId = DB::table('admins')->insertGetId([
                'name'          => $request->first_name . ' ' . $request->last_name,
                'email'         => $request->email,
                'password_hash' => Hash::make($request->password),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            session()->flush();
            session([
                'admin_id'    => $adminId,
                'admin_name'  => $request->first_name . ' ' . $request->last_name,
                'role'        => 'admin',
            ]);

            return redirect()->route('admin');
        }

        $studentId = DB::table('students')->insertGetId([
            'full_name'     => $request->first_name . ' ' . $request->last_name,
            'email'         => $request->email,
            'index_number'  => $indexNumber,
            'password_hash' => Hash::make($request->password),
            'role'          => $request->role,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $student = DB::table('students')->where('student_id', $studentId)->first();

        session()->flush();

        session([
            'student_id'    => $student->student_id,
            'student_name'  => $student->full_name,
            'student_email' => $student->email,
            'role'          => $student->role,
        ]);

        if ($student->role === 'admin') {
            return redirect()->route('admin')->with('success', 'Registration successful! You are now logged in.');
        }

        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to your dashboard.');
    }

    public function showLogin()
    {
        return view('partials.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
        ]);

        // Check admins table first
        $admin = DB::table('admins')->where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password_hash)) {
            session()->flush();
            session([
                'admin_id'   => $admin->admin_id,
                'admin_name' => $admin->name,
                'role'       => 'admin',
            ]);
            return redirect()->route('admin');
        }

        $student = DB::table('students')
                     ->where('email', $request->email)
                     ->first();

        if ($student && Hash::check($request->password, $student->password_hash)) {
            session()->flush();

            session([
                'student_id'    => $student->student_id,
                'student_name'  => $student->full_name,
                'student_email' => $student->email,
                'role'          => $student->role,
            ]);

            if ($student->role === 'lecturer') {
                return redirect()->route('lecturer');
            }

            return redirect()->route('dashboard');
        }

        $lecturer = DB::table('lecturers')
                     ->where('email', $request->email)
                     ->first();

        if ($lecturer && Hash::check($request->password, $lecturer->password_hash)) {
            session()->flush();

            session([
                'lecturer_id'   => $lecturer->lecturer_id,
                'lecturer_name' => $lecturer->name,
                'role'          => 'lecturer',
            ]);

            return redirect()->route('lecturer');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}