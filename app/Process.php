<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'title', 'note', 'description', 'schedule_date', 'duration', 'case_record_id'
    ];

    public function caserecord()
    {
        return $this->belongsTo('App\CaseRecord', 'case_record_id');
    }

    public function calendar()
    {
        return $this->hasOne('App\Calendar');
    }
}
