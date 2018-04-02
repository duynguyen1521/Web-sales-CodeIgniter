<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('catalog_model');
    }


    public function index()
    {
        $list = $this->catalog_model->get_list();
        $total = $this->catalog_model->get_total();

        //Lấy thông báo nếu có
        $message = $this->session->flashdata('message');

        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/catalog/index';
        $this->data['total'] = $total;
        $this->data['message'] = $message;
        $this->load->view('admin/main', $this->data);
    }


    public function add()
    {
        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');

        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');

            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $name       = $this->input->post('name');
                $parent_id  = $this->input->post('parent_id');
                $sort_order = $this->input->post('sort_order');

                //luu du lieu can them
                $data = array(
                    'name'      => $name,
                    'parent_id' => $parent_id,
                    'sort_order' => intval($sort_order)
                );
                //them moi vao csdl
                if($this->catalog_model->create($data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('catalog'));
            }
        }

        //lay danh sach danh muc cha
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $list = $this->catalog_model->get_list($input);
        $this->data['list']  = $list;

        $this->data['temp'] = 'admin/catalog/add';
        $this->load->view('admin/main', $this->data);
    }

    public function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $info = $this->catalog_model->get_info_id($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại danh mục sản phẩm này');
            redirect(admin_url('catalog'));
        }
        $this->data['info'] = $info;

        //Neu co DL post len thi kiem tra form
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên danh mục', 'required');
//            $this->form_validation->set_rules('sort_order', 'Username', 'required|');

            if($this->form_validation->run())
            {
                $sort_order = $this->input->post('sort_order');
                $insert = array(
                    'name' => $this->input->post('name'),
                    'sort_order' => intval($sort_order),
                    'parent_id' => $this->input->post('parent_id'),
                );
                if($this->catalog_model->update_id($id, $insert))
                {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách catalog
                redirect(admin_url('catalog'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        //Giả định menu 2 cấp, Lấy danh sách các danh mục cha (có parent_id = 0)
        $input = array();
        $input['where'] = array(
            'parent_id' => 0,
        );
        $list = $this->catalog_model->get_list($input);

        $this->data['temp'] = 'admin/catalog/edit';
        $this->data['list'] = $list;
        $this->load->view('admin/main', $this->data);
    }

    //Xoa 1 danh muc
    public function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $this->_del($id);

        redirect(admin_url('catalog'));
    }

    //Xoa nhieu danh muc
    public function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id, FALSE);
        }
    }


    //Thao tac xoa
    //$redirect để kiểm tra xem có redirect khi xóa xong hay không
    //Vì khi delete_all() (gọi từ ajax) thì k cần redirect
    //Còn delete() thì cần redirect
    private function _del($id, $redirect = TRUE)
    {
        $info = $this->catalog_model->get_info_id($id);
        if(!$info)
        {
            $this->session->set_flashdata('message', 'Không tồn tại danh mục sản phẩm này');
            if($redirect)
            {
                redirect(admin_url('catalog'));
            }else{
                return FALSE;
            }
        }else{
            //Kiểm tra catalog có danh mục con hay không
            $where_catalog = array(
                'parent_id' => $id,
            );
            $catalog = $this->catalog_model->get_info($where_catalog, 'id');
            if($catalog)
            {
                $this->session->set_flashdata('message', 'Danh mục ' . $info->name . ' có chứa danh mục con, bạn cần xóa hết các danh mục trước khi xóa danh mục này');
                if($redirect)
                {
                    redirect(admin_url('catalog'));
                }else{
                    return FALSE;
                }
            }


            //Kiểm tra catalog có sp hay không
            $this->load->model('product_model');
            $where_product = array(
                'catalog_id' => $id,
            );
            $product = $this->product_model->get_info($where_product, 'id');
            if($product)
            {
                $this->session->set_flashdata('message', 'Danh mục ' . $info->name . ' có chứa sản phẩm, bạn cần xóa hết các sản phẩm trước khi xóa danh mục này');
                if($redirect)
                {
                    redirect(admin_url('catalog'));
                }else{
                    return FALSE;
                }
            }

            if($this->catalog_model->delete_id($id))
            {
                $this->session->set_flashdata('message', 'Xóa danh mục sản phẩm thành công');
            }else{
                $this->session->set_flashdata('message', 'Xóa danh mục sản phẩm thất bại');
            }
        }
    }
}