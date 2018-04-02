<?php

/*
 * Lay ngay o dang int
 * @time: int
 * @full_time: cho biet co lay ca h-m-s hay khong
 */
function get_date($time, $full_time = TRUE)
{
    $format = '%d-%m-%Y';
    if($full_time)
    {
        $format = $format . ' - %h:%i:%s';
    }
    $date = mdate($format, $time);
    return $date;
}