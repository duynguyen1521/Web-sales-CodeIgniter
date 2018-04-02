<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction_model');
    }

    public function index()
    {
        $this->load->library('pagination');
        $config = array();
        $total = $this->transaction_model->get_total();
        $this->data['total'] = $total;
        $config['total_rows'] = $total;
        $config['per_page'] = 4;
        $config['base_url'] = admin_url('transaction/index');         //Link hiển thị danh sách sản phẩm
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

        //Kiem tra xem co yeu cau filter khong
        $id = intval($this->input->get('id'));
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }

        $user = intval($this->input->get('user'));
        if($user)
        {
            $input['like'] = array('user_id', $user);
        }

        $payment = $this->input->get('payment');
        if($payment)
        {
            $input['where']['payment'] = $payment;
        }

        $status = $this->input->get('status');
        if($status)
        {
            $input['where']['status'] = $status;
        }

        //Lay danh sach transaction
        $transactions = $this->transaction_model->get_list($input);
        $this->data['transactions'] = $transactions;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['temp'] = 'admin/transaction/index';
        $this->load->view('admin/main', $this->data);
    }

    //Xoa 1 danh muc
    public function delete()
    {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $this->_del($id);

        redirect(admin_url('transaction'));
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
        $info = $this->transaction_model->get_info_id($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'Không tồn tại giao dịch này');
            if ($redirect) {
                redirect(admin_url('transaction'));
            } else {
                return FALSE;
            }
        } else {
            //Kiểm tra transaction có order hay không
            $input = array();
            $input['where'] = array('transaction_id' => $id);
            $this->load->model('order_model');
            $orders = $this->order_model->get_list($input);
            foreach ($orders as $row)
            {
                $this->order_model->delete_id($row->id);
            }

            if ($this->transaction_model->delete_id($id)) {
                $this->session->set_flashdata('message', 'Xóa danh giao dịch thành công');
            } else {
                $this->session->set_flashdata('message', 'Xóa danh giao dịch thất bại');
                return FALSE;
            }
        }
    }
}