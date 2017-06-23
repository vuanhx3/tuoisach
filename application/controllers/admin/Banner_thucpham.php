<?php 
class Banner_thucpham extends MY_Controller
{

   /*ham khoi tao*/
	function __construct()
	{
		parent::__construct();
		$this->load->model("banner_thucpham_model");
		$this->load->model("admin_model");
		$this->load->model("catalog_model");
	}

	/*hien thi danh sach banner*/
	function index()
	{
		/*lay danh sach tat ca banners */
		$input = array();
		$list = $this->banner_thucpham_model->get_list($input);
	    foreach($list as $row) // lap de lay danh sach slide co chung catalog_id
	    {
	       $input = array('where' => array('catalog_id' => $row->catalog_id));
	       $sub = $this->banner_thucpham_model->get_list($input);
	       $row->sub = $sub;
	    }
		$this->data['list'] = $list;

		/*lay danh sach the loai*/
		$input_1['where'] = array('parent_id' => 0);
		$list_catalog = $this->catalog_model->get_list($input_1);
		$this->data['list_catalog'] = $list_catalog;

	    /*lay danh sach dieu huong menu*/
	    $input_2['where'] = array('parent_id' => 0);
	    $input_2['order'] = array('id', 'ASC');
	    $list_catalog_title = $this->catalog_model->get_list($input_2);
	    $this->data['list_catalog_title'] = $list_catalog_title;

		/*load message*/
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;

		/* load sang view */
	    $this->data['temp'] = 'admin/banner_thucpham/index';
	    $this->load->view('admin/layout', $this->data);
	}


    /*ham them moi slide*/
	function add()
	{
		$input = array();
		$list = $this->banner_thucpham_model->get_list($input);
	    foreach($list as $row) // lap de lay danh sach slide co chung catalog_id
	    {
	       $input = array('where' => array('catalog_id' => $row->catalog_id));
	       $sub = $this->banner_thucpham_model->get_list($input);
	       $row->sub = $sub;
	    }
		$this->data['list'] = $list;

		// lay danh sach the loai
		$input = array();
		$input['where'] = array('parent_id' => 0);
		$list_catalog = $this->catalog_model->get_list($input);
		$this->data['list_catalog'] = $list_catalog;

		/*lay thong tin*/
		$login = $this->session->userdata('login');
	    $admin = $this->admin_model->get_info($login['id']);
	    $admin_add = $admin->name;

		// load thu vien tap luat
		$this->load->library('form_validation');
		$this->load->helper('form');
		// kiem tra nhap lieu chinh xac
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên Banner','required');
	        $this->form_validation->set_rules('image','Ảnh Banner','required');
	        $this->form_validation->set_rules('catalog','Trường thể loại','required');
	        $this->form_validation->set_rules('sort_order', 'Trường Vị Trí', 'required');
	        $this->form_validation->set_rules('anhien', 'Trường Ẩn Hiện', 'required');

	        // them vao csdl
	        if($this->form_validation->run())
	        {
	        	$created = now();// thoi gian
	        	$data = array(
	        		'name'       => $this->input->post('name'),
	        		'image_link' => $this->input->post('image'),
	        		'catalog_id' => $this->input->post('catalog'),
	        		'vitri'      => $this->input->post('sort_order'),
	        		'admin_add'  => $admin_add,
	        		'created'    => $created
	        	);
	        	// truong hop khong chon muc trang thai thi mac dinh cho an
	        	if($this->input->post('anhien') == '')
	        	{
	        		$data['anhien'] = 0;
	        	}else{
	        		$data['anhien'] = $this->input->post('anhien');
	        	}

	        	// them vao csdl
	        	if($this->banner_thucpham_model->create($data))
	        	{
	        		 //tạo ra nội dung thông báo
	                $this->session->set_flashdata('message', 'Thêm mới banner thực phẩm thành công');	
	        	}else{
	        		$this->session->set_flashdata('message', 'Không thêm banner thực phẩm được');
	        	}
	        	//chuyen tới trang danh sách
	            redirect(admin_url('banner_thucpham'));
	        }
		}
		/* load sang view */
	    $this->data['temp'] = 'admin/banner_thucpham/add';
	    $this->load->view('admin/layout', $this->data);
	}


	/*fam chinh sua slide*/
	function edit()
	{
		$input = array();
		$list = $this->banner_thucpham_model->get_list($input);
	    foreach($list as $row) // lap de lay danh sach slide co chung catalog_id
	    {
	       $input = array('where' => array('catalog_id' => $row->catalog_id));
	       $sub = $this->banner_thucpham_model->get_list($input);
	       $row->sub = $sub;
	    }
		$this->data['list'] = $list;
		
		// lay id thuc pham can chinh sua
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$slide = $this->banner_thucpham_model->get_info($id);
		if(!$slide)
		{
			$this->session->set_flashdata('message', 'Không tồn tại banner này!');
			redirect(admin_url('banner_thucpham'));
		}
		$this->data['slide'] = $slide;

		// lay danh sach the loai
		$input = array();
		$input['where'] = array('parent_id' => 0);
		$list_catalog = $this->catalog_model->get_list($input);
		$this->data['list_catalog'] = $list_catalog;

		/*lay thong tin*/
		$login = $this->session->userdata('login');
	    $admin = $this->admin_model->get_info($login['id']);
	    $admin_add = $admin->name;

		// load thu vien tap luat
		$this->load->library('form_validation');
		$this->load->helper('form');
		// kiem tra nhap lieu chinh xac
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên Banner','required');
	        $this->form_validation->set_rules('image','Ảnh Banner','required');
	        $this->form_validation->set_rules('catalog','Trường thể loại','required');
	        $this->form_validation->set_rules('sort_order', 'Trường Vị Trí', 'required');
	        $this->form_validation->set_rules('anhien', 'Trường Ẩn Hiện', 'required');

	        // them vao csdl
	        if($this->form_validation->run())
	        {
	        	$created = now();// thoi gian
	        	$data = array(
	        		'name'       => $this->input->post('name'),
	        		'image_link' => $this->input->post('image'),
	        		'catalog_id' => $this->input->post('catalog'),
	        		'vitri'      => $this->input->post('sort_order'),
	        		'admin_add'  => $admin_add,
	        		'created'    => $created
	        	);
	        	// truong hop khong chon muc trang thai thi mac dinh cho an
	        	if($this->input->post('anhien') == '')
	        	{
	        		$data['anhien'] = 0;
	        	}else{
	        		$data['anhien'] = $this->input->post('anhien');
	        	}

	        	// them vao csdl
	        	if($this->banner_thucpham_model->update($id, $data))
	        	{
	        		 //tạo ra nội dung thông báo
	                $this->session->set_flashdata('message', 'Cập nhật banner thực phẩm thành công');	
	        	}else{
	        		$this->session->set_flashdata('message', 'Cập nhật banner thực phẩm không được');
	        	}
	        	//chuyen tới trang danh sách
	            redirect(admin_url('banner_thucpham'));
	        }
		}
		/* load sang view */
	    $this->data['temp'] = 'admin/banner_thucpham/edit';
	    $this->load->view('admin/layout', $this->data);
	}























}
 ?>
