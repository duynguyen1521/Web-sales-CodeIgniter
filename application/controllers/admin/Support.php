<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Support extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('support_model');
    }

    public function index()
    {
        $input = array();
        $list = $this->support_model->get_list($input);
        $total = $this->support_model->get_total();
        //Lấy thông báo nếu có
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/support/index';
        $this->data['total'] = $total;
        $this->load->view('admin/main', $this->data);
    }

    public function add()
    {
        //Validation
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên hỗ trợ viên', 'required');
            $this->form_validation->set_rules('gmail', 'Gmail', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]');

            if($this->form_validation->run())
            {
                $insert = array(
                    'name' => $this->input->post('name'),
                    'yahoo' => $this->input->post('yahoo'),
                    'gmail' => $this->input->post('gmail'),
                    'skype' => $this->input->post('skype'),
                    'phone' => $this->input->post('phone'),
                    'sort_order' => $this->input->post('sort_order'),
                );
                if($this->support_model->create($insert))
                {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách support
                redirect(admin_url('support'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'admin/support/add';
        $this->load->view('admin/main', $this->data);
    }

    public function edit()
    {
        $id = intval($this->uri->rsegment(3));
        $support = $this->support_model->get_info_id($id);
        if(!$support)
        {
            $this->session->set_flashdata('message', 'Không tồn tại hỗ trợ viên này');
            redirect(admin_url('support'));
        }
        $this->data['support'] = $support;

        //Validation
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên hỗ trợ viên', 'required');
            $this->form_validation->set_rules('gmail', 'Gmail', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]');

            if($this->form_validation->run())
            {
                $insert = array(
                    'name' => $this->input->post('name'),
                    'yahoo' => $this->input->post('yahoo'),
                    'gmail' => $this->input->post('gmail'),
                    'skype' => $this->input->post('skype'),
                    'phone' => $this->input->post('phone'),
                    'sort_order' => $this->input->post('sort_order'),
                );

                if($this->support_model->update_id($id, $insert))
                {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách support
                redirect(admin_url('support'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'admin/support/edit';
        $this->load->view('admin/main', $this->data);
    }

    //Xoa 1 support
    public function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $this->_del($id);

        $this->session->set_flashdata('message', 'Xóa thành công');
        redirect(admin_url('support'));
    }

    //Xoa nhieu supports
    public function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id);
        }
    }


    //Hanh dong xoa support
    private function _del($id)
    {
        $support = $this->support_model->get_info_id($id);
        if(!$support)
        {
            $this->session->set_flashdata('message', 'Không tồn tại hỗ trợ viên này');
            redirect(admin_url('support'));
        }
        $this->support_model->delete_id($id);
    }
}