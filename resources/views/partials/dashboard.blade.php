@extends('layouts.app')

@section('content')

<canvas id="particles-dashboard"></canvas>

<div class="dashboard-wrapper">

    <!-- Sidebar -->
    <div class="dash-sidebar">
        <div class="dash-logo">🧠 MindMapQuiz</div>

        <p class="dash-menu-label">MENU</p>
        <ul class="dash-nav">
    <li class="active"><a href="{{ route('dashboard') }}">📊 Dashboard</a></li>
    <li><a href="{{ route('dashboard.quiz') }}">📝 Take Quiz</a></li>
    <li><a href="{{ route('quiz.history') }}">🕐 Quiz History</a></li>
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
            <div class="dash-avatar">
                {{ strtoupper(substr($student->full_name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $student->full_name)[1] ?? '', 0, 1)) }}
            </div>
            <div>
                <strong>{{ $student->full_name }}</strong>
                <small>Student</small>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="dash-main">

        <!-- Header -->
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">
                    Welcome back, {{ explode(' ', $student->full_name)[0] }}!
                </h2>
                <p class="dash-latest">
                    @if(!empty($latestResult))
                        Latest result:
                        <span class="badge-visual">{{ $latestResult->dominant_style }} Learner</span>
                    @else
                        Latest result:
                        <span class="badge-visual">Take a quiz first</span>
                    @endif
                </p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('dashboard.quiz') }}" class="btn-start-quiz">▶ Take Quiz</a>
                <div class="dash-avatar-sm">
                    {{ strtoupper(substr($student->full_name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $student->full_name)[1] ?? '', 0, 1)) }}
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <!-- Stats Cards -->
        <div class="dash-stats">
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <p class="stat-label">Quizzes Taken</p>
                <h3 class="stat-value">{{ $quizCount }}</h3>
                <small class="stat-sub">{{ $quizCount > 0 ? 'Latest progress shown below' : 'No quizzes yet' }}</small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <p class="stat-label">Dominant Style</p>
                <h3 class="stat-value">{{ $latestResult->dominant_style ?? '—' }}</h3>
                <small class="stat-sub">{{ $latestResult ? 'Most recent result' : 'Take a quiz first' }}</small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">❌</div>
                <p class="stat-label">Secondary Style</p>
                <h3 class="stat-value">{{ $latestResult->secondary_style ?? '—' }}</h3>
                <small class="stat-sub">{{ $latestResult ? 'Most recent result' : 'Take a quiz first' }}</small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💡</div>
                <p class="stat-label">Tips Viewed</p>
                <h3 class="stat-value">0</h3>
                <small class="stat-sub">This week</small>
            </div>
        </div>

        <!-- VARK Profile -->
        <div class="dash-card">
            <h5 class="dash-card-title">Your VARK Profile</h5>
            @if(!empty($latestResult))
                <div class="profile-summary">
                    <p style="color:#9a9aae;font-size:0.9rem; margin-bottom:15px;">
                        Your most recent quiz shows how you learn best.
                    </p>

                    <div style="max-width: 250px; margin: 0 auto 20px;">
                        <canvas id="varkPieChart" height="250"></canvas>
                    </div>

                    <div class="result-scores" style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;text-align:center;">
                        <div><strong style="color:#b89cff">Visual</strong><br>{{ min($latestResult->visual_pct, 100) }}%</div>
                        <div><strong style="color:#7de8c4">Auditory</strong><br>{{ min($latestResult->auditory_pct, 100) }}%</div>
                        <div><strong style="color:#ffc078">Reading/Writing</strong><br>{{ min($latestResult->read_write_pct, 100) }}%</div>
                        <div><strong style="color:#ff9cd9">Kinesthetic</strong><br>{{ min($latestResult->kinesthetic_pct, 100) }}%</div>
                    </div>
                    @if(!empty($latestRecommendation))
                        <div class="recommendation-box" style="margin-top:20px;padding:15px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:12px;">
                            <h6 style="margin-bottom:10px;color:#f1f1ff;">Recommended study tip</h6>
                            <p style="color:#c8c8da;margin-bottom:0;">{{ $latestRecommendation->study_techniques }}</p>
                        </div>
                    @endif
                    <a href="{{ route('dashboard.quiz') }}" class="btn-start-quiz" style="display:inline-block;text-decoration:none;margin-top:10px">
                        ▶ Retake Quiz
                    </a>
                </div>
            @else
                <p style="color:#9a9aae;font-size:0.9rem">
                    Take the VARK quiz to see your learning style profile here.
                </p>
                <a href="{{ route('dashboard.quiz') }}" class="btn-start-quiz" 
                   style="display:inline-block;text-decoration:none;margin-top:10px">
                    ▶ Start Quiz Now
                </a>
            @endif
        </div>

        <!-- Study Tips -->
        <div class="dash-card">
            <h5 class="dash-card-title">Recommended Study Tips</h5>

            <div class="tip-item">
                <div class="tip-icon tip-blue">📊</div>
                <div>
                    <strong>Use mind maps & diagrams</strong>
                    <p>Convert notes into visual diagrams to retain information.</p>
                </div>
            </div>
            <div class="tip-item">
                <div class="tip-icon tip-teal">🎥</div>
                <div>
                    <strong>Watch educational videos</strong>
                    <p>YouTube tutorials help visual learners understand faster.</p>
                </div>
            </div>
            <div class="tip-item">
                <div class="tip-icon tip-purple">✋</div>
                <div>
                    <strong>Hands-on practice</strong>
                    <p>Labs and projects support your kinesthetic side.</p>
                </div>
            </div>
        </div>

        <!-- Quiz History -->
        <div class="dash-card">
            <h5 class="dash-card-title">Quiz History</h5>
            @if($quizCount > 0)
                <p style="color:#9a9aae;font-size:0.9rem">
                    You have completed {{ $quizCount }} quiz{{ $quizCount > 1 ? 'zes' : '' }}.
                    <a href="{{ route('quiz.history') }}" style="color:#b89cff">View your quiz history</a>
                </p>
            @else
                <p style="color:#9a9aae;font-size:0.9rem">
                    No quiz attempts yet.
                    <a href="{{ route('dashboard.quiz') }}" style="color:#b89cff">Take your first quiz!</a>
                </p>
            @endif
        </div>

    </div>
</div>

@if(!empty($latestResult))
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('varkPieChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Visual', 'Auditory', 'Reading/Writing', 'Kinesthetic'],
            datasets: [{
                data: [
                    {{ min($latestResult->visual_pct, 100) }},
                    {{ min($latestResult->auditory_pct, 100) }},
                    {{ min($latestResult->read_write_pct, 100) }},
                    {{ min($latestResult->kinesthetic_pct, 100) }}
                ],
                backgroundColor: ['#b89cff', '#7de8c4', '#ffc078', '#ff9cd9'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            }
        }
    });
});
</script>
@endif

@endsection