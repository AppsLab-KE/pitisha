<?php

namespace Pitisha\Traits;

trait Approves
{
    /**
     * Return user approvals
     *
     * @return mixed
     */
    public function approvals()
    {
        return $this->morphMany(config('pitisha.models.approval'), 'approver');
    }
}