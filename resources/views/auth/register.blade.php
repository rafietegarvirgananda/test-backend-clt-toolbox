<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <!-- LEFT -->
        <div class="relative hidden md:flex items-center justify-center">
            <img
                src="https://app.clttoolbox.com.au/images/login-bg.jpg"
                class="absolute inset-0 w-full h-full object-cover"
            >

            <div class="absolute inset-0 bg-black/40"></div>

            <div class="relative z-10 text-white px-10">
                <h1 class="text-6xl font-bold leading-tight">
                    CLT<br>Toolbox
                </h1>

                <p class="mt-8 text-2xl leading-relaxed text-gray-200">
                    Composite Layer Management Platform
                </p>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="flex items-center justify-center p-8 md:p-14">
            <div class="w-full max-w-md">

                <h2 class="text-5xl font-bold text-gray-900 mb-4">
                    Create Account
                </h2>

                <p class="text-gray-500 mb-10 text-lg">
                    Register to continue using CLT Toolbox.
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Name
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none"
                            placeholder="Enter your name"
                        >

                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Email Address
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none"
                            placeholder="Enter your email"
                        >

                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none"
                            placeholder="Enter password"
                        >

                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Confirm Password
                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none"
                            placeholder="Confirm password"
                        >

                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-4 rounded-2xl transition duration-300"
                    >
                        Register
                    </button>

                    <div class="mt-6 text-center">
                        <a
                            href="{{ route('login') }}"
                            class="text-green-600 hover:underline"
                        >
                            Already registered?
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>