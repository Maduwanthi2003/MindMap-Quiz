<div class="dash-sidebar">
    <div class="dash-logo">🧠 MindMapQuiz</div>

    <p class="dash-menu-label">LECTURER PANEL</p>
    <ul class="dash-nav">
        <li class="{{ Request::is('lecturer') ? 'active' : '' }}">
            <a href="{{ route('lecturer') }}">📊 Dashboard</a>
        </li>
        <li class="{{ Request::is('lecturer/students') ? 'active' : '' }}">
            <a href="{{ route('lecturer.students') }}">👥 Students</a>
        </li>
        <li class="{{ Request::is('lecturer/lectures') ? 'active' : '' }}">
            <a href="{{ route('lecturer.lectures') }}">📚 Lectures</a>
        </li>
        <li class="{{ Request::is('lecturer/share-links') ? 'active' : '' }}">
            <a href="{{ route('lecturer.links') }}">🔗 Share Links</a>
        </li>
        <li class="{{ Request::is('lecturer/reports') ? 'active' : '' }}">
            <a href="{{ route('lecturer.reports') }}">📈 Reports</a>
        </li>
        <li class="{{ Request::is('lecturer/feedback') ? 'active' : '' }}">
            <a href="{{ route('lecturer.feedback') }}">💬 Feedback</a>
        </li>
    </ul>

    <p class="dash-menu-label">SETTINGS</p>
    <ul class="dash-nav">
        <li class="{{ Request::is('lecturer/settings') ? 'active' : '' }}"><a href="{{ route('lecturer.settings') }}">⚙️ Settings</a></li>
        <li class="{{ Request::is('lecturer/profile') ? 'active' : '' }}"><a href="{{ route('lecturer.profile') }}">👤 My Profile</a></li>
        <li><a href="{{ route('logout') }}" class="logout-link">🚪 Logout</a></li>
    </ul>

    <div class="dash-user">
        <div class="dash-avatar" 
             style="background:linear-gradient(135deg,#7b5cff,#4dd0e1)">
            {{ strtoupper(substr($lecturer->name, 0, 2)) }}
        </div>
        <div>
            <strong>{{ $lecturer->name }}</strong>
            <small>Lecturer</small>
        </div>
    </div>
</div>