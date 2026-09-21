@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.lecturer-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Reports</h2>
                <p class="dash-latest">Student learning style analytics</p>
            </div>
        </div>

        <!-- Stats -->
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
                <div class="stat-icon">👁️</div>
                <p class="stat-label">Avg Visual</p>
                <h3 class="stat-value">{{ $varkDist ? round($varkDist->visual) : 0 }}%</h3>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✋</div>
                <p class="stat-label">Avg Kinesthetic</p>
                <h3 class="stat-value">{{ $varkDist ? round($varkDist->kinesthetic) : 0 }}%</h3>
            </div>
        </div>

        <!-- VARK Distribution -->
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

        <!-- Recent Results -->
        <div class="dash-card">
            <h5 class="dash-card-title">Recent Student Results</h5>
            @if($recentResults->isEmpty())
                <p style="color:#9a9aae">No quiz results yet.</p>
            @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>STUDENT</th>
                        <th>DATE</th>
                        <th>DOMINANT</th>
                        <th>VISUAL</th>
                        <th>AUDITORY</th>
                        <th>R/W</th>
                        <th>KINESTH.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentResults as $r)
                    <tr>
                        <td>
                            <div class="student-cell">
                                <div class="dash-avatar" 
                                     style="width:30px;height:30px;font-size:0.65rem;background:linear-gradient(135deg,#7b5cff,#4dd0e1)">
                                    {{ strtoupper(substr($r->full_name, 0, 2)) }}
                                </div>
                                <span style="color:#fff">{{ $r->full_name }}</span>
                            </div>
                        </td>
                        <td style="color:#9a9aae">
                            {{ date('Y-m-d', strtotime($r->calculated_at)) }}
                        </td>
                        <td><span class="badge-visual">{{ $r->dominant_style }}</span></td>
                        <td><strong style="color:#b89cff">{{ $r->visual_pct }}%</strong></td>
                        <td><strong style="color:#7de8c4">{{ $r->auditory_pct }}%</strong></td>
                        <td><strong style="color:#ffc078">{{ $r->read_write_pct }}%</strong></td>
                        <td><strong style="color:#ff9cd9">{{ $r->kinesthetic_pct }}%</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection