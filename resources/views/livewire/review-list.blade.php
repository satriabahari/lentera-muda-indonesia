<div class="w-full">
    <h2 class="text-2xl font-bold my-6">Reviews</h2>

    @forelse ($reviews as $review)
        <div class="bg-neutral-100 grid grid-cols-[0.5fr_2fr] rounded-md p-4 mb-4">
            <div class="flex justify-center flex-col">
                <p>{{ $review->user->name }}</p>
                {!! str_repeat('⭐', $review->rating) !!}
            </div>

            <p>{{ $review->comment }}</p>
        </div>
    @empty
        <p>No lessons available.</p>
    @endforelse
</div>
