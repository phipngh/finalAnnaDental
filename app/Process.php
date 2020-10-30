<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $fillable =[
        'title','note','description','schedule_date','schedule_time','case_record_id'
    ];

    public function caserecord(){
        return $this->belongsTo('App\CaseRecord','case_record_id');
    }
}
