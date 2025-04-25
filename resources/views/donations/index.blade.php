@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Page Header with Search -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
        <h1 class="text-primary mb-0">{{ __('All Donations') }}</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('donations.index') }}" class="input-group search-bar w-100 w-md-auto" style="max-width: 400px;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control shadow-sm"
                placeholder="Search donations..." aria-label="Search Donations">
            <button class="btn btn-primary d-flex align-items-center justify-content-center" type="submit">
                <i class="fas fa-search me-1"></i> Search
            </button>
        </form>

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
                    <div class="card h-100 border-0 shadow" style="background-color: #ffffff; border-radius: 0.75rem; border: 1px solid rgba(0,0,0,0.1);">
                        <a href="{{ route('donations.show', $donation->id) }}" class="text-decoration-none text-dark">
                            <!-- Image Container -->
                            <div class="ratio ratio-16x9 bg-light position-relative" style="border-bottom: 1px solid rgba(0,0,0,0.1);">
                                <img src="{{ asset('images/donations/' . $donation->image) }}" 
                                    class="img-fluid object-fit-cover"
                                    alt="{{ $donation->title }}"
                                    style="border-radius: 0.75rem 0.75rem 0 0;">
                            </div>
                            
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0 fw-bold">{{ $donation->title }}</h5>
                                    <span class="badge bg-secondary">{{ $donation->category }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge fs-6
                                        @if($donation->availability === 'available') bg-success
                                        @elseif($donation->availability === 'pending') bg-warning text-dark
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

                        <!-- Actions - Show for creator or admin -->
                        @if(auth()->id() === $donation->user_id || auth()->user()->role === 'admin')
                        <div class="card-footer border-top-0 pt-0 pb-3 px-3 bg-white">
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
                                            onclick="return confirm('Are you sure you want to delete this donation?')">
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

<!-- Styles -->
<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .ratio-16x9::before {
        padding-top: 100%;
    }
    .object-fit-cover {
        object-fit: cover;
        object-position: center;
    }
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
    body {
        background-color: #f5f7fa;
    }
    .card-title {
        color: #2c3e50;
    }
    .search-bar input.form-control {
        border-radius: 2rem 0 0 2rem;
        padding: 0.6rem 1.2rem;
    }
    .search-bar .btn {
        border-radius: 0 2rem 2rem 0;
        padding: 0.6rem 1.2rem;
        display: flex;
        align-items: center;
    }
</style>
@endsection
