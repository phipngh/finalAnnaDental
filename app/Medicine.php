<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name','slug','manufacturer','dose','description','note','image','price',
    ];
}
