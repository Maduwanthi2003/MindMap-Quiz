@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.lecturer-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Lectures</h2>
                <p class="dash-latest">Manage your lecture materials</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <!-- Add Lecture Form -->
        <div class="dash-card mb-4">
            <h5 class="dash-card-title">Add New Lecture</h5>
            <form method="POST" action="{{ route('lecturer.lectures.add') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="auth-label">TITLE</label>
                        <input type="text" name="title" class="auth-input" 
                               placeholder="Lecture title" required>
                    </div>
                    <div class="col-md-6">
                        <label class="auth-label">VARK CATEGORY</label>
                        <select name="vark_category" class="auth-input">
                            <option value="Visual">Visual</option>
                            <option value="Auditory">Auditory</option>
                            <option value="Reading/Writing">Reading/Writing</option>
                            <option value="Kinesthetic">Kinesthetic</option>
                            <option value="MT">Multimodal (MT)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="auth-label">FORMAT</label>
                        <select name="format" class="auth-input">
                            <option value="Video">Video</option>
                            <option value="PDF">PDF</option>
                            <option value="Audio">Audio</option>
                            <option value="Lab">Lab Session</option>
                            <option value="Article">Article</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="auth-label">URL / LINK</label>
                        <input type="text" name="url" class="auth-input" 
                               placeholder="https://...">
                    </div>
                    <div class="col-12">
                        <label class="auth-label">DESCRIPTION</label>
                        <textarea name="description" class="auth-input" 
                                  rows="3" 
                                  placeholder="Brief description..."></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn-auth-gradient">
                            + Add Lecture
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Lectures List -->
        <div class="dash-card">
            <h5 class="dash-card-title">Your Lectures ({{ $lectures->count() }})</h5>
            @if($lectures->isEmpty())
                <p style="color:#9a9aae">No lectures added yet.</p>
            @else
            @foreach($lectures as $l)
            <div class="lec-item">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <strong style="color:#fff">{{ $l->title }}</strong>
                    @php
                        $catClass = [
                            'Visual'=>'lec-visual',
                            'Auditory'=>'lec-aud',
                            'Reading/Writing'=>'lec-read',
                            'Kinesthetic'=>'lec-kine',
                            'MT'=>'lec-mt'
                        ][$l->vark_category] ?? 'lec-visual';
                    @endphp
                    <span class="lec-badge {{ $catClass }}">{{ $l->vark_category }}</span>
                </div>
                <p style="color:#9a9aae;font-size:0.85rem;margin-bottom:8px">
                    {{ $l->description }}
                </p>
                <div class="d-flex gap-3">
                    <span style="color:#6e6e85;font-size:0.8rem">📁 {{ $l->format }}</span>
                    @if($l->url)
                    <a href="{{ $l->url }}" target="_blank" 
                       style="color:#b89cff;font-size:0.8rem">🔗 Open Link</a>
                    @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection