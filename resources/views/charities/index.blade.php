@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">{{ __('All Charities') }}</h2>
        <a href="{{ route('charities.create') }}" class="btn btn-primary">Add Aharity</a>
    </div>

    <!-- Charities Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h3 class="h5 mb-3">List of Charities:</h3>

            @if ($charities->isEmpty())
                <p class="text-muted">No charities available.</p>
            @else
                <div class="row">
                    @foreach($charities as $charity)
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <!-- Card Component -->
                            <div class="card h-100 shadow-sm">
                                <a href="{{ route('charities.show', $charity->id) }}" class="text-decoration-none text-dark">
                                    <img src="{{ asset('images/charities/' . $charity->image) }}" class="card-img-top img-fluid rounded-top" alt="{{ $charity->title }}">

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $charity->title }}</h5>
                                    </div>
                                </a>

                                <!-- Action Buttons -->
                                <div class="card-footer bg-white border-0 d-flex justify-content-between">
                                    <!-- Edit Button -->
                                    <a href="{{ route('charities.edit', $charity->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <!-- Delete Form -->
                                    <form action="{{ route('charities.destroy', $charity->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this charity?');">
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
