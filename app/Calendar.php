<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = ['title', 'start', 'end', 'duration', 'color', 'description', 'note', 'process_id'];

    public function process()
    {
        return $this->belongsTo('App\Process', 'process_id');
    }
}
