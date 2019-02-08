<?php
    $file="stat/stat.log";
    $max_rows=4999; 

    function getRealIpAddr() {
      if (!empty($_SERVER['HTTP_CLIENT_IP']))
      { $ip=$_SERVER['HTTP_CLIENT_IP']; }
      elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
      { $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; }
      else { $ip=$_SERVER['REMOTE_ADDR']; }
      return $ip;
    }

    if (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexBot')) {$bot='YandexBot';}
    elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot')) {$bot='Googlebot';}
    else { $bot=$_SERVER['HTTP_USER_AGENT']; }

    $ip = getRealIpAddr();
    $date = date("H:i:s d.m.Y");  
    $home = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
    $lines = file($file);
    while(count($lines) > $max_rows) array_shift($lines);
    $lines[] = $date."|".$bot."|".$ip."|".$home."|\r\n";
    file_put_contents($file, $lines);