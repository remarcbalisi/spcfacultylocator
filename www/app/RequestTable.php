<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestTable extends Model
{
    protected $table = 'request';
    protected $fillable = [
        'id', 'title', 'body', 'granted_by'
    ];
}
