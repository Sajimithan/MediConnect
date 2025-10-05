<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'HealthCare Pro') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-50 via-white to-blue-50">
            <!-- Logo and Branding Section -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <x-application-logo class="w-24 h-24 fill-current text-indigo-600 mx-auto mb-4" />
                </a>
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold text-gray-900">HealthCare Pro</h1>
                    <p class="text-lg text-gray-600">Professional Healthcare Management</p>
                </div>
            </div>

            <!-- Login Form Card -->
            <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-2xl rounded-2xl border border-gray-100">
                {{ $slot }}
            </div>

            <!-- Footer Links -->
            <div class="mt-8 text-center space-y-2">
                <p class="text-sm text-gray-500">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                        Register here
                    </a>
                </p>
                <a href="/" class="text-sm text-gray-400 hover:text-gray-600">
                    ← Back to Home
                </a>
            </div>
        </div>
    </body>
</html>
