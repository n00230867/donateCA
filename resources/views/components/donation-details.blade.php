@props([
    'title',
    'image',
    'category',
    'quantity',
    'description',
    'availability'
])

<div class="card shadow mx-auto" style="max-width: 36rem;">
    @if ($image)
        <img src="{{ asset('public/images/donations/' . $donation->image) }}" class="card-img-top" alt="{{ $title }}">
    @endif

    <div class="card-body">
        <h1 class="card-title">{{ $title }}</h1>
        <hr>
        <h3>Description</h3>
        <p class="card-text">{{ $description }}</p>

        <!-- Display additional props if needed -->
        @if ($category)
            <p class="card-text"><strong>Category:</strong> {{ $category }}</p>
        @endif

        @if ($quantity)
            <p class="card-text"><strong>Quantity:</strong> {{ $quantity }}</p>
        @endif

        @if ($availability)
            <p class="card-text"><strong>Availability:</strong> {{ $availability }}</p>
        @endif
    </div>

    <div class="card-footer text-end">
        <a href="{{ route('donations.index') }}" class="btn btn-secondary">Back to Donations</a>
    </div>
</div>