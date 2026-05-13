<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-slate-800 leading-tight">
            Edit Supplier
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F6F8FB] py-10">

        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

                {{-- HEADER --}}
                <div class="px-8 py-6 border-b border-slate-200">

                    <h1 class="text-3xl font-bold text-slate-900">
                        Edit Supplier
                    </h1>

                    <p class="text-slate-500 mt-2">
                        Update supplier information and company details.
                    </p>

                </div>

                {{-- FORM --}}
                <form action="{{ route('suppliers.update', $supplier) }}"
                      method="POST"
                      class="p-8">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- SUPPLIER NAME --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">

                                Supplier Name

                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $supplier->name) }}"
                                placeholder="Enter supplier name"
                                class="w-full h-12 px-4 rounded-xl border border-slate-300
                                       focus:ring-2 focus:ring-green-600 focus:border-green-600
                                       outline-none transition">

                            @error('name')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        {{-- EMAIL --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">

                                Email Address

                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $supplier->email) }}"
                                placeholder="supplier@email.com"
                                class="w-full h-12 px-4 rounded-xl border border-slate-300
                                       focus:ring-2 focus:ring-green-600 focus:border-green-600
                                       outline-none transition">

                            @error('email')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                    {{-- ADDRESS --}}
                    <div class="mt-6">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Address

                        </label>

                        <textarea
                            name="address"
                            rows="4"
                            placeholder="Enter supplier address"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300
                                   focus:ring-2 focus:ring-green-600 focus:border-green-600
                                   outline-none transition">{{ old('address', $supplier->address) }}</textarea>

                        @error('address')

                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                    {{-- CERTIFICATION --}}
                    <div class="mt-6">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Material Certification

                        </label>

                        <input
                            type="text"
                            name="certification"
                            value="{{ old('certification', $supplier->certification) }}"
                            placeholder="Example: SPF Certified"
                            class="w-full h-12 px-4 rounded-xl border border-slate-300
                                   focus:ring-2 focus:ring-green-600 focus:border-green-600
                                   outline-none transition">

                        @error('certification')

                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex items-center justify-end gap-4 mt-8">

                        <a href="{{ route('suppliers.show', $supplier) }}"
                           class="h-12 px-6 inline-flex items-center justify-center
                                  rounded-xl border border-slate-300
                                  text-slate-700 font-medium
                                  hover:bg-slate-100 transition">

                            Cancel

                        </a>

                        <button
                            type="submit"
                            class="h-12 px-8 inline-flex items-center justify-center
                                   rounded-xl bg-green-700 text-white
                                   font-semibold hover:bg-green-800 transition">

                            Update Supplier

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>