@props([
    'title' => 'Perpustakaan SMP IT Harapan Bunda',
    'polos' => false, // Set true untuk halaman Login
])

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Perpustakaan SMP IT' }}</title>

    <!-- Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8F8F8] text-[#111111] font-['Inter',sans-serif] text-xs leading-4.5 tracking-[-0.02em] antialiased min-h-screen">

    @if ($polos)
        {{ $slot }}
    @else
        <x-navbar />
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-20 py-6">
            {{ $slot }}
        </main>
    @endif

</body>
</html>