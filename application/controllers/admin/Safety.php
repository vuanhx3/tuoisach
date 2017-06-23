<?php 
class Safety extends MY_Controller
{
	/*ham khoi tao*/
	function __construct()
	{
		parent::__construct();
		$this->load->model("safety_model");
		$this->load->model("admin_model");
	}

	/*ham hien thi danh sach new*/
	function index()
	{
		// lay tong so tin tp ban dang co
		$total_rows = $this->safety_model->get_total();
		$this->data['total_rows'] = $total_rows;
		// load thu vien phan trang va cau hinh phan trang
	    $this->load->library('pagination');
	    $config = array();
	    $config['total_rows'] = $total_rows; // tong tat ca san pham tren 1 website
	    $config['base_url']   = admin_url('safety/index'); // link hien thi ra danh sach san pham 
	    $config['per_page']   = 10; // so luong hien thi bai viet tren 1 trang
	    $config['uri_segment']= 4; // phan doan hien thi ra so trang tren url 
	    $config['next_link'] = 'Trang kế tiếp';
	    $config['prev_link'] = 'Trang trước';
	        
	    // khoi tao phan trang
	    $this->pagination->initialize($config);
	    // lấy phân đoạn là trang hiển thị danh sách thuc phẩm
	    $segment = $this->uri->segment(4);
	    $segment = intval($segment);
	    $input = array('limit' => array($config['per_page'], $segment));

        // kiem tra loc du lieu theo ma so
        $id = $this->input->get('id');
        $id = intval($id);
        if(isset($id) && $id > 0)
        {
        	$input['where'] = array('id' => $id);
        }

        // kiem tra loc du lieu theo tieu de
        $title = $this->input->get('title');
        if(isset($title))
        {
        	$input['like'] = array('title', $title);
        }

        // lay danh sach tat ca 
        $input['order'] = array('created', 'DESC');
        $list = $this->safety_model->get_list($input);
        $this->data['list'] = $list;

        /*load thong bao*/
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

		// load sang view
		$this->data['temp'] = 'admin/safety/index';
		$this->load->view("admin/layout", $this->data);
	}

	/*ham add bai viet tp ban*/
	function add()
	{
		// lay session admin
		$login = $this->session->userdata('login');
		$admin = $this->admin_model->get_info($login['id']);
		$admin_add = $admin->name;

		/* load thư viên tập luật */
	    $this->load->library('form_validation');
	    $this->load->helper('form');

	    if($this->input->post())
	    {
	     // tạo tra những tập luật của những trường bắt buộc phải nhập
		    $this->form_validation->set_rules('title','Tiêu đề bài viết','required');
		    $this->form_validation->set_rules('content', 'Nội dung bài viết', 'required');
		    $this->form_validation->set_rules('image', 'Ảnh đại diện', 'required');
		    $this->form_validation->set_rules('status', 'Ẩn hiện', 'required');
		    /*kiem tra co trung slug hay khong*/
		    if($this->input->post('slug') != '')
		    {
		    	$this->form_validation->set_rules('slug', 'Slug', 'callback_check_slug_add');
		    }

		    if($this->form_validation->run())
		    {
		    	$title   = $this->input->post('title');
		    	$tags    = json_encode($this->input->post('tags'));
		    	$content = $this->input->post('content');
		       // lưu dữ liệu cần thêm
		         $data = array(
		             'image_link' => $this->input->post('image'),
		             'title'      => $title,
		             'site_title' => $this->input->post('site_title'),
		             'meta_key'   => $this->input->post('meta_key'),
		             'meta_desc'  => $this->input->post('meta_desc'),
		             'tags'       => $tags,
		             'status'     => $this->input->post('status'),
		             'content'    => $content,
		             'admin_add'  => $admin_add,
		             'created'    => now()
		          );
		            // neu admin nhap truogn slug thi them khong thi mac dinh chhu khong dau
			         if($this->input->post('slug') == '')
			         {
			         	$data['slug'] = str_slug($title);
			         }else{
			         	$data['slug'] = $this->input->post('slug');
			         }
			         // neu adminmenuin nhap truogn intro thi them khong thi mac dinh se lay 100 tu tu content
			         if($this->input->post('intro') == '')
			         {
			         	$data['intro'] = limit_text($content, 100);
			         }else{
			         	$data['intro'] = $this->input->post('intro');
			         }	

		            // Thêm mới vào cơ sỡ dữ liệu
	                if ($this->safety_model->create($data)){
	                    // tạo nội dung thông báo
	                    $this->session->set_flashdata('message', 'Thêm mới bài viết mẹo vặt thành công !');
	                }else {
	                    $this->session->set_flashdata('message','Thêm bài viết mẹo vặt không thành công !');
	                }
	                redirect(admin_url('safety'));
		    }
	    }

		// load sang view
		$this->data['temp'] = 'admin/safety/add';
		$this->load->view("admin/layout", $this->data);
	}

	/*ham kiem tra slug add*/
	function check_slug_add()
	{
		$slug  =$this->input->post('slug');
		$where = array('slug' => $slug);
		if($this->safety_model->check_exists($where))
		{
			$this->form_validation->set_message(__FUNCTION__,'slug ' . '( ' . $slug .' )' . ' đã tồn tại');
     		 return false;
		}
		return true;
	}

