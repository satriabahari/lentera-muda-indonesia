<div>
    <h2 class="text-3xl font-bold mb-4">Reviews</h2>

    @foreach ($reviews as $review)
    {{-- @if($revies->) --}}

    {{-- @endif --}}
        <div class="bg-gray-800 rounded-md px-4 py-2 mb-4">
            <div>
                <strong>{{ $review->user->name }}</strong>:
                {!! str_repeat('⭐', $review->rating) !!}
            </div>
            <p>{{ $review->comment }}</p>
        </div>
    @endforeach
</div>
