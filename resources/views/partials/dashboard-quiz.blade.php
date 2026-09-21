@extends('layouts.app')

@section('content')
<canvas id="particles-dashboard"></canvas>

<div class="dashboard-wrapper">

    <!-- Sidebar -->
    <div class="dash-sidebar">
        <div class="dash-logo">🧠 MindMapQuiz</div>

        <p class="dash-menu-label">MENU</p>
        <ul class="dash-nav">
            <li><a href="{{ route('dashboard') }}">📊 Dashboard</a></li>
            <li class="active"><a href="{{ route('dashboard.quiz') }}">📝 Take Quiz</a></li>
            <li><a href="{{ route('quiz.history') }}">🕐 Quiz History</a></li>
            <li><a href="{{ route('study.tips') }}">💡 Study Tips</a></li>
            <li><a href="{{ route('progress') }}">📈 Progress</a></li>
        </ul>

        <p class="dash-menu-label">ACCOUNT</p>
        <ul class="dash-nav">
            <li><a href="{{ route('profile') }}">👤 My Profile</a></li>
            <li><a href="{{ route('feedback') }}">💬 Feedback</a></li>
            <li><a href="{{ route('logout') }}" class="logout-link">🚪 Logout</a></li>
        </ul>

        <div class="dash-user">
            <div class="dash-avatar">
                {{ strtoupper(substr($student->full_name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $student->full_name)[1] ?? '', 0, 1)) }}
            </div>
            <div>
                <strong>{{ $student->full_name }}</strong>
                <small>Student</small>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="dash-main">

        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">VARK Quiz</h2>
                <p class="dash-latest">Answer 10 scenario-based questions to identify your learning style</p>
            </div>
        </div>

        <!-- Quiz Card -->
        <div class="dash-card" id="quizCard">
            <div class="quiz-progress-wrapper">
                <div class="quiz-progress-bar" id="progressBar" style="width:0%"></div>
            </div>
            <p class="quiz-progress-text" id="progressText">Question 1 of 10</p>
            <div id="quizAlert" class="alert-error" style="display:none; margin-bottom:10px;"></div>

            <div class="quiz-question-number" id="questionNumber">01</div>
            <h3 class="quiz-question" id="questionText">Loading...</h3>

            <div class="quiz-options" id="optionsContainer"></div>

            <button class="btn-quiz-next" id="nextBtn"
                    onclick="nextQuestion()" style="display:none;">
                Next Question →
            </button>
        </div>

        <!-- Result Card -->
        <div class="dash-card" id="resultCard" style="display:none; text-align:center;">
            <div style="font-size:3rem;margin-bottom:20px">🎯</div>
            <h3 style="color:#fff;font-weight:800;margin-bottom:10px">Your VARK Profile</h3>
            <p style="color:#9a9aae;margin-bottom:20px">
                Based on your answers, your learning style is:
            </p>
            <div class="result-type" id="resultType"></div>
            <p class="result-desc" id="resultDesc"></p>
            <div class="result-scores" id="resultScores"></div>

            <div class="d-flex gap-3 justify-content-center mt-4">
                <a href="{{ route('dashboard') }}" class="btn-quiz-next">
                    View Dashboard →
                </a>
                <button onclick="retakeQuiz()" 
                        class="btn-quiz-next" 
                        style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2)">
                    Retake Quiz
                </button>
            </div>
        </div>

    </div>
</div>

