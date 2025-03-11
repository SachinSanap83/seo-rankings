<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel App')</title>
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    @if (file_exists(public_path('build/manifest.json')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <script src="{{ asset('build/assets/app.js') }}" defer></script>
@endif

</head>
<body class="bg-gray-100">

    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('dashboard') }}" class="text-lg font-semibold">Dashboard</a>
            <a href="{{ route('projects.index') }}" class="text-lg font-semibold">Projects</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-lg font-semibold">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto mt-5">
        @yield('content')
    </div>

</body>
</html>
