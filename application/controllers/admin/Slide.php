<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slide extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('slide_model');
    }

    public function index()
    {
        $input = array();
        $list = $this->slide_model->get_list($input);
        $total = $this->slide_model->get_total();
        //Lấy thông báo nếu có
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/slide/index';
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
            $this->form_validation->set_rules('name', 'Tên slide', 'required');
            $this->form_validation->set_rules('link', 'Đường dẫn slide', 'required');

            if($this->form_validation->run())
            {
                //Lấy tên file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path = './upload/slide/';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }

                $insert = array(
                    'name' => $this->input->post('name'),
                    'image_link' => $image_link,
                    'link' => $this->input->post('link'),
                    'info' => $this->input->post('info'),
                    'sort_order' => $this->input->post('sort_order'),
                );
                if($this->slide_model->create($insert))
                {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách slide
                redirect(admin_url('slide'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'admin/slide/add';
        $this->load->view('admin/main', $this->data);
    }

    public function edit()
    {
        $id = intval($this->uri->rsegment(3));
        $slide = $this->slide_model->get_info_id($id);
        if(!$slide)
        {
            $this->session->set_flashdata('message', 'Không tồn tại slide này');
            redirect(admin_url('slide'));
        }
        $this->data['slide'] = $slide;

        //Validation
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên slide', 'required');
            $this->form_validation->set_rules('link', 'Đường dẫn slide', 'required');

            if($this->form_validation->run())
            {
                //Lấy tên file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path = './upload/slide/';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }

                $insert = array(
                    'name' => $this->input->post('name'),
                    'link' => $this->input->post('link'),
                    'info' => $this->input->post('info'),
                    'sort_order' => $this->input->post('sort_order'),
                );
                //Nếu người dùng cập nhật ảnh thì mới lưu lại
                if($image_link != '')
                {
                    $insert['image_link'] = $image_link;
                }

                if($this->slide_model->update_id($id, $insert))
                {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách slide
                redirect(admin_url('slide'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'admin/slide/edit';
        $this->load->view('admin/main', $this->data);
    }


    //Xoa 1 slide
    public function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $this->_del($id);

        $this->session->set_flashdata('message', 'Xóa thành công');
        redirect(admin_url('slide'));
    }

    //Xoa nhieu slides
    public function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id);
        }
    }


    //Hanh dong xoa slide
    private function _del($id)
    {
        $slide = $this->slide_model->get_info_id($id);
        if(!$slide)
        {
            $this->session->set_flashdata('message', 'Không tồn tại slide này');
            redirect(admin_url('slide'));
        }
        $this->slide_model->delete_id($id);

        //Xoa cac anh minh hoa
        $image_link = './upload/slide/' . $slide->image_link;
        if(file_exists($image_link))
        {
            //Xoa file trong PHP
            unlink($image_link);
        }
    }
}