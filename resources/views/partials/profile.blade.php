@extends('layouts.app')

@section('content')
<canvas id="particles-dashboard"></canvas>

<div class="dashboard-wrapper">
    <div class="dash-sidebar">
        <div class="dash-logo">🧠 MindMapQuiz</div>
        <p class="dash-menu-label">MENU</p>
        <ul class="dash-nav">
            <li><a href="{{ route('dashboard') }}">📊 Dashboard</a></li>
            <li><a href="{{ route('dashboard.quiz') }}">📝 Take Quiz</a></li>
            <li><a href="{{ route('quiz.history') }}">🕐 Quiz History</a></li>
            <li><a href="{{ route('study.tips') }}">💡 Study Tips</a></li>
            <li><a href="{{ route('progress') }}">📈 Progress</a></li>
        </ul>
        <p class="dash-menu-label">ACCOUNT</p>
        <ul class="dash-nav">
            <li class="active"><a href="{{ route('profile') }}">👤 My Profile</a></li>
            <li><a href="{{ route('feedback') }}">💬 Feedback</a></li>
            <li><a href="{{ route('logout') }}" class="logout-link">🚪 Logout</a></li>
        </ul>
        <div class="dash-user">
            @if(!empty($student->profile_photo))
                <img src="{{ asset('profile_photos/' . $student->profile_photo) }}" 
                     alt="Profile photo" 
                     class="dash-avatar" 
                     style="object-fit:cover;" />
            @else
                <div class="dash-avatar">{{ strtoupper(substr($student->full_name, 0, 2)) }}</div>
            @endif
            <div>
                <strong>{{ $student->full_name }}</strong>
                <small>Student</small>
            </div>
        </div>
    </div>

    <div class="dash-main">
            @if(session('success'))
                <div class="alert alert-success" style="margin-bottom: 16px; padding: 12px 16px; background: rgba(40,167,69,.12); color: #28a745; border-radius: 8px;">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger" style="margin-bottom: 16px; padding: 12px 16px; background: rgba(220,53,69,.12); color: #dc3545; border-radius: 8px;">
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="d-flex align-items-start gap-4 mb-4">
                <div style="position:relative;width:90px;height:90px;">
                    @if(!empty($student->profile_photo))
                        <img src="{{ asset('profile_photos/' . $student->profile_photo) }}" 
                             alt="Profile photo" 
                             style="width:90px;height:90px;border-radius:20px;object-fit:cover;border:2px solid rgba(255,255,255,0.15);">
                    @else
                        <div class="dash-avatar" style="width:90px;height:90px;font-size:2rem;line-height:90px;">
                            {{ strtoupper(substr($student->full_name, 0, 2)) }}
                        </div>
                    @endif
                </div>
                <div style="flex:1;">
                    <h4 style="color:#fff;margin:0">{{ $student->full_name }}</h4>
                    <div style="margin-top:10px;">
                        <div style="color:#c8c8da;margin-bottom:8px;">
                            <strong>Email:</strong> {{ $student->email }}
                        </div>
                        <div style="color:#c8c8da;margin-bottom:8px;">
                            <strong>Index Number:</strong> {{ $student->index_number ?? 'N/A' }}
                        </div>
                        <div style="color:#c8c8da;margin-bottom:8px;">
                            <strong>Role:</strong> {{ ucfirst($student->role ?? 'student') }}</div>
                        <div style="color:#c8c8da;">
                            <strong>Member Since:</strong> {{ date('Y-m-d', strtotime($student->created_at)) }}</div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="auth-label">PROFILE PHOTO</label>
                    <input type="file" name="profile_photo" class="auth-input" accept="image/*">
                </div>

                <div class="form-group">
                    <label class="auth-label">FULL NAME</label>
                    <input type="text" name="full_name" class="auth-input"
                           value="{{ $student->full_name }}">
                </div>

                <div class="form-group">
                    <label class="auth-label">EMAIL ADDRESS</label>
                    <input type="email" name="email" class="auth-input"
                           value="{{ $student->email }}">
                </div>

                <div class="form-group">
                    <label class="auth-label">INDEX NUMBER</label>
                    <input type="text" name="index_number" class="auth-input"
                           value="{{ $student->index_number ?? '' }}">
                </div>

                <div class="form-group">
                    <label class="auth-label">NEW PASSWORD</label>
                    <input type="password" name="password" class="auth-input"
                           placeholder="New password">
                </div>

                <button type="submit" class="btn-auth-gradient mt-3">
                    Update Profile
                </button>
            </form>
        </div>
    </div>
</div>
@endsection