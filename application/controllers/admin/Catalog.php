<?php 
class Catalog extends MY_Controller
{
	/*ham khoi tao*/
	function __construct()
	{
		parent::__construct();
		$this->load->model('catalog_model');
		$this->load->model('product_model');
	}

	/*lay danh sach catalog*/
	function index()
	{
	    $input = array();
	    
        /*kiểm tra lọc dữ liệu theo mã số*/
        $id = $this->input->get('id');
        $id = intval($id);
        if(isset($id) && $id > 0){
           $input['where']['id'] = $id;
        }

		// kiem tra loc du lieu theo ten
		$name = $this->input->get('name');
		if(isset($name)){
			$input['like'] = array('name', $name);
		}	

		// lay tat ca danh sach
		$list = $this->catalog_model->get_list($input);
		$this->data['list'] = $list;

		// lay danh sach danh muc cha
		$input['where'] = array('parent_id' => 0);
		$catalog_list = $this->catalog_model->get_list($input);
		 //lấy ra danh mục con trong danh mục cha đó
        //danh mục con là danh mục có parent_id bằng id danh mục cha.
        //dùng vòng lặp foreach để lặp danh mục cha. sau đó lấy ra các danh mục con trong danh mục cha đó. gắn cái danh mục con vào biến mảng. để sau này lấy ra dùng
        foreach ($catalog_list as $key => $value) {
        	$input_1 = array();
        	$input_1['where'] = array('parent_id' => $value->id);
        	$catalog_sub = $this->catalog_model->get_list($input_1);
        	$value->subs = $catalog_sub;//tạo mảng subs chứa tất cả thông tin của biens catalog_sub 
        }
        $this->data['catalog_list'] = $catalog_list;

        // lay noi dung bien message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

		$this->data['temp'] = 'admin/catalog/index';
		$this->load->view('admin/layout', $this->data);
	}


	/*ham them moi danh muc*/
	function add()
	{
		//load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');
        // neu co du lieu post len thi kiem tra
        if($this->input->post())
        {
        	$this->form_validation->set_rules('name', 'Tên danh mục', 'required');
        	$this->form_validation->set_rules('content', 'Giới thiệu ngắn', 'required');
        	$this->form_validation->set_rules('sort_order', 'Vị trí hiển thị', 'numeric');
        	$this->form_validation->set_rules('box_vitri', 'Box hiển thị', 'numeric');
        	if($this->input->post('slug') != ''){
        		 $this->form_validation->set_rules('slug', 'Slug', 'callback_check_slug_add');
        	}	
        	// nhap lieu chinh xac
        	if($this->form_validation->run())
        	{
        		$name       = $this->input->post('name');
        		$meta_desc  = $this->input->post('meta_desc');
                $meta_key   = $this->input->post('meta_key');
                $content    = $this->input->post('content');
                $parent_id  = $this->input->post('parent_id');
                $sort_order = $this->input->post('sort_order');
                $box_vitri  = $this->input->post('box_vitri');
                $image_link = $this->input->post('image');
                $avatar     = $this->input->post('avatar');
                $created    = now();

                $data = array('name' => $name, 'meta_desc' => $meta_desc, 'meta_key' => $meta_key, 'content' => $content, 'parent_id' => $parent_id, 'sort_order' => intval($sort_order), 'box_vitri' => $box_vitri ,'image_link' => $image_link, 'avatar' => $avatar , 'created' => $created );

                if($this->input->post('seo_title') == '')
                {
                	$data['seo_title'] = $name;
                }else{
                	$data['seo_title'] = $this->input->post('seo_title');
                }

                if($this->input->post('slug') == '')
                    $data['slug']  = str_slug($name);
                else
                     $data['slug'] =$this->input->post('slug');

                 //them moi vao csdl
                if($this->catalog_model->create($data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('catalog'));
        	}
        }

        // lay danh sach danh muc cha
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $list = $this->catalog_model->get_list($input);
        $this->data['list'] = $list;

		$this->data['temp'] = 'admin/catalog/add';
		$this->load->view('admin/layout', $this->data);
	}

	/*ham check_slug_add*/
	function check_slug_add()
	{	
		$slug = $this->input->post('slug');
		$where = array("slug" => $slug );
		if($this->catalog_model->check_exists($where))
		{
			$this->form_validation->set_message(__FUNCTION__,'slug ' . '( ' . $slug .' )' . ' đã tồn tại');
			return false;
		}
		return true;
	}


	/*ham chinh sua danh muc*/
	function edit()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');
		// lay id danh muc can chinh sua
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		// lay thong tin
		$info = $this->catalog_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Không tồn tại danh mục này!');
			redirect(admin_url('catalog'));
		}	
		$this->data['info'] = $info;
		
