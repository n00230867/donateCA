@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Create a Donation</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required maxlength="255">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Image:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <!-- Category Dropdown -->
            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select name="category" id="category" class="form-control" required onchange="toggleCustomCategory(this)">
                    <option value="">-- Select a Category --</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Books">Books</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Other">Other (Specify Below)</option>
                </select>
            </div>

            <!-- Custom Category Field -->
            <div class="mb-3" id="custom-category-field" style="display: none;">
                <label for="category_custom" class="form-label">Custom Category:</label>
                <input type="text" name="category_custom" id="category_custom" class="form-control" maxlength="255">
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign to Charity</label>
                @foreach($charities as $charity)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" 
                            name="charity_id" 
                            value="{{ $charity->id }}"
                            id="charity_{{ $charity->id }}"
                            @if(isset($donation) && $donation->charities->contains($charity->id)) checked @endif
                            required>
                        <label class="form-check-label" for="charity_{{ $charity->id }}">
                            {{ $charity->title }}
                            @if($charity->registration_no)
                                (Reg #{{ $charity->registration_no }})
                            @endif
                        </label>
                    </div>
                @endforeach
                @error('charity_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="availability" class="form-label">Availability:</label>
                <select name="availability" id="availability" class="form-control" required>
                    <option value="available">Available</option>
                    <option value="pending">Pending</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Donate</button>
        </form>
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
    </script>
@endsection
