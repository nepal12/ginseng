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

 /**
  * 2. Function to replace user status with number
  */
  function userStatusRank($status){
     if($status === "active"){
         return 1 ;
     } elseif ($status === "inactive"){
         return 0;
     } elseif($status === "blocked"){
         return 2 ;
     }  
  }