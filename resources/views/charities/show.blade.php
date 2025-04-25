@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Charity Card -->
    <div class="card mb-5">
        <div class="row g-0">
            <!-- Charity Image -->
            <div class="col-md-4 bg-light d-flex align-items-center">
                <img src="{{ asset('images/charities/' . $charity->image) }}" 
                    class="img-fluid p-3 rounded-start" 
                    alt="{{ $charity->title }}"
                    style="object-fit: cover; height: 100%; width: 100%;">
            </div>
            
            <!-- Charity Details -->
            <div class="col-md-8">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="card-title display-6 fw-bold text-primary">{{ $charity->title }}</h1>
                            @if($charity->registration_no)
                                <span class="badge bg-info text-dark fs-6 mb-3">
                                    Reg #{{ $charity->registration_no }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Description Section -->
                    <div class="mb-4">
                        <h3 class="h4 border-bottom pb-2 text-primary">About Our Charity</h3>
                        <p class="card-text fs-5">{{ $charity->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Donations Section -->
    <div class="mt-5">
        <div class="d-flex align-items-center mb-4">
            <h2 class="h4 m-0 pe-3 text-primary">Available Donations</h2>
            <div class="flex-grow-1 border-top"></div>
        </div>

        @if($charity->donations->count() > 0)
            <div class="row g-4">
                @foreach($charity->donations as $donation)
                    <div class="col-md-6">
                        <div class="card h-100 border">
                            <div class="card-img-top overflow-hidden" style="height: 200px;">
                                <img src="{{ asset('images/donations/' . $donation->image) }}" 
                                    class="img-fluid w-100 h-100" 
                                    alt="{{ $donation->title }}"
                                    style="object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h3 class="h5 card-title">{{ $donation->title }}</h3>
                                    <span class="badge bg-{{ $donation->availability === 'Available' ? 'success' : 'warning' }}">
                                        {{ $donation->availability }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge bg-secondary">{{ $donation->category }}</span>
                                    <span class="text-muted">Qty: {{ $donation->quantity }}</span>
                                </div>
                                <p class="card-text">{{ Str::limit($donation->description, 100) }}</p>
                                <div class="d-grid">
                                    <a href="{{ route('donations.show', $donation) }}" class="btn btn-primary">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 bg-white rounded-3 border">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No donations available</h4>
                <p class="text-muted">This charity currently has no donations listed.</p>
            </div>
        @endif
    </div>
</div>

@endsection