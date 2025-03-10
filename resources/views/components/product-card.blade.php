@props(['title', 'category', 'price', 'image'])

<div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300">
    <h4 class="font-bold text-lg mb-2">{{ $title }}</h4>
    <p class="text-gray-600 mb-1">Category: {{ $category }}</p>
    <p class="text-gray-600 mb-4">Price: ${{ number_format($price, 2) }}</p>
    <img src="{{ asset('images/products/' . $image) }}" alt="{{ $title }}" class="w-full h-48 object-cover rounded">
</div>
