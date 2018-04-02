<?php                   //Trang quan tri cac admin
Class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index()
    {
        $list = $this->admin_model->get_list();
        $total = $this->admin_model->get_total();
        //Lấy thông báo nếu có
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/admin/index';
        $this->data['list'] = $list;
        $this->data['total'] = $total;
        $this->load->view('admin/main', $this->data);
    }


    //Them moi 1 admin
    public function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        //Neu co DL post len thi kiem tra form
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Họ tên', 'required|min_length[8]');
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|callback_check_username');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');

            if($this->form_validation->run())
            {
                $password = $this->input->post('password');
                $insert = array(
                    'name' => $this->input->post('name'),
                    'username' => $this->input->post('username'),
                    'password' => md5($password),
                );
                if($this->admin_model->create($insert))
                {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách admin
                redirect(admin_url('admin'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main', $this->data);
    }

    //Kiem tra username da ton tai trong CSDL chua
    public function check_username()
    {
        $username = $this->input->post('username');
        $where = array('username' => $username);
        if($this->admin_model->check_exists($where))
        {
            $this->form_validation->set_message(__FUNCTION__, 'Username đã tồn tại');
            return FALSE;
        }
        return TRUE;
    }


    public function edit()
    {
                                                    //url có dạng .../admin/admin/edit/id
        $id = $this->uri->rsegment(3);               //rsegment là url đã rewrite, trong TH này là bỏ qua folder admin
                                                    //nếu dùng segment thì phân đoạn sẽ là 4.
        //ép kiểu về integer
        $id = intval($id);
        //Lấy thông tin admin
        $info = $this->admin_model->get_info_id($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại admin này');
            redirect(admin_url('admin'));
        }

        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Họ tên', 'required|min_length[8]');
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|callback_check_username');

            $password = $this->input->post('password');
            if($password)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            }

            if($this->form_validation->run())
            {

                $insert = array(
                    'name' => $this->input->post('name'),
                    'username' => $this->input->post('username'),
                );

                if($password)
                {
                    $insert['password'] = md5($password);
                }

                if($this->admin_model->update_id($id, $insert))
                {
                    $this->session->set_flashdata('message', 'Cập nhật thông tin admin thành công');
                }else{
                    $this->session->set_flashdata('message', 'Cập nhật thông tin admin thất bại');
                }

                redirect(admin_url('admin'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['info'] = $info;
        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/main', $this->data);

    }


    public function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $info = $this->admin_model->get_info_id($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại admin này');
        }else{
            if($this->admin_model->delete_id($id))
            {
                $this->session->set_flashdata('message', 'Xóa admin thành công');
            }else{
                $this->session->set_flashdata('message', 'Xóa admin thất bại');
            }
        }
        redirect(admin_url('admin'));
    }


    public function logout()
    {
        if($this->session->userdata('login'))
        {
            $this->session->unset_userdata('login');
            redirect(admin_url('login'));
        }
    }

}