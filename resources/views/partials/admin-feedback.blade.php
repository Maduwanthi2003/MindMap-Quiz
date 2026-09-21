@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.admin-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Feedback</h2>
                <p class="dash-latest">Student feedback and ratings</p>
            </div>
            <span class="badge-visual">{{ $feedbacks->count() }} Total</span>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <div class="dash-card">
            @forelse($feedbacks as $f)
            <div class="feedback-row">
                <div style="flex:1">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <div class="dash-avatar"
                             style="width:30px;height:30px;font-size:0.65rem;background:linear-gradient(135deg,#7b5cff,#4dd0e1)">
                            {{ strtoupper(substr($f->full_name, 0, 2)) }}
                        </div>
                        <strong style="color:#fff">{{ $f->full_name }}</strong>
                        <small style="color:#6e6e85">
                            {{ date('Y-m-d', strtotime($f->submitted_at)) }}
                        </small>
                    </div>
                    <p style="color:#9a9aae;margin:0;font-size:0.9rem">
                        "{{ $f->comment ?? 'No comment.' }}"
                    </p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $f->rating ? '★' : '☆' }}
                        @endfor
                    </div>
                    <a href="{{ route('admin.feedback.delete', $f->feedback_id) }}"
                       class="btn-delete"
                       onclick="return confirm('Delete this feedback?')">🗑️</a>
                </div>
            </div>
            @empty
            <p style="color:#9a9aae">No feedback yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection