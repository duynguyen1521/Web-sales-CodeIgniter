<?php
Class Home extends MY_Controller
{
    public function index()
    {
        $this->data['temp'] = 'admin/home/index';
        $this->load->view('admin/main', $this->data);
    }

    public function test()
    {
        $this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|matches[password]');
        $this->load->model('Model_File');
        $this->session->flashdata('name');
    }

}