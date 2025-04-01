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
    <div class="card border-0 shadow-sm mb-4 rounded-3">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <div class="align-items-center">
                <i class="fas fa-box-open text-primary me-3"></i>
                <h3 class="h5 mb-0 fw-semibold text-primary">My Recent Donations</h3>
            </div>
            <a href="{{ route('donations.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> New Donation
            </a>
        </div>
        
        <div class="card-body p-0">
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
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">Item</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Quantity</th>
                                <th class="border-0">Charity</th>
                                <th class="border-0">Date</th>
                                <th class="border-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donations as $donation)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3" style="width: 60px; height: 60px;">
                                            <img src="{{ asset('images/donations/' . $donation->image) }}" class="img-fluid rounded h-100 w-100 object-fit-cover"alt="{{ $donation->title }}">
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $donation->title }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ $donation->status === 'available' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </td>
                                <td>{{ $donation->quantity }}</td>
                                <td>
                                    @if($donation->charity)
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-hands-helping text-primary me-1"></i>
                                            {{ $donation->charity->name }}
                                        </span>
                                    @else
                                        <span class="text-muted">Not assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $donation->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('donations.show', $donation) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection