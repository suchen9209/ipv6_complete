<?php

/**
 * Class PHPToolsFunction
 * @author suchot
 * web开发中常用工具函数
 */
Class PHPToolsFunction{
    public function __construct(){

    }

    /**
     * 补足ipv6，将简写的ipv6补足完整
     * @param $ipv6
     * @return string
     * ipv6完整地址为8段，7个冒号
     */
    public function completeIPV6($ipv6){
        if(filter_var($ipv6,FILTER_VALIDATE_IP,FILTER_FLAG_IPV6)){
            if(strpos($ipv6,'::') !== false){
                $supple_char = '0000';
                $colon_count = substr_count($ipv6,':');
                for($i = 7 - $colon_count; $i > 0; $i --){
                    $supple_char .= ':0000';
                }
                $ipv6 = str_replace('::',':'.$supple_char.':',$ipv6);
            }
            $char_arr = explode(':',$ipv6);
            foreach ($char_arr as &$char){
                if(strlen($char) < 4){
                    $char = str_pad($char,4,'0',STR_PAD_LEFT);
                }
            }
            unset($char);
            return implode(':',$char_arr);
        }else{
            return 'NOT IPV6 :)';
        }
    }

    /**
     * 判断version1是否比version2更新
     * 比较版本号大小  4.10.3 > 4.9.3
     * version1 比 version2 版本更高，返回true
     * 否则返回false
     * @param $version1
     * @param $version2
     * @return bool
     */
    public function compareVersion($version1, $version2){
        $result = false;
        $data1 = explode('.',$version1);
        $data2 = explode('.',$version2);
        foreach ($data1 as $key => $v){
            if(intval($v) > intval($data2[$key])){
                $result = true;
                break;
            }
            if(intval($v) < intval($data2[$key])){
                $result = false;
                break;
            }
        }
        return $result;
    }
}

$tools = new PHPToolsFunction();
$full_ipv6 = $tools->completeIPV6('2001:DB8:0:0:ABCD::1234'); // '2001:0DB8:0000:0000:ABCD:0000:0000:1234'
$new_version = $tools->compareVersion('2.8.10','2.5.10');// true




