<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //Them sp vao cart
    public function add()
    {
        $this->load->model('product_model');
        $id = $this->uri->segment(3);
        $id = intval($id);
        $product = $this->product_model->get_info_id($id);
        if(!$product)
        {
            redirect(base_url());
        }

        $qty = 1;                           //Moi lan tang so luong them bn khi click mua
        $price = $product->price;
        if($product->discount > 0)
        {
            $price = $price - $product->discount;
        }

        $data = array();
        $data['id'] = $product->id;
        $data['qty'] = $qty;
        $data['name'] = url_title($product->name);
        $data['image_link'] = $product->image_link;
        $data['price'] = $price;

        $this->cart->insert($data);
        //Chuyen sang trang ds sp trong cart
        redirect(base_url('cart'));
    }

    //Hien thi danh sach sp trong cart
    public function index()
    {
        //Thong tin gio hang
        $carts = $this->cart->contents();
        $this->data['carts'] = $carts;

        $this->data['temp'] = 'site/cart/index';
        $this->load->view('site/layout', $this->data);
    }

    //Cap nhat gio hang
    public function update()
    {
        $carts = $this->cart->contents();
        foreach ($carts as $key => $row)
        {
            $total_qty = intval($this->input->post('qty_'.$row['id']));
            $data = array();
            $data['rowid'] = $key;
            $data['qty'] = $total_qty;
            $this->cart->update($data);
        }

        redirect(base_url('cart'));
    }

    //Neu co id truyen vao thi xoa sp do, con khong co thi xoa tat ca sp
    public function delete()
    {
        $id = $this->uri->segment(3);
        $id = intval($id);

        //Xoa 1 sp
        if($id)
        {
            $carts = $this->cart->contents();
            foreach ($carts as $key => $row)
            {
                if($row['id'] == $id)
                {
                    $data = array();
                    $data['rowid'] = $key;
                    $data['qty'] = 0;
                    $this->cart->update($data);
                }
            }
        }else{      //Xoa toan bo cart
            $this->cart->destroy();
        }

        redirect(base_url('cart'));
    }
}