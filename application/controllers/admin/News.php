<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }

    public function index()
    {
        $this->load->library('pagination');
        $config = array();
        $total = $this->news_model->get_total();
        $config['total_rows'] = $total;
        $config['per_page'] = 5;
        $config['base_url'] = admin_url('news/index');         //Link hiển thị danh sách sản phẩm
        $config['uri_segment'] = 4;                             //url: locolhost/webproduct/admin/news/index/so_trang
        $config['next_link'] = 'Trang sau';
        $config['prev_link'] = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        $config['num_links'] = 2;

        //Khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $input = array();
        $segment = $this->uri->segment(4);          //đây k phải là trang thứ bn mà là lấy từ sp thứ bn
        $segment = intval($segment);

        $input['limit'] = array($config['per_page'], $segment);

        //Kiểm tra xem có yêu cầu filter hay không
        $id = $this->input->get('id');
        $id = intval($id);
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }
        $title = $this->input->get('title');
        if($title)
        {
            $input['like'] = array('title', $title);
        }

        $list = $this->news_model->get_list($input);

        //Lấy thông báo nếu có
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/news/index';
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
            $this->form_validation->set_rules('title', 'Tên bài viết', 'required');
            $this->form_validation->set_rules('content', 'Nội dung bài viết', 'required');

            if($this->form_validation->run())
            {
                //Lấy tên file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path = './upload/news/';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }

                $insert = array(
                    'title' => $this->input->post('title'),
                    'image_link' => $image_link,
                    'content' => $this->input->post('content'),
                    'created' => now(),                             //lay thoi gian hien tai duoi dang int
                );
                if($this->news_model->create($insert))
                {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách news
                redirect(admin_url('news'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'admin/news/add';
        $this->load->view('admin/main', $this->data);
    }

    public function edit()
    {
        $id = intval($this->uri->rsegment(3));
        $news = $this->news_model->get_info_id($id);
        if(!$news)
        {
            $this->session->set_flashdata('message', 'Không tồn tại bài viết này');
            redirect(admin_url('news'));
        }
        $this->data['news'] = $news;

        //Validation
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('title', 'Tên bài viết', 'required');
            $this->form_validation->set_rules('content', 'Nội dung bài viết', 'required');

            if($this->form_validation->run())
            {
                //Lấy tên file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path = './upload/news/';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }

                $insert = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'created' => now(),                             //lay thoi gian hien tai duoi dang int
                );
                //Nếu người dùng cập nhật ảnh thì mới lưu lại
                if($image_link != '')
                {
                    $insert['image_link'] = $image_link;
                }

                if($this->news_model->update_id($id, $insert))
                {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách news
                redirect(admin_url('news'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'admin/news/edit';
        $this->load->view('admin/main', $this->data);
    }


    //Xoa 1 bai viet
    public function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $this->_del($id);

        $this->session->set_flashdata('message', 'Xóa thành công');
        redirect(admin_url('news'));
    }

    //Xoa nhieu bai viet
    public function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id);
        }
    }


    //Hanh dong xoa bai viêt
    private function _del($id)
    {
        $news = $this->news_model->get_info_id($id);
        if(!$news)
        {
            $this->session->set_flashdata('message', 'Không tồn tại bài viết này');
            redirect(admin_url('news'));
        }
        $this->news_model->delete_id($id);

        //Xoa cac anh minh hoa
        $image_link = './upload/news/' . $news->image_link;
        if(file_exists($image_link))
        {
            //Xoa file trong PHP
            unlink($image_link);
        }
    }
}