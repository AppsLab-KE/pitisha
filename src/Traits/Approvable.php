<?php


namespace Pitisha\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Approvable
{
    /**
     * Item reviews
     *
     * @return mixed
     */
    public function approvals(): MorphMany
    {
        return $this->morphMany(config('pitisha.models.approval'), 'approvable');
    }

    private function getApprovalModel()
    {
        return \config('pitisha.models.approval');
    }

    public function approve(Model $approver, string $review = null)
    {
        $this->checkIfApproverIsEmpty($approver);

        $model = $this->getApprovalModel();
        $approval = new $model;
        $approval = $approval->fill([
            'approver_id' => $approver->id,
            'approver_type' => get_class($approver),
            'approvable_id' => $this->id,
            'approvable_type' => get_class($this),
            'state' => 'approved',
            'review' => $review
        ]);

        return $this->storeApproval($approval);
    }

    public function disapprove(Model $approver, string $review = null)
    {
        $this->checkIfApproverIsEmpty($approver);

        $model = $this->getApprovalModel();
        $approval = new $model;
        $approval = $approval->fill([
            'approver_id' => $approver->id,
            'approver_type' => get_class($approver),
            'approvable_id' => $this->id,
            'approvable_type' => get_class($this),
            'state' => 'disapproved',
            'review' => $review
        ]);

        return $this->storeApproval($approval);
    }

    private function storeApproval($approval)
    {
        return $this->approvals()->save($approval);
    }

    private function checkIfApproverIsEmpty($model)
    {
        if (!$model->id) {
            throw new \Exception("Approver model cannot be empty");
        }
    }
}
