<?php
/*
 * Files for helpers
 * 
 * 
 */

 /*
  * 1 : Php function to generate random characters
  */
 function random_generator($size=25){
    $randomstring = substr(str_shuffle(MD5(microtime())), 0, $size);
    return $randomstring;
 }