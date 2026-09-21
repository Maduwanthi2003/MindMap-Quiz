@extends('layouts.app')

@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.admin-sidebar')
    <div class="dash-main">

        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">My Profile</h2>
                <p class="dash-latest">Manage your admin account</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <div class="dash-card">
            <div class="d-flex align-items-center gap-4 mb-4">
                <div class="dash-avatar" style="width:70px;height:70px;">
                    @if(!empty($admin->profile_photo))
                        <img src="{{ asset('profile_photos/' . $admin->profile_photo) }}" alt="Profile photo">
                    @else
                        <span style="font-size:1.5rem;">{{ strtoupper(substr($admin->name ?? 'AD', 0, 2)) }}</span>
                    @endif
                </div>
                <div>
                    <h4 style="color:#fff;margin:0">{{ $admin->full_name ?? $admin->name ?? 'Administrator' }}</h4>
                    <p style="color:#9a9aae;margin:0">{{ $admin->email }}</p>
                    <small style="color:#6e6e85">Admin · MindMap Quiz</small>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf

                <div class="form-group">
                    <label class="auth-label">FULL NAME</label>
                    <input type="text" name="full_name" class="auth-input" value="{{ $admin->full_name ?? $admin->name ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label class="auth-label">EMAIL ADDRESS</label>
                    <input type="email" name="email" class="auth-input" value="{{ $admin->email ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label class="auth-label">NEW PASSWORD</label>
                    <input type="password" name="password" class="auth-input" placeholder="Leave blank to keep current password">
                </div>

                <button type="submit" class="btn-auth-gradient mt-3">Update Profile</button>
            </form>
        </div>

        <div class="dash-card mt-4">
            <h5 class="dash-card-title">Account Information</h5>
            <div class="history-row">
                <span style="color:#9a9aae">Role</span>
                <span class="badge-visual">Administrator</span>
            </div>
            <div class="history-row">
                <span style="color:#9a9aae">Member Since</span>
                <span style="color:#fff">{{ optional($admin->created_at ? \Carbon\Carbon::parse($admin->created_at): null)->format('d M Y') ?? 'N/A' }}</span>
            </div>
            <div class="history-row">
                <span style="color:#9a9aae">Email</span>
                <span style="color:#fff">{{ $admin->email ?? 'N/A' }}</span>
            </div>
        </div>

    </div>
</div>
@endsection
