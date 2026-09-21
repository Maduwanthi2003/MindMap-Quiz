<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Student Dashboard
Route::get('/dashboard', function () {
    if (!session('student_id') || session('role') !== 'student') {
        return redirect()->route('login');
    }

    $student = DB::table('students')
                 ->where('student_id', session('student_id'))
                 ->first();

    $quizCount = DB::table('quiz_attempts')
                   ->where('student_id', session('student_id'))
                   ->count();

    $latestResult = DB::table('quiz_results')
                      ->join('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
                      ->where('quiz_results.student_id', session('student_id'))
                      ->orderBy('quiz_results.calculated_at', 'desc')
                      ->select('quiz_results.*', 'vark_scores.*')
                      ->first();

    $latestRecommendation = null;
    if ($latestResult) {
        $latestRecommendation = DB::table('recommendations')
                                  ->where('result_id', $latestResult->result_id)
                                  ->orderBy('rec_id', 'desc')
                                  ->first();
    }

    return view('partials.dashboard', compact('student', 'quizCount', 'latestResult', 'latestRecommendation'));
})->name('dashboard');

// Quiz
Route::get('/quiz', function () {
    if (!session('student_id') || session('role') !== 'student') {
        return redirect()->route('login');
    }
    return redirect()->route('dashboard.quiz');
})->name('quiz');

// Admin Dashboard
Route::get('/admin', function () {
    if (!session('admin_id') || session('role') !== 'admin') {
        return redirect()->route('login');
    }

    $admin = DB::table('admins')->where('admin_id', session('admin_id'))->first();

    $studentCount = DB::table('students')->where('role', 'student')->count();
    $quizCount = DB::table('quiz_attempts')->count();
    $feedbackCount = DB::table('feedback')->count();
    $lecturerCount = DB::table('lecturers')->count();

    $visualCount = DB::table('quiz_results')
        ->join('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
        ->where('vark_scores.visual_pct', '>=', DB::raw('vark_scores.auditory_pct'))
        ->where('vark_scores.visual_pct', '>=', DB::raw('vark_scores.read_write_pct'))
        ->where('vark_scores.visual_pct', '>=', DB::raw('vark_scores.kinesthetic_pct'))
        ->count();

    $recentResults = DB::table('quiz_results')
        ->join('students', 'quiz_results.student_id', '=', 'students.student_id')
        ->leftJoin('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
        ->select('quiz_results.*', 'students.full_name', 'students.index_number', 'vark_scores.visual_pct', 'vark_scores.auditory_pct', 'vark_scores.read_write_pct', 'vark_scores.kinesthetic_pct')
        ->orderBy('quiz_results.calculated_at', 'desc')
        ->limit(5)
        ->get();

    $recentFeedback = DB::table('feedback')
        ->join('students', 'feedback.student_id', '=', 'students.student_id')
        ->select('feedback.*', 'students.full_name')
        ->orderBy('feedback.submitted_at', 'desc')
        ->limit(3)
        ->get();

    return view('partials.admin', compact('admin', 'studentCount', 'quizCount', 'feedbackCount', 'lecturerCount', 'visualCount', 'recentResults', 'recentFeedback'));
})->name('admin');

// Admin Profile
Route::get('/admin/profile', function () {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    $admin = DB::table('admins')->where('admin_id', session('admin_id'))->first();
    return view('admin.profile', compact('admin'));
})->name('admin.profile');

// Admin Settings
Route::get('/admin/settings', function () {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    $admin = DB::table('admins')->where('admin_id', session('admin_id'))->first();
    return view('admin.settings', compact('admin'));
})->name('admin.settings');

Route::post('/admin/settings', function () {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');

    $validated = request()->validate([
        'full_name' => 'required|string|max:150',
        'email'     => 'required|email|max:200',
        'password'  => 'nullable|string|min:6',
    ]);

    $data = [
        'name' => $validated['full_name'],
        'email' => $validated['email'],
    ];

    if (!empty($validated['password'])) {
        $data['password_hash'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
    }

    DB::table('admins')->where('admin_id', session('admin_id'))->update($data);

    session(['admin_name' => $validated['full_name']]);

    return redirect()->route('admin.profile')->with('success', 'Settings updated!');
})->name('admin.settings.update');

// Temporary debug route: set session as admin and redirect (local only)
Route::get('/admin/debug-login', function () {
    if (env('APP_ENV') !== 'local') abort(403);
    $admin = DB::table('admins')->first();
    if (!$admin) return redirect('/login')->withErrors(['email' => 'No admin account found.']);
    session()->flush();
    session([
        'admin_id'   => $admin->admin_id,
        'admin_name' => $admin->name,
        'role'       => 'admin',
    ]);
    return redirect()->route('admin');
})->name('admin.debug');

// One-time transfer helper: move admin rows from `students` to `admins` (local only)
Route::get('/admin/transfer-admins', function () {
    if (env('APP_ENV') !== 'local') abort(403);
    $admins = DB::table('students')->where('role', 'admin')->get();
    $moved = [];
    foreach ($admins as $a) {
        $exists = DB::table('admins')->where('email', $a->email)->first();
        if ($exists) {
            $moved[] = ['email' => $a->email, 'status' => 'already_exists'];
            continue;
        }
        $id = DB::table('admins')->insertGetId([
            'name' => $a->full_name,
            'email' => $a->email,
            'password_hash' => $a->password_hash,
            'profile_photo' => $a->profile_photo ?? null,
            'created_at' => $a->created_at ?? now(),
            'updated_at' => $a->updated_at ?? now(),
        ]);
        DB::table('students')->where('student_id', $a->student_id)->delete();
        $moved[] = ['email' => $a->email, 'status' => 'moved', 'admin_id' => $id];
    }
    return response()->json(['moved' => $moved]);
});

// Student pages
Route::get('/quiz-history', function () {
    if (!session('student_id') || session('role') !== 'student') return redirect()->route('login');
    $student = DB::table('students')->where('student_id', session('student_id'))->first();
    $attempts = DB::table('quiz_attempts')
                  ->join('quiz_results', 'quiz_attempts.attempt_id', '=', 'quiz_results.attempt_id')
                  ->join('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
                  ->where('quiz_attempts.student_id', session('student_id'))
                  ->orderBy('quiz_attempts.started_at', 'desc')
                  ->select('quiz_attempts.*', 'quiz_results.*', 'vark_scores.*')
                  ->get();
    return view('partials.quiz-history', compact('student', 'attempts'));
})->name('quiz.history');

Route::get('/study-tips', function () {
    if (!session('student_id') || session('role') !== 'student') return redirect()->route('login');
    $student = DB::table('students')->where('student_id', session('student_id'))->first();
    $latestResult = DB::table('quiz_results')
                      ->where('student_id', session('student_id'))
                      ->orderBy('calculated_at', 'desc')
                      ->first();
    return view('partials.study-tips', compact('student', 'latestResult'));
})->name('study.tips');

Route::get('/progress', function () {
    if (!session('student_id') || session('role') !== 'student') return redirect()->route('login');
    $student = DB::table('students')->where('student_id', session('student_id'))->first();
    $attempts = DB::table('quiz_attempts')
                  ->join('quiz_results', 'quiz_attempts.attempt_id', '=', 'quiz_results.attempt_id')
                  ->join('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
                  ->where('quiz_attempts.student_id', session('student_id'))
                  ->orderBy('quiz_attempts.started_at', 'asc')
                  ->select('quiz_attempts.*', 'quiz_results.*', 'vark_scores.*')
                  ->get();
    return view('partials.progress', compact('student', 'attempts'));
})->name('progress');

Route::get('/profile', function () {
    if (!session('student_id') || session('role') !== 'student') return redirect()->route('login');
    $student = DB::table('students')->where('student_id', session('student_id'))->first();
    return view('partials.profile', compact('student'));
})->name('profile');

Route::get('/feedback', function () {
    if (!session('student_id') || session('role') !== 'student') return redirect()->route('login');
    $student = DB::table('students')->where('student_id', session('student_id'))->first();
    return view('partials.feedback', compact('student'));
})->name('feedback');

Route::post('/feedback', function () {
    if (!session('student_id') || session('role') !== 'student') return redirect()->route('login');

    request()->validate([
        'rating'  => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    DB::table('feedback')->insert([
        'student_id'   => session('student_id'),
        'rating'       => request('rating'),
        'comment'      => request('comment'),
        'submitted_at' => now(),
    ]);
    return redirect()->route('feedback')->with('success', 'Feedback submitted!');
})->name('feedback.submit');


Route::post('/profile', function () {
    if (!session('student_id')) return redirect()->route('login');

    $validated = request()->validate([
        'profile_photo' => 'nullable|image|max:2048',
        'full_name'    => 'required|string|max:100',
        'email'        => 'required|email|max:150',
        'index_number' => 'nullable|string|max:50',
        'password'     => 'nullable|string|min:6',
    ]);

    $data = [
        'updated_at' => now(),
        'full_name' => $validated['full_name'],
        'email' => $validated['email'],
        'index_number' => $validated['index_number'] ?? null,
    ];

    if (!empty($validated['password'])) {
        $data['password_hash'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
    }

    if (request()->hasFile('profile_photo')) {
        $photo = request()->file('profile_photo');
        if ($photo->isValid()) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $photo->getClientOriginalName());
            $destination = public_path('profile_photos');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $photo->move($destination, $filename);
            $data['profile_photo'] = $filename;
        }
    }

    DB::table('students')
      ->where('student_id', session('student_id'))
      ->update($data);

    session(['student_name' => $validated['full_name']]);

    return redirect()->route('profile')->with('success', 'Profile updated!');
})->name('profile.update');

Route::get('/dashboard/quiz', function () {
    if (!session('student_id') || session('role') !== 'student') return redirect()->route('login');
    $student = DB::table('students')
                 ->where('student_id', session('student_id'))
                 ->first();
    return view('partials.dashboard-quiz', compact('student'));
})->name('dashboard.quiz');

Route::post('/dashboard/quiz/save', function () {
    if (!session('student_id') || session('role') !== 'student') {
        return response()->json(['success' => false, 'redirect' => route('login')]);
    }

    request()->validate([
        'visual_pct'     => 'required|integer|min:0|max:100',
        'auditory_pct'   => 'required|integer|min:0|max:100',
        'read_write_pct' => 'required|integer|min:0|max:100',
        'kinesthetic_pct'=> 'required|integer|min:0|max:100',
        'dominant_style' => 'required|string',
        'secondary_style'=> 'required|string',
    ]);

    $quiz = DB::table('quizzes')->first();
    if (!$quiz) {
        $quizId = DB::table('quizzes')->insertGetId([
            'total_questions' => 10,
            'status'          => 'active',
            'created_at'      => now(),
        ]);
    } else {
        $quizId = $quiz->quiz_id;
    }

    $attemptId = DB::table('quiz_attempts')->insertGetId([
        'student_id'   => session('student_id'),
        'quiz_id'      => $quizId,
        'started_at'   => now(),
        'completed_at' => now(),
        'status'       => 'completed',
    ]);

    $resultId = DB::table('quiz_results')->insertGetId([
        'attempt_id'      => $attemptId,
        'student_id'      => session('student_id'),
        'calculated_at'   => now(),
        'dominant_style'  => request('dominant_style'),
        'secondary_style' => request('secondary_style'),
    ]);

    $visualPct      = max(0, min(100, intval(request('visual_pct'))));
    $auditoryPct    = max(0, min(100, intval(request('auditory_pct'))));
    $readWritePct   = max(0, min(100, intval(request('read_write_pct'))));
    $kinestheticPct = max(0, min(100, intval(request('kinesthetic_pct'))));

    $percentSum = $visualPct + $auditoryPct + $readWritePct + $kinestheticPct;
    if ($percentSum !== 100) {
        $values = [
            'visual_pct'      => $visualPct,
            'auditory_pct'    => $auditoryPct,
            'read_write_pct'  => $readWritePct,
            'kinesthetic_pct' => $kinestheticPct,
        ];
        $maxKey = array_keys($values, max($values))[0];
        $values[$maxKey] += 100 - $percentSum;
        $visualPct      = max(0, min(100, $values['visual_pct']));
        $auditoryPct    = max(0, min(100, $values['auditory_pct']));
        $readWritePct   = max(0, min(100, $values['read_write_pct']));
        $kinestheticPct = max(0, min(100, $values['kinesthetic_pct']));
    }

    DB::table('vark_scores')->insert([
        'result_id'       => $resultId,
        'visual_pct'      => $visualPct,
        'auditory_pct'    => $auditoryPct,
        'read_write_pct'  => $readWritePct,
        'kinesthetic_pct' => $kinestheticPct,
    ]);

    $techniques = [
        'Visual'          => 'Use mind maps, diagrams, colour-coded notes and videos.',
        'Auditory'        => 'Join study groups, record lectures and discuss concepts aloud.',
        'Reading/Writing' => 'Write detailed notes, read widely and create written summaries.',
        'Kinesthetic'     => 'Use hands-on practice, lab sessions and real-world examples.',
    ];

    DB::table('recommendations')->insert([
        'result_id'        => $resultId,
        'learner_type'     => request('dominant_style'),
        'study_techniques' => $techniques[request('dominant_style')] ?? '',
        'content_format'   => request('dominant_style'),
    ]);

    return response()->json(['success' => true, 'redirect' => route('dashboard')]);
})->name('dashboard.quiz.save');

// Lecturer routes
Route::get('/lecturer', function () {
    if (!session('lecturer_id')) return redirect()->route('login');

    $lecturer = DB::table('lecturers')
                  ->where('lecturer_id', session('lecturer_id'))
                  ->first();

    if (!$lecturer) {
        $lecturer = (object) [
            'name' => session('lecturer_name') ?? 'Lecturer',
            'role' => 'lecturer',
        ];
    }

    $studentCount = DB::table('students')
                      ->where('role', 'student')
                      ->count();

    $resultCount = DB::table('quiz_results')->count();

    $recommendationCount = DB::table('recommendations')->count();

    $mtLearners = DB::table('quiz_results')
                    ->whereColumn('dominant_style', '<>', 'secondary_style')
                    ->count();

    $studentProfiles = DB::table('students')
                         ->join('quiz_results', 'students.student_id', '=', 'quiz_results.student_id')
                         ->join('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
                         ->where('students.role', 'student')
                         ->orderBy('quiz_results.calculated_at', 'desc')
                         ->select(
                             'students.student_id',
                             'students.full_name',
                             'students.index_number',
                             'quiz_results.dominant_style',
                             'quiz_results.secondary_style',
                             'vark_scores.visual_pct',
                             'vark_scores.auditory_pct',
                             'vark_scores.read_write_pct',
                             'vark_scores.kinesthetic_pct'
                         )
                         ->limit(8)
                         ->get();

    $mtPercent = $studentCount > 0 ? round($mtLearners / $studentCount * 100) : 0;

    // additional lecturer data
    $totalLectures    = DB::table('lectures')->where('lecturer_id', session('lecturer_id'))->count();
    $assignmentsCount = DB::table('lecture_assignments')
                         ->join('lectures', 'lecture_assignments.lecture_id', '=', 'lectures.lecture_id')
                         ->where('lectures.lecturer_id', session('lecturer_id'))
                         ->count();
    $lectures         = DB::table('lectures')->where('lecturer_id', session('lecturer_id'))->orderBy('created_at','desc')->get();

    return view('partials.lecturer', compact('lecturer', 'studentCount', 'resultCount', 'recommendationCount', 'mtPercent', 'studentProfiles', 'totalLectures', 'assignmentsCount', 'lectures'));
})->name('lecturer');

Route::get('/lecturer/students', function () {
    if (!session('lecturer_id')) return redirect()->route('login');
    $lecturer = DB::table('lecturers')->where('lecturer_id', session('lecturer_id'))->first();
    $students = DB::table('students')
                  ->leftJoin('quiz_results', function($join) {
                      $join->on('students.student_id', '=', 'quiz_results.student_id')
                           ->whereRaw('quiz_results.result_id = (SELECT MAX(r2.result_id) FROM quiz_results r2 WHERE r2.student_id = students.student_id)');
                  })
                  ->leftJoin('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
                  ->select('students.*', 'quiz_results.dominant_style', 'quiz_results.secondary_style', 'vark_scores.visual_pct', 'vark_scores.auditory_pct', 'vark_scores.read_write_pct', 'vark_scores.kinesthetic_pct')
                  ->orderBy('students.created_at', 'desc')
                  ->get();
    return view('partials.lecturer-students', compact('lecturer', 'students'));
})->name('lecturer.students');

Route::get('/lecturer/lectures', function () {
    if (!session('lecturer_id')) return redirect()->route('login');
    $lecturer = DB::table('lecturers')->where('lecturer_id', session('lecturer_id'))->first();
    $lectures = DB::table('lectures')
                  ->where('lecturer_id', session('lecturer_id'))
                  ->orderBy('created_at', 'desc')
                  ->get();
    return view('partials.lecturer-lectures', compact('lecturer', 'lectures'));
})->name('lecturer.lectures');

Route::post('/lecturer/lectures/add', function () {
    if (!session('lecturer_id')) return redirect()->route('login');
    DB::table('lectures')->insert([
        'title'        => request('title'),
        'description'  => request('description'),
        'vark_category'=> request('vark_category'),
        'format'       => request('format'),
        'url'          => request('url'),
        'lecturer_id'  => session('lecturer_id'),
        'created_at'   => now(),
    ]);
    return redirect()->route('lecturer.lectures')->with('success', 'Lecture added!');
})->name('lecturer.lectures.add');

Route::get('/lecturer/share-links', function () {
    if (!session('lecturer_id')) return redirect()->route('login');
    $lecturer = DB::table('lecturers')->where('lecturer_id', session('lecturer_id'))->first();
    $assignments = DB::table('lecture_assignments')
                     ->join('students', 'lecture_assignments.student_id', '=', 'students.student_id')
                     ->join('lectures', 'lecture_assignments.lecture_id', '=', 'lectures.lecture_id')
                     ->select('lecture_assignments.*', 'students.full_name', 'students.index_number', 'lectures.title', 'lectures.vark_category')
                     ->orderBy('lecture_assignments.assigned_at', 'desc')
                     ->get();
    $students = DB::table('students')->get();
    $lectures = DB::table('lectures')->where('lecturer_id', session('lecturer_id'))->get();
    return view('partials.lecturer-links', compact('lecturer', 'assignments', 'students', 'lectures'));
})->name('lecturer.links');

Route::post('/lecturer/share-links/add', function () {
    if (!session('lecturer_id')) return redirect()->route('login');
    $shareLink = 'mindmapquiz.lk/lectures/' . strtolower(substr(request('vark_category', 'v'), 0, 1)) . '/' . rand(100, 999);
    DB::table('lecture_assignments')->insert([
        'lecture_id'  => request('lecture_id'),
        'student_id'  => request('student_id'),
        'assigned_at' => now(),
        'share_link'  => $shareLink,
        'status'      => 'pending',
    ]);
    return redirect()->route('lecturer.links')->with('success', 'Link shared!');
})->name('lecturer.links.add');

Route::get('/lecturer/reports', function () {
    if (!session('lecturer_id')) return redirect()->route('login');
    $lecturer = DB::table('lecturers')->where('lecturer_id', session('lecturer_id'))->first();
    
    $totalStudents   = DB::table('students')->count();
    $totalAttempts   = DB::table('quiz_attempts')->where('status', 'completed')->count();
    
    $varkDist = DB::table('vark_scores')
                  ->selectRaw('AVG(visual_pct) as visual, AVG(auditory_pct) as auditory, AVG(read_write_pct) as readwrite, AVG(kinesthetic_pct) as kinesthetic')
                  ->first();

    $recentResults = DB::table('quiz_results')
                       ->join('students', 'quiz_results.student_id', '=', 'students.student_id')
                       ->join('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
                       ->select('quiz_results.*', 'students.full_name', 'students.index_number', 'vark_scores.*')
                       ->orderBy('quiz_results.calculated_at', 'desc')
                       ->limit(10)
                       ->get();

    return view('partials.lecturer-reports', compact('lecturer', 'totalStudents', 'totalAttempts', 'varkDist', 'recentResults'));
})->name('lecturer.reports');

Route::get('/lecturer/settings', function () {
    if (!session('lecturer_id')) return redirect()->route('login');
    $lecturer = DB::table('lecturers')->where('lecturer_id', session('lecturer_id'))->first();
    return view('partials.lecturer-settings', compact('lecturer'));
})->name('lecturer.settings');

Route::post('/lecturer/settings', function () {
    if (!session('lecturer_id')) return redirect()->route('login');

    // No persistent settings stored yet; this action simply returns success.
    return redirect()->route('lecturer.settings')->with('success', 'Settings saved!');
})->name('lecturer.settings.save');

Route::get('/lecturer/profile', function () {
    if (!session('lecturer_id')) return redirect()->route('login');
    $lecturer = DB::table('lecturers')->where('lecturer_id', session('lecturer_id'))->first();
    return view('partials.lecturer-profile', compact('lecturer'));
})->name('lecturer.profile');

Route::post('/lecturer/profile', function () {
    if (!session('lecturer_id')) return redirect()->route('login');

    $validated = request()->validate([
        'profile_photo' => 'nullable|image|max:2048',
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $data = [
        'updated_at' => now(),
        'name' => $validated['name'],
        'email' => $validated['email'],
    ];

    if (!empty($validated['password'])) {
        $data['password_hash'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
    }

    if (request()->hasFile('profile_photo')) {
        $photo = request()->file('profile_photo');
        if ($photo->isValid()) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $photo->getClientOriginalName());
            $destination = public_path('profile_photos');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $photo->move($destination, $filename);
            $data['profile_photo'] = $filename;
        }
    }

    DB::table('lecturers')
      ->where('lecturer_id', session('lecturer_id'))
      ->update($data);

    session(['lecturer_name' => $validated['name']]);

    return redirect()->route('lecturer.profile')->with('success', 'Profile updated!');
})->name('lecturer.profile.update');

Route::get('/lecturer/feedback', function () {
    if (!session('lecturer_id')) return redirect()->route('login');
    $lecturer = DB::table('lecturers')->where('lecturer_id', session('lecturer_id'))->first();
    $feedbacks = DB::table('feedback')
                   ->join('students', 'feedback.student_id', '=', 'students.student_id')
                   ->select('feedback.*', 'students.full_name')
                   ->orderBy('feedback.submitted_at', 'desc')
                   ->get();
    return view('partials.lecturer-feedback', compact('lecturer', 'feedbacks'));
})->name('lecturer.feedback');

// Admin Students
Route::get('/admin/students', function () {
    if (!session('admin_id')) return redirect()->route('login');
    $admin = DB::table('admins')->where('admin_id', session('admin_id'))->first();
    $students = DB::table('students')
                  ->leftJoin('quiz_results', function($join) {
                      $join->on('students.student_id', '=', 'quiz_results.student_id')
                           ->whereRaw('quiz_results.result_id = (SELECT MAX(r2.result_id) FROM quiz_results r2 WHERE r2.student_id = students.student_id)');
                  })
                  ->leftJoin('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
                  ->select('students.*', 'quiz_results.dominant_style', 'vark_scores.visual_pct', 'vark_scores.auditory_pct', 'vark_scores.read_write_pct', 'vark_scores.kinesthetic_pct')
                  ->orderBy('students.created_at', 'desc')
                  ->get();
    return view('partials.admin-students', compact('admin', 'students'));
})->name('admin.students');

Route::get('/admin/students/{id}/edit', function ($id) {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    $admin   = DB::table('admins')->where('admin_id', session('admin_id'))->first();
    $student = DB::table('students')->where('student_id', $id)->first();
    return view('partials.admin-student-edit', compact('admin', 'student'));
})->name('admin.students.edit');

Route::post('/admin/students/{id}/update', function ($id) {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    $data = [
        'full_name'    => request('full_name'),
        'email'        => request('email'),
        'index_number' => request('index_number'),
        'updated_at'   => now(),
    ];
    if (request('password')) {
        $data['password_hash'] = \Illuminate\Support\Facades\Hash::make(request('password'));
    }
    DB::table('students')->where('student_id', $id)->update($data);
    return redirect()->route('admin.students')->with('success', 'Student updated!');
})->name('admin.students.update');

Route::get('/admin/students/{id}/delete', function ($id) {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    DB::table('students')->where('student_id', $id)->delete();
    return redirect()->route('admin.students')->with('success', 'Student deleted!');
})->name('admin.students.delete');

// Admin Quiz Results
Route::get('/admin/quiz-results', function () {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    $admin = DB::table('admins')->where('admin_id', session('admin_id'))->first();
    $results = DB::table('quiz_results')
                 ->join('students', 'quiz_results.student_id', '=', 'students.student_id')
                 ->join('vark_scores', 'quiz_results.result_id', '=', 'vark_scores.result_id')
                 ->select('quiz_results.*', 'students.full_name', 'students.index_number', 'vark_scores.*')
                 ->orderBy('quiz_results.calculated_at', 'desc')
                 ->get();
    return view('partials.admin-results', compact('admin', 'results'));
})->name('admin.results');

Route::get('/admin/quiz-results/{id}/delete', function ($id) {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    $result = DB::table('quiz_results')->where('result_id', $id)->first();
    if ($result) {
        DB::table('vark_scores')->where('result_id', $id)->delete();
        DB::table('recommendations')->where('result_id', $id)->delete();
        DB::table('quiz_results')->where('result_id', $id)->delete();
    }
    return redirect()->route('admin.results')->with('success', 'Result deleted!');
})->name('admin.results.delete');

// Admin Reports
Route::get('/admin/reports', function () {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    $admin         = DB::table('admins')->where('admin_id', session('admin_id'))->first();
    $totalStudents = DB::table('students')->count();
    $totalAttempts = DB::table('quiz_attempts')->where('status', 'completed')->count();
    $totalLecturers= DB::table('lecturers')->count();
    $varkDist      = DB::table('vark_scores')
                       ->selectRaw('AVG(visual_pct) as visual, AVG(auditory_pct) as auditory, AVG(read_write_pct) as readwrite, AVG(kinesthetic_pct) as kinesthetic')
                       ->first();
    $dominantCount = DB::table('quiz_results')
                       ->selectRaw('dominant_style, COUNT(*) as count')
                       ->groupBy('dominant_style')
                       ->get();
    return view('partials.admin-reports', compact('admin', 'totalStudents', 'totalAttempts', 'totalLecturers', 'varkDist', 'dominantCount'));
})->name('admin.reports');

// Admin Feedback
Route::get('/admin/feedback', function () {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    $admin     = DB::table('admins')->where('admin_id', session('admin_id'))->first();
    $feedbacks = DB::table('feedback')
                   ->join('students', 'feedback.student_id', '=', 'students.student_id')
                   ->select('feedback.*', 'students.full_name', 'students.index_number')
                   ->orderBy('feedback.submitted_at', 'desc')
                   ->get();
    return view('partials.admin-feedback', compact('admin', 'feedbacks'));
})->name('admin.feedback');

Route::get('/admin/feedback/{id}/delete', function ($id) {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    DB::table('feedback')->where('feedback_id', $id)->delete();
    return redirect()->route('admin.feedback')->with('success', 'Feedback deleted!');
})->name('admin.feedback.delete');

// Admin Lecturers
Route::get('/admin/lecturers', function () {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    $admin     = DB::table('admins')->where('admin_id', session('admin_id'))->first();
    $lecturers = DB::table('lecturers')->orderBy('created_at', 'desc')->get();
    return view('partials.admin-lecturers', compact('admin', 'lecturers'));
})->name('admin.lecturers');

Route::post('/admin/lecturers/add', function () {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    DB::table('lecturers')->insert([
        'name'          => request('name'),
        'email'         => request('email'),
        'password_hash' => \Illuminate\Support\Facades\Hash::make(request('password')),
        'role'          => 'lecturer',
        'created_at'    => now(),
    ]);
    return redirect()->route('admin.lecturers')->with('success', 'Lecturer added!');
})->name('admin.lecturers.add');

Route::get('/admin/lecturers/{id}/delete', function ($id) {
    if (!session('admin_id') || session('role') !== 'admin') return redirect()->route('login');
    DB::table('lecturers')->where('lecturer_id', $id)->delete();
    return redirect()->route('admin.lecturers')->with('success', 'Lecturer deleted!');
})->name('admin.lecturers.delete');

{}
