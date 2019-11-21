<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class texta extends Model
{
    //表的主键id
    public $primaryKey='c_id';
    //表名
    protected $table='testa';
    //设置黑名单
    protected $guarded = [];
    //取消时间戳
    public $timestamps=false;
}
