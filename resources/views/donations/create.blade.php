@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Create a New Donation</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Donation Form -->
    <form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <!-- Category Selection -->
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select" required>
                <option value="Books">Books</option>
                <option value="Toys">Toys</option>
                <option value="Kitchen Utensils">Kitchen Utensils</option>
                <option value="Jackets">Jackets</option>
                <option value="Coat Hangers">Coat Hangers</option>
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="
