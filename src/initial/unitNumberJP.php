<?php
    function unitNumberJP($n, $d) {
        if($d < 0) $d = 0;
        $num = floatval($n);
        if(log10($num) < $d+1 || log10($num) < 4) return number_format($num);
        else {
            $cnt = 0;
            $units = ['', '万', '億', '兆', '京', '垓', '秭', '穰', '溝', '澗', '正', '載', '極',
                        '恒河沙', '阿僧祇', '那由他'/*, '不可思議', '無量大数' */];
            while(log10($num) >= $d) {
                $cnt++;
                $num /= 10000;
            }
            return number_format($num, $d - floor(log10($num))).$units[$cnt];
        }
    }
?>