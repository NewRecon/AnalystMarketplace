<?php 

function _p($data){
    echo "<pre>";
    echo (is_array($data) ? print_r($data, 1) : $data);
    echo "</pre>";
}
