<?php


namespace Reviewable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Reviewable\Traits\ReviewHasRelation;

class Review extends Model
{
    use ReviewHasRelation, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('reviewable.tables.review'));
    }

    protected $guarded = [
        'id','created_at','updated_at'
    ];
}