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
                Learn Deeper.<br>
                <span class="gradient-text">Remember Forever.</span>
            </h2>

            <p class="auth-left-text">
                Identify your VARK learning style and unlock personalised
                study strategies — powered by spaced repetition.
            </p>

            <div class="auth-feature">
                <span class="auth-feature-icon">🗺️</span>
                <span><strong>Identify</strong> your VARK or MT learning type</span>
            </div>
            <div class="auth-feature">
                <span class="auth-feature-icon">⚡</span>
                <span><strong>Train</strong> with smart scenario-based quizzes</span>
            </div>
            <div class="auth-feature">
                <span class="auth-feature-icon">✅</span>
                <span><strong>Track</strong> your progress and mastery over time</span>
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

            <p class="auth-copyright">© 2026 MindMap Quiz - Built for lifelong learners.</p>
        </div>

        <!-- Right Panel -->
        <div class="auth-right">
            <h3 class="auth-right-title">Welcome back</h3>
            @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert-error">
        {{ $errors->first() }}
    </div>
@endif
            <p class="auth-right-subtitle">Sign in to continue your learning journey</p>

            <form method="POST" action="{{ route('login.submit') }}" autocomplete="off">
                <!-- hidden dummy fields to discourage browser autofill -->
                <input type="text" name="prevent_autofill" autocomplete="off" style="position:absolute;left:-9999px;top:-9999px;" />
                <input type="password" name="prevent_password" autocomplete="off" style="position:absolute;left:-9999px;top:-9999px;" />
                @csrf

                  <label class="auth-label">EMAIL ADDRESS</label>
                  <input type="email" name="email" class="auth-input"
                      placeholder="you@example.com" autocomplete="username" value="{{ old('email') }}">

 <label class="auth-label">PASSWORD</label>
<div class="password-wrapper">
        <input type="password" 
            name="password" 
            id="passwordField" 
            class="auth-input" 
            autocomplete="current-password"
            placeholder="Enter your password">
    <button type="button" class="eye-btn" id="eyeBtn" onclick="togglePassword()">
        👁️
    </button>
</div>

                <div class="text-end mb-3">
                    <a href="#" class="auth-link-small">Forgot password?</a>
                </div>

                <button type="submit" class="btn-auth-gradient mb-3">
                    Sign in
                </button>

                <div class="auth-divider"><span>or continue with</span></div>

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
                    Don't have an account?
                    <a href="{{ route('register') }}" class="auth-link">Register</a>
                </p>
            </form>
        </div>

    </div>
</div>

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
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // rename visible inputs so password managers can't match saved credentials,
    // then create hidden real inputs and copy values on submit.
    function preventAutofillByRenaming(form, names) {
        if (!form) return;
        names.forEach(function(n) {
            var el = form.querySelector('input[name="' + n + '"]');
            if (el) {
                // store original name and give it a fake name immediately
                el.setAttribute('data-original-name', n);
                el.setAttribute('name', n + '_fake_' + Math.random().toString(36).slice(2,8));
                // ensure autocomplete off on visible
                el.setAttribute('autocomplete', 'off');
                // create hidden real field
                var hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = n;
                hidden.value = '';
                form.appendChild(hidden);
            }
        });
        form.addEventListener('submit', function(e) {
            names.forEach(function(n) {
                var visible = form.querySelector('[data-original-name="' + n + '"]');
                var hidden = form.querySelector('input[type="hidden"][name="' + n + '"]');
                if (visible && hidden) hidden.value = visible.value || '';
            });
        });
    }

    function clearAutofillOnce() {
        var email = document.querySelector('input[name="email"]');
        var pwd = document.querySelector('input[name="password"]');
        if (email && pwd) {
            if (email.value || pwd.value) {
                email.value = '';
                pwd.value = '';
                // notify any listeners
                email.dispatchEvent(new Event('input', { bubbles: true }));
                pwd.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }
    }

    // run several times to catch different browser timings
    // attempt renaming immediately to avoid matches
    var form = document.querySelector('form');
    preventAutofillByRenaming(form, ['email','password']);
    [120, 500, 1000, 2000].forEach(function(t) { setTimeout(clearAutofillOnce, t); });

    // also clear when inputs receive focus (user likely wants fresh values)
    var emailEl = document.querySelector('input[name="email"]');
    var pwdEl = document.querySelector('input[name="password"]');
    if (emailEl) {
        emailEl.addEventListener('focus', function() { setTimeout(clearAutofillOnce, 50); });
    }
    if (pwdEl) {
        pwdEl.addEventListener('focus', function() { setTimeout(clearAutofillOnce, 50); });
    }
});
</script>

@endsection