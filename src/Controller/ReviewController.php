<?php

namespace App\Controller;

use App\Model\ReviewManager;

class ReviewController extends AbstractController
{
    public function index()
    {
        $review = new ReviewManager();
        $review = $review->reviewSelect();
    }
}
