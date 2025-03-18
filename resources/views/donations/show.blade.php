@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('images/donations/' . $donation->image) }}" class="img-fluid rounded-start" alt="{{ $donation->title }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ $donation->title }}</h1>
                    <h5 class="text-muted">Published: {{ $donation->category }}</h5>

                    <p class="card-text">{{ $donation->quantity }}</p>

                    <h3>Description</h3>
                    <p class="card-text">{{ $donation->description }}</p>

                    <p class="card-text">{{ $donation->availability }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
