<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    //Lay thong tin khach hang
    public function checkout()
    {
        //thong tin gio hang
        $carts = $this->cart->contents();
        $total_items = $this->cart->total_items();

        if($total_items <= 0)
        {
            redirect();
        }

        //Tổng số tiền thanh toán
        $total_amount = 0;
        foreach ($carts as $row)
        {
            $total_amount += $row['subtotal'];
        }
        $this->data['total_amount'] = $total_amount;

        //Nếu thành viên đã đăng nhập thì lấy thông tin thành viên
        $user_id = 0;
        $user = '';
        if($this->session->userdata('user_id_login'))
        {
            $user_id = $this->session->userdata('user_id_login');
            $user = $this->user_model->get_info_id($user_id);
        }
        $this->data['user'] = $user;

        $this->load->library('form_validation');
        $this->load->helper('form');

        //Neu co DL post len thi kiem tra form
        if ($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Họ tên khách hàng', 'required|min_length[6]');
            $this->form_validation->set_rules('email', 'Email nhận hàng', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]');
            $this->form_validation->set_rules('message', 'Chi chú', 'required');
            $this->form_validation->set_rules('payment', 'Cổng thanh toán', 'required');

            if ($this->form_validation->run())
            {
                $payment = $this->input->post('payment');
                $insert = array(
                    'status' => 0,      //1: chua thanh toan, 2: đã thanh toán, 3: thanh toán thất bại
                    'user_id' => $user_id,
                    'user_name' => $this->input->post('name'),
                    'user_email' => $this->input->post('email'),
                    'user_phone' => $this->input->post('phone'),
                    'message' => $this->input->post('message'),         //ghi chu mua hang
                    'amount' =>  $total_amount,                         //tong so tien can thanh toan
                    'payment' => $payment,                               //Cong thanh toan
                    'created' => now(),
                );

                //Them DL vao bang Transaction
                $this->load->model('transaction_model');
                $this->transaction_model->create($insert);
                $transaction_id = $this->db->insert_id();               //Lay id cua record vua them vao

                //1 transaction gom 1 hoac nhieu order

                //Them vao bang order (chi tiet don hang)
                $this->load->model('order_model');
                foreach ($carts as $row)
                {
                    $data = array(
                        'transaction_id' => $transaction_id,
                        'product_id' => $row['id'],
                        'qty' => $row['qty'],
                        'amount' => $row['subtotal'],
                        'status' => 0,          //1: chưa gửi hàng cho khách, 2: đã giao, 3: hủy bỏ
                    );
                    $this->order_model->create($data);
                }

                //Xoa gio hang
                $this->cart->destroy();
                if($payment == 'offline')
                {
                    $this->session->set_flashdata('message', 'Đặt hàng thành công, chúng tôi sẽ liên hệ để kiểm tra và gửi hàng');
                    //Chuyển hướng tới trang danh sách user
                    redirect(base_url());
                }elseif (in_array($payment, array('nganluong', 'baokim')))
                {
                    //Code tich hop cong thanh toan
                }

            } else {
                //Không cần hiển thị gì vì đã bắt lỗi bên view
            }
        }

        $this->data['temp'] = 'site/order/checkout';
        $this->load->view('site/layout', $this->data);
    }
}