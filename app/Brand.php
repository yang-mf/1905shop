<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $primaryKey='brand_id';
    protected $table='brand';
    protected $guarded = [];
    //取消时间戳
    public $timestamps=false;
}
