<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    //Dang ki thanh vien
    public function register()
    {
        //Neu da dang nhap k cho dang ky nua
        if($this->session->userdata('user_id_login'))
        {
            redirect(base_url('user'));
        }

        $this->load->library('form_validation');
        $this->load->helper('form');

        //Neu co DL post len thi kiem tra form
        if ($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Họ tên', 'required|min_length[6]');
            $this->form_validation->set_rules('email', 'Email đăng nhập', 'required|valid_email|callback_check_email');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

            if ($this->form_validation->run()) {
                $password = $this->input->post('password');
                $insert = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => md5($password),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'created' => now(),
                );
                if ($this->user_model->create($insert)) {
                    $this->session->set_flashdata('message', 'Đăng ký thành công');
                } else {
                    $this->session->set_flashdata('message', 'Đăng ký thất bại');
                }

                //Chuyển hướng tới trang danh sách user
                redirect(base_url('user'));
            } else {
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }


        $this->data['temp'] = 'site/user/register';
        $this->load->view('site/layout', $this->data);
    }

    //Kiem tra email da ton tai trong CSDL chua
    public function check_email()
    {
        $email = $this->input->post('email');
        $where = array('email' => $email);
        if ($this->user_model->check_exists($where)) {
            $this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại');
            return FALSE;
        }
        return TRUE;
    }

    //Đăng nhập
    public function login()
    {
        //Neu da dang nhap chuyen ve trang thong tin thanh vien
        if($this->session->userdata('user_id_login'))
        {
            redirect(base_url('user'));
        }
        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post()) {
            $this->form_validation->set_rules('login', 'login', 'callback_check_login');
            if ($this->form_validation->run())
            {
                //Lay thong tin thanh vien
                $user = $this->get_user_info();
                $this->session->set_userdata('user_id_login', $user->id);
                $this->session->set_flashdata('message', 'Đăng nhập thành công');
                redirect(base_url());
            }
        }

        $this->data['temp'] = 'site/user/login';
        $this->load->view('site/layout', $this->data);
    }

    //Kiểm tra xem email và password có chính xác không
    public function check_login()
    {
        $user = $this->get_user_info();
        if($user)
        {
            return TRUE;
        }
        $this->form_validation->set_message(__FUNCTION__, 'Đăng nhập thất bại');
        return FALSE;
    }

    //Lay ra thong tin thanh vien
    private function get_user_info()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password = md5($password);

        $where = array('email' => $email, 'password' => $password);
        $user = $this->user_model->get_info($where);
        return $user;
    }

    public function logout()
    {
        if($this->session->userdata('user_id_login'))
        {
            $this->session->unset_userdata('user_id_login');
            $this->session->set_flashdata('message', 'Đăng xuất thành công');
            redirect(base_url());
        }
    }

    //Hiển thị thông tin thành viên
    public function index()
    {
        if(!$this->session->userdata('user_id_login'))
        {
            redirect(base_url());
        }
        $user_id = $this->session->userdata('user_id_login');
        $user = $this->user_model->get_info_id($user_id);
        $this->data['user'] = $user;

        $this->data['temp'] = 'site/user/index';
        $this->load->view('site/layout', $this->data);
    }

    //Chinh sua thong tin user
    public function edit()
    {
        if(!$this->session->userdata('user_id_login'))
        {
            redirect(base_url('user/login'));
        }
        $user_id = $this->session->userdata('user_id_login');
        $user = $this->user_model->get_info_id($user_id);
        $this->data['user'] = $user;

        $this->load->library('form_validation');
        $this->load->helper('form');

        //Neu co DL post len thi kiem tra form
        if ($this->input->post())
        {
            $password = $this->input->post('password');

            $this->form_validation->set_rules('name', 'Họ tên', 'required|min_length[6]');
            if($password)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            }
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

            if ($this->form_validation->run())
            {
                $insert = array(
                    'name' => $this->input->post('name'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                );
                if($password)
                {
                    $insert['password'] = md5($password);
                }
                if ($this->user_model->update_id($user->id, $insert)) {
                    $this->session->set_flashdata('message', 'Cập nhật thành công');
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật thất bại');
                }

                //Chuyển hướng tới trang danh sách user
                redirect(base_url('user'));
            } else {
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'site/user/edit';
        $this->load->view('site/layout', $this->data);
    }
}