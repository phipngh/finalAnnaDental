<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrescriptionDetail extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
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
