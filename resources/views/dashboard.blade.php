@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Simple Welcome Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">{{ __('Dashboard') }}</h2>
        </div>
        
        <div class="card-body text-center py-4">
            <div class="mb-4">
                <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
                <h3 class="h4">Welcome back, {{ Auth::user()->name }}!</h3>
                <p class="text-muted">You're successfully logged in.</p>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="{{ route('donations.index') }}" class="btn btn-primary">
                    <i class="fas fa-box-open me-1"></i> Donations
                </a>
                <a href="{{ route('charities.index') }}" class="btn btn-success">
                    <i class="fas fa-hands-helping me-1"></i> Charities
                </a>
                <a href="{{ route('offers.index') }}" class="btn btn-info">
                    <i class="fas fa-hand-holding-heart me-1"></i> Offers
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Tips Section -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white">
            <h3 class="h5 mb-0"><i class="fas fa-lightbulb text-warning me-2"></i> Quick Tips</h3>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                <li class="mb-2"><i class="fas fa-arrow-right text-muted me-2"></i> Browse donations to find items you need</li>
                <li class="mb-2"><i class="fas fa-arrow-right text-muted me-2"></i> Connect with charities to donate items</li>
                <li class="mb-2"><i class="fas fa-arrow-right text-muted me-2"></i> Make offers on available donations</li>
            </ul>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 0.5rem;
    }
    .btn {
        border-radius: 0.25rem;
    }
</style>
@endsection