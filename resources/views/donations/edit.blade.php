@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Donation</h2>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('donations.update', $donation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $donation->title) }}" required maxlength="255">
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="image" class="form-label">Upload New Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <small class="form-text text-muted">Leave blank to keep the current image.</small>
                </div>

                @if ($donation->image)
                <div class="mb-3">
                    <label class="form-label d-block">Current Image:</label>
                    <img src="{{ asset('images/donations/' . $donation->image) }}" alt="Donation Image" class="img-thumbnail shadow" width="150">
                </div>
                @endif

                <!-- Category Dropdown -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select name="category" id="category" class="form-control" required onchange="toggleCustomCategory(this)">
                        <option value="">-- Select a Category --</option>
                        <option value="Clothing" {{ old('category', $donation->category) === 'Clothing' ? 'selected' : '' }}>Clothing</option>
                        <option value="Books" {{ old('category', $donation->category) === 'Books' ? 'selected' : '' }}>Books</option>
                        <option value="Furniture" {{ old('category', $donation->category) === 'Furniture' ? 'selected' : '' }}>Furniture</option>
                        <option value="Electronics" {{ old('category', $donation->category) === 'Electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="Other" {{ old('category', $donation->category) === 'Other' ? 'selected' : '' }}>Other (Specify Below)</option>
                    </select>
                </div>

                <!-- Custom Category Field -->
                <div class="mb-3" id="custom-category-field" style="display: {{ old('category', $donation->category) === 'Other' ? 'block' : 'none' }};">
                    <label for="category_custom" class="form-label">Custom Category:</label>
                    <input type="text" name="category_custom" id="category_custom" class="form-control" maxlength="255" value="{{ old('category_custom', $donation->category_custom) }}">
                </div>

                <!-- Quantity -->
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $donation->quantity) }}" min="1" required>
                </div>

                <!-- Availability -->
                <div class="mb-3">
                    <label for="availability" class="form-label">Availability:</label>
                    <select name="availability" id="availability" class="form-control" required>
                        <option value="available" {{ old('availability', $donation->availability) === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="pending" {{ old('availability', $donation->availability) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="unavailable" {{ old('availability', $donation->availability) === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $donation->description) }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-check-circle"></i> Update Donation
                    </button>
                    <a href="{{ route('donations.index') }}" class="btn btn-secondary btn-lg">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleCustomCategory(select) {
        const customCategoryField = document.getElementById('custom-category-field');
        if (select.value === 'Other') {
            customCategoryField.style.display = 'block';
        } else {
            customCategoryField.style.display = 'none';
            document.getElementById('category_custom').value = ''; // Clear input if hidden
        }
    }

    // Run on page load (when editing an item with "Other" already selected)
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        toggleCustomCategory(categorySelect);
    });
</script>
@endsection
