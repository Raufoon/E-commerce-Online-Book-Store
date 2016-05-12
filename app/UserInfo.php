<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $table = 'user_info';

    public $timestamps = false;

    protected $fillable = array('id','name','member_since');
}
