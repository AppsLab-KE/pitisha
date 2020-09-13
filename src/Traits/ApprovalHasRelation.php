<?php


namespace Pitisha\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait ApprovalHasRelation
{
    /**
     * @return MorphTo
     */
    public function approvable() : MorphTo
    {
        return $this->morphTo('approvable');
    }

    /**
     * @return MorphTo
     */
    public function approver() : MorphTo
    {
        return $this->morphTo('approver');
    }
}