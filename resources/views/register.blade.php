@extends('layouts.auth')

@section('content')

<div class="reg-bg"></div>

<div class="auth-wrapper">
    <div class="auth-card">

        <!-- Left Panel -->
        <div class="auth-left">
            <div class="auth-logo">
                <span class="auth-logo-icon">🧠</span>
                <strong>MindMap Quiz</strong>
            </div>

            <h2 class="auth-left-title">
                Start Learning<br>
                <span class="gradient-text">The Right Way.</span>
            </h2>

            <p class="auth-left-text">
                Join thousands of students who discovered their VARK
                learning style and improved their results with
                personalised study strategies.
            </p>

            <div class="auth-feature">
                <span class="auth-feature-icon">🗺️</span>
                <span><strong>Discover</strong> your Visual, Auditory, R/W or Kinesthetic type</span>
            </div>
            <div class="auth-feature">
                <span class="auth-feature-icon">⚡</span>
                <span><strong>Detect</strong> Multimodal (MT) combinations automatically</span>
            </div>
            <div class="auth-feature">
                <span class="auth-feature-icon">✅</span>
                <span><strong>Track</strong> progress with your personal results dashboard</span>
            </div>

            <div class="auth-stats">
                <div class="auth-stat">
                    <small>LEARNERS</small>
                    <strong class="stat-purple">2.4k+</strong>
                </div>
                <div class="auth-stat">
                    <small>QUIZZES</small>
                    <strong class="stat-green">18k+</strong>
                </div>
                <div class="auth-stat">
                    <small>MT USERS</small>
                    <strong class="stat-orange">63%</strong>
                </div>
            </div>

            <p class="auth-copyright">© 2024 MindMap Quiz - HND Information Technology</p>
        </div>

        <!-- Right Panel -->
        <div class="auth-right">
            <h3 class="auth-right-title">Create your account</h3>
            <p class="auth-right-subtitle">Free forever — no credit card required</p>

            <form method="POST" action="{{ route('register.submit') }}" autocomplete="off">
                @csrf

                @if($errors->any())
                    <div class="alert-error mb-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="row g-2">
                    <div class="col-6">
                        <label class="auth-label">FIRST NAME</label>
                        <input type="text" name="first_name" class="auth-input" placeholder="" autocomplete="off">
                    </div>
                    <div class="col-6">
                        <label class="auth-label">LAST NAME</label>
                        <input type="text" name="last_name" class="auth-input" placeholder="" autocomplete="off">
                    </div>
                </div>

                <label class="auth-label">EMAIL ADDRESS</label>
                <input type="email" name="email" class="auth-input" placeholder="you@example.com" autocomplete="off">

                <label class="auth-label">ROLE</label>
                <select name="role" class="auth-input" id="roleSelect">
                    <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                    <option value="lecturer" {{ old('role') === 'lecturer' ? 'selected' : '' }}>Lecturer</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }} {{ !empty($adminExists) ? 'disabled' : '' }}>Administrator</option>
                </select>

                @if(!empty($adminExists))
                    <small class="text-danger"></small>
                @endif

                <div id="indexNumberField">
                    <label class="auth-label">INDEX NUMBER</label>
                    <input type="text" name="index_number" class="auth-input" placeholder="" autocomplete="off">
                </div>

                <small id="lecturerIndexHint" style="display:none;color:#9a9aae;"></small>

                <div class="row g-2">
                    <div class="col-6">
                        <label class="auth-label">PASSWORD</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" 
                                       id="passwordField" class="auth-input" 
                                       autocomplete="off" placeholder="••••••••">
                            <button type="button" class="eye-btn" 
                                    id="eyeBtn" onclick="togglePassword()">👁️</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="auth-label">CONFIRM PASSWORD</label>
                        <div class="password-wrapper">
                            <input type="password" name="password_confirmation" 
                                id="confirmField" class="auth-input" 
                                autocomplete="off" placeholder="••••••••">
                            <button type="button" class="eye-btn" 
                                    id="eyeBtn2" onclick="toggleConfirm()">👁️</button>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 mt-3 mb-3">
                    <input type="checkbox" id="terms" name="terms">
                    <label for="terms" class="auth-terms">
                        I agree to the 
                        <a href="#" class="auth-link">Terms of Service</a> 
                        and 
                        <a href="#" class="auth-link">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="btn-auth-gradient mb-3">
                    Create account
                </button>

                <div class="auth-divider"><span>or register with</span></div>

                <button type="button" class="auth-google-btn mb-3">
                    <svg width="20" height="20" viewBox="0 0 48 48">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    </svg>
                    Continue with Google
                </button>

                <p class="auth-bottom-text">
                    Already have an account?
                    <a href="{{ route('login') }}" class="auth-link">Sign in</a>
                </p>
            </form>
        </div>

    </div>
</div>

<script>
function togglePassword() {
    var field = document.getElementById('passwordField');
    var btn   = document.getElementById('eyeBtn');
    if (field.getAttribute('type') === 'password') {
        field.setAttribute('type', 'text');
        btn.textContent = '🙈';
    } else {
        field.setAttribute('type', 'password');
        btn.textContent = '👁️';
    }
}

function toggleConfirm() {
    var field = document.getElementById('confirmField');
    var btn   = document.getElementById('eyeBtn2');
    if (field.getAttribute('type') === 'password') {
        field.setAttribute('type', 'text');
        btn.textContent = '🙈';
    } else {
        field.setAttribute('type', 'password');
        btn.textContent = '👁️';
    }
}

var roleSelect = document.getElementById('roleSelect');
var indexNumberField = document.getElementById('indexNumberField');
var lecturerIndexHint = document.getElementById('lecturerIndexHint');

function updateIndexField() {
    if (roleSelect.value === 'lecturer') {
        indexNumberField.style.display = 'none';
        lecturerIndexHint.style.display = 'block';
    } else {
        indexNumberField.style.display = 'block';
        lecturerIndexHint.style.display = 'none';
    }
}

if (roleSelect) {
    roleSelect.addEventListener('change', updateIndexField);
    updateIndexField();
}
</script>


@endsection