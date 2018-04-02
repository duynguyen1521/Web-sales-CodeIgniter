<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
    }

    public function index()
    {
        $this->load->library('pagination');
        $config = array();
        $total = $this->order_model->get_total();
        $this->data['total'] = $total;
        $config['total_rows'] = $total;
        $config['per_page'] = 4;
        $config['base_url'] = admin_url('order/index');         //Link hiển thị danh sách sản phẩm
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
        $input = array();
        $input['limit'] = array($config['per_page'], $segment);

        //Kiểm tra xem có yêu cầu filter không
        $id = intval($this->input->get('id'));
        if($id)
        {
            $input['where']['id'] = $id;
        }

        $status = $this->input->get('payment');
        if($status)
        {
            $input['where']['status'] = $status;
        }

        $orders = $this->order_model->get_list($input);

        //Lay sp trong don hang va transaction cua don hang
        $this->load->model('product_model');
        $this->load->model('transaction_model');
        foreach ($orders as $row)
        {
            $product = $this->product_model->get_info_id($row->product_id);
            $transaction = $this->transaction_model->get_info_id($row->transaction_id);
            $row->product = $product;
            $row->transaction = $transaction;
        }
        $this->data['orders'] = $orders;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['temp'] = 'admin/order/index';
        $this->load->view('admin/main', $this->data);
    }

    //Xoa 1 danh muc
    public function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $this->_del($id);

        redirect(admin_url('order'));
    }

    //Xoa nhieu danh muc
    public function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->_del($id, FALSE);
        }
    }


    //Thao tac xoa
    //$redirect để kiểm tra xem có redirect khi xóa xong hay không
    //Vì khi delete_all() (gọi từ ajax) thì k cần redirect
    //Còn delete() thì cần redirect
    private function _del($id, $redirect = TRUE)
    {
        $info = $this->order_model->get_info_id($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'Không tồn tại đơn hàng này');
            if ($redirect) {
                redirect(admin_url('order'));
            } else {
                return FALSE;
            }
        }

        if ($this->order_model->delete_id($id)) {
            $this->session->set_flashdata('message', 'Xóa đơn hàng thành công');
        } else {
            $this->session->set_flashdata('message', 'Xóa đơn hàng thất bại');
            return FALSE;
        }
    }
}