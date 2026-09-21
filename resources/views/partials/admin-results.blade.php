@extends('layouts.app')
@section('content')
<canvas id="particles-admin"></canvas>
<div class="dashboard-wrapper">
    @include('partials.admin-sidebar')
    <div class="dash-main">
        <div class="dash-header">
            <div>
                <h2 class="dash-welcome">Quiz Results</h2>
                <p class="dash-latest">All student VARK quiz results</p>
            </div>
            <span class="badge-visual">{{ $results->count() }} Results</span>
        </div>

        @if(session('success'))
            <div class="alert-success mb-3">✅ {{ session('success') }}</div>
        @endif

        <div class="dash-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>STUDENT</th>
                        <th>DATE</th>
                        <th>DOMINANT</th>
                        <th>SECONDARY</th>
                        <th>VISUAL</th>
                        <th>AUDITORY</th>
                        <th>R/W</th>
                        <th>KINESTH.</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $r)
                    <tr>
                        <td>
                            <div class="student-cell">
                                <div class="dash-avatar"
                                     style="width:30px;height:30px;font-size:0.65rem;background:linear-gradient(135deg,#7b5cff,#4dd0e1)">
                                    {{ strtoupper(substr($r->full_name, 0, 2)) }}
                                </div>
                                <div>
                                    <strong style="color:#fff;font-size:0.85rem">
                                        {{ $r->full_name }}
                                    </strong>
                                    <small style="color:#6e6e85;display:block;font-size:0.7rem">
                                        {{ $r->index_number ?? '' }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td style="color:#9a9aae">
                            {{ date('Y-m-d', strtotime($r->calculated_at)) }}
                        </td>
                        <td><span class="badge-visual">{{ $r->dominant_style }}</span></td>
                        <td><span class="badge-kine">{{ $r->secondary_style }}</span></td>
                        <td><strong style="color:#b89cff">{{ $r->visual_pct }}%</strong></td>
                        <td><strong style="color:#7de8c4">{{ $r->auditory_pct }}%</strong></td>
                        <td><strong style="color:#ffc078">{{ $r->read_write_pct }}%</strong></td>
                        <td><strong style="color:#ff9cd9">{{ $r->kinesthetic_pct }}%</strong></td>
                        <td>
                            <a href="{{ route('admin.results.delete', $r->result_id) }}"
                               class="btn-delete"
                               onclick="return confirm('Delete this result?')">🗑️</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="color:#9a9aae;text-align:center">
                            No results yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection