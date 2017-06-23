<?php 
class Video extends MY_Controller
{
	/*ham khoi tao*/
	function __construct()
	{
		parent::__construct();
		$this->load->model("video_model");
		$this->load->model("admin_model");
		$this->load->model("catalog_model");
	}

	/*hien thi danh sach video*/
	function index()
	{
		$input = array();
		// lay tong so video
		$total_rows = $this->video_model->get_total();
		$this->data['total_rows'] = $total_rows;

		// load thu vien phan trang
		$this->load->library('pagination');
		$config = array();
		$config['total_rows']  = $total_rows;// tong tat ca san pham tren website
        $config['base_url']    = admin_url('video/index');//link hien thi ra danh sach san pham
        $config['per_page']    = 10; //so luong san pham tren 1 trang
        $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren link url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';

        $this->pagination->initialize($config);// khoi tao cau hinh phan trang
        // thuc hien limit  san pham tren 1 url
        $segment = $this->uri->segment('4');
        $segment = intval($segment);
        $input = array('limit' => array($config['per_page'], $segment));

        // kiem tra thuc hien loc ma so
        $id = $this->input->get('id');
        $id = intval($id);
        if(isset($id) && $id > 0)
        {
        	$input['where']['id'] = $id;
        }

        // kiem tra loc video theo ten
        $name = $this->input->get('name');
        if(isset($name)){
           $input['like'] = array('name', $name);
        }

        // kiem tra loc du lieu theo danh muc san pham
        $catalog_id = $this->input->get('catalog');
        $catalog_id = intval($catalog_id);
        if (isset($catalog_id) && $catalog_id > 0) {
            $input['where']['catalog_id'] = $catalog_id;
        }

		// lay danh sach video
		$input['order'] = array('created', 'DESC');
		$list = $this->video_model->get_list($input);
		$this->data['list'] = $list;

		// lay danh muc san pham de loc
		$input = array('where' => array('parent_id' => 0));
		$catalogs = $this->catalog_model->get_list($input);
		foreach($catalogs as $row)
		{	
			$input = array('where' => array('parent_id' => $row->id));
			$subs  = $this->catalog_model->get_list($input);
            $row->subs = $subs;	
		}
		$this->data['catalogs'] = $catalogs;

		// load thong bao
		$message = $this->session->flashdata('message');
        $this->data['message'] = $message;

		// load sang view
		$this->data['temp'] = "admin/video/index";
		$this->load->view("admin/layout", $this->data);
	}

	function add()
	{
		// lay session admin
		$login = $this->session->userdata('login');
		$admin = $this->admin_model->get_info($login['id']);
		$admin_add = $admin->name;

		// lay danh sach san pham 
		$input = array('where' => array('parent_id' => 0));
		$catalogs = $this->catalog_model->get_list($input);
		foreach($catalogs as $row)
		{
			$input = array('where' => array('parent_id' => $row->id));
			$subs  = $this->catalog_model->get_list($input);
            $row->subs = $subs;	
		}
		$this->data['catalogs'] = $catalogs;

		// load form validation
		$this->load->library('form_validation');
		$this->load->helper('form'); 

		if($this->input->post())
		{
			// tap luat validate
		   $this->form_validation->set_rules('name','Tên video','required');
		   $this->form_validation->set_rules('image', 'Ảnh video', 'required');
	       $this->form_validation->set_rules('catalog','Thể loại','required');
	       $this->form_validation->set_rules('link','Mã nhúng video','required');
	       $this->form_validation->set_rules('status','Trạng thái','required');

	       if($this->form_validation->run())
	       {
	       		$name       = $this->input->post('name');
	       		$images     = $this->input->post('image');
	       		$catalog_id = $this->input->post('catalog');
	       		$link       = $this->input->post('link');
	       		$status     = $this->input->post('status');

	       		$data = array('name' => $name, 'images' => $images, 'catalog_id' => $catalog_id, 'link' => $link, 'status' => $status, 'admin_add' => $admin_add, 'created' => now() );

	       		// Thêm mới vào cơ sỡ dữ liệu
		        if ($this->video_model->create($data)){
		            // tạo nội dung thông báo
		            $this->session->set_flashdata('message', 'Thêm mới video thành công !');
		        }else {
		            $this->session->set_flashdata('message','Thêm mới video không thành công !');
		        }
		        redirect(admin_url('video'));
	       }
		}

		// load sang view
		$this->data['temp'] = "admin/video/add";
		$this->load->view("admin/layout", $this->data);

	}


