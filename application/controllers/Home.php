<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        //Chi trang chu moi load Slide
        $this->load->model('slide_model');
        $slide_list = $this->slide_model->get_list();
        $this->data['slide_list'] = $slide_list;

        //Lay danh sach san pham moi
        $this->load->model('product_model');
        $input = array();
        $input['limit'] = array(10, 0);
        $product_newest = $this->product_model->get_list($input);
        $this->data['product_newest'] = $product_newest;

        //Lay danh sach sp duoc mua nhieu
        $input['order'] = array('buyed', 'DESC');
        $input['limit'] = array(5, 0);
        $product_buyed = $this->product_model->get_list($input);
        $this->data['product_buyed'] = $product_buyed;

        //Lấy thông báo nếu có
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

		$this->data['temp'] = 'site/home/index';
		$this->load->view('site/layout', $this->data, FALSE);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */