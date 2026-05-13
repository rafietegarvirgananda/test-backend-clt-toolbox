<x-app-layout>

<div class="min-h-screen bg-[#F6F8FB]">

    <div class="max-w-7xl mx-auto px-8 py-8">

        {{-- BACK --}}
        <div class="mb-6">

            <a href="{{ route('suppliers.index') }}"
               class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-black transition">

                ← Back to Suppliers

            </a>

        </div>

        {{-- HEADER --}}
        <div class="bg-white border border-slate-200 rounded-3xl p-8 mb-8">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm uppercase tracking-[0.2em] text-slate-400 mb-3">

                        Supplier Detail

                    </p>

                    <div class="flex items-center gap-3 mb-3">

                        <h1 class="text-4xl font-bold text-slate-900 tracking-tight">
                            {{ $supplier->name }}
                        </h1>

                        <span class="px-3 py-1 rounded-full
                                     bg-green-100 text-green-700
                                     text-xs font-semibold">

                            ACTIVE PARTNER

                        </span>

                    </div>

                    <p class="text-slate-500">

                        Managing CLT Layup Structures

                    </p>

                    <p class="text-sm text-slate-400 mt-3">

                        Supplier ID :
                        SUP-{{ str_pad($supplier->id, 3, '0', STR_PAD_LEFT) }}

                    </p>

                </div>

                {{-- EDIT --}}
                <a href="{{ route('suppliers.edit', $supplier) }}"
                   class="h-11 px-5 inline-flex items-center rounded-xl
                          border border-slate-200 bg-white
                          text-slate-700 text-sm font-medium
                          hover:bg-slate-50 transition">

                    Edit Supplier

                </a>

            </div>

        </div>

        {{-- INFO CARDS --}}
        <div class="grid grid-cols-3 gap-6 mb-8">

            {{-- EMAIL --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6">

                <p class="text-sm text-slate-400 mb-2">
                    Email
                </p>

                <p class="font-semibold text-slate-800 break-all">
                    {{ $supplier->email ?? '-' }}
                </p>

            </div>

            {{-- ADDRESS --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6">

                <p class="text-sm text-slate-400 mb-2">
                    Address
                </p>

                <p class="font-semibold text-slate-800">
                    {{ $supplier->address ?? '-' }}
                </p>

            </div>

            {{-- TOTAL --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6">

                <p class="text-sm text-slate-400 mb-2">
                    Total Layups
                </p>

                <p class="text-3xl font-bold text-slate-900">
                    {{ $layups->count() }}
                </p>

            </div>

        </div>

        {{-- LAYUP HEADER --}}
        <div class="flex items-center justify-between mb-5">

            <div>

                <p class="text-sm uppercase tracking-[0.2em] text-slate-400 mb-1">

                    CLT Structures

                </p>

                <h2 class="text-3xl font-bold text-slate-900">

                    Layups

                </h2>

            </div>

            {{-- BUTTON --}}
            <a href="{{ route('suppliers.layups.create', $supplier) }}"
               class="h-11 px-5 inline-flex items-center
                      rounded-xl bg-green-700 text-white
                      text-sm font-semibold
                      hover:bg-green-800 transition">

                + Add Layup

            </a>

        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    {{-- HEADER --}}
                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Layup Name
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Total Thickness
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Ply Count
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Last Updated
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    {{-- BODY --}}
                    <tbody>

                        @forelse($layups as $layup)

                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                            {{-- NAME --}}
                            <td class="px-6 py-5">

                                <div>

                                    <h3 class="font-semibold text-slate-900">
                                        {{ $layup->name }}
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        CLT Panel Structure
                                    </p>

                                </div>

                            </td>

                            {{-- THICKNESS --}}
                            <td class="px-6 py-5 text-slate-700 font-medium">

                                {{ $layup->layers->sum('thickness') }} mm

                            </td>

                            {{-- PLY --}}
                            <td class="px-6 py-5">

                                <span class="px-3 py-1 rounded-lg
                                             bg-slate-100 text-slate-700
                                             text-sm font-medium">

                                    {{ $layup->layers->count() }} Layers

                                </span>

                            </td>

                            {{-- UPDATED --}}
                            <td class="px-6 py-5 text-sm text-slate-500">

                                {{ $layup->updated_at->diffForHumans() }}

                            </td>

                            {{-- ACTIONS --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-2">

                                    {{-- OPEN --}}
                                    <a href="{{ route('suppliers.layups.layers.index', [$supplier, $layup]) }}"
                                       class="h-10 px-4 inline-flex items-center
                                              rounded-xl bg-slate-900
                                              text-white text-sm font-medium
                                              hover:bg-black transition">

                                        Open

                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('suppliers.layups.edit', [$supplier, $layup]) }}"
                                       class="h-10 px-4 inline-flex items-center
                                              rounded-xl border border-slate-200
                                              bg-white text-slate-700
                                              text-sm font-medium
                                              hover:bg-slate-50 transition">

                                        Edit

                                    </a>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="py-24 text-center">

                                <h3 class="text-3xl font-bold text-slate-800">
                                    No Layups Found
                                </h3>

                                <p class="text-slate-400 mt-3">
                                    Create your first CLT layup structure.
                                </p>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</x-app-layout>