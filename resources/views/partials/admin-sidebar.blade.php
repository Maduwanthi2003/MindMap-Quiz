<div class="dash-sidebar">
    <div class="dash-logo">🧠 MindMapQuiz</div>

    <p class="dash-menu-label">ADMIN PANEL</p>
    <ul class="dash-nav">
        <li class="{{ Request::is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin') }}">📊 Dashboard</a>
        </li>
        <li class="{{ Request::is('admin/students*') ? 'active' : '' }}">
            <a href="{{ route('admin.students') }}">👥 Students</a>
        </li>
        <li class="{{ Request::is('admin/lecturers*') ? 'active' : '' }}">
            <a href="{{ route('admin.lecturers') }}">👨‍🏫 Lecturers</a>
        </li>
        <li class="{{ Request::is('admin/quiz-results*') ? 'active' : '' }}">
            <a href="{{ route('admin.results') }}">📝 Quiz Results</a>
        </li>
        <li class="{{ Request::is('admin/reports*') ? 'active' : '' }}">
            <a href="{{ route('admin.reports') }}">📈 Reports</a>
        </li>
        <li class="{{ Request::is('admin/feedback*') ? 'active' : '' }}">
            <a href="{{ route('admin.feedback') }}">💬 Feedback</a>
        </li>
    </ul>

    <p class="dash-menu-label">SETTINGS</p>
    <ul class="dash-nav">
        <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
            <a href="{{ route('admin.settings') }}">⚙️ System Settings</a>
        </li>
        <li class="{{ Request::is('admin/profile*') ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}">👤 My Profile</a>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="logout-link">🚪 Logout</a>
        </li>
    </ul>

    <div class="dash-user">
        <div class="dash-avatar">
            {{ strtoupper(substr($admin->name, 0, 2)) }}
        </div>
        <div>
            <strong>{{ $admin->name }}</strong>
            <small>Administrator</small>
        </div>
    </div>
</div>