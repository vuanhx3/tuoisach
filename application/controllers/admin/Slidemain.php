<?php 
class Slidemain extends MY_Controller
{

/*ham khoi tao*/
function __construct()
{
	parent::__construct();
	$this->load->model('slidemain_model');
	$this->load->model('catalog_model');
	$this->load->model('admin_model');
}


/*ham hien thi danh danh sach slidemain*/
function index()
{
	/*lay danh sach tat ca slide */
	$input = array();
	$list = $this->slidemain_model->get_list($input);
    foreach($list as $row) // lap de lay danh sach slide co chung catalog_id
    {
       $input = array('where' => array('catalog_id' => $row->catalog_id));
       $sub = $this->slidemain_model->get_list($input);
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
    $this->data['temp'] = 'admin/slidemain/index';
    $this->load->view('admin/layout', $this->data);
}


/*ham them moi slide*/
function add()
{
	// lay danh sach the loai
	$input = array();
	$input['where'] = array('parent_id' => 0);
	$list_catalog = $this->catalog_model->get_list($input);
	$this->data['list_catalog'] = $list_catalog;

	/*lay thong tin*/
	$login = $this->session->userdata('login');
    $admin = $this->admin_model->get_info($login['id']);
    $author = $admin->name;

	// load thu vien tap luat
	$this->load->library('form_validation');
	$this->load->helper('form');
	// kiem tra nhap lieu chinh xac
	if($this->input->post())
	{
		$this->form_validation->set_rules('name','Tên Slide','required');
        $this->form_validation->set_rules('image','Ảnh Slide','required');
        $this->form_validation->set_rules('catalog','Trường thể loại','required');
        if($this->input->post('sort_order') != '')// truong vi tri
        {
            $this->form_validation->set_rules('sort_order','Thứ tự hiển thị','required|numeric|callback_check_sort_order_add');
        }
        if($this->input->post('slug') != '') // truong slug 
        {
        	$this->form_validation->set_rules('slug','Trường Slug','callback_check_slug_add');
        }
        if($this->input->post('info') != '') // truong mo ta
        {
        	$this->form_validation->set_rules('info','Trường Mô tả','max_length[100]');
        }

        // them vao csdl
        if($this->form_validation->run())
        {
        	
        	$created = now();// thoi gian
        	$data = array(
        		'name'       => $this->input->post('name'),
        		'image_link' => $this->input->post('image'),
        		'catalog_id' => $this->input->post('catalog'),
        		'sort_order' => $this->input->post('sort_order'),
        		'info'       => $this->input->post('info'),
        		'author'     => $author,
        		'created'    => $created
        	);
        	// truong hop nguoi dung khong nhap slug
        	if($this->input->post('slug') == '')
        	{
        		$data['slug'] = str_slug($this->input->post('name'));
        	}else{
        		$data['slug'] = $this->input->post('slug');
        	}
        	// truong hop khong chon muc trang thai thi mac dinh cho an
        	if($this->input->post('anhien') == '')
        	{
        		$data['anhien'] = 0;
        	}else{
        		$data['anhien'] = $this->input->post('anhien');
        	}

        	// them vao csdl
        	if($this->slidemain_model->create($data))
        	{
        		 //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');	
        	}else{
        		$this->session->set_flashdata('message', 'Không thêm được');
        	}
        	//chuyen tới trang danh sách
            redirect(admin_url('slidemain'));
        }
	}

	/* load sang view */
    $this->data['temp'] = 'admin/slidemain/add';
    $this->load->view('admin/layout', $this->data);
}


/*ham kiem tra slug add*/
function check_slug_add()
{
    $slug = $this->input->post('slug');
    $where = array('slug' => $slug );
    if($this->slidemain_model->check_exists($where))
    {
      $this->form_validation->set_message(__FUNCTION__,'slug ' . '( ' . $slug .' )' . ' đã tồn tại');
      return false;
    }
    return true;
}

/*ham kiem tra vi tri add*/
function check_sort_order_add()
{
    $sort_order = $this->input->post('sort_order');
    $where = array('sort_order' => $sort_order );
    if($this->slidemain_model->check_exists($where))
    {
      $this->form_validation->set_message(__FUNCTION__,'vị trí ' . $sort_order . ' này đã có, hãy chọn thứ tự hiển thị tiếp theo');
      return false;
    }
    return true;
}

 /*ham check_slug edit*/
 function check_slug_edit()
 {
    $slug = $this->input->post('slug');
    $info = $this->slidemain_model->get_info($this->uri->rsegment(3));

     if($this->uri->rsegment('3')){
       $conditional = $this->slidemain_model->get_list(array('where' => array('slug !=' =>$info->slug,'slug'=>$slug)));
      }
     else{
        $conditional = $this->slidemain_model->get_list(array('where' => array('slug'=>$slug)));
      }

     if($conditional){
        $this->form_validation->set_message(__FUNCTION__,'slug ' . '( ' . $slug .' )' . ' đã tồn tại');
        return false;
      }else{
        return true;
      }
 }

 /*ham kiem tra vi tri edit*/
 function check_sort_order_edit()
 {
    $sort_order = $this->input->post('sort_order');
    $info = $this->slidemain_model->get_info($this->uri->rsegment(3));

     if($this->uri->rsegment('3')){
       $conditional = $this->slidemain_model->get_list(array('where' => array('sort_order !=' =>$info->sort_order,'sort_order'=>$sort_order)));
      }
     else{
        $conditional = $this->slidemain_model->get_list(array('where' => array('sort_order'=>$sort_order)));
      }

     if($conditional){
        $this->form_validation->set_message(__FUNCTION__,'vị trí ' . $sort_order . ' này đã có, hãy chọn thứ tự hiển thị tiếp theo');
        return false;
      }else{
        return true;
      }
 }


/*fam chinh sua slide*/
function edit()
{
	// lay id thuc pham can chinh sua
	$id = $this->uri->rsegment('3');
	$id = intval($id);
	$slide = $this->slidemain_model->get_info($id);
	if(!$slide)
	{
		$this->session->set_flashdata('message', 'Không tồn tại slide này!');
		redirect(admin_url('slidemain'));
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
    $author = $admin->name;

	// load thu vien tap luat
	$this->load->library('form_validation');
	$this->load->helper('form');
	// kiem tra nhap lieu chinh xac
	if($this->input->post())
	{
		$this->form_validation->set_rules('name','Tên Slide','required');
        $this->form_validation->set_rules('image','Ảnh Slide','required');
        $this->form_validation->set_rules('catalog','Trường thể loại','required');
        if($this->input->post('sort_order') != '')// truong vi tri
        {
            $this->form_validation->set_rules('sort_order','Thứ tự hiển thị','required|numeric|callback_check_sort_order_edit');
        }
        if($this->input->post('slug') != '')
        {
            $this->form_validation->set_rules('slug','slug','callback_check_slug_edit');
        }
        if($this->input->post('info') != '')
        {
            $this->form_validation->set_rules('info','Trường Mô tả','max_length[100]');
        }

        // them vao csdl
        if($this->form_validation->run())
        {
            $name       = $this->input->post('name');
            $image_link = $this->input->post('image');
            $created    = now();// thoi gian
        	$data = array(
        		'name'       => $name,
        		'catalog_id' => $this->input->post('catalog'),
        		'sort_order' => $this->input->post('sort_order'),
        		'info'       => $this->input->post('info'),
        		'author'     => $author,
        		'created'    => $created
        	);
        	// truong hop nguoi dung khong nhap slug
        	if($this->input->post('slug') == '')
        	{
        		$data['slug'] = str_slug($name);
        	}else{
        		$data['slug'] = $this->input->post('slug');
        	}
        	// truong hop khong chon muc trang thai thi mac dinh cho an
        	if($this->input->post('anhien') == '')
        	{
        		$data['anhien'] = 0;
        	}else{
        		$data['anhien'] = $this->input->post('anhien');
        	}
            // thay dổi anh khi ng dung cập nhật còn không thì giữ nguyên
            if($image_link != '')
            {
                $data['image_link'] = $image_link;
            }

        	// them vao csdl
        	if($this->slidemain_model->update($slide->id, $data))
        	{
        		 //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');	
        	}else{
        		$this->session->set_flashdata('message', 'Không cập nhật được !');
        	}
        	//chuyen tới trang danh sách
            redirect(admin_url('slidemain'));
        }
 }

	/* load sang view */
    $this->data['temp'] = 'admin/slidemain/edit';
    $this->load->view('admin/layout', $this->data);
}


/*ham xoa  1*/
function delete()
{
  $id = $this->uri->rsegment('3');
  // lay thong tin thuc pham muon xoa
  $slide = $this->slidemain_model->get_info($id);
  if(!$slide)
  {
     //tạo ra nội dung thông báo
      $this->session->set_flashdata('message', 'Không tồn tại slide này !');
      redirect(admin_url('slidemain'));
  }
  // con khong thi thuc hien xoa
  $this->slidemain_model->delete($id);
  $this->session->set_flashdata('message','Xóa slide thành công !');
  redirect(admin_url('slidemain'));
}























}

 ?>