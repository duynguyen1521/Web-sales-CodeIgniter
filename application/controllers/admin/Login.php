<?php
Class Login extends MY_Controller
{
    public function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post())
        {
            $this->form_validation->set_rules('login', 'login', 'callback_check_login');
            if($this->form_validation->run())
            {
                $this->session->set_userdata('login', $this->input->post('username'));
                redirect(admin_url('home'));
            }
        }

        $this->load->view('admin/login/index');
    }


    //Kiểm tra xem username và password có chính xác không
    public function check_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);

        $this->load->model('admin_model');
        $where = array('username' => $username, 'password' => $password);
        if($this->admin_model->check_exists($where))
        {
            return TRUE;
        }
        $this->form_validation->set_message(__FUNCTION__, 'Đăng nhập thất bại');
        return FALSE;
    }
}