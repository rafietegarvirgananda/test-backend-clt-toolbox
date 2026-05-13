<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Layup
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <form action="{{ route('suppliers.layups.store', $supplier) }}"
                      method="POST">

                    @csrf

                    <div class="mb-4">

                        <label class="block mb-2">
                            Layup Name
                        </label>

                        <input type="text"
                               name="name"
                               class="w-full border rounded p-2">

                    </div>

                    <button class="bg-blue-500 text-white px-4 py-2 rounded">
                        Save
                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>