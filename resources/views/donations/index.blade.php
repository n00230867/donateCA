@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="text-primary">{{ __('All Donations') }}</h1>
        <a href="{{ route('donations.create') }}" class="btn btn-primary btn-lg px-4">
            <i class="fas fa-plus me-2"></i> Add Donation
        </a>
    </div>

    <!-- Donations Grid -->
    @if ($donations->isEmpty())
        <div class="text-center py-5 bg-light rounded-3">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No donations available</h4>
            <p class="text-muted">Be the first to add a donation!</p>
            <a href="{{ route('donations.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i> Create Donation
            </a>
        </div>
    @else
        <div class="row g-4">
            @foreach($donations as $donation)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="background-color:rgb(255, 255, 255);">
                        <a href="{{ route('donations.show', $donation->id) }}" class="text-decoration-none text-dark">
                            <!-- Image Container -->
                            <div class="ratio ratio-16x9 bg-light position-relative">
                                <img src="{{ asset('images/donations/' . $donation->image) }}" 
                                    class="img-fluid object-fit-cover"
                                    alt="{{ $donation->title }}"
                                    style="border-radius: 0.5rem 0.5rem 0 0;">
                                <div class="position-absolute bottom-0 start-0 end-0 border-bottom" style="border-color: rgba(0,0,0,0.1) !important;"></div>
                            </div>
                            
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">{{ $donation->title }}</h5>
                                    <span class="badge bg-secondary">{{ $donation->category }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge 
                                        @if($donation->availability === 'available') bg-success
                                        @elseif($donation->availability === 'pending') bg-warning
                                        @else bg-danger
                                        @endif text-capitalize">
                                        {{ $donation->availability }}
                                    </span>
                                    @if($donation->quantity > 1)
                                        <small class="text-muted">
                                            <i class="fas fa-boxes me-1"></i> {{ $donation->quantity }} items
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </a>

                        <!-- Admin Actions -->
                        @if(auth()->user()->role === 'admin')
                        <div class="card-footer border-top-0 pt-0 pb-3 px-3" style="background-color:rgb(255, 255, 255);">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('donations.edit', $donation->id) }}" 
                                    class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-pencil-alt me-1"></i> Edit
                                </a>
                                
                                <form action="{{ route('donations.destroy', $donation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                            onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .ratio-16x9::before {
        padding-top: 100%; /* 16:9 Aspect Ratio */
    }
    .object-fit-cover {
        object-fit: cover;
        object-position: center;
    }
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    .badge {
        font-weight: 500;
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>

@endsection