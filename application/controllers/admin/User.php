<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->library('pagination');
        $config = array();
        $total = $this->user_model->get_total();
        $this->data['total'] = $total;
        $this->data['total'] = $total;
        $config['total_rows'] = $total;
        $config['per_page'] = 5;
        $config['base_url'] = admin_url('user/index');         //Link hiển thị danh sách user
        $config['uri_segment'] = 4;                             //url: locolhost/webproduct/admin/user/index/so_trang
        $config['next_link'] = 'Trang sau';
        $config['prev_link'] = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        $config['num_links'] = 2;

        //Khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);          //đây k phải là trang thứ bn mà là lấy từ user thứ bn
        $segment = intval($segment);
        $input = array();
        $input['limit'] = array($config['per_page'], $segment);
        $list = $this->user_model->get_list($input);

        //Lấy thông báo nếu có
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/main', $this->data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        //Neu co DL post len thi kiem tra form
        if($this->input->post())
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
                    $this->session->set_flashdata('message', 'Tạo user thành công');
                } else {
                    $this->session->set_flashdata('message', 'Tạo user thất bại');
                }

                //Chuyển hướng tới trang danh sách user
                redirect(admin_url('user'));
            } else {
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'admin/user/add';
        $this->load->view('admin/main', $this->data);
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


    public function edit()
    {
        $id = $this->uri->rsegment(3);               //rsegment là url đã rewrite, trong TH này là bỏ qua folder admin
        //nếu dùng segment thì phân đoạn sẽ là 4.
        $id = intval($id);
        //Lấy thông tin user
        $user = $this->user_model->get_info_id($id);
        $this->data['user'] = $user;
        if(!$user)
        {
            $this->session->set_flashdata('message', 'Không tồn tại thành viên này');
            redirect(admin_url('user'));
        }

        $this->load->library('form_validation');
        $this->load->helper('form');

        //Neu co DL post len thi kiem tra form
        if ($this->input->post())
        {
            $password = $this->input->post('password');
            if($password)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            }

            $this->form_validation->set_rules('name', 'Họ tên', 'required|min_length[6]');
            $this->form_validation->set_rules('email', 'Email đăng nhập', 'required|valid_email|callback_check_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

            if ($this->form_validation->run())
            {
                $insert = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'created' => now(),
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
                redirect(admin_url('user'));
            } else {
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'admin/user/edit';
        $this->load->view('admin/main', $this->data);
    }

    //Xoa 1 user
    public function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $this->_del($id);

        $this->session->set_flashdata('message', 'Xóa thành công');
        redirect(admin_url('user'));
    }

    //Xoa nhieu users
    public function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id);
        }
    }


    //Hanh dong xoa user
    private function _del($id)
    {
        $user = $this->user_model->get_info_id($id);
        if(!$user)
        {
            $this->session->set_flashdata('message', 'Không tồn tại thành viên này');
            redirect(admin_url('user'));
        }
        $this->user_model->delete_id($id);
    }
}