		if($this->input->post())
		{
			$this->form_validation->set_rules('name', 'Tên danh mục', 'required');
            $this->form_validation->set_rules('sort_order','Thứ tự','numeric');
            $this->form_validation->set_rules('box_vitri', 'Box hiển thị', 'numeric');
            $this->form_validation->set_rules('content','Mô tả Danh mục Thực Phẩm','required');
            if($this->input->post('slug') != ''){
        		 $this->form_validation->set_rules('slug', 'Slug', 'callback_check_slug_edit');
        	}	

        	// nhap lieu chinh xac
        	if($this->form_validation->run())
        	{
        		$name       = $this->input->post('name');
        		$meta_desc  = $this->input->post('meta_desc');
                $meta_key   = $this->input->post('meta_key');
                $content    = $this->input->post('content');
                $parent_id  = $this->input->post('parent_id');
                $sort_order = $this->input->post('sort_order');
                $box_vitri  = $this->input->post('box_vitri');
                $created    = now();

                // luu du lieu can them
                $data = array(
                	'name' => $name,
                	'meta_desc'  => $meta_desc,
                	'meta_key'   => $meta_key,
                	'content'    => $content,
                	'parent_id'  => $parent_id,
                	'sort_order' => intval($sort_order),
                	'box_vitri'  => intval($box_vitri),
                	'image_link' => $this->input->post('image'),
                	'avatar'     => $this->input->post('avatar'),
                	'created'    => $created
                );

                 if($this->input->post('seo_title') == '')
                {
                	$data['seo_title'] = $name;
                }else{
                	$data['seo_title'] =$this->input->post('seo_title');
                }

                if($this->input->post('slug') == '')
                {
                	$data['slug'] = str_slug($name);
                }else{
                	$data['slug'] =$this->input->post('slug');
                }

                //them moi vao csdl
                if($this->catalog_model->update($id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('catalog'));
        	}
		}
		// lay danh muc cha
		$input = array('where' => array('parent_id' => 0));
        $list = $this->catalog_model->get_list($input);
        foreach($list as $row)
		{
			$input = array('where' => array('parent_id' => $row->id));
			$subs = $this->catalog_model->get_list($input);
			$row->subs = $subs;
		}
        $this->data['list'] = $list;

		$this->data['temp'] = 'admin/catalog/edit';
		$this->load->view('admin/layout', $this->data);
	}

	
	/*ham kiem tra slug phan edit*/
	function check_slug_edit()
	{
		$slug = $this->input->post('slug');
        $info = $this->catalog_model->get_info($this->uri->rsegment(3));

	     if($this->uri->rsegment('3')){
	       $conditional = $this->catalog_model->get_list(array('where'=>array('slug !=' =>$info->slug,'slug'=>$slug)));
	      }
	     else{
	        $conditional = $this->catalog_model->get_list(array('where'=>array('slug'=>$slug)));
	      }

	     if($conditional){
	        $this->form_validation->set_message(__FUNCTION__,'slug ' . '( ' . $slug .' )' . ' đã tồn tại');
	        return false;
	        }else{
	         return true;
	        }

	}

	

	/*ham xoa 1 danh muc*/
	function delete()
	{
		// lay id
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$this->_del($id);
		$this->session->set_flashdata('message','Xóa danh mục thực phẩm này thành công !');
        redirect(admin_url('catalog'));
	}

	/*ham xoa nhieu danh muc cung luc*/
	 function del_all($id)
     {
        $ids = $this->input->post('ids'); // ids duoc post len khi goi ngam ajax de xu ly xoa trong file custom_admin.js
        foreach($ids as $id)
        {
           $this->_del($id, false);
        }    
     }


	/*ham thuc hien xoa cho 1 va nhieu cung 1 luc*/
	private function _del($id, $redirect = true)
	{
		// lấy thông tin sản phẩm muốn xóa
	      $info = $this->catalog_model->get_info($id);
	      // kiem tra xem thong tin thuc pham co ton tai hay khong
	      if(!$info)
	      {
	         $this->session->set_flashdata('message','Không tồn tại danh mục thực phẩm này !');
	         if($redirect)
	         {
	            redirect(admin_url('catalog'));
	         }else{
	            return false;
	         }
	      }  
	      
	      // kiem tra dieu kien xoa danh muc cha còn chứa danh mục con
	      $catalog = $this->catalog_model->get_info_rule(array('parent_id' => $id), 'id');
	       if($catalog)
	       {
	          $this->session->set_flashdata('message', 'Danh mục '. $info->name .' cha có chứa danh mục con và sản phẩm, rất nguy hiểm khi bạn xóa danh mục cha này !');
	          if($redirect)
	          {
	            redirect(admin_url('catalog'));
	          }else{
	            return false;
	          }
	       }

	       // kiem tra xem danh muc nay co thuc pham hay khong
	        $product = $this->product_model->get_info_rule(array('catalog_id' => $id), 'id');//catalog_id bang chinh id cua danh muc muon xoa, id: la lay tai cot id
	        // neu $product ton tai thi hien thong bao khong cho xoa phai xoa san pham truoc khi xoa danh muc
	        if($product)
	        {
	          $this->session->set_flashdata('message', 'Danh mục '. $info->name .' có chứa sản phẩm, bạn cần phải xóa sản phẩm trước khi xóa danh mục !');
	          if($redirect)
	          {
	            redirect(admin_url('catalog'));
	          }else{
	            return false;
	          }
	        }
	        // thuc hien xoa
	        $this->catalog_model->delete($id);  
	}




}




?>