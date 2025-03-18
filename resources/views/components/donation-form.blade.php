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

    <!-- Category Dropdown -->
    <div class="form-group">
        <label for="category">Category</label>
        <select name="category" class="form-control">
            <option value="Fiction">Fiction</option>
            <option value="Non-Fiction">Non-Fiction</option>
            <option value="Mystery">Mystery</option>
            <option value="Science">Science</option>
            <option value="Custom">Other (Enter Below)</option>
        </select>
        <input type="text" name="category_custom" class="form-control mt-2" placeholder="Enter custom category" style="display: none;">
    </div>

    <!-- Quantity -->
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" class="form-control" required>
    </div>

    <!-- Description -->
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <!-- Availability -->
    <div class="form-group">
        <label for="availability">Availability</label>
        <select name="availability" class="form-control">
            <option value="available">Available</option>
            <option value="pending">Pending</option>
            <option value="unavailable">Unavailable</option>
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit Donation</button>
</form>

<script>
    document.querySelector('[name="category"]').addEventListener('change', function () {
        if (this.value === "Custom") {
            document.querySelector('[name="category_custom"]').style.display = 'block';
        } else {
            document.querySelector('[name="category_custom"]').style.display = 'none';
        }
    });
</script>
