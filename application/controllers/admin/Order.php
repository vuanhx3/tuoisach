<?php 
class order extends MY_Controller
{
	// ham khoi tao
	 function __construct(){
        parent::__construct();
        // load thu muc transaction_model vao
        $this->load->model('transaction_model');
        $this->load->model('product_model');
        $this->load->model('order_model');
        $this->load->model('huyen_model');
        $this->load->model('tinh_model');
     }


     // ham hien thi danh sach don hang
     function index()
     {
     	// lay danh sach san pham
     	$list_pd = $this->product_model->get_list();
     	$this->data['list_pd'] = $list_pd;

        // lay danh sach giao dich
        $list_tran = $this->transaction_model->get_list();
        $this->data['list_tran'] = $list_tran;

     	 // lay tong so các giao dịch
        $total_rows = $this->order_model->get_total();
        $this->data['total_rows'] = $total_rows;

        // load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca giao dịch tren 1 website;
        $config['base_url']     = admin_url('order/index'); // link hien thi ra danh sach giao dịch
        $config['per_page']   = 10; // so luong hien thi tren 1 trang 
        $config['uri_segment']= 4; // phan doan hien thi ra so trang tren url
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';
        // khoi tao phan trang
        $this->pagination->initialize($config);
        
        // lấy phân đoạn là trang hiển thị danh sách giao dịch
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input = array();
        $input['limit'] = array($config['per_page'], $segment ); 

        // kiem tra thuc hien loc du lieu theo ma so ( id )
        /* loc theo id */
        $id = $this->input->get('id');
        $id = intval($id);
        $input['where'] = array();
        if ($id > 0){
            $input['where']['id'] = $id;
        }    

        // lay danh sach chi tiết don hang
        $list = $this->order_model->get_list($input);
        $this->data['list'] = $list;
        
        // load thong bao
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

     	// su dung layout master de load sang view
        $this->data['temp'] = 'admin/order/index';
        $this->load->view('admin/layout', $this->data);
     }















}
 ?>
