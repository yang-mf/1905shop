<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cal extends Model
{
    //表的主键id
    public $primaryKey='cate_id';
    //表名
    protected $table='cate';
    //设置黑名单
    protected $guarded = [];
    //取消时间戳
    public $timestamps=false;
}
