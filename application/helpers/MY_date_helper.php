<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
 * Lay ngay tu dang int
 * @$time : int - thoi gian muon hien thi ngay
 * @$full_time : cho biet co lay ca gio phut giay hay khong
 */
function get_date($time)
{
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  
    $date = unix_to_human($time);
    return $date;
}


function get_date_news($time, $full_time = true)
{
    $fomat = '%d';
    $date = mdate($fomat , $time);
    return $date;
}

function get_month($time, $full_time = true)
{
    $fomat = '%m';
    $date = mdate($fomat , $time);
    return $date;
}


function get_date_full($time, $full_time = true)
{
    $fomat = '%d-%m-%Y';
    if($full_time)
    {
        $fomat = $fomat.' - %H:%i:%s';
    }
    $date = mdate($fomat , $time);
    return $date;
}

 /*function get_date($time, $full_time = true)
  {
    $defauld = '%d-%m-%Y';
    if($full_time)
    {
       $defauld = $defauld . '<br>' . '%H:%i:%s';
       date_default_timezone_set('Asia/Ho_Chi_Minh'); 
    }
    date_default_timezone_set('Asia/Ho_Chi_Minh'); 
    $date = mdate($defauld, $time);
    return $date;
  }
  
  function get_mdate($time)
  {
     $defauld = '%d-%m-%Y';
    date_default_timezone_set('Asia/Ho_Chi_Minh'); 
    $date = mdate($defauld, $time);
    return $date;
  } */

?>


 


