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

    /**
     * @param null $paginate
     * @return mixed
     */
    public function declinedApprovals($paginate = null)
    {
        $approvals = $this->approvals()->where('state', 'declined');
        if ($paginate) {
            return $approvals->paginate($paginate);
        }

        return $approvals->get();
    }

    /**
     * @param null $paginate
     * @return mixed
     */
    public function acceptedApprovals($paginate = null)
    {
        $approvals = $this->approvals()->where('state', 'accepted');
        if ($paginate) {
            return $approvals->paginate($paginate);
        }

        return $approvals->get();
    }
}