<?php


namespace Pitisha\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pitisha\Traits\ApprovalHasRelation;

class Approval extends Model
{
    use ApprovalHasRelation, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('pitisha.tables.approval'));
    }

    protected $guarded = [
        'id','created_at','updated_at'
    ];
}