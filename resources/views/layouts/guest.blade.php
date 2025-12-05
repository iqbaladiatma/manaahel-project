<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Manaahel') }}</title>
        <link rel="icon" type="image/jpeg" href="{{ asset('manaahel-logo.jpg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Main Content -->
            <div class="pt-20 min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
                <div class="w-full max-w-md">
                    <!-- Logo -->
                    <div class="flex justify-center mb-8">
                        <a href="/">
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-amber-500 rounded-2xl blur-md opacity-50"></div>
                                <div class="relative w-16 h-16 bg-gradient-to-br from-blue-600 to-amber-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-white font-bold text-2xl">M</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-white rounded-lg border border-gray-200 p-8 shadow-lg">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
