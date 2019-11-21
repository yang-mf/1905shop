<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    //表的主键id
    public $primaryKey='goods_id';
    //表名
    protected $table='goods';
    //设置黑名单
    protected $guarded = [];
    //取消时间戳
    public $timestamps=false;
}
