@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Charity</h2>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('charities.update', $charity->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $charity->title) }}" required maxlength="255">
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="image" class="form-label">Upload New Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <small class="form-text text-muted">Leave blank to keep the current image.</small>
                </div>

                @if ($charity->image)
                <div class="mb-3">
                    <label class="form-label d-block">Current Image:</label>
                    <img src="{{ asset('images/charities/' . $charity->image) }}" alt="Charity Image" class="img-thumbnail shadow" width="150">
                </div>
                @endif

                <!-- Registration Number -->
                <div class="mb-3">
                    <label for="registration_no" class="form-label">Registration Number:</label>
                    <input type="text" name="registration_no" id="registration_no" class="form-control" 
                        value="{{ old('registration_no', $charity->registration_no) }}" maxlength="255">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $charity->description) }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-check-circle"></i> Update Charity
                    </button>
                    <a href="{{ route('charities.index') }}" class="btn btn-secondary btn-lg">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
