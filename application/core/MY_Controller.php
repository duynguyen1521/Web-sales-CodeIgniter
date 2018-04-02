<?php
Class MY_Controller extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        $controller = $this->uri->segment(1);
        switch ($controller)
        {
            case 'admin':
                {
                    //Xử lý khi truy cập vào trang admin
                    $this->load->helper('admin');
                    $this->_check_login();
                    break;
                }
            default:
                {
                    //Lấy danh mục sản phẩm
                    $this->load->model('catalog_model');
                    $input = array();
                    $input['where'] = array('parent_id' => 0);
                    $catalog_parent = $this->catalog_model->get_list($input);
                    foreach ($catalog_parent as $parent)
                    {
                        $input['where'] = array('parent_id' => $parent->id);
                        $parent->subs = $this->catalog_model->get_list($input);
                    }
                    $this->data['catalog_list'] = $catalog_parent;

                    //Lay danh sach bai viet moi
                    $this->load->model('news_model');
                    $input = array();
                    $input['limit'] = array(5, 0);
                    $news_list = $this->news_model->get_list($input);
                    $this->data['news_list'] = $news_list;

                    //Kiem tra thanh vien da dang nhap chua
                    $user_id_login = $this->session->userdata('user_id_login');
                    $this->data['user_id_login'] = $user_id_login;
                    if($user_id_login)
                    {
                        $this->load->model('user_model');
                        $user_info = $this->user_model->get_info_id($user_id_login);
                        $this->data['user_info'] = $user_info;
                    }

                    //Load model ho tro truc tuyen
                    $this->load->model('support_model');
                    $supports = $this->support_model->get_list();
                    $this->data['supports'] = $supports;

                    //Hien thi tong so sp trong Cart
                    $this->load->library('cart');
                    $this->data['total_items'] = $this->cart->total_items();
                }
        }
    }

    //Kiểm tra trạng thái admin đã đăng nhập chưa
    private function _check_login()
    {
        $controller = $this->uri->rsegment(1);
        $controller = strtolower($controller);

        $login = $this->session->userdata('login');
        //Nếu chưa đăng nhập và đòi vào controller khác login thì chuyển về trang login
        if(!$login && $controller != 'login')
        {
            redirect(admin_url('login'));
        }

        //Nếu đã đăng nhập thì không cho vào trang login nữa
        if($login && $controller == 'login')
        {
            redirect(admin_url('home'));
        }
    }
}