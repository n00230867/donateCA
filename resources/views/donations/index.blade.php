@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">{{ __('All Donations') }}</h2>
    </div>

    {{-- Donations Section --}}
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="h5 mb-3">List of Donations:</h3>
            
            <div class="row">
                @foreach($donations as $donation)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        {{-- Entire card is wrapped in a link --}}
                        <a href="{{ route('donations.show', $donation->id) }}" class="text-decoration-none text-dark">
                            <div class="card h-100">
                                @if($donation->image)
                                    <img src="{{ asset('public/images/donations/' . $donation->image) }}" class="card-img-top" alt="{{ $donation->title }}">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $donation->title }}</h5>
                                    <p class="card-text text-muted">{{ $donation->category }}</p>
                                    <p class="card-text fw-bold">{{ $donation->description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>
</div>
@endsection
