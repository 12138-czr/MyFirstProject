<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function mydate($time,$format){
    return '时间:'.date($format,$time);
}

function get_root(){
    $root = __ROOT__;
    if ($root == '\\'){
        $root = '';
    }
    return $root;
}

function category_merge($data,$parent_id=0,$level=0){
    $res = [];
    foreach ($data as $v){
        if ($v['parent_id'] == $parent_id){
            $v['level'] = $level;
            $res[] = $v;

            $res = array_merge($res,category_merge($data,$v['id'],$level+1));
        }
    }

    return $res;
}