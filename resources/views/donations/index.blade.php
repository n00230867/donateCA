@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">{{ __('All Donations') }}</h2>
        <a href="{{ route('donations.create') }}" class="btn btn-primary">Add Donation</a>
    </div>

    <!-- Donations Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h3 class="h5 mb-3">List of Donations:</h3>

            @if ($donations->isEmpty())
                <p class="text-muted">No donations available.</p>
            @else
                <div class="row">
                    @foreach($donations as $donation)
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <!-- Card Component -->
                            <div class="card h-100 shadow-sm">
                                <a href="{{ route('donations.show', $donation->id) }}" class="text-decoration-none text-dark">
                                    <img src="{{ asset('images/donations/' . $donation->image) }}" class="card-img-top img-fluid rounded-top" alt="{{ $donation->title }}">

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $donation->title }}</h5>
                                        <p class="card-text text-muted mb-1">{{ $donation->category }}</p>
                                        <p class="card-text fw-bold text-success">{{ $donation->availability }}</p>
                                    </div>
                                </a>

                                <!-- Action Buttons -->
                                <div class="card-footer bg-white border-0 d-flex justify-content-between">
                                    <!-- Edit Button -->
                                    <a href="{{ route('donations.edit', $donation->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <!-- Delete Form -->
                                    <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this donation?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
