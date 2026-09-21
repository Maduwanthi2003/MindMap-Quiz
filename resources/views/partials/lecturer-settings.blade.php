@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.lecturer-sidebar')
    <div class="dash-main">

        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Settings</h2>
                <p class="dash-latest">System preferences and configurations</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('lecturer.settings.save') }}">
            @csrf

            <!-- Notification Settings -->
            <div class="dash-card mb-4">
                <h5 class="dash-card-title">Notification Settings</h5>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-bottom:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">Email Notifications</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Receive email when students complete a quiz
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="email_notifications" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-bottom:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">New Feedback Alerts</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Get notified when students submit feedback
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="feedback_alerts" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center py-3">
                    <div>
                        <strong style="color:#fff">Weekly Report Summary</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Receive weekly analytics report via email
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="weekly_report">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <!-- Quiz Settings -->
            <div class="dash-card mb-4">
                <h5 class="dash-card-title">Quiz Settings</h5>

                <label class="auth-label">DEFAULT QUIZ QUESTIONS COUNT</label>
                <select name="quiz_count" class="auth-input mb-3">
                    <option value="10" selected>10 Questions</option>
                    <option value="15">15 Questions</option>
                    <option value="20">20 Questions</option>
                </select>

                <label class="auth-label">RESULT VISIBILITY</label>
                <select name="result_visibility" class="auth-input mb-3">
                    <option value="immediate" selected>Show results immediately</option>
                    <option value="delayed">Show after lecturer review</option>
                </select>

                <div class="d-flex justify-content-between align-items-center py-3"
                     style="border-top:1px solid rgba(255,255,255,0.05)">
                    <div>
                        <strong style="color:#fff">Allow Retake</strong>
                        <p style="color:#9a9aae;font-size:0.85rem;margin:0">
                            Students can retake the quiz multiple times
                        </p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="allow_retake" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <!-- Display Settings -->
            <div class="dash-card mb-4">
                <h5 class="dash-card-title">Display Settings</h5>

                <label class="auth-label">DASHBOARD LANGUAGE</label>
                <select name="language" class="auth-input mb-3">
                    <option value="en" selected>English</option>
                    <option value="si">Sinhala</option>
                </select>

                <label class="auth-label">ITEMS PER PAGE</label>
                <select name="items_per_page" class="auth-input">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>

            <button type="submit" class="btn-auth-gradient">
                💾 Save Settings
            </button>
        </form>

    </div>
</div>
@endsection