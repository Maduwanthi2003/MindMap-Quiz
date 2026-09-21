@extends('layouts.app')

@section('content')

<canvas id="particles-lecturer"></canvas>

<div class="dashboard-wrapper">

    <!-- Sidebar -->
    <div class="dash-sidebar">
        <div class="dash-logo">🧠 MindMapQuiz</div>

        <p class="dash-menu-label">LECTURER PANEL</p>
        <ul class="dash-nav">
            <li class="active"><a href="{{ route('lecturer') }}">📊 Dashboard</a></li>
            <li><a href="{{ route('lecturer.students') }}">👥 Students</a></li>
            <li><a href="{{ route('lecturer.lectures') }}">📚 Lectures</a></li>
            <li><a href="{{ route('lecturer.links') }}">🔗 Share Links</a></li>
            <li><a href="{{ route('lecturer.reports') }}">📈 Reports</a></li>
            <li><a href="{{ route('lecturer.feedback') }}">💬 Feedback</a></li>
        </ul>

        <p class="dash-menu-label">SETTINGS</p>
        <ul class="dash-nav">
            <li><a href="{{ route('lecturer.settings') }}">⚙️ Settings</a></li>
            <li><a href="{{ route('lecturer.profile') }}">👤 My Profile</a></li>
            <li><a href="{{ route('logout') }}" class="logout-link">🚪 Logout</a></li>
        </ul>

        <div class="dash-user">
            @if(!empty($lecturer->profile_photo))
                <img src="{{ asset('profile_photos/' . $lecturer->profile_photo) }}"
                     alt="Lecturer photo"
                     class="dash-avatar"
                     style="object-fit:cover;"
                />
            @else
                <div class="dash-avatar" style="background:linear-gradient(135deg,#7b5cff,#4dd0e1)">
                    {{ strtoupper(substr($lecturer->name ?? $lecturer->full_name ?? 'LE', 0, 2)) }}
                </div>
            @endif
            <div>
                <strong>{{ $lecturer->name ?? $lecturer->full_name ?? 'Lecturer' }}</strong>
                <small>{{ ucfirst($lecturer->role ?? 'lecturer') }}</small>
                <div style="font-size:0.8rem;color:#9a9aae">{{ $lecturer->email ?? '' }}</div>
                <div style="font-size:0.75rem;color:#7e7e8f">Joined: {{ isset($lecturer->created_at) ? \Carbon\Carbon::parse($lecturer->created_at)->format('M d, Y') : '' }}</div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="dash-main">

        <!-- Header -->
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Lecture Assignment Dashboard</h2>
                <p class="dash-latest">MindMap Quiz — Assign lectures based on student VARK & MT profiles</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn-lec-outline">+ Add Lecture</button>
                <button class="btn-lec-gradient">🔗 Share All Links</button>
            </div>
        </div>

        <!-- Stats -->
        <div class="dash-stats">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <p class="stat-label">Total Students</p>
                <h3 class="stat-value">{{ $studentCount }}</h3>
                <small class="stat-sub">Students registered</small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <p class="stat-label">Lectures Assigned</p>
                <h3 class="stat-value">{{ $resultCount }}</h3>
                <small class="stat-sub">Quiz results recorded</small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🧩</div>
                <p class="stat-label">MT Learners</p>
                <h3 class="stat-value">{{ $mtPercent }}%</h3>
                <small class="stat-sub">Multimodal detected</small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🔗</div>
                <p class="stat-label">Links Shared</p>
                <h3 class="stat-value">{{ $recommendationCount }}</h3>
                <small class="stat-sub">Recommendations saved</small>
            </div>
        </div>

        <!-- Share Links -->
        <div class="dash-card">
            <h5 class="dash-card-title" style="color:#4dd0e1">
                🔗 Active Share Links — Send lectures to students by their VARK type
            </h5>

            @php
            $links = [
                ['init'=>'DR','name'=>'D.R.P Maduwanthi','type'=>'Visual + Kinesthetic (MT)','color'=>'linear-gradient(135deg,#7b5cff,#4dd0e1)','url'=>'mindmapquiz.lk/lectures/mt/dr-234'],
                ['init'=>'KP','name'=>'K.P Nishantha','type'=>'Kinesthetic','color'=>'linear-gradient(135deg,#ff6bcb,#ff9cd9)','url'=>'mindmapquiz.lk/lectures/k/kp-189'],
                ['init'=>'SM','name'=>'S.M Dilrukshi','type'=>'Read/Write','color'=>'linear-gradient(135deg,#ffc078,#f5c542)','url'=>'mindmapquiz.lk/lectures/r/sm-312'],
                ['init'=>'AP','name'=>'A.P Kumara','type'=>'Visual','color'=>'linear-gradient(135deg,#7b5cff,#4dd0e1)','url'=>'mindmapquiz.lk/lectures/v/ap-401'],
                ['init'=>'NW','name'=>'N.W Perera','type'=>'Auditory','color'=>'linear-gradient(135deg,#4dd0e1,#4dd6a8)','url'=>'mindmapquiz.lk/lectures/a/nw-567'],
            ];
            @endphp

            @foreach($links as $l)
            <div class="lec-link-row">
                <div class="d-flex align-items-center gap-3">
                    <div class="dash-avatar" style="background:{{ $l['color'] }}">{{ $l['init'] }}</div>
                    <div>
                        <strong style="color:#fff">{{ $l['name'] }}</strong>
                        <small style="color:#9a9aae;display:block">{{ $l['type'] }}</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="lec-url">{{ $l['url'] }}</span>
                    <button class="btn-copy">📋 Copy</button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Bottom Grid -->
        <div class="row g-4">

            <!-- Student VARK Profiles -->
            <div class="col-lg-7">
                <div class="dash-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="dash-card-title mb-0">Student VARK Profiles</h5>
                        <small style="color:#6e6e85">{{ $studentCount }} students</small>
                    </div>

                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>STUDENT</th>
                                <th>VARK TYPE</th>
                                <th>SCORE</th>
                                <th>LECTURE</th>
                                <th>LINK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($studentProfiles as $profile)
                                @php
                                    $score = max([$profile->visual_pct, $profile->auditory_pct, $profile->read_write_pct, $profile->kinesthetic_pct]);
                                    $type = $profile->dominant_style;
                                    if (!empty($profile->secondary_style) && $profile->secondary_style !== $profile->dominant_style) {
                                        $type = $profile->dominant_style . ' + ' . $profile->secondary_style;
                                    }
                                    $initials = strtoupper(substr($profile->full_name, 0, 2));
                                    $badgeClass = 'lec-' . strtolower(str_replace(['/', ' '], '-', $profile->dominant_style));
                                @endphp
                                <tr>
                                    <td>
                                        <div class="student-cell">
                                            <div class="dash-avatar" style="background:linear-gradient(135deg,#7b5cff,#4dd0e1);width:32px;height:32px;font-size:0.7rem">{{ $initials }}</div>
                                            <div>
                                                <strong style="color:#fff;font-size:0.85rem">{{ $profile->full_name }}</strong>
                                                <small style="color:#6e6e85;display:block;font-size:0.7rem">{{ $profile->index_number }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="lec-badge {{ $badgeClass }}">{{ $type }}</span></td>
                                    <td><strong style="color:#b89cff">{{ $score }}%</strong></td>
                                    <td><span class="lec-badge lec-visual">{{ $profile->dominant_style }} Study</span></td>
                                    <td><button class="btn-share">🔗 Share</button></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="color:#fff; text-align:center; padding: 24px 0;">No student profiles found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right side -->
            <div class="col-lg-5">

                <!-- Available Lectures -->
                <div class="dash-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="dash-card-title mb-0">Available Lectures</h5>
                        <small style="color:#6e6e85">{{ $totalLectures ?? 0 }} total</small>
                    </div>

                    <div class="lec-item">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <strong style="color:#fff;font-size:0.9rem">Mind Mapping Techniques</strong>
                            <span class="lec-badge lec-visual">Visual</span>
                        </div>
                        <small style="color:#9a9aae">Colour-coded diagrams and flowcharts for concept mapping</small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small style="color:#6e6e85">Assigned to <strong style="color:#b89cff">12 students</strong></small>
                            <button class="btn-assign">+ Assign</button>
                        </div>
                    </div>

                    <div class="lec-item">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <strong style="color:#fff;font-size:0.9rem">Hands-on Lab Sessions</strong>
                            <span class="lec-badge lec-kine">Kinesthetic</span>
                        </div>
                        <small style="color:#9a9aae">Practice-based exercises and real-world simulations</small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small style="color:#6e6e85">Assigned to <strong style="color:#ff9cd9">8 students</strong></small>
                            <button class="btn-assign">+ Assign</button>
                        </div>
                    </div>

                    <div class="lec-item">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <strong style="color:#fff;font-size:0.9rem">Podcast Study Series</strong>
                            <span class="lec-badge lec-aud">Auditory</span>
                        </div>
                        <small style="color:#9a9aae">Listen-and-learn audio content with discussion prompts</small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small style="color:#6e6e85">Assigned to <strong style="color:#7de8c4">6 students</strong></small>
                            <button class="btn-assign">+ Assign</button>
                        </div>
                    </div>

                    <div class="lec-item">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <strong style="color:#fff;font-size:0.9rem">Visual + Practice Combo</strong>
                            <span class="lec-badge lec-mt">MT</span>
                        </div>
                        <small style="color:#9a9aae">Blended diagrams + hands-on tasks for multimodal learners</small>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small style="color:#6e6e85">Assigned to <strong style="color:#b89cff">14 students</strong></small>
                            <button class="btn-assign">+ Assign</button>
                        </div>
                    </div>
                </div>

                <!-- VARK Distribution -->
                <div class="dash-card">
                    <h5 class="dash-card-title">VARK Distribution</h5>
                    <div class="vark-bar-row">
                        <span>Visual (V)</span>
                        <div class="vark-bar-track">
                            <div class="vark-bar-fill vark-purple" style="width:43%"></div>
                        </div>
                        <span>43%</span>
                    </div>
                    <div class="vark-bar-row">
                        <span>Kinesthetic (K)</span>
                        <div class="vark-bar-track">
                            <div class="vark-bar-fill vark-pink" style="width:30%"></div>
                        </div>
                        <span>30%</span>
                    </div>
                    <div class="vark-bar-row">
                        <span>Auditory (A)</span>
                        <div class="vark-bar-track">
                            <div class="vark-bar-fill vark-teal" style="width:15%"></div>
                        </div>
                        <span>15%</span>
                    </div>
                    <div class="vark-bar-row">
                        <span>Read/Write (R)</span>
                        <div class="vark-bar-track">
                            <div class="vark-bar-fill vark-yellow" style="width:12%"></div>
                        </div>
                        <span>12%</span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection