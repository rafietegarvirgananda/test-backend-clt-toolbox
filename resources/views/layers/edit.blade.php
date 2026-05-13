<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Layer
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <form action="{{ route('suppliers.layups.layers.update', [$supplier, $layup, $layer]) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block mb-2">
                            Layer Order
                        </label>

                        <input type="number"
                               name="layer_order"
                               value="{{ $layer->layer_order }}"
                               class="w-full border rounded p-2">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2">
                            Thickness
                        </label>

                        <input type="number"
                               step="0.01"
                               name="thickness"
                               value="{{ $layer->thickness }}"
                               class="w-full border rounded p-2">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2">
                            Width
                        </label>

                        <input type="number"
                               step="0.01"
                               name="width"
                               value="{{ $layer->width }}"
                               class="w-full border rounded p-2">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2">
                            Angle
                        </label>

                        <input type="number"
                               step="0.01"
                               name="angle"
                               value="{{ $layer->angle }}"
                               class="w-full border rounded p-2">

                    </div>

                    <button class="bg-blue-500 text-white px-4 py-2 rounded">
                        Update
                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>