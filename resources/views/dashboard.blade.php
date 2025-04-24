@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Welcome Card -->
    <div class="card border-0 shadow-sm mb-4 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient-primary text-white py-4">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h2 class="h4 mb-0 fw-bold">{{ __('Dashboard Overview') }}</h2>
                    <p class="mb-0 opacity-75">Welcome back, {{ Auth::user()->name }}</p>
                </div>
                <div class="avatar bg-white text-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; font-size: 1.25rem;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
        
        <div class="card-body text-center py-4 px-4 bg-white">
            <div class="mb-4">
                <h3 class="h4 fw-bold mb-2">Donation Portal</h3>
                <p class="text-muted mb-4">Manage your donations, charities, and offers in one place</p>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('donations.index') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-box-open me-2"></i> My Donations
                </a>
                <a href="{{ route('charities.index') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-hands-helping me-2"></i> Charities
                </a>
                <a href="{{ route('donations.create') }}" class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-plus me-2"></i> New Donation
                </a>
            </div>
        </div>
    </div>

    <!-- My Recent Donations Section -->
    <div class="card border-0 shadow-sm mb-4 rounded-4 overflow-hidden">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h3 class="h5 mb-0 fw-bold">My Recent Donations</h3>
            </div>
            <a href="{{ route('donations.create') }}" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                <i class="fas fa-plus me-1"></i> New Donation
            </a>
        </div>
        
        <div class="card-body p-0">
            @if($donations->isEmpty())
                <div class="text-center p-5 bg-light rounded-bottom-4">
                    <i class="fas fa-box-open text-muted fa-2x mb-3"></i>
                    <h5 class="fw-bold mb-2">No Donations Yet</h5>
                    <p class="text-muted mb-4">You haven't made any donations yet</p>
                    <a href="{{ route('donations.create') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
                        <i class="fas fa-plus me-2"></i> Create Donation
                    </a>
                </div>
            @else
                <div class="list-group list-group-flush">
                    @foreach($donations as $donation)
                    <a href="{{ route('donations.show', $donation) }}" class="list-group-item list-group-item-action border-0 py-3 px-4 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3" style="width: 60px; height: 60px;">
                                <img src="{{ asset('images/donations/' . $donation->image) }}" class="img-fluid rounded-3 h-100 w-100 object-fit-cover" alt="{{ $donation->title }}">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="fw-bold mb-0 text-dark">{{ $donation->title }}</h6>
                                    <span class="badge rounded-pill bg-{{ $donation->availability === 'available' ? 'success' : ($donation->availability === 'pending' ? 'warning text-dark' : 'danger') }}">
                                        {{ ucfirst($donation->availability) }}
                                    </span>
                                </div>
                                
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <span class="me-3 text-muted small">
                                            <i class="fas fa-boxes me-1"></i>
                                            {{ $donation->quantity }} items
                                        </span>
                                        @if($donation->charity)
                                        <span class="badge bg-light text-dark small border">
                                            <i class="fas fa-hands-helping text-primary me-1"></i>
                                            {{ $donation->charity->name }}
                                        </span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $donation->created_at->diffForHumans() }}</small>
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
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="h5 mb-0 fw-bold">My Recent Offers</h3>
                <a href="{{ route('donations.index') }}" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                    <i class="fas fa-search me-1"></i> Browse Donations
                </a>
            </div>
        </div>
        
        <div class="card-body p-0">
            @if($offers->isEmpty())
                <div class="text-center p-5 bg-light rounded-bottom-4">
                    <i class="fas fa-hand-holding-heart text-muted fa-2x mb-3"></i>
                    <h5 class="fw-bold mb-2">No Offers Yet</h5>
                    <p class="text-muted mb-4">You haven't made any offers yet</p>
                    <a href="{{ route('donations.index') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
                        <i class="fas fa-search me-2"></i> Browse Donations
                    </a>
                </div>
            @else
                <div class="list-group list-group-flush">
                    @foreach($offers as $offer)
                    <a href="{{ route('donations.show', $offer->donation) }}" class="list-group-item list-group-item-action border-0 py-3 px-4 border-bottom">
                        <div class="d-flex align-items-center">
                            @if($offer->donation->image)
                            <div class="flex-shrink-0 me-3" style="width: 60px; height: 60px;">
                                <img src="{{ asset('images/donations/' . $offer->donation->image) }}" class="img-fluid rounded-3 h-100 w-100 object-fit-cover" alt="{{ $offer->donation->title }}">
                            </div>
                            @endif
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="fw-bold mb-0 text-dark">{{ $offer->donation->title }}</h6>
                                    <span class="badge rounded-pill bg-{{ $offer->status === 'accepted' ? 'success' : ($offer->status === 'rejected' ? 'danger' : 'warning text-dark') }}">
                                        {{ ucfirst($offer->status) }}
                                    </span>
                                </div>
                                
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <span class="badge bg-primary rounded-pill me-2">
                                            €{{ number_format($offer->amount, 2) }}
                                        </span>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-primary text-white rounded-circle me-2" style="width: 24px; height: 24px; line-height: 24px; font-size: 0.75rem;">
                                                {{ strtoupper(substr($offer->donation->user->name, 0, 1)) }}
                                            </div>
                                            <span class="text-muted small">{{ $offer->donation->user->name }}</span>
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
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    }
    .rounded-4 {
        border-radius: 1rem !important;
    }
    .rounded-bottom-4 {
        border-bottom-left-radius: 1rem !important;
        border-bottom-right-radius: 1rem !important;
    }
    .avatar {
        font-weight: bold;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }
    .list-group-item {
        transition: background-color 0.2s ease;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .btn {
        transition: all 0.2s ease;
    }
    .border-bottom {
        border-bottom: 1px solid #e9ecef !important;
    }
    .badge.bg-warning.text-dark {
        color: #212529 !important;
    }
</style>
@endsection