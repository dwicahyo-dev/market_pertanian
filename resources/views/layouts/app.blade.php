<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') &mdash; Market Pertanian</title>

    <!-- General CSS Files -->
    @include('partials.css')

    @yield('css')

</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container" id="app">
            @include('partials.navbar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            
            @include('partials.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    @include('partials.js')

    @yield('script')
</body>

</html>