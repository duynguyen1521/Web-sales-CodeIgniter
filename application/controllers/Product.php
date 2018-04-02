
<?php       //Xu ly lien quan sp, nhu xem chi tiet sp
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }

    //Hien thi tat ca san pham o tab san pham
    public function index()
    {
        //Load Slide
        $this->load->model('slide_model');
        $slide_list = $this->slide_model->get_list();
        $this->data['slide_list'] = $slide_list;

        $list = $this->product_model->get_list();
        $this->data['list'] = $list;

        //Lấy thông báo nếu có
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'site/product/index';
        $this->load->view('site/layout', $this->data);
    }

    //Hien thi danh sach san pham theo danh muc
    public function catalog()
    {
        //Lay thong tin the loai
        $id = intval($this->uri->segment(3));
        $this->load->model('catalog_model');
        $catalog = $this->catalog_model->get_info_id($id);
        if(!$catalog)
        {
            redirect(base_url());
        }
        $this->data['catalog'] = $catalog;
        $input = array();
        $total = 0;
        //Kiểm tra xem đây là danh mục con hay cha
        if($catalog->parent_id == 0)
        {
            $catalog_subs = $this->catalog_model->get_list(array('where' => array('parent_id' => $id)));
            if(!empty($catalog_subs))
            {
                $catalog_subs_ids = array();
                foreach ($catalog_subs as $sub)
                {
                    $catalog_subs_ids[] = $sub->id;
                }
                $input['where_in'] = array('catalog_id', $catalog_subs_ids);
                $total = count($this->product_model->get_list($input));
            }else{
                $input['where'] = array('catalog_id'=> $id);
                $total = $this->product_model->get_total(array('where' => array('catalog_id' => $id)));
            }

        }else{
            $input['where'] = array('catalog_id'=> $id);
            $total = $this->product_model->get_total(array('where' => array('catalog_id' => $id)));
        }


        //Lay danh sach sp thuoc danh muc do + phan trang
        $this->load->library('pagination');
        $config = array();


        $this->data['total'] = $total;
        $config['total_rows'] = $total;
        $config['per_page'] = 6;
        $config['base_url'] = base_url('product/catalog/'.$id);         //Link hiển thị danh sách sản phẩm
        $config['uri_segment'] = 4;                             //url: locolhost/webproduct/admin/product/index/so_trang
        //Khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);          //đây k phải là trang thứ bn mà là lấy từ sp thứ bn
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'], $segment);
        //Lay danh sach san pham thuoc catalog
        $list = $this->product_model->get_list($input);
//        pre($list);
        $this->data['list'] = $list;

        $this->data['temp'] = 'site/product/catalog';
        $this->load->view('site/layout', $this->data);
    }


    //Xem chi tiet sp
    public function view()
    {
        $id = intval($this->uri->segment(3));
        $product = $this->product_model->get_info_id($id);
        if(!$product)
        {
            redirect(base_url());
        }
        $this->data['product'] = $product;

        //lay danh muc san pham
        $this->load->model('catalog_model');
        $catalog = $this->catalog_model->get_info_id($product->catalog_id);
        $this->data['catalog'] = $catalog;

        //Lay sap cung loai
        $input = array();
        $input['where'] = array(
            'catalog_id' => $catalog->id,
            'id !=' => $product->id,
        );
        $spcl = $this->product_model->get_list($input);
        $this->data['spcl'] = $spcl;

        //Lay danh sach hinh anh kem theo
        $image_list = json_decode($product->image_list);
        $this->data['image_list'] = $image_list;

        //Cập nhật lượt view sp
        $data = array();
        $data['view'] = $product->view + 1;
        $this->product_model->update_id($id, $data);

        $this->data['temp'] = 'site/product/view';
        $this->load->view('site/layout', $this->data);
    }

    //Tim kiem theo ten sp, (thanh tim kiem tren header)
    public function search()
    {
        //Kiem tra co dung autocomplete khong
        if($this->uri->segment(3) == 1)
        {
            $key = $this->input->get('term');           //Bien mac dinh cua autocomplete, gui sang = method Get
        }else{
            $key = $this->input->get('key-search');
        }

        $this->data['key'] = trim($key);
        $input = array();
        $input['like'] = array('name', $key);
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;

        //Kiem tra co dung autocomplete khong
        if($this->uri->segment(3) == 1)
        {
            //Xu ly autocomplete
            $result = array();
            foreach ($list as $row)
            {
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->name;
                $item['value'] = $row->name;
                $result[] = $item;
            }
            //du lieu tra ve dang JSON
            die(json_encode($result));
        }else{
            $this->data['temp'] = 'site/product/search';
            $this->load->view('site/layout', $this->data);
        }
    }

    //Tim theo gia sp
    public function search_price()
    {
        $price_from = $this->input->get('price_from');
        $price_from = intval($price_from);
        $this->data['price_from'] = $price_from;

        $price_to = $this->input->get('price_to');
        $price_to = intval($price_to);
        $this->data['price_to'] = $price_to;

        //Loc theo gia
        $input = array();
        $input['where'] = array(
            "price >= " => $price_from,
            "price <= " => $price_to
        );
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;

        $this->data['temp'] = 'site/product/search_price';
        $this->load->view('site/layout', $this->data);
    }
}