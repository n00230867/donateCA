    @props([
        'title',
        'description',
        'image',
        'registration_no'
    ])

    <div class="card shadow mx-auto" style="max-width: 36rem;">
        @if ($image)
            <img src="{{ asset('public/images/charities/' . $image) }}" class="card-img-top" alt="{{ $title }}">
        @endif

        <div class="card-body">
            <h1 class="card-title">{{ $title }}</h1>

            <hr>
            <h3>Description</h3>
            <p class="card-text">{{ $description }}</p>

            <!-- Display additional props if needed -->

            @if ($registration_no)
                <p class="card-text"><strong>Registration Number:</strong> {{ $registration_no }}</p>
            @endif
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('charities.index') }}" class="btn btn-secondary">Back to All Charities</a>
        </div>
    </div>