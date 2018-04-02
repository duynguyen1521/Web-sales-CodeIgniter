<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->input->post('submit'))
        {
            $this->load->library('upload_library');
            $path = './upload/user';
            $data = $this->upload_library->upload($path, 'image');
            pre($data);
        }

        $this->data['temp'] = 'admin/upload/index';
        $this->load->view('admin/main', $this->data);
    }

    public function upload_file()
    {
        if($this->input->post('submit'))
        {
            $this->load->library('upload_library');
            $upload_path = './upload/user';
            $data = $this->upload_library->upload_file($upload_path, 'image_list');
            pre($data);
        }

        $this->data['temp'] = 'admin/upload/index';
        $this->load->view('admin/main', $this->data);
    }
}