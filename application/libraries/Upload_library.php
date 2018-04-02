<?php
class Upload_library
{
    public $CI = '';        //Lưu siêu đối tượng trong CI
                            //Vì trong library hoặc helper nếu muốn sd method trong CI thì phải thông qua get_instance()
                            //ĐÂY LÀ LƯU Ý KHI TẠO LIBRARY HOẶC HELPER

    function __construct()
    {
        $this->CI = &get_instance();
    }

    //upload 1 file
    function upload($upload_path = '', $file_name = '')
    {
        //$upload_path là đường dẫn lưu file
        //$file_name là name của thẻ input

        $config = $this->config($upload_path);
        $this->CI->load->library('upload', $config);

        if($this->CI->upload->do_upload($file_name))
        {
            $data = $this->CI->upload->data();
        }else{
            $data = $this->CI->upload->display_errors();
        }
        return $data;
    }

    //cấu hình upload file
    function config($upload_path = '')
    {
        $config = array();
        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|png|gif';
        $config['max_size']      = '12000';
        $config['max_width']     = '3000';
        $config['max_height']    = '3000';
        return $config;
    }

    //Upload nhiều file
    function upload_file($upload_path = '', $file_name = '')
    {
        $config = $this->config($upload_path);

        //lưu biến môi trường khi thực hiện upload
        $file  = $_FILES['image_list'];
        /*
         * VD $file có dạng
         * Array(
            [name] => Array([0] => bui duc hieu.png, [1] => K to và phần còn lại.png)
            [type] => Array([0] => image/png, [1] => image/png)
            [tmp_name] => Array([0] => D:\XAMPP\tmp\phpA16A.tmp, [1] => D:\XAMPP\tmp\phpA16B.tmp)
            [error] => Array([0] => 0, [1] => 0)
            [size] => Array([0] => 172056 [1] => 180228)
          )
         *
         */
        $count = count($file['name']);              //lấy tổng số file được upload
        $image_list = array();                      //Lưu tên các file ảnh upload thành công
        for($i = 0; $i <= $count-1; $i++)
        {
            //userfile là mặc định trong CI
            $_FILES['userfile']['name']     = $file['name'][$i];
            $_FILES['userfile']['type']     = $file['type'][$i];
            $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i];        //khai báo đường dẫn tạm của file thứ i
            $_FILES['userfile']['error']    = $file['error'][$i];
            $_FILES['userfile']['size']     = $file['size'][$i];

            //load thư viện upload và cấu hình
            $this->CI->load->library('upload', $config);
            //thực hiện upload từng file
            if($this->CI->upload->do_upload())
            {
                //nếu upload thành công thì lưu toàn bộ dữ liệu
                $data = $this->CI->upload->data();
                /*
                 * $data sẽ có dạng
                 * Array(
                    [file_name] => bui_duc_hieu.png
                    [file_type] => image/png
                    [file_path] => D:/XAMPP/htdocs/webproduct/upload/user/
                    [full_path] => D:/XAMPP/htdocs/webproduct/upload/user/bui_duc_hieu.png
                    [raw_name] => bui_duc_hieu
                    [orig_name] => bui_duc_hieu.png
                    [client_name] => bui duc hieu.png
                    [file_ext] => .png
                    [file_size] => 168.02
                    [is_image] => 1
                    [image_width] => 1024
                    [image_height] => 768
                    [image_type] => png
                    [image_size_str] => width="1024" height="768"
                )
                 */
                $image_list[] = $data['file_name'];
            }
        }

        return $image_list;
    }

}