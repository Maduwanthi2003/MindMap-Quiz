<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">
      🧠 MindMapQuiz
    </a>

    <button class="navbar-toggler" type="button" 
            data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center gap-3">

        @if(Request::is('quiz'))
          {{-- Quiz page --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-gradient ms-2" href="{{ route('register') }}">Register</a>
          </li>

        @else
          {{-- Home page --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about-vark">About VARK</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#features">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#how-it-works">How It Works</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-gradient ms-2" href="{{ route('login') }}">Login</a>
          </li>
        @endif

      </ul>
    </div>
  </div>
</nav>