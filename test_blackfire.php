<?php
/**
 * Created by PhpStorm.
 * User: alimoedm
 * Date: 12.06.2016
 * Time: 21:35
 */
function sum($a, $b){
    return $a + $b;
}
function createFromRequest(){
    return $_REQUEST;
}
function main(){
    sum(1,2);
    sum(1,2);
    sum(1,2);
    createFromRequest();
}

main();