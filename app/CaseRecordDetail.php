<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseRecordDetail extends Model
{
    protected $fillable = [
        'service_id', 'case_record_id', 'note', 'quantity'
    ];


    public function caserecord()
    {
        return $this->belongsTo('App\CaseRecord', 'case_record_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }
}
