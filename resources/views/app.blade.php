<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Despawn') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=inter:100,200,300,400,500,600,700,800,900">

    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js', 'vendor/despawn/build')
    @inertiaHead
</head>
<body class="relative font-sans antialiased motion-safe:transition min-h-full bg-neutral-900">
@inertia
</body>
</html>
