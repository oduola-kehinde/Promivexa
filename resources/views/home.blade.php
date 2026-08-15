<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($services as $service)
                            <div class="border p-4 rounded-lg shadow">
                                <h3 class="text-lg font-bold">{{ $service->platform }} - {{ $service->name }}</h3>
                                <p class="text-sm text-gray-600 mt-2">{{ $service->description }}</p>
                                <p class="mt-2"><b>Min:</b> {{ $service->min_qty }} | <b>Max:</b> {{ $service->max_qty }}</p>
                                <p class="mt-2 text-xl font-bold text-blue-600">${{ $service->price_per_1000 }} / 1000</p>
                                
                                @auth
                                    <a href="{{ route('order.form', $service->id) }}" 
                                       class="mt-4 inline-block w-full text-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Order Now
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="mt-4 inline-block w-full text-center bg-gray-500 text-white px-4 py-2 rounded">
                                        Login to Order
                                    </a>
                                @endauth
                            </div>
                        @empty
                            <p>No services available yet. Add some from database.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>