<x-app-layout>

<div class="min-h-screen bg-[#F6F8FB]">

    <div class="px-8 py-8">

        {{-- PAGE HEADER --}}
        <div class="flex items-center justify-between mb-8">

            <div>

                <h1 class="text-4xl font-bold tracking-tight text-slate-900">
                    Suppliers
                </h1>

                <p class="text-slate-500 mt-2">
                    Manage composite suppliers and layup partners
                </p>

            </div>

            <a href="{{ route('suppliers.create') }}"
               class="h-11 px-5 inline-flex items-center
                      rounded-xl bg-slate-900
                      text-white text-sm font-semibold
                      hover:bg-black transition">

                + Add Supplier

            </a>

        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-3 gap-6 mb-8">

            {{-- CARD --}}
            <div class="bg-white border border-slate-200 rounded-3xl p-6">

                <p class="text-sm text-slate-500 font-medium">
                    Total Suppliers
                </p>

                <h2 class="text-5xl font-bold text-slate-900 mt-4">
                    {{ $suppliers->count() }}
                </h2>

            </div>

            {{-- CARD --}}
            <div class="bg-white border border-slate-200 rounded-3xl p-6">

                <p class="text-sm text-slate-500 font-medium">
                    Total Layups
                </p>

                <h2 class="text-5xl font-bold text-slate-900 mt-4">
                    {{ \App\Models\CltLayup::count() }}
                </h2>

            </div>

            {{-- CARD --}}
            <div class="bg-white border border-slate-200 rounded-3xl p-6">

                <p class="text-sm text-slate-500 font-medium">
                    Total Layers
                </p>

                <h2 class="text-5xl font-bold text-slate-900 mt-4">
                    {{ \App\Models\CltLayer::count() }}
                </h2>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden">

            {{-- TOP --}}
            <div class="px-8 py-6 border-b border-slate-200">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-2xl font-bold text-slate-900">
                            Supplier Directory
                        </h2>

                        <p class="text-slate-500 mt-1">
                            Composite manufacturing suppliers
                        </p>

                    </div>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="px-8 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Supplier
                            </th>

                            <th class="px-8 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Layups
                            </th>

                            <th class="px-8 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Layers
                            </th>

                            <th class="px-8 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Updated
                            </th>

                            <th class="px-8 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($suppliers as $supplier)

                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                            {{-- SUPPLIER --}}
                            <td class="px-8 py-6">

                                <div class="flex items-center gap-4">

                                    <div class="w-12 h-12 rounded-2xl
                                                bg-slate-100 flex items-center
                                                justify-center text-slate-700
                                                font-bold text-lg">

                                        {{ strtoupper(substr($supplier->name, 0, 1)) }}

                                    </div>

                                    <div>

                                        <h3 class="font-semibold text-slate-900 text-base">
                                            {{ $supplier->name }}
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">
                                            Composite Supplier
                                        </p>

                                    </div>

                                </div>

                            </td>

                            {{-- LAYUPS --}}
                            <td class="px-8 py-6">

                                <span class="px-3 py-1 rounded-xl
                                             bg-slate-100 text-slate-700
                                             text-sm font-medium">

                                    {{ $supplier->layups->count() }}

                                </span>

                            </td>

                            {{-- LAYERS --}}
                            <td class="px-8 py-6">

                                <span class="px-3 py-1 rounded-xl
                                             bg-slate-100 text-slate-700
                                             text-sm font-medium">

                                    {{ $supplier->layups->sum(fn($l) => $l->layers->count()) }}

                                </span>

                            </td>

                            {{-- UPDATED --}}
                            <td class="px-8 py-6 text-sm text-slate-500">

                                {{ $supplier->updated_at->diffForHumans() }}

                            </td>

                            {{-- ACTIONS --}}
                            <td class="px-8 py-6">

                                <div class="flex items-center gap-2">

                                    {{-- OPEN --}}
                                    <a href="{{ route('suppliers.layups.index', $supplier) }}"
                                       class="h-10 px-4 inline-flex items-center
                                              rounded-xl bg-slate-900
                                              text-white text-sm font-medium
                                              hover:bg-black transition">

                                        Open

                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('suppliers.edit', $supplier) }}"
                                       class="h-10 px-4 inline-flex items-center
                                              rounded-xl border border-slate-200
                                              bg-white text-slate-700
                                              text-sm font-medium
                                              hover:bg-slate-50 transition">

                                        Edit

                                    </a>

                                    {{-- DELETE --}}
                                    <form method="POST"
                                          action="{{ route('suppliers.destroy', $supplier) }}"
                                          onsubmit="return confirm('Delete this supplier?')">

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

                            <td colspan="5" class="px-8 py-20 text-center">

                                <h3 class="text-2xl font-bold text-slate-800">
                                    No Suppliers Available
                                </h3>

                                <p class="text-slate-500 mt-2">
                                    Create your first supplier.
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