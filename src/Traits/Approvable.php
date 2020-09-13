<?php


namespace Pitisha\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Approvable
{
    /**
     * @var
     */
    protected $approvalLevel;

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function getApprovalLevel()
    {
        if (!$this->approvalLevel) {
            $this->approvalLevel = config('pitisha.level');
        }

        return $this->approvalLevel;
    }

    /**
     * @param $levelCount
     * @return $this
     */
    public function setApprovalLevel($levelCount)
    {
        $this->approvalLevel = $levelCount;
        return $this;
    }

    /**
     * Item reviews
     *
     * @return mixed
     */
    public function approvals(): MorphMany
    {
        return $this->morphMany(config('pitisha.models.approval'), 'approvable');
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private function getApprovalModel()
    {
        return \config('pitisha.models.approval');
    }

    /**
     * @param Model $approver
     * @param string|null $review
     * @return false|Model
     * @throws \Exception
     */
    public function approve(Model $approver, $type, string $review = null)
    {
        if (!in_array($type, ['accepted', 'declined'])) {
            throw new \Exception("The approval type can only be accepted or declined");
        }

        $approval = $this->approvalValidation($approver);
        if (!$approval) {
            return  false;
        }

        return $this->storeApproval($approval->fill([
            'approver_id' => $approver->id,
            'approver_type' => get_class($approver),
            'approvable_id' => $this->id,
            'approvable_type' => get_class($this),
            'state' => $type,
            'review' => $review
        ]));
    }

    /**
     * @param $approver
     * @return false|mixed
     * @throws \Exception
     */
    private function approvalValidation($approver)
    {
        $level = $this->getApprovalLevel();
        $totalModelApprovals = $approver->approvals()->where('approvable_id', $this->id)->count();
        if ($totalModelApprovals >= config('pitisha.approval_limit')) {
            return false;
        }
        if ($level <= $totalModelApprovals) {
            return  false;
        }

        $this->checkIfApproverIsEmpty($approver);
        $model = $this->getApprovalModel();
        $approval = new $model;
        return $approval;
    }

    /**
     * @param $approval
     * @return false|Model
     */
    private function storeApproval($approval)
    {
        return $this->approvals()->save($approval);
    }

    /**
     * @param $model
     * @throws \Exception
     */
    private function checkIfApproverIsEmpty($model)
    {
        if (!$model->id) {
            throw new \Exception("Approver model cannot be empty");
        }
    }

    public function approvalStats()
    {
        $approvals = $this->approvals();
        $totalApprovals = $approvals->count();
        $acceptedApprovals = $approvals->where('state', 'accepted')->count();
        $declinedApprovals = $approvals->where('state', 'declined')->count();

        return [
            'level' => $this->getApprovalLevel(),
            'current_level' => $totalApprovals,
            'total_accepted' => $acceptedApprovals,
            'total_declined' => $declinedApprovals,
            'is_complete' => $this->getApprovalLevel() <= $totalApprovals,
            'percentage' => (float) sprintf("%0.2f", $totalApprovals ? (($acceptedApprovals / $this->getApprovalLevel()) * 100) : 0)
        ];
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
