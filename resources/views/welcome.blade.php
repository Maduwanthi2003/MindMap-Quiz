@extends('layouts.app')

@section('content')
<section class="hero-section" id="home">

    <!-- Animated dots background -->
    <canvas id="particles-bg"></canvas>

    <!-- Left floating images -->
    <img src="{{ asset('images/study1.jpg') }}" class="float-img float-left-1" alt="">
    <img src="{{ asset('images/study2.jpg') }}" class="float-img float-left-2" alt="">

    <!-- Right floating images -->
    <img src="{{ asset('images/study3.jpg') }}" class="float-img float-right-1" alt="">
    <img src="{{ asset('images/study4.jpg') }}" class="float-img float-right-2" alt="">

    <!-- Center text content -->
    <div class="hero-content">
        <h1 class="hero-title">
            Learn Smarter,<br>
            <span class="gradient-text">Not Harder.</span>
        </h1>

        <p class="hero-subtitle">
            MindMap Quiz fuses visual mind mapping with a scientifically proven
            spaced repetition engine. Build knowledge graphs, quiz yourself
            intelligently, and watch your memory grow node by node.
        </p>

        <p class="hero-paragraph">
            Every person absorbs and processes information differently
            some learn best through visuals, others through listening,
            reading, or hands-on practice. Understanding your own learning
            style helps you study more effectively, retain information
            longer, and apply what you've learned with greater confidence
            in both academic and everyday situations.
        </p>

        <a href="{{ route('quiz') }}" class="btn btn-gradient btn-lg">
    Get Quiz →
</a>
    </div>

</section>

<!-- About VARK Section -->
<section class="vark-section" id="about-vark">

    <canvas id="particles-vark"></canvas>

    <div class="container">
        <div class="text-center mb-3">
            <h2 class="vark-title">About VARK</h2>
            <p class="vark-subtitle">
                Discover your VARK learning style and unlock personalised study
                strategies node by node.
            </p>
        </div>

        <div class="row g-4">
            <!-- Visual -->
            <div class="col-md-6">
                <div class="vark-card vark-purple">
                    <div class="d-flex align-items-center mb-2">
                        <div class="vark-icon vark-icon-purple">V</div>
                        <div class="ms-3">
                            <h5 class="mb-0">Visual</h5>
                            <small class="text-muted">Learns by seeing</small>
                        </div>
                    </div>
                    <p class="vark-label">PREFERRED FORMATS</p>
                    <div class="vark-tags">
                        <span class="tag tag-purple">Diagrams</span>
                        <span class="tag tag-purple">Charts</span>
                        <span class="tag tag-purple">Mind maps</span>
                        <span class="tag tag-purple">Videos</span>
                    </div>
                    <p class="vark-label mt-3">STUDY TIP</p>
                    <p class="vark-text">
                        Use colour-coded notes, flowcharts and visual summaries
                        to understand new concepts.
                    </p>
                </div>
            </div>

            <!-- Auditory -->
            <div class="col-md-6">
                <div class="vark-card vark-green">
                    <div class="d-flex align-items-center mb-2">
                        <div class="vark-icon vark-icon-green">A</div>
                        <div class="ms-3">
                            <h5 class="mb-0">Auditory</h5>
                            <small class="text-muted">Learns by hearing</small>
                        </div>
                    </div>
                    <p class="vark-label">PREFERRED FORMATS</p>
                    <div class="vark-tags">
                        <span class="tag tag-green">Lectures</span>
                        <span class="tag tag-green">Podcasts</span>
                        <span class="tag tag-green">Discussions</span>
                        <span class="tag tag-green">Audio</span>
                    </div>
                    <p class="vark-label mt-3">STUDY TIP</p>
                    <p class="vark-text">
                        Recite notes aloud, join study groups and listen to
                        recorded lessons.
                    </p>
                </div>
            </div>

            <!-- Reading/Writing -->
            <div class="col-md-6">
                <div class="vark-card vark-yellow">
                    <div class="d-flex align-items-center mb-2">
                        <div class="vark-icon vark-icon-yellow">R</div>
                        <div class="ms-3">
                            <h5 class="mb-0">Reading / Writing</h5>
                            <small class="text-muted">Learns through text</small>
                        </div>
                    </div>
                    <p class="vark-label">PREFERRED FORMATS</p>
                    <div class="vark-tags">
                        <span class="tag tag-yellow">Textbooks</span>
                        <span class="tag tag-yellow">Notes</span>
                        <span class="tag tag-yellow">Essays</span>
                        <span class="tag tag-yellow">Lists</span>
                    </div>
                    <p class="vark-label mt-3">STUDY TIP</p>
                    <p class="vark-text">
                        Write detailed notes, rewrite key points and read
                        widely around each topic.
                    </p>
                </div>
            </div>

            <!-- Kinesthetic -->
            <div class="col-md-6">
                <div class="vark-card vark-pink">
                    <div class="d-flex align-items-center mb-2">
                        <div class="vark-icon vark-icon-pink">K</div>
                        <div class="ms-3">
                            <h5 class="mb-0">Kinesthetic</h5>
                            <small class="text-muted">Learns by doing</small>
                        </div>
                    </div>
                    <p class="vark-label">PREFERRED FORMATS</p>
                    <div class="vark-tags">
                        <span class="tag tag-pink">Practice</span>
                        <span class="tag tag-pink">Labs</span>
                        <span class="tag tag-pink">Examples</span>
                        <span class="tag tag-pink">Simulations</span>
                    </div>
                    <p class="vark-label mt-3">STUDY TIP</p>
                    <p class="vark-text">
                        Learn through hands-on exercises, real-world scenarios
                        and trial-and-error.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Features Section -->
