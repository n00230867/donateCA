@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Offer</h2>
    
    <form action="{{ route('offers.update', ['donation' => $donation, 'offer' => $offer]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="amount" class="form-label">Offer Amount (€)</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $offer->amount) }}" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Comment (optional)</label>
            <textarea name="comment" class="form-control" rows="3">{{ old('comment', $offer->comment) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Offer</button>
    </form>
</div>
@endsection
