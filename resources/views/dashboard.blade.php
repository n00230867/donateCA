@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Welcome Card -->
    <div class="card border-0 shadow-sm mb-4 rounded-3">
        <div class="card-header bg-white border-0 py-3">
            <h2 class="h5 mb-0 fw-semibold text-primary">{{ __('Dashboard') }}</h2>
        </div>
        
        <div class="card-body text-center py-4 px-4">
            <div class="mb-4">
                <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
                <h3 class="h4 fw-bold mb-2">Welcome back, {{ Auth::user()->name }}</h3>
                <p class="text-muted mb-4">You're successfully logged in to your donation portal</p>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('donations.index') }}" class="btn btn-primary px-4 py-2">
                    <i class="fas fa-box-open me-2"></i> Donations
                </a>
                <a href="{{ route('charities.index') }}" class="btn btn-success px-4 py-2">
                    <i class="fas fa-hands-helping me-2"></i> Charities
                </a>
                <a href="{{ route('offers.index') }}" class="btn btn-info px-4 py-2">
                    <i class="fas fa-hand-holding-heart me-2"></i> Offers
                </a>
            </div>
        </div>
    </div>

    <!-- My Recent Donations Section -->
    <div class="card border-0 shadow-sm mb-4 rounded-3 bg-white">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <div class="align-items-center">
                <i class="fas fa-box-open text-primary me-3"></i>
                <h3 class="h5 mb-0 fw-semibold text-primary">My Recent Donations</h3>
            </div>
            <a href="{{ route('donations.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> New Donation
            </a>
        </div>
        
        <div class="card-body">
            @if($donations->isEmpty())
                <div class="text-center p-5">
                    <i class="fas fa-box-open text-muted fa-2x mb-3"></i>
                    <h5 class="fw-semibold mb-2">No Donations Yet</h5>
                    <p class="text-muted mb-4">You haven't made any donations yet</p>
                    <a href="{{ route('donations.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i> Create Donation
                    </a>
                </div>
            @else
                <div class="donation-list">
                    @foreach($donations as $donation)
                    <a href="{{ route('donations.show', $donation) }}" class="text-decoration-none">
                        <div class="donation-item mb-4 p-3 border rounded bg-white">
                            <div class="d-flex">
                                <div class="me-3" style="width: 60px; height: 60px;">
                                    <img src="{{ asset('images/donations/' . $donation->image) }}" class="img-fluid rounded h-100 w-100 object-fit-cover" alt="{{ $donation->title }}">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-semibold mb-1 text-dark">{{ $donation->title }}</h6>
                                        <span class="badge rounded-pill bg-{{ $donation->availability === 'available' ? 'success' : ($donation->availability === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($donation->availability) }}
                                        </span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span class="me-3 text-dark">
                                                <i class="fas fa-boxes text-muted me-1"></i>
                                                {{ $donation->quantity }}
                                            </span>
                                            @if($donation->charity)
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-hands-helping text-primary me-1"></i>
                                                {{ $donation->charity->name }}
                                            </span>
                                            @else
                                            <span class="text-muted">Not assigned</span>
                                            @endif
                                        </div>
                                        <small class="text-muted">{{ $donation->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- My Offers Section -->
    <div class="card border-0 shadow-sm rounded-3 bg-white">
        <div class="card-header bg-white border-bottom py-3">
            <div class="align-items-center">
                <i class="fas fa-hand-holding-heart text-info me-3"></i>
                <h3 class="h5 mb-0 fw-semibold text-primary">My Recent Offers</h3>
            </div>
        </div>
        
        <div class="card-body">
            @if($offers->isEmpty())
                <div class="text-center p-5">
                    <i class="fas fa-hand-holding-heart text-muted fa-2x mb-3"></i>
                    <h5 class="fw-semibold mb-2">No Offers Yet</h5>
                    <p class="text-muted mb-4">You haven't made any offers yet</p>
                </div>
            @else
                <div class="offer-list">
                    @foreach($offers as $offer)
                    <a href="{{ route('donations.show', $offer->donation) }}" class="text-decoration-none">
                        <div class="offer-item mb-4 p-3 border rounded bg-white">
                            <div class="d-flex">
                                @if($offer->donation->image)
                                <div class="me-3" style="width: 60px; height: 60px;">
                                    <img src="{{ asset('images/donations/' . $offer->donation->image) }}" class="img-fluid rounded h-100 w-100 object-fit-cover" alt="{{ $offer->donation->title }}">
                                </div>
                                @endif
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-semibold mb-1 text-dark">{{ $offer->donation->title }}</h6>
                                        <span class="badge rounded-pill bg-{{ $offer->status === 'accepted' ? 'success' : ($offer->status === 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($offer->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mt-2">
                                        <div>
                                            <span class="badge bg-info rounded-pill me-2">
                                                €{{ number_format($offer->amount, 2) }}
                                            </span>
                                            <div class="d-inline-flex align-items-center">
                                                <div class="avatar bg-primary text-white rounded-circle me-2" style="width: 24px; height: 24px; line-height: 24px; text-align: center;">
                                                    {{ strtoupper(substr($offer->donation->user->name, 0, 1)) }}
                                                </div>
                                                <span class="text-dark">{{ $offer->donation->user->name }}</span>
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $offer->created_at->diffForHumans() }}</small>
                                    </div>
                                    
                                    @if($offer->comment)
                                    <div class="bg-light p-2 rounded mt-2">
                                        <p class="mb-0 small text-dark">{{ $offer->comment }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .avatar {
        font-weight: bold;
        font-size: 0.8rem;
    }
    .card, .donation-item, .offer-item {
        background-color: white !important;
        border: 1px solid #dee2e6 !important;
    }
    .card-header {
        background-color: white;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .donation-item:hover, .offer-item:hover {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 1px #0d6efd;
        cursor: pointer;
    }
</style>
@endsection