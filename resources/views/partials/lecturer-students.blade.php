@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.lecturer-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Students</h2>
                <p class="dash-latest">All registered students and their VARK profiles</p>
            </div>
        </div>

        <div class="dash-card">
            <h5 class="dash-card-title">Student VARK Profiles</h5>
            @if($students->isEmpty())
                <p style="color:#9a9aae">No students registered yet.</p>
            @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>STUDENT</th>
                        <th>INDEX</th>
                        <th>EMAIL</th>
                        <th>DOMINANT STYLE</th>
                        <th>VISUAL</th>
                        <th>AUDITORY</th>
                        <th>R/W</th>
                        <th>KINESTH.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $s)
                    <tr>
                        <td>
                            <div class="student-cell">
                                <div class="dash-avatar" 
                                     style="width:32px;height:32px;font-size:0.7rem;background:linear-gradient(135deg,#7b5cff,#4dd0e1)">
                                    {{ strtoupper(substr($s->full_name, 0, 2)) }}
                                </div>
                                <strong style="color:#fff">{{ $s->full_name }}</strong>
                            </div>
                        </td>
                        <td style="color:#9a9aae">{{ $s->index_number ?? 'N/A' }}</td>
                        <td style="color:#9a9aae">{{ $s->email }}</td>
                        <td>
                            @if($s->dominant_style)
                                <span class="badge-visual">{{ $s->dominant_style }}</span>
                            @else
                                <span style="color:#5e5e75">No quiz</span>
                            @endif
                        </td>
                        <td><strong style="color:#b89cff">{{ $s->visual_pct ?? '—' }}%</strong></td>
                        <td><strong style="color:#7de8c4">{{ $s->auditory_pct ?? '—' }}%</strong></td>
                        <td><strong style="color:#ffc078">{{ $s->read_write_pct ?? '—' }}%</strong></td>
                        <td><strong style="color:#ff9cd9">{{ $s->kinesthetic_pct ?? '—' }}%</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
