<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ZYFIN - Leading the Future of Finance</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">ZYFIN</a>
            </div>
        </nav>

        <div id="app">
            @yield('content')
        </div>

        <footer class="bg-dark text-white text-center py-3">
            <div class="container">
                <p>&copy; 2024 ZYFIN. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
