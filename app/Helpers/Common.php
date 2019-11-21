<?php

function getInfo($Info,$parent_id=0){
    $info=[];
//    $info['num']=0;
//    $info['num']=$info['num']+1;
    foreach($Info as $k=>$v){
        if($v['parent_id']==$parent_id){
            $v['child']=getInfo($Info,$v['cate_id']);
//            $info['num']=1;
            $info[]=$v;
        }
    }
    return $info;
}

function getCateInfo($Cate_Info,$parent_id=0,$level=0){
    static $info=[];//定义静态数组，让查询下一级可以不断赋值
    foreach ($Cate_Info as $k => $v) {
        //print_r($v);所有数据
        if($v['parent_id']==$parent_id){
            // print_r($v);
            $v['level']=$level;
            $info[]=$v;
            getCateInfo($Cate_Info,$v['cate_id'],$level+1);//拿到顶级分类下的子类数据
            // print_r($info);
        }
    }
    return $info;
}