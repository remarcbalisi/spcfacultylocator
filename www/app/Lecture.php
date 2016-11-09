<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table = 'lecture';
    protected $fillable = [
        'student', 'faculty', 'subject_id', 'semester_id'
    ];

    public function student(){
        return $this->belongsTo('App\User', 'student', 'id');
    }

    public function faculty(){
        return $this->belongsTo('App\User', 'faculty', 'id');
    }
}
