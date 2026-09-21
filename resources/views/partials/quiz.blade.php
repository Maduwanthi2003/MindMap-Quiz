@extends('layouts.app')

@section('content')

<section class="quiz-section">
    <canvas id="particles-quiz"></canvas>

    <div class="container quiz-container">

        <div class="quiz-progress-wrapper">
            <div class="quiz-progress-bar" id="progressBar" style="width: 0%"></div>
        </div>
        <p class="quiz-progress-text" id="progressText">Question 1 of 10</p>

        <div class="quiz-card" id="quizCard">
            <div class="quiz-question-number" id="questionNumber">01</div>
            <h2 class="quiz-question" id="questionText">Loading...</h2>
            <div class="quiz-options" id="optionsContainer"></div>
            <button class="btn-quiz-next" id="nextBtn" 
                    onclick="nextQuestion()" style="display:none;">
                Next Question →
            </button>
        </div>

        <div class="quiz-result" id="resultCard" style="display:none;">
            <div class="result-icon">🎯</div>
            <h2 class="result-title">Your VARK Profile</h2>
            <p class="result-subtitle">Based on your answers, your learning style is:</p>
            <div class="result-type" id="resultType"></div>
            <p class="result-desc" id="resultDesc"></p>
            <div class="result-scores" id="resultScores"></div>
            <a href="{{ route('quiz') }}" class="btn-quiz-next mt-4 d-inline-block">
                Retake Quiz →
            </a>
        </div>

    </div>
</section>

@push('scripts')
<script src="{{ asset('js/quiz.js') }}"></script>
@endpush

@endsection