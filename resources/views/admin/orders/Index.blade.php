<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📦 All Orders - Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border p-2">ID</th>
                                <th class="border p-2">User</th>
                                <th class="border p-2">Service</th>
                                <th class="border p-2">Link</th>
                                <th class="border p-2">Qty</th>
                                <th class="border p-2">Status</th>
                                <th class="border p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="border p-2">{{ $order->id }}</td>
                                <td class="border p-2">{{ $order->user->name ?? 'Guest' }}</td>
                                <td class="border p-2">{{ $order->service->name ?? '-' }}</td>
                                <td class="border p-2">{{ $order->link }}</td>
                                <td class="border p-2">{{ $order->quantity }}</td>
                                <td class="border p-2">{{ $order->status }}</td>
                                <td class="border p-2">
                                    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="border rounded p-1">
                                            <option value="Pending" {{ $order->status=='Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Processing" {{ $order->status=='Processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="Completed" {{ $order->status=='Completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="Cancelled" {{ $order->status=='Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center p-4">No orders yet</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>