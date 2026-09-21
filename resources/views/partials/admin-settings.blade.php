@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.admin-sidebar')
    <div class="dash-main">

        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">System Settings</h2>
                <p class="dash-latest">Configure MindMap Quiz system preferences</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.settings.save') }}">
            @csrf

            <!-- General Settings -->
            <div class="dash-card mb-4">
                <h5 class="dash-card-title">General Settings</h5>

                <label class="auth-label">SYSTEM NAME</label>
                <input type="text" name="system_name" class="auth-input"
                       value="MindMap Quiz" placeholder="System name">

                <label class="auth-label">CONTACT EMAIL</label>
                <input type="email" name="contact_email" class="auth-input"
                       value="admin@mindmapquiz.lk" placeholder="Contact email">

                <label class="auth-label">SYSTEM LANGUAGE</label>
                <select name="language" class="auth-input">
                    <option value="en" selected>English</option>
                    <option value="si">Sinhala</option>
                </select>
            </div>

            <!-- User Settings -->
            <div class="dash-card mb-4">
                <h5 class="dash-card-title">User Management Settings</h5>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-bottom:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">Allow Student Registration</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Allow new students to register accounts
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="allow_registration" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-bottom:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">Email Verification</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Require email verification on registration
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="email_verification">
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3">
                    <div>
                        <strong style="color:#fff">Allow Multiple Sessions</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Allow users to login from multiple devices
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="multiple_sessions" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <!-- Quiz Settings -->
            <div class="dash-card mb-4">
                <h5 class="dash-card-title">Quiz Settings</h5>

                <label class="auth-label">DEFAULT QUESTIONS COUNT</label>
                <select name="quiz_questions" class="auth-input mb-3">
                    <option value="10" selected>10 Questions</option>
                    <option value="15">15 Questions</option>
                    <option value="20">20 Questions</option>
                </select>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-top:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">Allow Quiz Retake</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Students can retake the quiz multiple times
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="allow_retake" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-top:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">Show Results Immediately</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Show VARK results right after quiz completion
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="show_results" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <!-- Notification Settings -->
            <div class="dash-card mb-4">
                <h5 class="dash-card-title">Notification Settings</h5>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-bottom:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">New Student Alerts</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Get notified when new students register
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="student_alerts" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-bottom:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">Quiz Completion Alerts</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Get notified when students complete quizzes
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="quiz_alerts">
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3">
                    <div>
                        <strong style="color:#fff">Weekly Report Email</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Receive weekly system analytics via email
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="weekly_report" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <!-- Security Settings -->
            <div class="dash-card mb-4">
                <h5 class="dash-card-title">Security Settings</h5>

                <label class="auth-label">SESSION TIMEOUT (MINUTES)</label>
                <select name="session_timeout" class="auth-input mb-3">
                    <option value="30">30 Minutes</option>
                    <option value="60" selected>60 Minutes</option>
                    <option value="120">2 Hours</option>
                    <option value="480">8 Hours</option>
                </select>

                <label class="auth-label">MIN PASSWORD LENGTH</label>
                <select name="min_password" class="auth-input mb-3">
                    <option value="6" selected>6 Characters</option>
                    <option value="8">8 Characters</option>
                    <option value="10">10 Characters</option>
                </select>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-top:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">Force HTTPS</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Redirect all HTTP traffic to HTTPS
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="force_https">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-auth-gradient">
                💾 Save All Settings
            </button>
        </form>

    </div>
</div>
@endsection