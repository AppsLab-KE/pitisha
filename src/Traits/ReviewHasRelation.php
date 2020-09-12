<?php


namespace Reviewable\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait ReviewHasRelation
{
    public function reviewable() : MorphTo
    {
        return $this->morphTo('reviewable');
    }

    public function reviewer() : MorphTo
    {
        return $this->morphTo('reviewer');
    }
}