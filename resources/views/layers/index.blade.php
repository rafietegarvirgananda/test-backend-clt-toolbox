<x-app-layout>

<div class="min-h-screen bg-[#F6F8FB]">

    <div class="max-w-7xl mx-auto px-8 py-8">

        {{-- BREADCRUMB --}}
        <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">

            <a href="{{ route('suppliers.index') }}"
               class="hover:text-slate-700 transition">

                Suppliers

            </a>

            <span>/</span>

            <a href="{{ route('suppliers.show', $supplier) }}"
               class="hover:text-slate-700 transition">

                {{ $supplier->name }}

            </a>

            <span>/</span>

            <span class="text-slate-700 font-semibold">

                {{ $layup->name }}

            </span>

        </div>

        {{-- HEADER --}}
        <div class="bg-white border border-slate-200 rounded-3xl p-8 mb-8">

            <div class="flex items-start justify-between">

                <div>

                    <div class="flex items-center gap-3 mb-3">

                        <h1 class="text-4xl font-bold text-slate-900">

                            {{ $layup->name }}

                        </h1>

                        <span class="px-3 py-1 rounded-full
                                     bg-green-100 text-green-700
                                     text-xs font-semibold">

                            Active

                        </span>

                    </div>

                    <p class="text-slate-500">

                        Standard {{ $layers->count() }}-layer panel structure

                    </p>

                </div>

                <div class="flex items-center gap-3">

                    <a href="{{ route('suppliers.show', $supplier) }}"
                       class="h-11 px-5 inline-flex items-center
                              rounded-xl border border-slate-200
                              bg-white text-slate-700 text-sm font-medium
                              hover:bg-slate-50 transition">

                        ← Back

                    </a>

                    <a href="{{ route('suppliers.layups.layers.create', [$supplier, $layup]) }}"
                       class="h-11 px-5 inline-flex items-center
                              rounded-xl bg-green-700 text-white
                              text-sm font-semibold hover:bg-green-800 transition">

                        + Add Layer

                    </a>

                </div>

            </div>

            {{-- STATS --}}
            <div class="grid grid-cols-4 gap-6 mt-8">

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-400 font-semibold mb-2">
                        Created By
                    </p>

                    <h3 class="font-semibold text-slate-800">
                        CLT Manager
                    </h3>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-400 font-semibold mb-2">
                        Last Modified
                    </p>

                    <h3 class="font-semibold text-slate-800">
                        {{ $layup->updated_at->format('M d, Y') }}
                    </h3>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-400 font-semibold mb-2">
                        Total Thickness
                    </p>

                    <h3 class="font-bold text-green-700 text-xl">
                        {{ $layers->sum('thickness') }} mm
                    </h3>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-400 font-semibold mb-2">
                        Total Layers
                    </p>

                    <h3 class="font-bold text-slate-900 text-xl">
                        {{ $layers->count() }} Layers
                    </h3>

                </div>

            </div>

        </div>

        {{-- MAIN CONTENT --}}
        <div class="grid grid-cols-2 gap-8">

            {{-- LEFT --}}
            <div>

                {{-- TITLE --}}
                <div class="flex items-center justify-between mb-5">

                    <h2 class="text-xl font-bold text-slate-900">
                        Layer Composition
                    </h2>

                    <a href="{{ route('suppliers.layups.layers.create', [$supplier, $layup]) }}"
                       class="text-sm text-green-700 font-semibold hover:underline">

                        + Add Layer

                    </a>

                </div>

                {{-- TABLE --}}
                <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden">

                    <table class="w-full">

                        <thead class="bg-slate-50 border-b border-slate-200">

                            <tr>

                                <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-slate-500">
                                    Order
                                </th>

                                <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-slate-500">
                                    Thickness
                                </th>

                                <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-slate-500">
                                    Width
                                </th>

                                <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-slate-500">
                                    Angle
                                </th>

                                <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-slate-500">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($layers as $layer)

                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                                {{-- ORDER --}}
                                <td class="px-5 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="w-9 h-9 rounded-lg
                                                    bg-slate-100 flex items-center
                                                    justify-center font-bold text-slate-700">

                                            {{ $layer->layer_order }}

                                        </div>

                                    </div>

                                </td>

                                {{-- THICKNESS --}}
                                <td class="px-5 py-5 text-sm text-slate-700">

                                    {{ $layer->thickness }} mm

                                </td>

                                {{-- WIDTH --}}
                                <td class="px-5 py-5 text-sm text-slate-700">

                                    {{ $layer->width }} mm

                                </td>

                                {{-- ANGLE --}}
                                <td class="px-5 py-5">

                                    @if($layer->angle == 90)

                                    <span class="px-3 py-1 rounded-full
                                                 bg-orange-100 text-orange-700
                                                 text-xs font-semibold">

                                        ↕ 90°

                                    </span>

                                    @else

                                    <span class="px-3 py-1 rounded-full
                                                 bg-slate-100 text-slate-700
                                                 text-xs font-semibold">

                                        ↔ 0°

                                    </span>

                                    @endif

                                </td>

                                {{-- ACTION --}}
                                <td class="px-5 py-5">

                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('suppliers.layups.layers.edit', [$supplier, $layup, $layer]) }}"
                                           class="px-4 h-9 inline-flex items-center
                                                  rounded-xl border border-slate-200
                                                  text-sm hover:bg-slate-50 transition">

                                            Edit

                                        </a>

                                        <form method="POST"
                                              action="{{ route('suppliers.layups.layers.destroy', [$supplier, $layup, $layer]) }}">

                                            @csrf
                                            @method('DELETE')

                                             <button
                                                type="button"
                                                onclick="confirmDelete(this)"
                                                class="h-10 px-4 inline-flex items-center
                                                    rounded-xl border border-red-200
                                                    bg-red-50 text-red-600
                                                    text-sm font-medium
                                                    hover:bg-red-100 transition">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-20 text-slate-400">

                                    No Layers Available

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- ENGINEERING NOTE --}}
                <div class="mt-6 bg-white border border-orange-200
                            rounded-3xl p-5">

                    <div class="flex gap-3">

                        <div class="w-10 h-10 rounded-full
                                    bg-orange-100 flex items-center
                                    justify-center text-orange-600">

                            !

                        </div>

                        <div>

                            <h3 class="font-semibold text-slate-900 mb-1">

                                Engineering Note

                            </h3>

                            <p class="text-sm text-slate-500 leading-relaxed">

                                Ensure bonding pressure is adjusted for varying
                                layer grades. Verify alignment of 90° transverse
                                layers before structural assembly.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT VISUALIZER --}}
            <div>

                <h2 class="text-xl font-bold text-slate-900 mb-5">
                    Structure Visualizer
                </h2>

                <div class="bg-white border border-slate-200
                            rounded-3xl p-8 min-h-[700px]
                            flex items-center justify-center relative">

                    {{-- TOP LABEL --}}
                    <div class="absolute top-10 left-8
                                text-xs text-slate-400 uppercase">

                        Top (Outside)

                    </div>

                    {{-- BOTTOM LABEL --}}
                    <div class="absolute bottom-10 left-8
                                text-xs text-slate-400 uppercase">

                        Bottom (Inside)

                    </div>

                    {{-- STACK --}}
                    <div class="w-[260px] bg-slate-50 rounded-3xl
                                p-6 border border-slate-200">

                        @foreach($layers->sortBy('layer_order') as $layer)

                        <div
                            class="mb-3 rounded-lg border border-[#C79A63]
                                   shadow-sm py-5 text-center font-semibold
                                   text-[#6B4E2E]"
                            style="
                                background:
                                {{ $layer->angle == 90 ? '#D9A56A' : '#E7C99D' }};
                            ">

                            L{{ $layer->layer_order }}
                            ({{ $layer->thickness }}mm)

                            <div class="text-xs mt-1">

                                {{ $layer->angle == 90 ? '↕ Transverse' : '↔ Longitudinal' }}

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>