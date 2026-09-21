@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.admin-sidebar')
    <div class="dash-main">

        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Edit Student</h2>
                <p class="dash-latest">Manage the selected student account</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <div class="dash-card">
                    <form method="POST" action="{{ route('admin.students.update', $student->student_id) }}" autocomplete="off">
                @csrf

                <div class="form-group">
                    <label class="auth-label">FULL NAME</label>
                            <input type="text" name="full_name" class="auth-input" autocomplete="name" required>
                </div>

                <div class="form-group">
                    <label class="auth-label">EMAIL ADDRESS</label>
                            <input type="email" name="email" class="auth-input" autocomplete="email" required>
                </div>

                <div class="form-group">
                    <label class="auth-label">INDEX NUMBER</label>
                            <input type="text" name="index_number" class="auth-input" autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="auth-label">NEW PASSWORD</label>
                    <input type="password" name="password" class="auth-input"
                           placeholder="Set new password (optional)">
                </div>

                <button type="submit" class="btn-auth-gradient mt-3">
                    Update Student
                </button>
            </form>
        </div>

        <div class="dash-card mt-4">
            <h5 class="dash-card-title">Student Information</h5>
            <div class="history-row">
                <span style="color:#9a9aae">Email</span>
                <span style="color:#fff">{{ $student->email }}</span>
            </div>
            <div class="history-row">
                <span style="color:#9a9aae">Registered</span>
                <span style="color:#fff">{{ date('d M Y', strtotime($student->created_at)) }}</span>
            </div>
            <div class="history-row">
                <span style="color:#9a9aae">Last Quiz</span>
                <span style="color:#fff">{{ $student->dominant_style ?? 'No quiz taken' }}</span>
            </div>
        </div>

    </div>
</div>
@endsection