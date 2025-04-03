<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class ReviewList extends Component
{
    public $reviews;

    public function mount($reviews)
    {
        $this->reviews = $reviews->load(['user']);
    }
    public function render()
    {
        return view('livewire.review-list');
    }
}
