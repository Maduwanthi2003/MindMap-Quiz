@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.admin-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Reports</h2>
                <p class="dash-latest">System analytics and learning style statistics</p>
            </div>
        </div>

        <div class="dash-stats">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <p class="stat-label">Total Students</p>
                <h3 class="stat-value">{{ $totalStudents }}</h3>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📝</div>
                <p class="stat-label">Quiz Attempts</p>
                <h3 class="stat-value">{{ $totalAttempts }}</h3>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👨‍🏫</div>
                <p class="stat-label">Lecturers</p>
                <h3 class="stat-value">{{ $totalLecturers }}</h3>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <p class="stat-label">Avg Visual %</p>
                <h3 class="stat-value">
                    {{ $varkDist ? round($varkDist->visual) : 0 }}%
                </h3>
            </div>
        </div>

        @if($varkDist)
        <div class="dash-card">
            <h5 class="dash-card-title">VARK Distribution — All Students</h5>
            <div class="vark-bar-row">
                <span>Visual (V)</span>
                <div class="vark-bar-track">
                    <div class="vark-bar-fill vark-purple"
                         style="width:{{ round($varkDist->visual) }}%"></div>
                </div>
                <span>{{ round($varkDist->visual) }}%</span>
            </div>
            <div class="vark-bar-row">
                <span>Auditory (A)</span>
                <div class="vark-bar-track">
                    <div class="vark-bar-fill vark-teal"
                         style="width:{{ round($varkDist->auditory) }}%"></div>
                </div>
                <span>{{ round($varkDist->auditory) }}%</span>
            </div>
            <div class="vark-bar-row">
                <span>Read/Write (R)</span>
                <div class="vark-bar-track">
                    <div class="vark-bar-fill vark-yellow"
                         style="width:{{ round($varkDist->readwrite) }}%"></div>
                </div>
                <span>{{ round($varkDist->readwrite) }}%</span>
            </div>
            <div class="vark-bar-row">
                <span>Kinesthetic (K)</span>
                <div class="vark-bar-track">
                    <div class="vark-bar-fill vark-pink"
                         style="width:{{ round($varkDist->kinesthetic) }}%"></div>
                </div>
                <span>{{ round($varkDist->kinesthetic) }}%</span>
            </div>
        </div>
        @endif

        <div class="dash-card">
            <h5 class="dash-card-title">Dominant Style Distribution</h5>
            @forelse($dominantCount as $d)
            <div class="history-row">
                <span class="badge-visual">{{ $d->dominant_style }}</span>
                <strong style="color:#fff">{{ $d->count }} students</strong>
            </div>
            @empty
            <p style="color:#9a9aae">No data yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection