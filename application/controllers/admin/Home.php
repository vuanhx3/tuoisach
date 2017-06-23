<?php 

class Home extends MY_Controller
{
	function __construct()
	{
		// ham khoi tao
		parent::__construct();
	}
	

	function index()
	{
		 // load model transaction_model
        $this->load->model('transaction_model');
        // lay tổng số các giao dịch
        $total_rows = $this->transaction_model->get_total();
        $this->data['total_rows'] = $total_rows;

		// lấy tổng số sản phẩm
        $this->load->model('product_model');
        $total_product = $this->product_model->get_total();
        $this->data['total_product'] = $total_product;
        
        // lấy tổng số bài viết mẹo vặt
        $this->load->model('news_model');
        $total_new = $this->news_model->get_total();
        $this->data['total_new'] = $total_new;
        
        // lấy tổng số thành viên
        $this->load->model('user_model');
        $total_user = $this->user_model->get_total();
        $this->data['total_user'] = $total_user;

        // tong so lien he
        
         // load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca giao dịch tren 1 website;
        $config['base_url']     = admin_url('home/index'); // link hien thi ra danh sach giao dịch
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

        // lay danh sach giao dịch
        $list = $this->transaction_model->get_list($input);
        $this->data['list'] = $list;
        

		// load thong bao
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
		
		$this->data["temp"] = "admin/home/index"; //giao dien phan box thay doi se duoc hien ra ben ngoai
		$this->load->view("admin/layout", $this->data); // load ca phan thay doi lan co dinh sag layout, gd
	}

	 /* Thuc hien Dang xuat tai sao phan logout bay lai de o hone co nghia la 
		admin nao cung co the logout ra 	
	   */
   function logout(){
       if ($this->session->userdata('login'))
       {
           $this->session->unset_userdata('login');
       }
       redirect(admin_url('login'));
   }
}






 ?>