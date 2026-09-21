@extends('layouts.app')

@section('content')

<canvas id="particles-admin"></canvas>

<div class="dashboard-wrapper">

    <!-- Sidebar -->
<div class="dash-sidebar">
    <div class="dash-logo">🧠 MindMapQuiz</div>

    <p class="dash-menu-label">ADMIN PANEL</p>
    <ul class="dash-nav">
        <li class="{{ Request::is('admin') ? 'active' : '' }}"><a href="{{ route('admin') }}">📊 Dashboard</a></li>
        <li class="{{ Request::is('admin/students*') ? 'active' : '' }}"><a href="{{ route('admin.students') }}">👥 Students</a></li>
        <li class="{{ Request::is('admin/quiz-results*') ? 'active' : '' }}"><a href="{{ route('admin.results') }}">📝 Quiz Results</a></li>
        <li class="{{ Request::is('admin/reports*') ? 'active' : '' }}"><a href="{{ route('admin.reports') }}">📈 Reports</a></li>
        <li class="{{ Request::is('admin/feedback*') ? 'active' : '' }}"><a href="{{ route('admin.feedback') }}">💬 Feedback</a></li>
    </ul>

    <p class="dash-menu-label">SETTINGS</p>
    <ul class="dash-nav">
        <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}"><a href="{{ route('admin.settings') }}">⚙️ System Settings</a></li>
        <li class="{{ Request::is('admin/profile*') ? 'active' : '' }}"><a href="{{ route('admin.profile') }}">👤 My Profile</a></li>
        <li><a href="{{ route('logout') }}" class="logout-link">🚪 Logout</a></li>
    </ul>

    <div class="dash-user">
        <div class="dash-avatar">{{ strtoupper(substr($admin->full_name ?? $admin->name ?? 'AD', 0, 2)) }}</div>
        <div>
            <strong>{{ $admin->full_name ?? $admin->name ?? 'Admin' }}</strong>
            <small>Administrator</small>
        </div>
    </div>
</div>

    <!-- Main Content -->
    <div class="dash-main">

        <!-- Header -->
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Admin Dashboard</h2>
                <p class="dash-latest">MindMap Quiz — Learning Style Identification System</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span style="font-size:1.3rem;">🔔</span>
                <div class="dash-avatar-sm">{{ strtoupper(substr($admin->full_name ?? $admin->name ?? 'AD', 0, 2)) }}</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="dash-stats">
            <div class="stat-card">
                <div class="stat-icon">👤</div>
                <p class="stat-label">Total Students</p>
                <h3 class="stat-value">{{ $studentCount }}</h3>
                <small class="stat-sub">Registered students</small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📝</div>
                <p class="stat-label">Quizzes Taken</p>
                <h3 class="stat-value">{{ $quizCount }}</h3>
                <small class="stat-sub">Quiz attempts</small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👁️</div>
                <p class="stat-label">Visual Learners</p>
                <h3 class="stat-value">{{ $visualCount > 0 ? round(($visualCount / max($studentCount, 1)) * 100) : 0 }}%</h3>
                <small class="stat-sub">Visual dominant</small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💬</div>
                <p class="stat-label">Feedback</p>
                <h3 class="stat-value">{{ $feedbackCount }}</h3>
                <small class="stat-sub">Total feedback</small>
            </div>
        </div>

        <!-- Recent Student Results -->
        <div class="dash-card">
            <h5 class="dash-card-title">Recent Student Results</h5>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>STUDENT</th>
                        <th>DATE</th>
                        <th>STYLE</th>
                        <th>SCORE</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentResults as $result)
                        <tr>
                            <td>
                                <div class="student-cell">
                                    <div class="dash-avatar" style="background:linear-gradient(135deg,#7b5cff,#4dd0e1)">{{ strtoupper(substr($result->full_name ?? 'ST', 0, 2)) }}</div>
                                    {{ $result->full_name ?? 'Student' }}
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($result->calculated_at)->format('Y-m-d') }}</td>
                            <td><span class="badge-visual">{{ $result->dominant_style ?? 'N/A' }}</span></td>
                            <td><strong style="color:#b89cff">{{ $result->visual_pct ?? 0 }}%</strong></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="color:#9a9aae">No quiz results yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- VARK Distribution -->
        <div class="dash-card">
            <h5 class="dash-card-title">VARK Distribution — All Students</h5>

            <div class="vark-bar-row">
                <span>Visual (V)</span>
                <div class="vark-bar-track">
                    <div class="vark-bar-fill vark-purple" style="width:43%"></div>
                </div>
                <span>43%</span>
            </div>
            <div class="vark-bar-row">
                <span>Kinesthetic (K)</span>
                <div class="vark-bar-track">
                    <div class="vark-bar-fill vark-pink" style="width:30%"></div>
                </div>
                <span>30%</span>
            </div>
            <div class="vark-bar-row">
                <span>Auditory (A)</span>
                <div class="vark-bar-track">
                    <div class="vark-bar-fill vark-teal" style="width:15%"></div>
                </div>
                <span>15%</span>
            </div>
            <div class="vark-bar-row">
                <span>Read/Write (R)</span>
                <div class="vark-bar-track">
                    <div class="vark-bar-fill vark-yellow" style="width:12%"></div>
                </div>
                <span>12%</span>
            </div>
        </div>

        <!-- Recent Feedback -->
        <div class="dash-card">
            <h5 class="dash-card-title">Recent Feedback</h5>

            @forelse($recentFeedback as $feedback)
                <div class="feedback-row">
                    <div>
                        <strong>{{ $feedback->full_name }}</strong>
                        <p>"{{ $feedback->comment }}"</p>
                    </div>
                    <div class="stars">{{ str_repeat('★', max(1, (int) $feedback->rating)) }}</div>
                </div>
            @empty
                <div class="feedback-row">
                    <div>
                        <strong>No feedback yet</strong>
                        <p>No student feedback has been submitted.</p>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</div>

@endsection