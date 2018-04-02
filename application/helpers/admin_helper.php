<?php       //Chua cac ham ho tro quan ly admin

//Tao ra cac link trong admin
function admin_url($url)
{
    return base_url('admin/' . $url);
}
