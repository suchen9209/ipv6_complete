<?php

/**
 * Class Convert
 * @author suchot
 * ipv6完整地址为8段，7个冒号
 */
Class Convert{
    public function __construct(){

    }

    /**
     * @param $ipv6
     * @return string
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
}

$convert = new Convert();
$full_ipv6 = $convert->completeIPV6('2001:DB8:0:0:ABCD::1234');
echo $full_ipv6;



