<?php 
    function secureStr($str)
    {
        $str = htmlentities($str,ENT_HTML5);
        return$str;
    }

?>