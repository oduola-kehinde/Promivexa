<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order: {{ $service->platform }} {{ $service->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="mb-4">
                    <h3 class="text-lg font-bold">{{ $service->platform }} - ${{ $service->client_price_per_1000 }}/1000</h3>
                    <p class="text-sm text-gray-600">Min: {{ $service->min_qty }} | Max: {{ $service->max_qty }}</p>
                </div>
                
                <form method="POST" action="{{ route('order.store', $service) }}">
                    @csrf
                    <div>
                        <label class="block font-semibold">Link / Username</label>
                        <input type="text" name="link" class="w-full border rounded p-2 mt-1" placeholder="https://instagram.com/username" required>
                        @error('link') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label class="block font-semibold">Quantity</label>
                        <input type="number" name="quantity" class="w-full border rounded p-2 mt-1" min="{{ $service->min_qty }}" max="{{ $service->max_qty }}" required>
                        @error('quantity') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                    
                    <button class="mt-6 w-full bg-green-600 text-white py-2 rounded font-bold hover:bg-green-700">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>