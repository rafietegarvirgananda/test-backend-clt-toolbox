<x-app-layout>

<x-slot name="header">
    Conflict Resolution
</x-slot>

@php
$current = $conflicts[0] ?? null;
$total = count($conflicts);
@endphp

@if($current)

<div class="max-w-6xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>

        <h2 class="text-3xl font-bold">
            Resolve Import Conflict
        </h2>

        <p class="text-gray-500 mt-2">
            Conflict 1 of {{ $total }}
        </p>

    </div>

    {{-- CONFLICT CARD --}}
    <div class="bg-white rounded-2xl border overflow-hidden">

        <div class="grid grid-cols-2">

            {{-- EXISTING --}}
            <div class="p-8 border-r bg-red-50">

                <h3 class="text-xl font-bold text-red-600 mb-6">
                    Existing Data
                </h3>

                <div class="space-y-5">

                    {{-- THICKNESS --}}
                    <div class="bg-white rounded-xl p-4 border">

                        <p class="text-gray-500 text-sm">
                            Thickness
                        </p>

                        <h2 class="text-2xl font-bold">
                            {{ $current['existing']['thickness'] }}
                        </h2>

                    </div>

                    {{-- WIDTH --}}
                    <div class="bg-white rounded-xl p-4 border">

                        <p class="text-gray-500 text-sm">
                            Width
                        </p>

                        <h2 class="text-2xl font-bold">
                            {{ $current['existing']['width'] }}
                        </h2>

                    </div>

                    {{-- ANGLE --}}
                    <div class="bg-white rounded-xl p-4 border">

                        <p class="text-gray-500 text-sm">
                            Angle
                        </p>

                        <h2 class="text-2xl font-bold">
                            {{ $current['existing']['angle'] }}
                        </h2>

                    </div>

                </div>

            </div>

            {{-- INCOMING --}}
            <div class="p-8 bg-green-50">

                <h3 class="text-xl font-bold text-green-600 mb-6">
                    Incoming Data
                </h3>

                <div class="space-y-5">

                    {{-- THICKNESS --}}
                    <div class="bg-white rounded-xl p-4 border border-green-400">

                        <p class="text-gray-500 text-sm">
                            Thickness
                        </p>

                        <h2 class="text-2xl font-bold text-green-700">
                            {{ $current['incoming']['thickness'] }}
                        </h2>

                    </div>

                    {{-- WIDTH --}}
                    <div class="bg-white rounded-xl p-4 border border-green-400">

                        <p class="text-gray-500 text-sm">
                            Width
                        </p>

                        <h2 class="text-2xl font-bold text-green-700">
                            {{ $current['incoming']['width'] }}
                        </h2>

                    </div>

                    {{-- ANGLE --}}
                    <div class="bg-white rounded-xl p-4 border border-green-400">

                        <p class="text-gray-500 text-sm">
                            Angle
                        </p>

                        <h2 class="text-2xl font-bold text-green-700">
                            {{ $current['incoming']['angle'] }}
                        </h2>

                    </div>

                </div>

            </div>

        </div>

        {{-- ACTIONS --}}
        <div class="border-t p-6 flex justify-end gap-4">

            {{-- KEEP EXISTING --}}
            <form method="POST"
                  action="{{ route('suppliers.conflicts.resolve', $supplier) }}">

                @csrf

                <input type="hidden"
                       name="layup_id"
                       value="{{ $current['layup_id'] }}">

                <input type="hidden"
                       name="layer_order"
                       value="{{ $current['incoming']['layer_order'] }}">

                <input type="hidden"
                       name="action_type"
                       value="existing">

                <button class="px-6 py-3 rounded-xl border
                               hover:bg-gray-100 font-semibold">

                    Keep Existing
                </button>

            </form>

            {{-- ACCEPT INCOMING --}}
            <form method="POST"
                  action="{{ route('suppliers.conflicts.resolve', $supplier) }}">

                @csrf

                <input type="hidden"
                       name="layup_id"
                       value="{{ $current['layup_id'] }}">

                <input type="hidden"
                       name="layer_order"
                       value="{{ $current['incoming']['layer_order'] }}">

                <input type="hidden"
                       name="thickness"
                       value="{{ $current['incoming']['thickness'] }}">

                <input type="hidden"
                       name="width"
                       value="{{ $current['incoming']['width'] }}">

                <input type="hidden"
                       name="angle"
                       value="{{ $current['incoming']['angle'] }}">

                <input type="hidden"
                       name="action_type"
                       value="incoming">

                <button class="px-6 py-3 rounded-xl
                               bg-green-600 hover:bg-green-700
                               text-white font-semibold">

                    Accept Incoming
                </button>

            </form>

        </div>

    </div>

</div>

@endif

</x-app-layout>