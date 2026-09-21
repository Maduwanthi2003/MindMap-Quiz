<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$scores = DB::select('SELECT vark_scores.*, quiz_results.dominant_style, quiz_results.secondary_style FROM vark_scores JOIN quiz_results ON vark_scores.result_id = quiz_results.result_id ORDER BY vark_scores.result_id DESC LIMIT 10');
var_dump($scores);
