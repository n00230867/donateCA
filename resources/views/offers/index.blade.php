@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Offers</h1>
    
    @foreach($offers as $offer)
        <div class="card mb-2">
            <div class="card-body">
                <h5>{{ $offer->title }}</h5>
                <p>{{ $offer->description }}</p>
                <p><strong>Price:</strong> ${{ $offer->price }}</p>
                <p><strong>Posted by:</strong> {{ $offer->user->name }}</p>
            </div>
        </div>
    @endforeach

    @auth
    <h3>Add an Offer</h3>
    <form action="{{ route('offers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Offer Title" required>
        </div>
        <div class="form-group">
            <textarea name="description" class="form-control" placeholder="Description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
    @endauth
</div>
@endsection
