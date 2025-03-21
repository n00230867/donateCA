@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('images/charities/' . $charity->image) }}" class="img-fluid rounded-start m-3 border border-3 border-dark" alt="{{ $charity->title }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ $charity->title }}</h1>
                    <h3>Description</h3>
                    <p class="card-text">{{ $charity->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
