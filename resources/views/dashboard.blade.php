<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SMM Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                @foreach($services as $service)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">{{ $service->platform }}</h3>
                    <p class="text-md font-semibold mt-1">{{ $service->name }}</p>
                    <p class="text-sm text-gray-600 mt-2">{{ $service->description }}</p>
                    
                    <div class="mt-4 space-y-1 text-sm">
                        <p><strong>Price:</strong> ${{ number_format($service->client_price_per_1000, 2) }} / 1000</p>
                        <p><strong>Min:</strong> {{ number_format($service->min_qty) }}</p>
                        <p><strong>Max:</strong> {{ number_format($service->max_qty) }}</p>
                    </div>

                    <a href="{{ route('order.create', $service) }}" class="mt-4 w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold text-center block">
                        Order Now
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>