<script>
const questions = [
    {
        q: "You need to learn a new software tool for your IT project. What do you do first?",
        options: [
            { text: "Watch tutorial videos and look at screenshots of the interface", type: "V" },
            { text: "Ask a colleague to explain how it works verbally", type: "A" },
            { text: "Read the user manual and documentation carefully", type: "R" },
            { text: "Jump in and start using it to learn by doing", type: "K" }
        ]
    },
    {
        q: "Your lecturer explains a complex networking concept. How do you best remember it?",
        options: [
            { text: "Draw a diagram showing how the components connect", type: "V" },
            { text: "Repeat the explanation aloud to yourself later", type: "A" },
            { text: "Write detailed notes and reread them", type: "R" },
            { text: "Set up a practice network to see it working", type: "K" }
        ]
    },
    {
        q: "You have an upcoming exam on database design. How do you prepare?",
        options: [
            { text: "Create ER diagrams and visual schema maps", type: "V" },
            { text: "Discuss concepts with classmates or record voice notes", type: "A" },
            { text: "Write out definitions and read textbook chapters", type: "R" },
            { text: "Practice building actual databases on your computer", type: "K" }
        ]
    },
    {
        q: "When you are stuck on a programming bug, what do you typically do?",
        options: [
            { text: "Draw a flowchart to trace the program logic visually", type: "V" },
            { text: "Talk through the code logic out loud or with a friend", type: "A" },
            { text: "Read documentation and search for written solutions online", type: "R" },
            { text: "Try different approaches until something works", type: "K" }
        ]
    },
    {
        q: "You are studying cybersecurity. Which method helps you understand threats best?",
        options: [
            { text: "View infographics and attack flow diagrams", type: "V" },
            { text: "Listen to cybersecurity podcasts and recorded lectures", type: "A" },
            { text: "Read case studies and security research papers", type: "R" },
            { text: "Simulate attacks in a practice lab environment", type: "K" }
        ]
    },
    {
        q: "Your group needs to plan a system architecture. What is your contribution?",
        options: [
            { text: "Sketch out the architecture diagram on a whiteboard", type: "V" },
            { text: "Lead the verbal discussion and explain ideas aloud", type: "A" },
            { text: "Write a detailed technical specification document", type: "R" },
            { text: "Build a working prototype to demonstrate the idea", type: "K" }
        ]
    },
    {
        q: "How do you prefer to receive assignment instructions from your lecturer?",
        options: [
            { text: "Slides with diagrams and visual examples", type: "V" },
            { text: "A verbal walkthrough explaining each step", type: "A" },
            { text: "A written brief with detailed requirements", type: "R" },
            { text: "A demonstration they can follow step by step", type: "K" }
        ]
    },
    {
        q: "You are revising for your HND final project presentation. What works best?",
        options: [
            { text: "Create visual slides with charts, diagrams and colour coding", type: "V" },
            { text: "Practice presenting aloud and record yourself", type: "A" },
            { text: "Write out your talking points and read them through", type: "R" },
            { text: "Do a full mock presentation to simulate the real thing", type: "K" }
        ]
    },
    {
        q: "When learning about operating systems, which approach helps you most?",
        options: [
            { text: "Study system architecture diagrams and visual comparisons", type: "V" },
            { text: "Watch and listen to video lectures and explanations", type: "A" },
            { text: "Read the OS documentation and write comparative notes", type: "R" },
            { text: "Install and configure different OS environments yourself", type: "K" }
        ]
    },
    {
        q: "After completing a learning module, how do you know you have mastered it?",
        options: [
            { text: "You can draw a complete diagram of the concept from memory", type: "V" },
            { text: "You can explain it clearly to someone else verbally", type: "A" },
            { text: "You can write a detailed summary without referring to notes", type: "R" },
            { text: "You can successfully complete a practical task using the concept", type: "K" }
        ]
    }
];

let current = 0;
let scores = { V: 0, A: 0, R: 0, K: 0 };
let selected = null;

function loadQuestion() {
    const q = questions[current];
    document.getElementById('questionNumber').textContent =
        String(current + 1).padStart(2, '0');
    document.getElementById('questionText').textContent = q.q;
    document.getElementById('progressText').textContent =
        `Question ${current + 1} of ${questions.length}`;
    document.getElementById('progressBar').style.width =
        `${(current / questions.length) * 100}%`;
    document.getElementById('nextBtn').style.display = 'none';
    selected = null;

    const container = document.getElementById('optionsContainer');
    container.innerHTML = '';
    q.options.forEach(opt => {
        const btn = document.createElement('button');
        btn.className = 'quiz-option';
        btn.textContent = opt.text;
        btn.onclick = () => selectOption(btn, opt.type);
        container.appendChild(btn);
    });
}

function selectOption(btn, type) {
    document.querySelectorAll('.quiz-option').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    selected = type;
    document.getElementById('nextBtn').style.display = 'block';
    document.getElementById('quizAlert').style.display = 'none';
}

function nextQuestion() {
    if (!selected) {
        const alert = document.getElementById('quizAlert');
        alert.textContent = 'Please select an answer before continuing.';
        alert.style.display = 'block';
        return;
    }
    scores[selected]++;
    current++;
    if (current >= questions.length) {
        submitResults();
    } else {
        loadQuestion();
    }
}

