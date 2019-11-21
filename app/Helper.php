<?php
function wrfv($info,$parent_id=0){
    static $newInfo='';
    foreach($info as $k=>$v){
        if($k==$parent_id){
            $newInfo=$v;
            Inall($info,$k);
        }
    }
    return $newInfo;
}
