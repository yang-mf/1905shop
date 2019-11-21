<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $primaryKey='user_id';
    protected $table='u';
    protected $guarded = [];
    //取消时间戳
    public $timestamps=false;
}
