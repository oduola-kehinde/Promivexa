@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Add New Service</h2>
    <form method="POST" action="{{ route('admin.services.store') }}">
        @csrf
        <div class="mb-3">
            <label>Service Name</label>
            <input type="text" name="name" class="form-control" placeholder="Instagram Followers" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" value="Instagram" required>
        </div>
        <div class="mb-3">
            <label>Client Price per 1000</label>
            <input type="number" step="0.01" name="client_price_per_1000" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Worker Payout per Task</label>
            <input type="number" step="0.01" name="worker_payout_per_task" class="form-control" required>
        </div>
        <button class="btn btn-success">Save Service</button>
    </form>
</div>
@endsection