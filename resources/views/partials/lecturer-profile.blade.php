@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.lecturer-sidebar')
    <div class="dash-main">

        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">My Profile</h2>
                <p class="dash-latest">Manage your lecturer account</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <div class="dash-card">
            <!-- Avatar -->
            <div class="d-flex align-items-center gap-4 mb-4">
                <div class="dash-avatar" style="width:70px;height:70px;">
                    @if(!empty($lecturer->profile_photo))
                        <img src="{{ asset('profile_photos/' . $lecturer->profile_photo) }}" alt="Profile photo">
                    @else
                        <span style="font-size:1.5rem;">{{ strtoupper(substr($lecturer->name, 0, 2)) }}</span>
                    @endif
                </div>
                <div>
                    <h4 style="color:#fff;margin:0">{{ $lecturer->name }}</h4>
                    <p style="color:#9a9aae;margin:0">{{ $lecturer->email }}</p>
                    <small style="color:#6e6e85">Lecturer · MindMap Quiz</small>
                </div>
            </div>

            <form method="POST" action="{{ route('lecturer.profile.update') }}" enctype="multipart/form-data">
                @csrf

                @if(!empty($lecturer->profile_photo))
                    <div class="profile-photo-preview">
                        <img src="{{ asset('profile_photos/' . $lecturer->profile_photo) }}" alt="Current profile photo">
                        <span>Current profile photo</span>
                    </div>
                @endif

                <div class="form-group">
                    <label class="auth-label">PROFILE PHOTO</label>
                    <input type="file" name="profile_photo" class="auth-input" accept="image/*">
                </div>

                <div class="form-group">
                    <label class="auth-label">FULL NAME</label>
                    <input type="text" name="name" class="auth-input"
                           value="{{ $lecturer->name }}" required>
                </div>

                <div class="form-group">
                    <label class="auth-label">EMAIL ADDRESS</label>
                    <input type="email" name="email" class="auth-input"
                           value="{{ $lecturer->email }}" required>
                </div>

                <div class="form-group">
                    <label class="auth-label">
                        NEW PASSWORD
                        <span style="color:#6e6e85;font-weight:400">
                        
                        </span>
                    </label>
                    <input type="password" name="password" class="auth-input"
                           placeholder="New password">
                </div>

                <div class="form-group">
                    <label class="auth-label">CONFIRM NEW PASSWORD</label>
                    <input type="password" name="password_confirmation" class="auth-input"
                           placeholder="Confirm new password">
                </div>

                <button type="submit" class="btn-auth-gradient mt-3">
                    Update Profile
                </button>
            </form>
        </div>

        <!-- Account Info -->
        <div class="dash-card mt-4">
            <h5 class="dash-card-title">Account Information</h5>
            <div class="history-row">
                <span style="color:#9a9aae">Role</span>
                <span class="badge-visual">Lecturer</span>
            </div>
            <div class="history-row">
                <span style="color:#9a9aae">Member Since</span>
                <span style="color:#fff">
                    {{ date('d M Y', strtotime($lecturer->created_at)) }}
                </span>
            </div>
            <div class="history-row">
                <span style="color:#9a9aae">Email</span>
                <span style="color:#fff">{{ $lecturer->email }}</span>
            </div>
        </div>

    </div>
</div>
@endsection