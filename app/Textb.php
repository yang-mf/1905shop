<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class textb extends Model
{
    //表的主键id
    public $primaryKey='id';
    //表名
    protected $table='testb';
    //设置黑名单
    protected $guarded = [];
    //取消时间戳
    public $timestamps=false;
}
