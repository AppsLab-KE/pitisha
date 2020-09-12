<?php


namespace Pitisha\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait ApprovalHasRelation
{
    public function approvable() : MorphTo
    {
        return $this->morphTo('approvable');
    }

    public function approver() : MorphTo
    {
        return $this->morphTo('approver');
    }
}