	function edit()
	{
		// lay id video 
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$info = $this->video_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Không tồn tại video này');
			redirect(admin_url('video'));
		}
		$this->data['info'] = $info;

		// lay session admin
		$login = $this->session->userdata('login');
		$admin = $this->admin_model->get_info($login['id']);
		$admin_add = $admin->name;

		// lay danh sach san pham 
		$input = array('where' => array('parent_id' => 0));
		$catalogs = $this->catalog_model->get_list($input);
		foreach($catalogs as $row)
		{
			$input = array('where' => array('parent_id' => $row->id));
			$subs  = $this->catalog_model->get_list($input);
            $row->subs = $subs;	
		}
		$this->data['catalogs'] = $catalogs;

		// load form validation
		$this->load->library('form_validation');
		$this->load->helper('form'); 

		if($this->input->post())
		{
			// tap luat validate
		   $this->form_validation->set_rules('name','Tên video','required');
		   $this->form_validation->set_rules('image', 'Ảnh video', 'required');
	       $this->form_validation->set_rules('catalog','Thể loại','required');
	       $this->form_validation->set_rules('link','Mã nhúng video','required');
	       $this->form_validation->set_rules('status','Trạng thái','required');

	       if($this->form_validation->run())
	       {
	       		$name       = $this->input->post('name');
	       		$images     = $this->input->post('image');
	       		$catalog_id = $this->input->post('catalog');
	       		$link       = $this->input->post('link');
	       		$status     = $this->input->post('status');

	       		$data = array('name' => $name, 'images' => $images, 'catalog_id' => $catalog_id, 'link' => $link, 'status' => $status, 'admin_add' => $admin_add, 'created' => now() );

	       		// Thêm mới vào cơ sỡ dữ liệu
		        if ($this->video_model->update($id, $data)){
		            // tạo nội dung thông báo
		            $this->session->set_flashdata('message', 'Cập nhật video thành công !');
		        }else {
		            $this->session->set_flashdata('message','Cập nhật video không thành công !');
		        }
		        redirect(admin_url('video'));
	       }
		}
		// load sang view
		$this->data['temp'] = "admin/video/edit";
		$this->load->view("admin/layout", $this->data);
	}


	/*ham xoa 1 */
	function delete()
	{
	  $id = $this->uri->rsegment('3');// lay thong tin bai viet muon xoa
	  $id = intval($id);
	  $this->_del($id); 
	  // tạo nội dung thông báo
	  $this->session->set_flashdata('message','Xóa bài viết thành công !');
	  redirect(admin_url('video'));
	}

	/* ham xoa nhieu */
	function delete_all()
	{
	    // lấy id muốn xóa có chức năng làm ẩn các <tr/> chứa id bị check
	    $ids = $this->input->post('ids');
	    foreach($ids as $id)
	    {
	      $this->_del($id);
	    }
	}

	/*ham xoa nhieu va xoa 1*/
	private function _del($id)
	{
	  // lay thong tin thuc pham muon xoa
	  $video = $this->video_model->get_info($id);
	  if(!$video)
	  {
	     //tạo ra nội dung thông báo
	      $this->session->set_flashdata('message', 'Không tồn tại video này !');
	      redirect(admin_url('video'));
	  }
	  // con khong thi thuc hien xoa
	  $this->video_model->delete($id);
	}

	/*ham xem nhanh video*/
	function detail()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : false;
		$id = intval($id);
		$info = $this->video_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Không tồn tại video này !');
           redirect(admin_url('video'));
		}
		$this->data["info"] = $info;

		// load sang view
		$this->data["temp"] = "admin/video/detail";
		$this->load->view("admin/dialog", $this->data);
	}

















}



 ?>