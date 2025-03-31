@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Charity Card -->
    <div class="card shadow-lg overflow-hidden border-0">
        <div class="row g-0">
            <!-- Charity Image -->
            <div class="col-md-4 bg-light d-flex align-items-center p-3">
                <img src="{{ asset('images/charities/' . $charity->image) }}" 
                    class="img-fluid rounded-3 shadow-sm" 
                    alt="{{ $charity->title }}"
                    style="object-fit: cover; height: 100%; width: 100%; border: 3px solid var(--bs-primary);">
            </div>
            
            <!-- Charity Details -->
            <div class="col-md-8">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h1 class="card-title display-5 fw-bold text-primary mb-2">{{ $charity->title }}</h1>
                            @if($charity->registration_no)
                                <span class="badge bg-info text-dark fs-6">
                                    Reg #{{ $charity->registration_no }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Description Section -->
                    <div>
                        <h3 class="h4 border-bottom pb-2 text-primary mb-3">
                            <i class="fas fa-info-circle me-2"></i>About Our Charity
                        </h3>
                        <p class="card-text fs-5 lh-base">{{ $charity->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        /* Removed transition and transform properties */
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .border-primary {
        border-color: var(--bs-primary) !important;
    }
    .rounded-3 {
        border-radius: 0.5rem !important;
    }
</style>

@endsection