<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200">

    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        {{-- LEFT --}}
        <div class="flex items-center gap-10">

            {{-- LOGO --}}
            <div class="flex items-center gap-3">

            <img
                src="https://app.clttoolbox.com.au/images/logos/logo_color.png"
                alt="CLT Toolbox"
                class="h-14 w-auto object-contain"
            >

        </div>

            {{-- MENU --}}
            <div class="flex items-center gap-2">

                <a href="{{ route('dashboard') }}"
                   class="h-11 px-5 inline-flex items-center rounded-xl
                   text-sm font-semibold transition

                   {{ request()->routeIs('dashboard')
                       ? 'bg-slate-900 text-white shadow-sm'
                       : 'text-slate-600 hover:bg-slate-100' }}">

                    Dashboard
                </a>

                <a href="{{ route('suppliers.index') }}"
                   class="h-11 px-5 inline-flex items-center rounded-xl
                   text-sm font-semibold transition

                   {{ request()->routeIs('suppliers.*')
                       ? 'bg-green-100 text-green-700'
                       : 'text-slate-600 hover:bg-slate-100' }}">

                    Suppliers
                </a>

                <a href="#"
                   class="h-11 px-5 inline-flex items-center rounded-xl
                   text-sm font-semibold text-slate-600
                   hover:bg-slate-100 transition">

                    Layups
                </a>

                <a href="#"
                   class="h-11 px-5 inline-flex items-center rounded-xl
                   text-sm font-semibold text-slate-600
                   hover:bg-slate-100 transition">

                    Layers
                </a>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="flex items-center gap-5">

            {{-- USER --}}
            <div class="text-right leading-tight">

                <p class="text-sm font-semibold text-slate-800">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-slate-500">
                    {{ Auth::user()->email }}
                </p>

            </div>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="h-11 px-5 rounded-xl
                    bg-slate-900 hover:bg-black
                    text-white text-sm font-semibold
                    transition-all duration-200">

                    Logout
                </button>

            </form>

        </div>

    </div>

</nav>