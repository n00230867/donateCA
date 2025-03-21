<form action="{{ $action }}" method="{{ $method }}" enctype="multipart/form-data">
    @csrf

    <!-- Title -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <!-- Image -->
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <!-- Description -->
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit Donation</button>
</form>
