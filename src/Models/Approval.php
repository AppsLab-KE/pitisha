<?php


namespace Pitisha\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pitisha\Traits\ApprovalHasRelation;

class Approval extends Model
{
    use ApprovalHasRelation, SoftDeletes;

    /**
     * @var string[]
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * @var
     */
    protected $table;

    /**
     * Approval constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('pitisha.tables.approval'));
    }

    /**
     * @var string[]
     */
    protected $guarded = [
        'id','created_at','updated_at'
    ];
}