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
                <div class="dash-avatar"
                     style="width:70px;height:70px;font-size:1.5rem">
                    {{ strtoupper(substr($admin->name, 0, 2)) }}
                </div>
                <div>
                    <h4 style="color:#fff;margin:0">{{ $admin->name }}</h4>
                    <p style="color:#9a9aae;margin:0">{{ $admin->email }}</p>
                    <span class="badge-visual" style="font-size:0.75rem">
                        Administrator
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="auth-label">FULL NAME</label>
                        <input type="text" name="name" class="auth-input"
                               value="{{ $admin->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="auth-label">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="auth-input"
                               value="{{ $admin->email }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="auth-label">
                            NEW PASSWORD
                            <span style="color:#6e6e85;font-weight:400">
                                (leave blank to keep)
                            </span>
                        </label>
                        <input type="password" name="password"
                               class="auth-input" placeholder="New password">
                    </div>
                    <div class="col-md-6">
                        <label class="auth-label">CONFIRM PASSWORD</label>
                        <input type="password" name="password_confirmation"
                               class="auth-input" placeholder="Confirm password">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn-auth-gradient">
                            💾 Save Changes
                        </button>
                    </div>
                </div>
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
                <span style="color:#fff">
                    {{ date('d M Y', strtotime($admin->created_at)) }}
                </span>
            </div>
            <div class="history-row">
                <span style="color:#9a9aae">Email</span>
                <span style="color:#fff">{{ $admin->email }}</span>
            </div>
        </div>

    </div>
</div>
@endsection