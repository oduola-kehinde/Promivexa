@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Place New Order</h4>
                </div>
                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Select Service</label>
                            <select name="service_id" class="form-control" required>
                                <option value="">-- Choose a Service --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">
                                        {{ $service->name }} - ₦{{ number_format($service->client_price_per_1000, 2) }} / 1000
                                        @if($service->category) ({{ $service->category }}) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="text" name="link" class="form-control" placeholder="Enter post, profile or link URL" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" min="1" placeholder="Enter quantity" required>
                            <small class="text-muted">Min: @if(isset($service)) {{ $service->min }} @endif | Max: @if(isset($service)) {{ $service->max }} @endif</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection