<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }

    public function index()
    {
        $this->load->library('pagination');
        $config = array();
        $total = $this->product_model->get_total();
        $this->data['total'] = $total;
        $config['total_rows'] = $total;
        $config['per_page'] = 5;
        $config['base_url'] = admin_url('product/index');         //Link hiển thị danh sách sản phẩm
        $config['uri_segment'] = 4;                             //url: locolhost/webproduct/admin/product/index/so_trang
        $config['next_link'] = 'Trang sau';
        $config['prev_link'] = 'Trang trước';
        $config['first_link'] = 'Trang đầu';
        $config['last_link'] = 'Trang cuối';
        $config['num_links'] = 2;

        //Khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);          //đây k phải là trang thứ bn mà là lấy từ sp thứ bn
        $segment = intval($segment);

        //Lấy danh sách danh mục sản phẩm để cho vào filter
        $this->load->model('catalog_model');
        //Lấy các danh mục cha trước
        $input['where'] = array('parent_id' => 0);
        $catalogs = $this->catalog_model->get_list($input);
        //Lấy ra các danh mục con của mỗi danh mục cha
        foreach ($catalogs as  $catalog)
        {
            $input['where'] = array('parent_id' => $catalog->id);
            $subs = $this->catalog_model->get_list($input);
            $catalog->subs = $subs;                 //Thêm thuộc tính mới subs cho mỗi catalog cha
        }

        $segment = $this->uri->segment(4);          //đây k phải là trang thứ bn mà là lấy từ sp thứ bn
        $segment = intval($segment);

        $input = array();
        $input['limit'] = array($config['per_page'], $segment);

        //Kiểm tra xem có yêu cầu filter hay không
        $id = $this->input->get('id');
        $id = intval($id);
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }
        $name = $this->input->get('name');
        if($name)
        {
            $input['like'] = array('name', $name);
        }

        $catalog_id = $this->input->get('catalog');
        $catalog_id = intval($catalog_id);
        if($catalog_id > 0)
        {
            $input['where']['catalog_id'] = $catalog_id;
        }
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;

        //Lấy thông báo nếu có
        $message = $this->session->flashdata('message');

        $this->data['temp'] = 'admin/product/index';
        $this->data['catalogs'] = $catalogs;
        $this->data['message'] = $message;
        $this->load->view('admin/main', $this->data);
    }

    public function add()
    {
        //Lay danh muc san pham
        $this->load->model('catalog_model');
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $catalogs = $this->catalog_model->get_list($input);
        //Lấy ra các danh mục con của mỗi danh mục cha
        foreach ($catalogs as  $catalog)
        {
            $input['where'] = array('parent_id' => $catalog->id);
            $subs = $this->catalog_model->get_list($input);
            $catalog->subs = $subs;                 //Thêm thuộc tính mới subs cho mỗi catalog cha
        }

        //Validation
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên sản phẩm', 'required');
            $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');

            if($this->form_validation->run())
            {
                //Lấy tên file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path = './upload/product/';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                $image_list = array();
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }

                //Lấy các tên file ảnh kèm theo
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                //Chuyen 1 mang ve dang json de luu trong csdl
                $image_list = json_encode($image_list);

                $price = $this->input->post('price');
                $discount = $this->input->post('discount');
                $insert = array(
                    'name' => $this->input->post('name'),
                    'catalog_id' => $this->input->post('catalog'),
                    'price' => str_replace(',', '', $price),
                    'discount' => str_replace(',', '', $discount),
                    'warranty' => $this->input->post('warranty'),
                    'gifts' => $this->input->post('gifts'),
                    'image_link' => $image_link,
                    'image_list' => $image_list,

                    'content' => $this->input->post('content'),
                    'created' => now(),                     //lay thoi gian hien tai, bd duoi dang int
                );
                if($this->product_model->create($insert))
                {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách product
                redirect(admin_url('product'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['catalogs'] = $catalogs;
        $this->data['temp'] = 'admin/product/add';
        $this->load->view('admin/main', $this->data);
    }

    public function edit()
    {
        $id = intval($this->uri->rsegment(3));
        $product = $this->product_model->get_info_id($id);
        if(!$product)
        {
            $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này');
            redirect(admin_url('product'));
        }
        $this->data['product'] = $product;

        //Lay danh muc san pham
        $this->load->model('catalog_model');
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $catalogs = $this->catalog_model->get_list($input);
        //Lấy ra các danh mục con của mỗi danh mục cha
        foreach ($catalogs as  $catalog)
        {
            $input['where'] = array('parent_id' => $catalog->id);
            $subs = $this->catalog_model->get_list($input);
            $catalog->subs = $subs;                 //Thêm thuộc tính mới subs cho mỗi catalog cha
        }

        //Validation
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên sản phẩm', 'required');
            $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');

            if($this->form_validation->run())
            {
                //Lấy tên file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path = './upload/product/';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                $image_list = array();
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }

                //Lấy các tên file ảnh kèm theo
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                //Chuyen 1 mang ve dang json de luu trong csdl
                $image_list_json = json_encode($image_list);

                $price = $this->input->post('price');
                $discount = $this->input->post('discount');
                $insert = array(
                    'name' => $this->input->post('name'),
                    'catalog_id' => $this->input->post('catalog'),
                    'price' => str_replace(',', '', $price),
                    'discount' => str_replace(',', '', $discount),
                    'warranty' => $this->input->post('warranty'),
                    'gifts' => $this->input->post('gifts'),
                    'content' => $this->input->post('content'),
                );
                //Nếu người dùng cập nhật ảnh thì mới lưu lại
                if($image_link != '')
                {
                    $insert['image_link'] = $image_link;
                }
                if(!empty($image_list))
                {
                    $insert['image_list'] = $image_list_json;
                }


                if($this->product_model->update_id($id, $insert))
                {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
                }

                //Chuyển hướng tới trang danh sách product
                redirect(admin_url('product'));
            }else{
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['catalogs'] = $catalogs;
        $this->data['temp'] = 'admin/product/edit';
        $this->load->view('admin/main', $this->data);
    }


    //Xoa 1 sp
    public function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $this->_del($id);

        $this->session->set_flashdata('message', 'Xóa thành công');
        redirect(admin_url('product'));
    }

    //Xoa nhieu san pham
    public function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id);
        }
    }


    //Hanh dong xoa sp
    private function _del($id)
    {
        $product = $this->product_model->get_info_id($id);
        if(!$product)
        {
            $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này');
            redirect(admin_url('product'));
        }
        $this->product_model->delete_id($id);

        //Xoa cac anh minh hoa va anh kem theo
        $image_link = './upload/product/' . $product->image_link;
        $image_list = $product->image_list;
        $image_list = json_decode($image_list);
        if(file_exists($image_link))
        {
            //Xoa file trong PHP
            unlink($image_link);
        }
        if(is_array($image_list))
        {
            foreach ($image_list as $img)
            {
                $img_link = './upload/product/' . $img;
                if(file_exists($img_link))
                {
                    //Xoa file trong PHP
                    unlink($img_link);
                }
            }
        }
    }
}