<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestTable extends Model
{
    /*
    When you are setting your own ID and not
    using auto_increment be sure to add public $incrementing = false;
    */
    public $incrementing = false;
    protected $table = 'request';
    protected $fillable = [
        'id', 'title', 'body', 'granted_by'
    ];
}
