<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ar 24 Test Technique</title>
    @vite(['resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
@include('partials.header')
<main class="flex-fill">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif
    @yield('create_user_form')
    @yield('show_user_form')
    @yield('user_form')
    @yield('upload_document_form')
    @yield('user_not_found')
    @yield('send_email_form')
    @yield('show_email_info_form')

</main>
@include('partials.footer')
<script>
    setTimeout(function() {
        document.querySelector('.alert').remove();
    }, 10000);
</script>
@stack('js')
</body>
</html>
