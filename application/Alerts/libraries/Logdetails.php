<?php

class Logdetails {

  public function get_logdetails($ip=NULL)

  {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

      $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {

      $ip = $_SERVER['REMOTE_ADDR'];

    }
    return $ip;

  }
  public function get_ip()

  {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

      $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
    //  if(isset($_SERVER['REMOTE_ADDR']))
      $ip = $_SERVER['REMOTE_ADDR'];
    //  else
      //$ip = '0.0.0.0';

    }
    return $ip;

  }
}
?>
