@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Add a Charity</h1>

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

        <form action="{{ route('charities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Charity Name:</label>
                <input type="text" name="title" id="title" class="form-control" required maxlength="255">
            </div>

            <div class="mb-3">
                <label for="registration_no" class="form-label">Registration Number:</label>
                <input type="text" name="registration_no" id="registration_no" class="form-control" required maxlength="255">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Logo:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Charity</button>
        </form>
    </div>
@endsection
