<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'price','description','note','slug'
    ];


    public function caserecorddetail(){
        return $this->hasOne('App\CaseRecordDetail');
    }
}
