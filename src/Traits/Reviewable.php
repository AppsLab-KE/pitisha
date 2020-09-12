<?php


namespace Reviewable\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Reviewable
{
    /**
     * Item reviews
     *
     * @return mixed
     */
    public function reviews(): MorphMany
    {
        return $this->morphMany(config('reviewable.models.review'), 'reviewable');
    }
}
