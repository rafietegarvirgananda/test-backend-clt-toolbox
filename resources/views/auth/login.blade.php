<x-guest-layout>

<div class="min-h-screen flex">

    {{-- LEFT SIDE --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">

        {{-- BG IMAGE --}}
        <img
            src="https://app.clttoolbox.com.au/images/login-bg.jpg"
            class="absolute inset-0 w-full h-full object-cover"
            alt="Background">

        {{-- OVERLAY --}}
        <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div>

        {{-- CONTENT --}}
        <div class="relative z-10 flex flex-col justify-between p-16 text-white w-full">

            {{-- LOGO --}}
            <div>

                <img
                    src="https://app.clttoolbox.com.au/images/logos/logo_color_white.png"
                    class="w-48"
                    alt="Logo">

            </div>

            {{-- TEXT --}}
            <div>

                <h1 class="text-5xl font-bold leading-tight mb-6">
                    CLT Toolbox
                </h1>

                <p class="text-lg text-white/80 leading-relaxed max-w-lg">
                    Composite Layer Management Platform
                    for supplier, layup, and structural
                    engineering workflows.
                </p>

            </div>

        </div>

    </div>

    {{-- RIGHT SIDE --}}
    <div class="w-full lg:w-1/2 bg-[#F6F8FB]
                flex items-center justify-center
                px-6 py-10">

        <div class="w-full max-w-md">

            {{-- MOBILE LOGO --}}
            <div class="lg:hidden mb-10 text-center">

                <h1 class="text-3xl font-bold text-slate-900">
                    CLT Toolbox
                </h1>

                <p class="text-slate-500 mt-2">
                    Composite Management Platform
                </p>

            </div>

            {{-- CARD --}}
            <div class="bg-white border border-slate-200
                        rounded-3xl shadow-xl p-8">

                {{-- HEADER --}}
                <div class="mb-8">

                    <h2 class="text-3xl font-bold text-slate-900">
                        Welcome Back
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Login to continue managing your CLT structures.
                    </p>

                </div>

                {{-- SESSION STATUS --}}
                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')" />

                <form method="POST"
                      action="{{ route('login') }}"
                      class="space-y-5">

                    @csrf

                    {{-- EMAIL --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Email Address
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your email"
                            class="w-full h-12 rounded-xl
                                   border border-slate-300
                                   bg-white px-4
                                   text-sm text-slate-900
                                   focus:border-green-700
                                   focus:ring-green-700">

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2" />

                    </div>

                    {{-- PASSWORD --}}
                    <div>

                        <div class="flex items-center justify-between mb-2">

                            <label class="text-sm font-semibold text-slate-700">
                                Password
                            </label>

                            @if (Route::has('password.request'))

                            <a href="{{ route('password.request') }}"
                               class="text-sm text-green-700 hover:underline">

                                Forgot Password?

                            </a>

                            @endif

                        </div>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full h-12 rounded-xl
                                   border border-slate-300
                                   bg-white px-4
                                   text-sm text-slate-900
                                   focus:border-green-700
                                   focus:ring-green-700">

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2" />

                    </div>

                    {{-- REMEMBER --}}
                    <div class="flex items-center">

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-slate-300
                                   text-green-700
                                   focus:ring-green-700">

                        <label for="remember_me"
                               class="ml-3 text-sm text-slate-600">

                            Remember me

                        </label>

                    </div>

                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="w-full h-12 rounded-xl
                               bg-slate-900 text-white
                               text-sm font-semibold
                               hover:bg-black transition">

                        Log In

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</x-guest-layout>