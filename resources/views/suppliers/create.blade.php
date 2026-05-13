<x-app-layout>

<div class="min-h-screen bg-[#F6F8FB] py-10">

    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-10">

            {{-- TITLE --}}
            <div class="mb-8">

                <h1 class="text-3xl font-bold text-slate-900">
                    Add Supplier
                </h1>

                <p class="text-slate-500 mt-2">
                    Create new supplier information
                </p>

            </div>

            <form action="{{ route('suppliers.store') }}"
                  method="POST">

                @csrf

                {{-- NAME --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Supplier Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full h-14 rounded-2xl border border-slate-300 px-5 focus:ring-2 focus:ring-green-600 focus:border-green-600"
                        placeholder="Input supplier name">

                    @error('name')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- EMAIL --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Supplier Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full h-14 rounded-2xl border border-slate-300 px-5 focus:ring-2 focus:ring-green-600 focus:border-green-600"
                        placeholder="supplier@email.com">

                    @error('email')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- ADDRESS --}}
                <div class="mb-8">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Supplier Address
                    </label>

                    <textarea
                        name="address"
                        rows="5"
                        class="w-full rounded-2xl border border-slate-300 px-5 py-4 focus:ring-2 focus:ring-green-600 focus:border-green-600"
                        placeholder="Input supplier address">{{ old('address') }}</textarea>

                    @error('address')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- BUTTON --}}
                <div class="flex items-center gap-4">

                    <button
                        type="submit"
                        class="h-14 px-8 rounded-2xl bg-green-700 text-white font-semibold hover:bg-green-800 transition">

                        Save Supplier

                    </button>

                    <a href="{{ route('suppliers.index') }}"
                       class="h-14 px-8 rounded-2xl border border-slate-300 text-slate-700 inline-flex items-center font-semibold hover:bg-slate-100 transition">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>