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
            <li class="active"><a href="{{ route('quiz.history') }}">🕐 Quiz History</a></li>
            <li><a href="{{ route('study.tips') }}">💡 Study Tips</a></li>
            <li><a href="{{ route('progress') }}">📈 Progress</a></li>
        </ul>
        <p class="dash-menu-label">ACCOUNT</p>
        <ul class="dash-nav">
            <li><a href="{{ route('profile') }}">👤 My Profile</a></li>
            <li><a href="{{ route('feedback') }}">💬 Feedback</a></li>
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
                <h2 class="dash-welcome">Quiz History</h2>
                <p class="dash-latest">All your past VARK quiz attempts</p>
            </div>
        </div>

        <div class="dash-card">
            @if($attempts->isEmpty())
                <p style="color:#9a9aae">No quiz attempts yet.
                    <a href="{{ route('quiz') }}" style="color:#b89cff">Take your first quiz!</a>
                </p>
            @else
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>DATE</th>
                            <th>DOMINANT STYLE</th>
                            <th>VISUAL</th>
                            <th>AUDITORY</th>
                            <th>READ/WRITE</th>
                            <th>KINESTHETIC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attempts as $i => $a)
                        <tr>
                            <td style="color:#9a9aae">Attempt #{{ $i + 1 }}</td>
                            <td style="color:#9a9aae">{{ date('Y-m-d', strtotime($a->started_at)) }}</td>
                            <td><span class="badge-visual">{{ $a->dominant_style }}</span></td>
                            <td><strong style="color:#b89cff">{{ min($a->visual_pct, 100) }}%</strong></td>
                            <td><strong style="color:#7de8c4">{{ min($a->auditory_pct, 100) }}%</strong></td>
                            <td><strong style="color:#ffc078">{{ min($a->read_write_pct, 100) }}%</strong></td>
                            <td><strong style="color:#ff9cd9">{{ min($a->kinesthetic_pct, 100) }}%</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection