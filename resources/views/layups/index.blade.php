<x-app-layout>

<div class="min-h-screen bg-[#F6F8FB]">

    <div class="max-w-7xl mx-auto px-8 py-8">

        {{-- BREADCRUMB --}}
        <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">

            <span>Suppliers</span>

            <span>/</span>

            <span class="text-slate-700 font-medium">
                {{ $supplier->name }}
            </span>

        </div>

        {{-- SUPPLIER HEADER --}}
        <div class="bg-white border border-slate-200 rounded-3xl p-8 mb-6">

            <div class="flex items-start justify-between">

                <div>

                    <div class="flex items-center gap-3">

                        <h1 class="text-4xl font-bold text-slate-900 tracking-tight">
                            {{ $supplier->name }}
                        </h1>

                        <span class="px-3 py-1 rounded-full
                                     bg-green-100 text-green-700
                                     text-xs font-semibold">

                            ACTIVE PARTNER

                        </span>

                    </div>

                    <p class="text-sm text-slate-400 mt-3 tracking-wide">

                        ID :
                        SUP-{{ str_pad($supplier->id, 3, '0', STR_PAD_LEFT) }}

                    </p>

                </div>

                {{-- EDIT --}}
                <a href="{{ route('suppliers.edit', $supplier) }}"
                   class="h-11 px-5 inline-flex items-center gap-2
                          rounded-xl border border-slate-200
                          bg-white text-slate-700 text-sm font-medium
                          hover:bg-slate-50 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />

                    </svg>

                    Edit Supplier

                </a>

            </div>

        </div>

        {{-- INFO CARDS --}}
        <div class="grid grid-cols-4 gap-0 bg-white border border-slate-200 rounded-3xl overflow-hidden mb-8">

            {{-- EMAIL --}}
            <div class="p-6 border-r border-slate-200">

                <p class="text-xs uppercase tracking-wider
                          text-slate-400 font-semibold mb-4">

                    Primary Contact

                </p>

                <div class="text-sm text-slate-700">

                    {{ $supplier->email ?? '-' }}

                </div>

            </div>

            {{-- ADDRESS --}}
            <div class="p-6 border-r border-slate-200">

                <p class="text-xs uppercase tracking-wider
                          text-slate-400 font-semibold mb-4">

                    Address

                </p>

                <div class="text-sm text-slate-700">

                    {{ $supplier->address ?? '-' }}

                </div>

            </div>

            {{-- CERTIFICATION --}}
            <div class="p-6 border-r border-slate-200">

                <p class="text-xs uppercase tracking-wider
                          text-slate-400 font-semibold mb-4">

                    Material Certifications

                </p>

                <div class="text-sm text-slate-700">

                    {{ $supplier->certification ?? '-' }}

                </div>

            </div>

            {{-- UPDATED --}}
            <div class="p-6">

                <p class="text-xs uppercase tracking-wider
                          text-slate-400 font-semibold mb-4">

                    Last Updated

                </p>

                <div class="text-sm text-slate-700">

                    {{ $supplier->updated_at->format('M d, Y') }}

                </div>

            </div>

        </div>

        {{-- SUCCESS --}}
        @if(session('success'))

        <div class="mb-6 p-4 rounded-2xl
                    bg-green-50 border border-green-200
                    text-green-700 text-sm font-medium">

            {{ session('success') }}

        </div>

        @endif

        {{-- ERROR --}}
        @if($errors->any())

        <div class="mb-6 p-4 rounded-2xl
                    bg-red-50 border border-red-200">

            <ul class="text-sm text-red-600 space-y-1">

                @foreach($errors->all() as $error)

                <li>• {{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        {{-- LAYUP SECTION --}}
        <div class="flex items-center justify-between mb-5">

            <h2 class="text-2xl font-bold text-slate-900">
                Associated Layups
            </h2>

            <div class="flex items-center gap-3">

                {{-- IMPORT BUTTON --}}
                <button
                    onclick="document.getElementById('importModal').classList.remove('hidden')"
                    class="h-11 px-5 inline-flex items-center gap-2
                           rounded-xl border border-slate-200
                           bg-white text-slate-700 text-sm font-medium
                           hover:bg-slate-50 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 4v12m0 0l-4-4m4 4l4-4" />

                    </svg>

                    Import

                </button>

                {{-- EXPORT --}}
                @if($layups->count() > 0)

                <a href="{{ route('suppliers.export', $supplier) }}"
                   class="h-11 px-5 inline-flex items-center gap-2
                          rounded-xl border border-slate-200
                          bg-white text-slate-700 text-sm font-medium
                          hover:bg-slate-50 transition">

                    Export

                </a>

                @endif

                {{-- ADD --}}
                <a href="{{ route('suppliers.layups.create', $supplier) }}"
                   class="h-11 px-5 inline-flex items-center
                          rounded-xl bg-green-700 text-white
                          text-sm font-semibold hover:bg-green-800 transition">

                    + Add Layup

                </a>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Layup ID
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Name
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Thickness
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Ply Count
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Status
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Updated
                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($layups as $layup)

                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                            <td class="px-6 py-5 text-sm text-slate-500">

                                L-{{ str_pad($layup->id, 3, '0', STR_PAD_LEFT) }}

                            </td>

                            <td class="px-6 py-5">

                                <div>

                                    <h3 class="font-semibold text-slate-900">
                                        {{ $layup->name }}
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        CLT Structure
                                    </p>

                                </div>

                            </td>

                            <td class="px-6 py-5 text-sm text-slate-700">

                                {{ $layup->layers->sum('thickness') }} mm

                            </td>

                            <td class="px-6 py-5">

                                <span class="px-3 py-1 rounded-lg
                                             bg-slate-100 text-slate-700
                                             text-sm font-medium">

                                    {{ $layup->layers->count() }}

                                </span>

                            </td>

                            <td class="px-6 py-5">

                                <span class="px-3 py-1 rounded-full
                                             bg-green-100 text-green-700
                                             text-xs font-medium">

                                    Active

                                </span>

                            </td>

                            <td class="px-6 py-5 text-sm text-slate-500">

                                {{ $layup->updated_at->diffForHumans() }}

                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-2">

                                    <a href="{{ route('suppliers.layups.layers.index', [$supplier, $layup]) }}"
                                       class="h-10 px-4 inline-flex items-center
                                              rounded-xl bg-slate-900
                                              text-white text-sm font-medium
                                              hover:bg-black transition">

                                        Layers

                                    </a>

                                    <a href="{{ route('suppliers.layups.edit', [$supplier, $layup]) }}"
                                       class="h-10 px-4 inline-flex items-center
                                              rounded-xl border border-slate-200
                                              bg-white text-slate-700
                                              text-sm font-medium
                                              hover:bg-slate-50 transition">

                                        Edit

                                    </a>

                                    <form method="POST"
                                          action="{{ route('suppliers.layups.destroy', [$supplier, $layup]) }}">

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

                            <td colspan="7" class="px-6 py-20 text-center">

                                <h3 class="text-2xl font-bold text-slate-800">
                                    No Layups Available
                                </h3>

                                <p class="text-slate-500 mt-2">
                                    Create your first layup structure.
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

{{-- IMPORT MODAL --}}
<div id="importModal"
     class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl p-8 relative">

        {{-- CLOSE --}}
        <button
            onclick="document.getElementById('importModal').classList.add('hidden')"
            class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 transition">

            ✕

        </button>

        {{-- TITLE --}}
        <h2 class="text-xl font-bold text-slate-900 mb-6">
            Import Layup Data
        </h2>

        <form method="POST"
              action="{{ route('suppliers.import', $supplier) }}"
              enctype="multipart/form-data">

            @csrf

            {{-- UPLOAD AREA --}}
            <label
                class="border-2 border-dashed border-slate-300
                       rounded-2xl p-10 flex flex-col items-center
                       justify-center text-center cursor-pointer
                       hover:border-green-600 hover:bg-green-50/30 transition">

                <div class="w-14 h-14 rounded-full bg-green-100
                            flex items-center justify-center mb-4">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-7 h-7 text-green-700"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />

                    </svg>

                </div>

                <p class="text-sm font-medium text-slate-700">
                    Click to upload
                    <span class="text-slate-400">
                        or drag and drop
                    </span>
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    JSON files only
                </p>

                <input
                    type="file"
                    name="json_file"
                    accept=".json"
                    required
                    class="hidden">

            </label>

            {{-- STRATEGY --}}
            <div class="mt-6">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Conflict Resolution Strategy
                </label>

                <select
                    name="strategy"
                    class="w-full border border-slate-300
                           rounded-xl px-4 py-3 text-sm">

                    <option value="skip">
                        Skip conflicts (Default)
                    </option>

                    <option value="overwrite">
                        Overwrite existing layers
                    </option>

                </select>

            </div>

            {{-- DRY RUN --}}
            <div class="mt-5 border border-slate-200 rounded-2xl p-4">

                <label class="flex items-start gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="dry_run"
                        class="mt-1 rounded border-slate-300 text-green-700">

                    <div>

                        <p class="text-sm font-medium text-slate-700">
                            Run as Dry Run
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            Simulate import process without saving changes.
                        </p>

                    </div>

                </label>

            </div>

            {{-- WARNING --}}
            <div class="mt-5 bg-red-50 border border-red-200
                        rounded-2xl p-4 flex gap-3">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-red-500 mt-0.5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.8"
                          d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />

                </svg>

                <div>

                    <p class="text-sm font-semibold text-red-700">
                        Potential Conflicts Detected
                    </p>

                    <p class="text-xs text-red-500 mt-1">
                        Existing layups may require manual review.
                    </p>

                </div>

            </div>

            {{-- ACTIONS --}}
            <div class="flex items-center justify-end gap-3 mt-8">

                <button
                    type="button"
                    onclick="document.getElementById('importModal').classList.add('hidden')"
                    class="px-5 h-11 rounded-xl border border-slate-300
                           text-slate-700 text-sm font-medium
                           hover:bg-slate-50 transition">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="px-5 h-11 rounded-xl bg-green-700
                           text-white text-sm font-semibold
                           hover:bg-green-800 transition">

                    Confirm Import

                </button>

            </div>

        </form>

    </div>

</div>

</x-app-layout>