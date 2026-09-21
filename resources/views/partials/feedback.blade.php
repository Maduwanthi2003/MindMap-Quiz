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
            <li><a href="{{ route('profile') }}">👤 My Profile</a></li>
            <li class="active"><a href="{{ route('feedback') }}">💬 Feedback</a></li>
            <li><a href="{{ route('logout') }}" class="logout-link">🚪 Logout</a></li>
        </ul>
        <div class="dash-user">
            <div class="dash-avatar">{{ strtoupper(substr($student->full_name, 0, 2)) }}</div>
            <div>
                <strong>{{ $student->full_name }}</strong>
                <small>Student</small>
            </div>
        </div>
    </div>

    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Feedback</h2>
                <p class="dash-latest">Share your experience with MindMap Quiz</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <div class="dash-card">
            <h5 class="dash-card-title">Submit Feedback</h5>

            @if($errors->any())
                <div class="alert-error mb-3">{{ $errors->first() }}</div>
            @endif

            @if(session('success'))
                <div class="alert-success mb-3">✅ {{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('feedback.submit') }}">
                @csrf

                @if($errors->any())
                    <div class="alert-error mb-3">{{ $errors->first() }}</div>
                @endif

                <label class="auth-label">RATING</label>
                <div class="d-flex gap-3 mb-3">
                    @for($i = 1; $i <= 5; $i++)
                    <label style="cursor:pointer;color:#ffc078;font-size:1.5rem">
                        <input type="radio" name="rating" value="{{ $i }}"
                               style="display:none" {{ old('rating') == $i ? 'checked' : '' }}>
                        ★
                    </label>
                    @endfor
                </div>

                <label class="auth-label">COMMENT</label>
                <textarea name="comment" class="auth-input"
                          rows="5"
                          placeholder="Share your thoughts about MindMap Quiz..."
                          style="resize:vertical">{{ old('comment') }}</textarea>

                <button type="submit" class="btn-auth-gradient mt-3">
                    Submit Feedback
                </button>
            </form>
        </div>
    </div>
</div>
@endsection