const questions = [
    {
        q: "When you need to learn something new, you prefer to:",
        options: [
            { text: "Look at diagrams, charts, or videos", type: "V" },
            { text: "Listen to someone explain it or discuss it", type: "A" },
            { text: "Read about it in detail", type: "R" },
            { text: "Try it out hands-on", type: "K" }
        ]
    },
    {
        q: "When you're trying to remember something, you:",
        options: [
            { text: "Picture it in your mind as an image or map", type: "V" },
            { text: "Repeat it aloud or recall the sound of it", type: "A" },
            { text: "Write it down or read your notes again", type: "R" },
            { text: "Associate it with a physical action or experience", type: "K" }
        ]
    },
    {
        q: "In a class or lecture, you learn best when:",
        options: [
            { text: "The teacher uses slides, graphs, or visual aids", type: "V" },
            { text: "There's discussion and verbal explanation", type: "A" },
            { text: "You have detailed handouts or textbooks to read", type: "R" },
            { text: "You do activities, role plays, or real examples", type: "K" }
        ]
    },
    {
        q: "When studying for an exam, you typically:",
        options: [
            { text: "Use colour-coded notes, mind maps, or diagrams", type: "V" },
            { text: "Record yourself and listen back, or study with friends", type: "A" },
            { text: "Write summaries, essays, or detailed notes", type: "R" },
            { text: "Practice past papers and real-world examples", type: "K" }
        ]
    },
    {
        q: "When following instructions, you prefer them to be:",
        options: [
            { text: "Shown with diagrams or visual steps", type: "V" },
            { text: "Spoken or explained verbally", type: "A" },
            { text: "Written clearly in a manual or guide", type: "R" },
            { text: "Demonstrated so you can try it yourself", type: "K" }
        ]
    },
    {
        q: "When you're working on a problem, you tend to:",
        options: [
            { text: "Draw it out or create a visual model", type: "V" },
            { text: "Talk through it with someone", type: "A" },
            { text: "Write out the steps or research it", type: "R" },
            { text: "Jump in and experiment until it works", type: "K" }
        ]
    },
    {
        q: "Your ideal study environment includes:",
        options: [
            { text: "Whiteboards, posters, or colour-coded materials", type: "V" },
            { text: "Background music or study group discussions", type: "A" },
            { text: "Quiet space with books and written notes", type: "R" },
            { text: "Movement, experiments, or field trips", type: "K" }
        ]
    },
    {
        q: "When giving someone directions, you usually:",
        options: [
            { text: "Draw a map or point to landmarks", type: "V" },
            { text: "Explain verbally with clear spoken steps", type: "A" },
            { text: "Write down the directions step by step", type: "R" },
            { text: "Walk with them or use physical gestures", type: "K" }
        ]
    },
    {
        q: "You find it easiest to explain a concept by:",
        options: [
            { text: "Creating a diagram or visual representation", type: "V" },
            { text: "Talking through it clearly", type: "A" },
            { text: "Writing a detailed explanation", type: "R" },
            { text: "Showing a real example or demonstration", type: "K" }
        ]
    },
    {
        q: "After a learning session, you remember most from:",
        options: [
            { text: "Images, charts, or colour-coded notes you saw", type: "V" },
            { text: "Discussions or explanations you heard", type: "A" },
            { text: "Notes or summaries you wrote or read", type: "R" },
            { text: "Activities or real tasks you actually did", type: "K" }
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
    document.querySelectorAll('.quiz-option').forEach(b => {
        b.classList.remove('selected');
    });
    btn.classList.add('selected');
    selected = type;
    document.getElementById('nextBtn').style.display = 'block';
}

function nextQuestion() {
    if (!selected) return;
    scores[selected]++;
    current++;
    if (current >= questions.length) {
        showResult();
    } else {
        loadQuestion();
    }
}

function showResult() {
    document.getElementById('quizCard').style.display = 'none';
    document.getElementById('resultCard').style.display = 'block';
    document.getElementById('progressBar').style.width = '100%';
    document.getElementById('progressText').textContent = 'Complete!';

    const max = Math.max(scores.V, scores.A, scores.R, scores.K);
    const types = [];
    if (scores.V === max) types.push('Visual');
    if (scores.A === max) types.push('Auditory');
    if (scores.R === max) types.push('Reading/Writing');
    if (scores.K === max) types.push('Kinesthetic');

    const isMultimodal = types.length > 1;
    const typeLabel = isMultimodal
        ? 'Multimodal (MT) — ' + types.join(' + ')
        : types[0];

    const descriptions = {
        'Visual': 'You learn best through images, diagrams, charts, and colour-coded notes. Use mind maps and visual summaries to master new concepts.',
        'Auditory': 'You learn best by listening and discussing. Try recording lectures, joining study groups, and explaining concepts aloud.',
        'Reading/Writing': 'You learn best through reading and writing. Use detailed notes, summaries, and written explanations to reinforce learning.',
        'Kinesthetic': 'You learn best by doing. Use hands-on practice, real-world examples, and experiments to understand new concepts.',
    };

    document.getElementById('resultType').textContent = typeLabel;
    document.getElementById('resultDesc').textContent = isMultimodal
        ? 'You thrive across multiple learning styles! Use a blend of techniques for best results.'
        : descriptions[types[0]];

    document.getElementById('resultScores').innerHTML = `
        <div class="score-item">
            <span>Visual</span>
            <strong style="color:#b89cff">${scores.V}</strong>
        </div>
        <div class="score-item">
            <span>Auditory</span>
            <strong style="color:#7de8c4">${scores.A}</strong>
        </div>
        <div class="score-item">
            <span>Reading/Writing</span>
            <strong style="color:#ffc078">${scores.R}</strong>
        </div>
        <div class="score-item">
            <span>Kinesthetic</span>
            <strong style="color:#ff9cd9">${scores.K}</strong>
        </div>
    `;
}

window.addEventListener('DOMContentLoaded', loadQuestion);