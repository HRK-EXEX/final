<?php
    function unitNumberJP($n) {
        $num = floatval($n);
        if(log10($num) < 4) return $num;
        else {
            $cnt = 0;
            $units = ['', '万', '億', '兆', '京', '垓', '秭', '穰', '溝', '澗', '正', '載', '極',
                        '恒河沙', '阿僧祇', '那由他'/*, '不可思議', '無量大数' */];
            while(log10($num) >= 4) {
                $cnt++;
                $num /= 10000;
            }
            return strval(round($num, 1)).$units[$cnt];
        }
    }
?>