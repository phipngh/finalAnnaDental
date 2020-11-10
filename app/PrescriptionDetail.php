<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{
    protected $fillable =[
        'prescription_id','medicine_id','quantity'
    ];

    public function prescription(){
        return $this->belongsTo('App\Prescription','prescription_id');
    }

    public function medicine(){
        return $this->belongsTo('App\Medicine','medicine_id');
    }
}
