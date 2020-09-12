<?php

namespace Reviewable\Traits;

trait HasReview
{
    /**
     * Return user reviews
     *
     * @return mixed
     */
    public function reviews()
    {
        return $this->morphMany(config('reviewable.models.review'), 'reviewer');
    }
}