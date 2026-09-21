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
            <li class="active"><a href="{{ route('progress') }}">📈 Progress</a></li>
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
                <h2 class="dash-welcome">My Progress</h2>
                <p class="dash-latest">Track your VARK learning style over time</p>
            </div>
        </div>

        @if($attempts->isEmpty())
        <div class="dash-card">
            <p style="color:#9a9aae">No progress data yet.
                <a href="{{ route('quiz') }}" style="color:#b89cff">Take your first quiz!</a>
            </p>
        </div>
        @else
        <!-- Progress Stats -->
        <div class="dash-stats">
            <div class="stat-card">
                <div class="stat-icon">📝</div>
                <p class="stat-label">Total Attempts</p>
                <h3 class="stat-value">{{ $attempts->count() }}</h3>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <p class="stat-label">Best Visual</p>
                <h3 class="stat-value">{{ min($attempts->max('visual_pct'), 100) }}%</h3>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <p class="stat-label">Best Kinesthetic</p>
                <h3 class="stat-value">{{ min($attempts->max('kinesthetic_pct'), 100) }}%</h3>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🎯</div>
                <p class="stat-label">Dominant Style</p>
                <h3 class="stat-value" style="font-size:1rem">
                    {{ $attempts->last()->dominant_style ?? '—' }}
                </h3>
            </div>
        </div>

        <!-- Progress Chart -->
        <div class="dash-card">
            <h5 class="dash-card-title">VARK Score Trends</h5>
            <canvas id="progressChart" height="100"></canvas>
        </div>

        <!-- Attempt History -->
        <div class="dash-card">
            <h5 class="dash-card-title">Attempt History</h5>
            @foreach($attempts as $i => $a)
            <div style="margin-bottom:20px">
                <div class="d-flex justify-content-between mb-2">
                    <strong style="color:#fff">Attempt #{{ $i + 1 }}</strong>
                    <small style="color:#6e6e85">{{ date('Y-m-d', strtotime($a->started_at)) }}</small>
                </div>
                <div class="vark-bar-row">
                    <span>Visual</span>
                    <div class="vark-bar-track">
                        <div class="vark-bar-fill vark-purple" style="width:{{ min($a->visual_pct, 100) }}%"></div>
                    </div>
                    <span>{{ min($a->visual_pct, 100) }}%</span>
                </div>
                <div class="vark-bar-row">
                    <span>Auditory</span>
                    <div class="vark-bar-track">
                        <div class="vark-bar-fill vark-teal" style="width:{{ min($a->auditory_pct, 100) }}%"></div>
                    </div>
                    <span>{{ min($a->auditory_pct, 100) }}%</span>
                </div>
                <div class="vark-bar-row">
                    <span>Read/Write</span>
                    <div class="vark-bar-track">
                        <div class="vark-bar-fill vark-yellow" style="width:{{ min($a->read_write_pct, 100) }}%"></div>
                    </div>
                    <span>{{ min($a->read_write_pct, 100) }}%</span>
                </div>
                <div class="vark-bar-row">
                    <span>Kinesthetic</span>
                    <div class="vark-bar-track">
                        <div class="vark-bar-fill vark-pink" style="width:{{ min($a->kinesthetic_pct, 100) }}%"></div>
                    </div>
                    <span>{{ min($a->kinesthetic_pct, 100) }}%</span>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@if(!$attempts->isEmpty())
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('progressChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($attempts as $i => $a)
                'Attempt {{ $i + 1 }}',
            @endforeach
        ],
        datasets: [
            {
                label: 'Visual',
                data: [{{ $attempts->pluck('visual_pct')->implode(',') }}],
                borderColor: '#9b6bff',
                tension: 0.4,
                fill: false
            },
            {
                label: 'Auditory',
                data: [{{ $attempts->pluck('auditory_pct')->implode(',') }}],
                borderColor: '#4dd0e1',
                tension: 0.4,
                fill: false
            },
            {
                label: 'Read/Write',
                data: [{{ $attempts->pluck('read_write_pct')->implode(',') }}],
                borderColor: '#ffc078',
                tension: 0.4,
                fill: false
            },
            {
                label: 'Kinesthetic',
                data: [{{ $attempts->pluck('kinesthetic_pct')->implode(',') }}],
                borderColor: '#ff6bcb',
                tension: 0.4,
                fill: false
            }
        ]
    },
    options: {
        plugins: { legend: { labels: { color: '#b9b9c9' } } },
        scales: {
            x: { ticks: { color: '#9a9aae' }, grid: { color: 'rgba(255,255,255,0.05)' } },
            y: { ticks: { color: '#9a9aae' }, grid: { color: 'rgba(255,255,255,0.05)' }, max: 100 }
        }
    }
});
</script>
@endif

@endsection