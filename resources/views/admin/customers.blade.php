@extends('layouts.app')
@section('title', 'Admin - Customers')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">👥 Customer Management</h2>

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Customers</h5>
            <span class="badge bg-primary">Total: {{ $customers->count() }}</span>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Total Bookings</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            <span class="badge bg-success">{{ $customer->bookings_count }}</span>
                        </td>
                        <td>{{ $customer->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No customers yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection