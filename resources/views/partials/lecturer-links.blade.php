@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.lecturer-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Share Links</h2>
                <p class="dash-latest">Assign lectures to students by VARK type</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <!-- Assign Form -->
        <div class="dash-card mb-4">
            <h5 class="dash-card-title">Assign Lecture to Student</h5>
            <form method="POST" action="{{ route('lecturer.links.add') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="auth-label">SELECT STUDENT</label>
                        <select name="student_id" class="auth-input" required>
                            <option value="">Choose student...</option>
                            @foreach($students as $s)
                            <option value="{{ $s->student_id }}">
                                {{ $s->full_name }} - {{ $s->index_number ?? $s->email }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="auth-label">SELECT LECTURE</label>
                        <select name="lecture_id" class="auth-input" required>
                            <option value="">Choose lecture...</option>
                            @foreach($lectures as $l)
                            <option value="{{ $l->lecture_id }}" 
                                    data-category="{{ $l->vark_category }}">
                                {{ $l->title }} ({{ $l->vark_category }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn-auth-gradient">
                            🔗 Share Lecture
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Shared Links -->
        <div class="dash-card">
            <h5 class="dash-card-title">Active Share Links</h5>
            @if($assignments->isEmpty())
                <p style="color:#9a9aae">No links shared yet.</p>
            @else
            @foreach($assignments as $a)
            <div class="lec-link-row">
                <div class="d-flex align-items-center gap-3">
                    <div class="dash-avatar" 
                         style="width:36px;height:36px;font-size:0.75rem;background:linear-gradient(135deg,#7b5cff,#4dd0e1)">
                        {{ strtoupper(substr($a->full_name, 0, 2)) }}
                    </div>
                    <div>
                        <strong style="color:#fff">{{ $a->full_name }}</strong>
                        <small style="color:#9a9aae;display:block">
                            {{ $a->title }}
                        </small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="lec-url">{{ $a->share_link }}</span>
                    <button onclick="navigator.clipboard.writeText('{{ $a->share_link }}')" 
                            class="btn-copy">📋 Copy</button>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
