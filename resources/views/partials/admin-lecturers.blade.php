@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.admin-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Lecturers</h2>
                <p class="dash-latest">Manage lecturer accounts</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <!-- Add Lecturer -->
        <div class="dash-card mb-4">
            <h5 class="dash-card-title">Add New Lecturer</h5>
            <form method="POST" action="{{ route('admin.lecturers.add') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="auth-label">FULL NAME</label>
                        <input type="text" name="name" class="auth-input"
                               placeholder="Dr. Name" required>
                    </div>
                    <div class="col-md-4">
                        <label class="auth-label">EMAIL</label>
                        <input type="email" name="email" class="auth-input"
                               placeholder="lecturer@mindmapquiz.lk" required>
                    </div>
                    <div class="col-md-4">
                        <label class="auth-label">PASSWORD</label>
                        <input type="password" name="password" class="auth-input"
                               placeholder="Password" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn-auth-gradient">
                            + Add Lecturer
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Lecturers List -->
        <div class="dash-card">
            <h5 class="dash-card-title">
                All Lecturers ({{ $lecturers->count() }})
            </h5>
            @if($lecturers->isEmpty())
                <p style="color:#9a9aae">No lecturers added yet.</p>
            @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>JOINED</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lecturers as $l)
                    <tr>
                        <td>
                            <div class="student-cell">
                                <div class="dash-avatar"
                                     style="width:32px;height:32px;font-size:0.7rem;background:linear-gradient(135deg,#4dd0e1,#7b5cff)">
                                    {{ strtoupper(substr($l->name, 0, 2)) }}
                                </div>
                                <strong style="color:#fff">{{ $l->name }}</strong>
                            </div>
                        </td>
                        <td style="color:#9a9aae">{{ $l->email }}</td>
                        <td><span class="badge-visual">{{ $l->role }}</span></td>
                        <td style="color:#9a9aae">
                            {{ date('Y-m-d', strtotime($l->created_at)) }}
                        </td>
                        <td>
                            <a href="{{ route('admin.lecturers.delete', $l->lecturer_id) }}"
                               class="btn-delete"
                               onclick="return confirm('Delete this lecturer?')">🗑️</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection