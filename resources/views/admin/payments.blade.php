@extends('layouts.app')
@section('title', 'Admin - Payments')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">💳 Payment Management</h2>

    <!-- Revenue Card -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Total Revenue</h5>
                    <h2>₹{{ number_format($totalRevenue, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5>Total Payments</h5>
                    <h2>{{ $payments->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <h5>Completed Payments</h5>
                    <h2>{{ $payments->where('status', 'completed')->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">All Payments</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Room</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Transaction ID</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ $payment->booking->room->name }}</td>
                        <td>₹{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                        <td><small>{{ $payment->transaction_id }}</small></td>
                        <td>
                            <span class="badge bg-{{ $payment->status === 'completed' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning') }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td>{{ $payment->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No payments yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection