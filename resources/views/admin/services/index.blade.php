<!DOCTYPE html>
<html>
<head>
    <title>All Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2>All Services</h2>
        <a href="/admin/services/create" class="btn btn-success mb-3">+ Add New Service</a>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Service Name</th>
                    <th>Client Price</th>
                    <th>Worker Payout</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->category }}</td>
                    <td>{{ $service->name }}</td>
                    <td>₦{{ number_format($service->client_price_per_1000) }}</td>
                    <td>₦{{ number_format($service->worker_payout_per_task) }}</td>
                    <td><span class="badge bg-success">{{ $service->status }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No services yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>