	/*ham kiem tra slug edit*/
	function check_slug_edit()
	{
		$slug = $this->input->post('slug');
	    $info = $this->safety_model->get_info($this->uri->rsegment(3));

	     if($this->uri->rsegment('3')){
	       $conditional = $this->safety_model->get_list(array('where' => array('slug !=' =>$info->slug,'slug'=>$slug)));
	      }
	     else{
	        $conditional = $this->safety_model->get_list(array('where' => array('slug'=>$slug)));
	      }

	     if($conditional){
	        $this->form_validation->set_message(__FUNCTION__,'slug ' . '( ' . $slug .' )' . ' đã tồn tại');
	        return false;
	      }else{
	        return true;
	      }
	}

   /*ham edit bai viet tp ban*/
	function edit()
	{
		// lay id cua bai viet muon sua
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$info = $this->safety_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Không tồn tại bài viết này');
			redirect(admin_url('safety'));
		}
		$this->data['info'] = $info;

		// lay session admin
		$login = $this->session->userdata('login');
		$admin = $this->admin_model->get_info($login['id']);
		$admin_add = $admin->name;

		/* load thư viên tập luật */
	    $this->load->library('form_validation');
	    $this->load->helper('form');

	    if($this->input->post())
	    {
	     // tạo tra những tập luật của những trường bắt buộc phải nhập
		    $this->form_validation->set_rules('title','Tiêu đề bài viết','required');
		    $this->form_validation->set_rules('content', 'Nội dung bài viết', 'required');
		    $this->form_validation->set_rules('image', 'Ảnh đại diện', 'required');
		    $this->form_validation->set_rules('status', 'Ẩn hiện', 'required');
		    /*kiem tra co trung slug hay khong*/
		    if($this->input->post('slug') != '')
		    {
		    	$this->form_validation->set_rules('slug', 'Slug', 'callback_check_slug_edit');
		    }

		    if($this->form_validation->run())
		    {
		    	$title   = $this->input->post('title');
		    	$tags    = json_encode($this->input->post('tags'));
		    	$content = $this->input->post('content');
		       // lưu dữ liệu cần thêm
		         $data = array(
		             'image_link' => $this->input->post('image'),
		             'title'      => $title,
		             'site_title' => $this->input->post('site_title'),
		             'meta_key'   => $this->input->post('meta_key'),
		             'meta_desc'  => $this->input->post('meta_desc'),
		             'tags'       => $tags,
		             'status'     => $this->input->post('status'),
		             'content'    => $content,
		             'admin_add'  => $admin_add,
		             'created'    => now()
		          );
		            // neu admin nhap truogn slug thi them khong thi mac dinh chhu khong dau
			         if($this->input->post('slug') == '')
			         {
			         	$data['slug'] = str_slug($title);
			         }else{
			         	$data['slug'] = $this->input->post('slug');
			         }
			         // neu adminmenuin nhap truogn intro thi them khong thi mac dinh se lay 100 tu tu content
			         if($this->input->post('intro') == '')
			         {
			         	$data['intro'] = limit_text($content, 100);
			         }else{
			         	$data['intro'] = $this->input->post('intro');
			         }	
 					

		            // Thêm mới vào cơ sỡ dữ liệu
	                if ($this->safety_model->update($id, $data)){
	                    // tạo nội dung thông báo
	                    $this->session->set_flashdata('message', 'Cập nhật bài viết mẹo vặt thành công !');
	                }else {
	                    $this->session->set_flashdata('message','Cập nhật viết mẹo vặt không thành công !');
	                }
	                redirect(admin_url('safety'));
		    }
	    }

		// load sang view
		$this->data['temp'] = 'admin/safety/edit';
		$this->load->view("admin/layout", $this->data);
	}

   /*ham xoa 1 thuc pham*/
	function delete()
	{
	  $id = $this->uri->rsegment('3');// lay thong tin bai viet muon xoa
	  $id = intval($id);
	  $this->_del($id); 
	  // tạo nội dung thông báo
	  $this->session->set_flashdata('message','Xóa bài viết thành công !');
	  redirect(admin_url('safety'));
	}

	/*ham xoa nhieu thuc pham*/
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
	  $safety = $this->safety_model->get_info($id);
	  if(!$safety)
	  {
	     //tạo ra nội dung thông báo
	      $this->session->set_flashdata('message', 'Không tồn tại bài viết này !');
	      redirect(admin_url('safety'));
	  }
	  // con khong thi thuc hien xoa
	  $this->safety_model->delete($id);
	}

	/*ham xem noi dung nhanh duoc gui tu ajax*/
	function viewcontent()
	{
		$id = isset($_POST['id'])? $_POST['id'] : false;
		$id = intval($id);
		$info = $this->safety_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Bài viết không tồn tại!');
           redirect(admin_url('safety'));
		}
		$this->data["info"] = $info;

		// /*load tap luat*/
		// $this->load->library('form_validation');
		// $this->load->helper('form');
		// if($this->input->post())
		// {
		// 	$this->form_validation->set_rules('content', 'Nội dung bài viết', 'required');
		// 	if($this->form_validation->run())
		// 	{
		// 		$content = $this->input->post('content');
		// 		$data['content'] = $content;
		// 		if($this->safety_model->update($id, $data))
		// 		{
		// 			$this->session->set_flashdata('message', 'Chỉnh sửa bài viết thành công');
		// 		}else{
		// 			$this->session->set_flashdata('message', 'Chỉnh sửa bài viết không thành công');
		// 		}
		// 		redirect(admin_url('safety'));
		// 	}
		// }

		// load sang view
		$this->data["temp"] = "admin/safety/viewcontent";
		$this->load->view("admin/content_new", $this->data);
	}





























}
 ?>