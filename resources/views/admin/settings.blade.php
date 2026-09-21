@extends('layouts.app')

@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.admin-sidebar')
    <div class="dash-main">

        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Settings</h2>
                <p class="dash-latest">Update your admin account details</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <div class="dash-card">
            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf

                <div class="form-group mb-3">
                    <label class="auth-label">FULL NAME</label>
                    <input type="text" name="full_name" class="auth-input" value="{{ $admin->full_name ?? $admin->name ?? '' }}" required>
                </div>

                <div class="form-group mb-3">
                    <label class="auth-label">EMAIL ADDRESS</label>
                    <input type="email" name="email" class="auth-input" value="{{ $admin->email ?? '' }}" required>
                </div>

                <div class="form-group mb-3">
                    <label class="auth-label">NEW PASSWORD</label>
                    <input type="password" name="password" class="auth-input" placeholder="Leave blank to keep current password">
                </div>

                <button type="submit" class="btn-auth-gradient mt-3">Save Settings</button>
                <a href="{{ route('admin.profile') }}" class="btn btn-secondary mt-3">Back to Profile</a>
            </form>
        </div>

    </div>
</div>
@endsection
