<?php

function public_url($url = '')
{
    return base_url('public/'.$url);
}

//In ra mang de de nhin
function pre($arr = array(), $exit = TRUE)
{
    echo "<pre>";
    print_r($arr);
    if($exit)
    {
        die();
    }
}