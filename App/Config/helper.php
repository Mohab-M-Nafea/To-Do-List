<?php

function url($url = '')
{
   echo MAIN_URL .  $url;
}

function redirect($url = ''){
   header("Location: " . MAIN_URL .  $url);
   exit();
}