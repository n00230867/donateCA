@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="text-primary">{{ __('All Charities') }}</h1>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('charities.create') }}" class="btn btn-primary btn-lg px-4">
                <i class="fas fa-plus me-2"></i> Add Charity
            </a>
        @endif
    </div>

    <!-- Charities Grid -->
    @if ($charities->isEmpty())
        <div class="text-center py-5 bg-light rounded-3">
            <i class="fas fa-hands-helping fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No charities available</h4>
            <p class="text-muted">Add your first charity to get started!</p>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('charities.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus me-2"></i> Create Charity
                </a>
            @endif
        </div>
    @else
        <div class="row g-4">
            @foreach($charities as $charity)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow" style="background-color: #ffffff; border-radius: 0.75rem;">
                        <a href="{{ route('charities.show', $charity->id) }}" class="text-decoration-none text-dark">
                            <!-- Image Container -->
                            <div class="bg-light" style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center; border-bottom: 1px solid #eee;">
                                <img src="{{ asset('images/charities/' . $charity->image) }}" 
                                    class="img-fluid" 
                                    alt="{{ $charity->title }}"
                                    style="object-fit: contain; max-height: 100%; max-width: 100%;">
                            </div>
                            
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h5 class="card-title mb-0 fw-bold">{{ $charity->title }}</h5>
                                    @if($charity->registration_no)
                                        <span class="badge bg-info text-dark fs-6">Reg #{{ $charity->registration_no }}</span>
                                    @endif
                                </div>
                                <p class="card-text mt-2 text-muted">
                                    {{ Str::limit($charity->description, 100) }}
                                </p>
                            </div>
                        </a>

                        <!-- Admin Actions -->
                        @if(auth()->user()->role === 'admin')
                        <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('charities.edit', $charity->id) }}" 
                                    class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-pencil-alt me-1"></i> Edit
                                </a>
                                
                                <form action="{{ route('charities.destroy', $charity->id) }}" method="POST">
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
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid rgba(0,0,0,0.1) !important;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
    .card-title {
        color: #2c3e50;
    }
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    body {
        background-color: #f5f7fa;
    }
</style>
@endsection