<?php

namespace App\Models\Module\Poll;

use App\Traits\Uuids;
use App\Models\BaseModel;
use App\Models\Module\Poll\Poll;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module\Member\Membership;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssigneePoll extends  BaseModel
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    protected $fillable = [
        'poll_id',
        'assignable_id',
        'assignable_type',
    ];
    public function poll()
    {
        return $this->belongsTo(Poll::class, 'poll_id');
    }
     public function assignable()
    {
        return $this->morphTo();
    }
}
