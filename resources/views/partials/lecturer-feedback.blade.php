@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.lecturer-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Student Feedback</h2>
                <p class="dash-latest">Reviews from students about the system</p>
            </div>
        </div>

        <div class="dash-card">
            <h5 class="dash-card-title">
                All Feedback ({{ $feedbacks->count() }})
            </h5>
            @if($feedbacks->isEmpty())
                <p style="color:#9a9aae">No feedback submitted yet.</p>
            @else
            @foreach($feedbacks as $f)
            <div class="feedback-row">
                <div>
                    <strong>{{ $f->full_name }}</strong>
                    <p>"{{ $f->comment ?? 'No comment provided.' }}"</p>
                    <small style="color:#6e6e85">
                        {{ date('Y-m-d', strtotime($f->submitted_at)) }}
                    </small>
                </div>
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $f->rating ? '★' : '☆' }}
                    @endfor
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection