@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.admin-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Students</h2>
                <p class="dash-latest">Manage all registered students</p>
            </div>
            <div>
                <span class="badge-visual">{{ $students->count() }} Total</span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <div class="dash-card">
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
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $s)
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
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.students.edit', $s->student_id) }}"
                                   class="btn-view">✏️ Edit</a>
                                <a href="{{ route('admin.students.delete', $s->student_id) }}"
                                   class="btn-delete"
                                   onclick="return confirm('Delete this student?')">🗑️</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="color:#9a9aae;text-align:center">
                            No students registered yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection