@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Donation Card -->
    <div class="card shadow-lg mb-5 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-4 bg-light d-flex align-items-center">
                <img src="{{ asset('images/donations/' . $donation->image) }}" 
                    class="img-fluid p-3 rounded-start" 
                    alt="{{ $donation->title }}"
                    style="object-fit: cover; height: 100%; width: 100%;">
            </div>
            <div class="col-md-8">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="card-title display-6 fw-bold text-primary">{{ $donation->title }}</h1>
                            <span class="badge bg-secondary mb-3">{{ $donation->category }}</span>
                        </div>
                        <span class="badge bg-{{ $donation->availability === 'available' ? 'success' : 'warning' }} fs-6">
                            {{ ucfirst($donation->availability) }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <p class="card-text fs-5">
                            <i class="fas fa-boxes me-2 text-muted"></i>
                            <strong>Quantity:</strong> {{ $donation->quantity }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <h3 class="h4 border-bottom pb-2 text-primary">Description</h3>
                        <p class="card-text fs-5">{{ $donation->description ?? 'No description provided' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Offers Section -->
    <div class="mt-5">
        <h2 class="mb-4 text-primary position-relative">
            <span class="bg-white pe-3">Offers</span>
            <span class="position-absolute top-50 start-0 w-100 border-top z-n1"></span>
        </h2>

        @if($donation->offers->isEmpty())
            <div class="text-center py-5 bg-light rounded-3">
                <i class="fas fa-hand-holding-heart fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No offers yet</h4>
                <p class="text-muted">Be the first to make an offer!</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($donation->offers as $offer)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar bg-primary text-white rounded-circle me-3" style="width: 40px; height: 40px; line-height: 40px; text-align: center;">
                                        {{ strtoupper(substr($offer->user->name, 0, 1)) }}
                                    </div>
                                    <h5 class="card-title mb-0">{{ $offer->user->name }}</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-success-subtle text-success fs-6">
                                        €{{ number_format($offer->amount, 2) }}
                                    </span>
                                    <small class="text-muted">{{ $offer->created_at->diffForHumans() }}</small>
                                </div>
                                @if($offer->comment)
                                    <div class="bg-light p-3 rounded mt-2">
                                        <p class="card-text mb-0">{{ $offer->comment }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Offer Form -->
        @auth
        <div class="mt-5">
            <div class="card border-0 shadow">
                <div class="card-body p-4">
                    <h3 class="h4 mb-4 text-primary">Make an Offer</h3>
                    <form action="{{ route('offers.store', $donation) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="amount" class="form-label fw-bold">Your Offer Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" step="0.01" 
                                    name="amount" 
                                    class="form-control form-control-lg" 
                                    placeholder="0.00"
                                    required
                                    min="0">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="form-label fw-bold">Message (Optional)</label>
                            <textarea name="comment" 
                                    class="form-control" 
                                    rows="3" 
                                    placeholder="Add any notes for the donor..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 py-2">
                            <i class="fas fa-paper-plane me-2"></i> Submit Offer
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endauth
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .avatar {
        font-weight: bold;
    }
</style>

@endsection