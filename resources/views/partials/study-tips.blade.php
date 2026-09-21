@extends('layouts.app')

@section('content')
<canvas id="particles-dashboard"></canvas>

<div class="dashboard-wrapper">
    <div class="dash-sidebar">
        <div class="dash-logo">🧠 MindMapQuiz</div>
        <p class="dash-menu-label">MENU</p>
        <ul class="dash-nav">
            <li><a href="{{ route('dashboard') }}">📊 Dashboard</a></li>
            <li><a href="{{ route('dashboard.quiz') }}">📝 Take Quiz</a></li>
            <li><a href="{{ route('quiz.history') }}">🕐 Quiz History</a></li>
            <li class="active"><a href="{{ route('study.tips') }}">💡 Study Tips</a></li>
            <li><a href="{{ route('progress') }}">📈 Progress</a></li>
        </ul>
        <p class="dash-menu-label">ACCOUNT</p>
        <ul class="dash-nav">
            <li><a href="{{ route('profile') }}">👤 My Profile</a></li>
            <li><a href="{{ route('feedback') }}">💬 Feedback</a></li>
            <li><a href="{{ route('logout') }}" class="logout-link">🚪 Logout</a></li>
        </ul>
        <div class="dash-user">
            <div class="dash-avatar">{{ strtoupper(substr($student->full_name, 0, 2)) }}</div>
            <div>
                <strong>{{ $student->full_name }}</strong>
                <small>Student</small>
            </div>
        </div>
    </div>

    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Study Tips</h2>
                <p class="dash-latest">
                    @if($latestResult)
                        Tips based on your {{ $latestResult->dominant_style }} learning style
                    @else
                        Take a quiz to get personalised tips
                    @endif
                </p>
            </div>
        </div>

        @php
        $tips = [
            'Visual' => [
                ['icon'=>'🗺️','title'=>'Use Mind Maps','desc'=>'Create visual diagrams and flowcharts to connect ideas and concepts.'],
                ['icon'=>'🎨','title'=>'Colour-Code Notes','desc'=>'Use different colours for different topics to improve memory retention.'],
                ['icon'=>'📊','title'=>'Charts & Graphs','desc'=>'Convert data and information into visual charts for better understanding.'],
                ['icon'=>'🎥','title'=>'Watch Videos','desc'=>'Use YouTube tutorials and educational videos to learn new concepts.'],
            ],
            'Auditory' => [
                ['icon'=>'🎧','title'=>'Listen to Podcasts','desc'=>'Find educational podcasts on topics you are studying.'],
                ['icon'=>'🗣️','title'=>'Study Groups','desc'=>'Join or form study groups to discuss and explain concepts aloud.'],
                ['icon'=>'🎵','title'=>'Record & Replay','desc'=>'Record your notes and listen back while studying.'],
                ['icon'=>'📢','title'=>'Read Aloud','desc'=>'Read your notes and textbooks out loud to improve retention.'],
            ],
            'Reading/Writing' => [
                ['icon'=>'📝','title'=>'Detailed Notes','desc'=>'Write comprehensive notes during lectures and while reading.'],
                ['icon'=>'📚','title'=>'Read Widely','desc'=>'Read textbooks, articles and reference materials on each topic.'],
                ['icon'=>'✍️','title'=>'Rewrite Key Points','desc'=>'Rewrite important concepts in your own words to reinforce learning.'],
                ['icon'=>'📋','title'=>'Make Lists','desc'=>'Create structured lists and outlines to organise information.'],
            ],
            'Kinesthetic' => [
                ['icon'=>'🔬','title'=>'Hands-on Practice','desc'=>'Apply concepts through practical exercises and lab sessions.'],
                ['icon'=>'🌍','title'=>'Real-world Examples','desc'=>'Connect theory to real-world scenarios and case studies.'],
                ['icon'=>'🧪','title'=>'Experiments','desc'=>'Learn through trial and error and experimental approaches.'],
                ['icon'=>'🏃','title'=>'Take Breaks','desc'=>'Study in short focused sessions with movement breaks in between.'],
            ],
        ];

        $style = $latestResult->dominant_style ?? 'Visual';
        $currentTips = $tips[$style] ?? $tips['Visual'];
        @endphp

        @if(!$latestResult)
        <div class="dash-card mb-4">
            <p style="color:#9a9aae">
                Take the VARK quiz first to get personalised study tips!
                <a href="{{ route('quiz') }}" style="color:#b89cff">Start Quiz →</a>
            </p>
        </div>
        @endif

        <div class="row g-4">
            @foreach($currentTips as $tip)
            <div class="col-md-6">
                <div class="dash-card h-100" style="border-top: 3px solid #9b6bff;">
                    <div style="font-size:2rem;margin-bottom:15px">{{ $tip['icon'] }}</div>
                    <h5 style="color:#fff;font-weight:700">{{ $tip['title'] }}</h5>
                    <p style="color:#9a9aae;font-size:0.9rem">{{ $tip['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- All styles tips -->
        @if($latestResult)
        <div class="dash-card mt-4">
            <h5 class="dash-card-title">Tips for Other Learning Styles</h5>
            @foreach($tips as $styleName => $styleTips)
                @if($styleName !== $style)
                <div class="mb-3">
                    <h6 style="color:#b89cff;margin-bottom:10px">{{ $styleName }}</h6>
                    @foreach($styleTips as $t)
                    <div class="tip-item">
                        <div class="tip-icon tip-blue">{{ $t['icon'] }}</div>
                        <div>
                            <strong>{{ $t['title'] }}</strong>
                            <p>{{ $t['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection