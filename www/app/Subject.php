<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $fillable = [
        'code', 'title', 'semester_id', 'section'
    ];

    public function semester(){
        return $this->belongsTo('App\Semester', 'semester_id', 'id');
    }
}
