@props(['title', 'image', 'category', 'quantity', 'description', 'availability'])

<div class="card h-100 shadow-sm">
    <div class="text-center">
        <img src="{{ asset('images/donations/' . $image) }}" alt="{{ $title }}" class="card-img-top img-fluid" style="max-width: 300px;">
    </div>

    <div class="card-body">
        <h2 class="card-title">{{ $title }}</h2>

        <h6 class="text-muted fst-italic mb-2">Category: {{ $category }}</h6>
        <h6 class="text-muted fst-italic mb-2">Quantity: {{ $quantity }}</h6>

        <h5 class="fw-semibold mt-4">Description</h5>
        <p class="text-secondary">{{ $description }}</p>

        <h6 class="text-muted fst-italic mt-3">Availability: {{ $availability }}</h6>
    </div>

    <div class="card-footer text-center">
        <a href="#" class="btn btn-primary">Read More</a>
    </div>
</div>
