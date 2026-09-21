<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VARK Quiz</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<link href="{{ asset('css/quiz.css') }}" rel="stylesheet">

<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

@php
$hideLayout = Request::is('dashboard') ||
              Request::is('dashboard/*') ||
              Request::is('admin') ||
              Request::is('admin/*') ||
              Request::is('lecturer') ||
              Request::is('lecturer/*') ||
              Request::is('quiz-history') ||
              Request::is('study-tips') ||
              Request::is('progress') ||
              Request::is('profile') ||
              Request::is('feedback');
@endphp

@if(!$hideLayout)
    @include('partials.navbar')
@endif

<main>
    @yield('content')
</main>

@if(!$hideLayout)
    @include('partials.footer')
@endif

     
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>