<section class="features-section" id="features">
    <canvas id="particles-features"></canvas>
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="vark-title">Every tool your memory needs</h2>
            <p class="vark-subtitle">
                Designed from the ground up around neuroscience not habit
                loops or gamification gimmicks.
            </p>
        </div>

        <div class="row g-4 mt-4">
            <!-- Visual Learning -->
            <div class="col-md-4">
                <div class="feature-card feature-purple">
                    <div class="feature-icon feature-icon-pink">🧠</div>
                    <h5>Visual Learning</h5>
                    <p>Understand concepts through diagrams, mind maps, charts, and colour-coded visual summaries in real time.</p>
                </div>
            </div>

            <!-- Auditory Learning -->
            <div class="col-md-4">
                <div class="feature-card feature-green">
                    <div class="feature-icon feature-icon-green">🎧</div>
                    <h5>Auditory Learning</h5>
                    <p>Absorb knowledge through lectures, podcasts, and group discussions. Recite and listen your way to mastery.</p>
                </div>
            </div>

            <!-- Reading / Writing -->
            <div class="col-md-4">
                <div class="feature-card feature-purple">
                    <div class="feature-icon feature-icon-purple">📖</div>
                    <h5>Reading / Writing</h5>
                    <p>Reinforce learning through textbooks, detailed notes, essays, and structured written summaries.</p>
                </div>
            </div>

            <!-- Kinesthetic Learning -->
            <div class="col-md-4">
                <div class="feature-card feature-green">
                    <div class="feature-icon feature-icon-yellow">⚡</div>
                    <h5>Kinesthetic Learning</h5>
                    <p>Learn by doing — hands-on practice, labs, real-world simulations, and trial-and-error exercises.</p>
                </div>
            </div>

            <!-- Interactive Quiz Paths -->
            <div class="col-md-4">
                <div class="feature-card feature-purple">
                    <div class="feature-icon feature-icon-blue">🗺️</div>
                    <h5>Interactive Quiz Paths</h5>
                    <p>Navigate branching quiz trees that adapt to your VARK profile. Each wrong answer reveals a new learning node.</p>
                </div>
            </div>

            <!-- Progress Visualisation -->
            <div class="col-md-4">
                <div class="feature-card feature-green">
                    <div class="feature-icon feature-icon-red">📈</div>
                    <h5>Progress Visualisation</h5>
                    <p>Watch your knowledge graph grow. Heatmaps, streaks, and mastery scores keep you on track.</p>
                </div>
            </div>
        </div>

        <!-- Multimodal (MT) Learner -->
        <div class="row g-4 mt-2">
            <div class="col-12">
                <div class="mt-card">
                    <div class="feature-icon feature-icon-orange mb-3">🧩</div>
                    <span class="mt-badge">NEW</span>
                    <h5 class="mt-3">Multimodal (MT) Learner</h5>
                    <p class="mt-text">
                        Some learners thrive across multiple VARK styles. The MT
                        type identifies your unique combination and delivers
                        blended study strategies.
                    </p>

                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <div class="mt-mini-box">
                                <strong class="mt-mini-title text-purple">V + A</strong>
                                <p class="mt-mini-text">Visual & Auditory — learns best with narrated visuals and diagrams</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-mini-box">
                                <strong class="mt-mini-title text-orange">R + K</strong>
                                <p class="mt-mini-text">Reading & Kinesthetic — reads deeply then reinforces through practice</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-mini-box">
                                <strong class="mt-mini-title text-green">V+A+R+K</strong>
                                <p class="mt-mini-text">Full multimodal — adapts fluidly to any learning context or format</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-section" id="how-it-works">
     <canvas id="particles-how"></canvas>
    <div class="container">
        <div class="row align-items-center g-5">

            <!-- Left side - steps -->
            <div class="col-lg-6">
                <h2 class="how-title">How it works</h2>

                <div class="how-step">
                    <div class="how-icon">🗺️</div>
                    <div>
                        <span class="how-number">01</span>
                        <h5>Identify Your Learning Style</h5>
                        <p>Take the scenario-based VARK quiz. The system analyses your answers and identifies whether you are a Visual, Auditory, Reading/Writing, Kinesthetic, or Multimodal learner.</p>
                    </div>
                </div>

                <div class="how-step">
                    <div class="how-icon">⚡</div>
                    <div>
                        <span class="how-number">02</span>
                        <h5>Train With Smart Quizzes</h5>
                        <p>Answer scenario-based questions derived from your VARK profile. The engine tracks confidence per learning type and adapts the next question accordingly.</p>
                    </div>
                </div>

                <div class="how-step">
                    <div class="how-icon">⏱️</div>
                    <div>
                        <span class="how-number">03</span>
                        <h5>Review at the Right Time</h5>
                        <p>SRS schedules each quiz session at the exact moment before you forget — turning short study sessions into long-term memory retention.</p>
                    </div>
                </div>

                <div class="how-step">
                    <div class="how-icon">📈</div>
                    <div>
                        <span class="how-number">04</span>
                        <h5>Track Your Growth</h5>
                        <p>View your results dashboard with graphical breakdowns of your VARK scores, history of past attempts, and personalised study recommendations.</p>
                    </div>
                </div>
            </div>

            <!-- Right side - layered images -->
            <div class="col-lg-6">
                <div class="how-image-wrapper">
                    <img src="{{ asset('images/neural-bg.jpg') }}" class="how-img how-img-back" alt="">
                    <img src="{{ asset('images/mindmap.jpg') }}" class="how-img how-img-front" alt="">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" style="background-image: url('{{ asset('images/cta-bg.jpg') }}');">

    <div class="container text-center cta-content">
        <div class="cta-icon">📊</div>

        <h2 class="cta-title">
            Start building your knowledge graph today
        </h2>

        <p class="cta-subtitle">
            Free forever. No credit card. Just better learning one node at a time.
        </p>

        <a href="{{ route('register') }}" class="btn btn-gradient btn-lg">
            Click Me & Register →
        </a>
    </div>
</section>
<script src="{{ asset('js/particles.js') }}"></script>
@endsection