@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Donation Card -->
    <div class="card mb-5">
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
                        <span class="badge bg-{{ $donation->availability === 'available' ? 'success' : ($donation->availability === 'pending' ? 'warning' : 'danger') }} fs-6">
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
                    
                    @if(auth()->id() === $donation->user_id && $donation->availability === 'available')
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            As the donor, you can accept one of the offers below. This will mark the donation as unavailable.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Offers Section -->
    <div class="mt-5">
        <h2 class="mb-4 text-primary position-relative">
            <span class="bg-white pe-3">Offers</span>
            <span class="position-absolute top-50 start-0 w-100 border-top"></span>
        </h2>

        @if($donation->offers->isEmpty())
            <div class="text-center py-5 bg-white rounded-3 border">
                <i class="fas fa-hand-holding-heart fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No offers yet</h4>
                <p class="text-muted">Be the first to make an offer!</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($donation->offers as $offer)
                    <div class="col-md-6">
                        <div class="card h-100 border {{ $offer->status === 'accepted' ? 'border-success border-3' : '' }}">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar bg-primary text-white rounded-circle me-3" style="width: 40px; height: 40px; line-height: 40px; text-align: center;">
                                        {{ strtoupper(substr($offer->user->name, 0, 1)) }}
                                    </div>
                                    <h5 class="card-title mb-0">{{ $offer->user->name }}</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-{{ $offer->status === 'accepted' ? 'success' : 'info' }} text-white fs-6">
                                        €{{ number_format($offer->amount, 2) }}
                                        @if($offer->status === 'accepted')
                                            <i class="fas fa-check ms-1"></i>
                                        @endif
                                    </span>
                                    <small class="text-muted">{{ $offer->created_at->diffForHumans() }}</small>
                                </div>
                                @if($offer->comment)
                                    <div class="bg-light p-3 rounded mt-2">
                                        <p class="card-text mb-0">{{ $offer->comment }}</p>
                                    </div>
                                @endif
                                
                                @if($offer->status === 'accepted')
                                    <div class="alert alert-success mt-3 mb-0">
                                        <i class="fas fa-check-circle me-2"></i>
                                        This offer has been accepted
                                    </div>
                                @elseif(auth()->id() === $donation->user_id && $donation->availability === 'available')
                                    <form action="{{ route('offers.accept', $offer) }}" method="POST" class="mt-3">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check me-1"></i> Accept Offer
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @auth
            @if($donation->availability === 'available' && auth()->id() !== $donation->user_id)
            <div class="mt-5">
                <div class="card border">
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
            @elseif(auth()->id() !== $donation->user_id)
            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-triangle me-2"></i>
                This donation is no longer available for offers.
            </div>
            @endif
        @endauth
    </div>

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
    .avatar {
        font-weight: bold;
    }
    .card {
        background-color: white;
    }
</style>
@endsection