function submitResults() {
    const total       = questions.length;
    const rawVisual      = (scores.V / total) * 100;
    const rawAuditory    = (scores.A / total) * 100;
    const rawReadwrite   = (scores.R / total) * 100;
    const rawKinesthetic = (scores.K / total) * 100;

    let visual      = Math.round(rawVisual);
    let auditory    = Math.round(rawAuditory);
    let readwrite   = Math.round(rawReadwrite);
    let kinesthetic = Math.round(rawKinesthetic);

    const percentSum = visual + auditory + readwrite + kinesthetic;
    if (percentSum !== 100) {
        const adjustment = 100 - percentSum;
        const values = [
            { name: 'visual',      val: visual },
            { name: 'auditory',    val: auditory },
            { name: 'readwrite',   val: readwrite },
            { name: 'kinesthetic', val: kinesthetic }
        ];
        const highest = values.reduce((best, current) => current.val > best.val ? current : best, values[0]);
        if (highest.name === 'visual') visual += adjustment;
        if (highest.name === 'auditory') auditory += adjustment;
        if (highest.name === 'readwrite') readwrite += adjustment;
        if (highest.name === 'kinesthetic') kinesthetic += adjustment;
    }

    const sorted = [
        { name: 'Visual',          val: visual },
        { name: 'Auditory',        val: auditory },
        { name: 'Reading/Writing', val: readwrite },
        { name: 'Kinesthetic',     val: kinesthetic }
    ].sort((a, b) => b.val - a.val);

    const dominant  = sorted[0].name;
    const secondary = sorted[1].name;

    fetch('{{ route("dashboard.quiz.save") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            visual_pct:      visual,
            auditory_pct:    auditory,
            read_write_pct:  readwrite,
            kinesthetic_pct: kinesthetic,
            dominant_style:  dominant,
            secondary_style: secondary
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.redirect) {
            window.location = data.redirect;
            return;
        }
        showResult(visual, auditory, readwrite, kinesthetic, dominant, secondary);
    })
    .catch(() => showResult(visual, auditory, readwrite, kinesthetic, dominant, secondary));
}

function showResult(visual, auditory, readwrite, kinesthetic, dominant, secondary) {
    const resultLabel = dominant === secondary ? dominant : `${dominant} + ${secondary}`;

    document.getElementById('quizCard').style.display = 'none';
    document.getElementById('resultCard').style.display = 'block';
    document.getElementById('progressBar').style.width = '100%';
    document.getElementById('progressText').textContent = 'Complete!';
    document.getElementById('resultType').textContent = resultLabel;

    const descriptions = {
        'Visual':          'You learn best through images, diagrams, charts, and colour-coded notes.',
        'Auditory':        'You learn best by listening and discussing. Try study groups and voice recordings.',
        'Reading/Writing': 'You learn best through reading and writing detailed notes and summaries.',
        'Kinesthetic':     'You learn best by doing — hands-on practice, labs, and real-world examples.',
    };

    document.getElementById('resultDesc').textContent = resultLabel.includes('+')
        ? `You show strengths in ${dominant} and ${secondary}, indicating a multimodal learning style.`
        : descriptions[dominant] ?? '';
    document.getElementById('resultScores').innerHTML = `
        <div class="score-item"><span>Visual</span><strong style="color:#b89cff">${visual}%</strong></div>
        <div class="score-item"><span>Auditory</span><strong style="color:#7de8c4">${auditory}%</strong></div>
        <div class="score-item"><span>Reading/Writing</span><strong style="color:#ffc078">${readwrite}%</strong></div>
        <div class="score-item"><span>Kinesthetic</span><strong style="color:#ff9cd9">${kinesthetic}%</strong></div>
    `;
}

function retakeQuiz() {
    current = 0;
    scores = { V: 0, A: 0, R: 0, K: 0 };
    selected = null;
    document.getElementById('quizCard').style.display = 'block';
    document.getElementById('resultCard').style.display = 'none';
    document.getElementById('progressBar').style.width = '0%';
    loadQuestion();
}

window.addEventListener('DOMContentLoaded', loadQuestion);
</script>

@endsection