<?php 
class Product extends MY_Controller
{


/*ham khoi tao*/
function __construct()
{
	parent::__construct();
	$this->load->model('product_model');
	$this->load->model('catalog_model');
	$this->load->model('partner_model');
}


/*ham hien thi danh sach san pham*/
function index()
{
	     /* lay tong so lương san pham */
        $total_rows = $this->product_model->get_total();
        $this->data['total_rows'] = $total_rows;
        /* load thu vien phan trang pagination */
        $this->load->library('pagination');
        $config = array();
        $config['total_rows']  = $total_rows;// tong tat ca san pham tren website
        $config['base_url']    = admin_url('product/index');//link hien thi ra danh sach san pham
        $config['per_page']    = 10; //so luong san pham tren 1 trang
        $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren link url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';

        $this->pagination->initialize($config);// khoi tao cau hinh phan trang
        
        /* thuc hien limit san pham tren 1 trang tren url */
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input   = array('limit' => array($config['per_page'], $segment));

        /* kiem tra co thuc hien loc du lieu theo ma so hay khong*/
        $id = $this->input->get('id');
        $id = intval($id);
        if(isset($id) && $id > 0){
          $input['where']['id'] = $id;
        }
        /* kiem tra loc du lieu theo ten*/
        $name = $this->input->get('name');
        if(isset($name)){
           $input['like'] = array('name', $name);
        }
        /* kiem tra loc du lieu theo danh muc san pham*/
        $catalog_id = $this->input->get('catalog');
        $catalog_id = intval($catalog_id);
        if (isset($catalog_id) && $catalog_id > 0) {
            $input['where']['catalog_id'] = $catalog_id;
        }

        // lay danh sach tat ca thuc pham phai ở trước danh mục sản phẩm 
        $input['order'] = array('created', 'DESC');
        $list_one = $this->product_model->get_list($input);
        $this->data['list_one'] = $list_one;

        /*lay danh mục sản phẩm de loc*/
        $this->load->model('catalog_model');
        $input    = array('where' => array('parent_id' => 0));
        $catalogs = $this->catalog_model->get_list($input);
        foreach($catalogs as $row)
        {
           $input = array('where' => array('parent_id' => $row->id));
           $subs  = $this->catalog_model->get_list($input);
           $row->subs = $subs;
        }
        $this->data['catalogs'] = $catalogs;

        /*lay danh sach doi tac de hien thi nguon goc*/
        $input_dt = array();
        $partner = $this->partner_model->get_list($input_dt);
        $this->data['partner'] = $partner;


        /*load thong bao*/
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        /* load sang view */
        $this->data['temp'] = 'admin/product/index';
        $this->load->view('admin/layout', $this->data);
}


/*ham them moi thuc pham*/
function add()
{
	// lay danh sach doi tac
	$input = array();
	$partner = $this->partner_model->get_list($input);
	$this->data['partner'] = $partner;

	// lay danh sach san pham
	$input = array('where' => array('parent_id' => 0));
	$catalogs = $this->catalog_model->get_list($input);
	// lap de lay ra danh muc con
	foreach($catalogs as $row)
	{
		$input = array('where' => array('parent_id' => $row->id));
		$subs = $this->catalog_model->get_list($input);
		$row->subs = $subs;
	}
	$this->data['catalogs'] = $catalogs;

	// load form validation
	$this->load->library('form_validation');
	$this->load->helper('form');

	if($this->input->post())
	{
		// tap luat validate
	   $this->form_validation->set_rules('name','Tên thực phẩm','required|max_length[25]');
	   $this->form_validation->set_rules('number_pd','Số lượng','required|max_length[6]');
	   $this->form_validation->set_rules('image', 'Hình ảnh', 'required');
     $this->form_validation->set_rules('price','Giá','required|max_length[9]');
     $this->form_validation->set_rules('catalog','Thể loại','required');
     $this->form_validation->set_rules('partner_id','Nguồn gốc thực phẩm','required');
     $this->form_validation->set_rules('content','Nội dung','required');
       // kiem tra co trung slug hay khong
       if($this->input->post('slug') != '')
       {
       		$this->form_validation->set_rules('slug','Slug','callback_check_slug_add');	
       }
     
       if($this->form_validation->run())
       {
       		// them vao csdl
       		$name       = $this->input->post('name');// ten thuc pham
       		$catalog_id = $this->input->post('catalog');//  thuoc the loai
       		$image_link = $this->input->post('image');// anh
       		$image_list = json_encode($this->input->post('image_list'));// anh kem theo
       		$number_pd  = $this->input->post('number_pd'); // so luong trong kho
       		$number_pd  = str_replace(',', '', $number_pd);
       		$price      = $this->input->post('price');// gia
          $price      = str_replace(',', '', $price);
          $discount   = $this->input->post('discount');// giam gia
          $discount   = str_replace(',', '', $discount);
          $partner_id = $this->input->post('partner_id'); // nguon goc tu doi tac
          $origin     = $this->input->post('origin'); // nguon goc khac
          $gifts      = $this->input->post('gifts'); // khuyen mai
          $noi_bat    = $this->input->post('noi_bat');// noi bat
          $site_title = $this->input->post('site_title');// the seo_title
          $meta_desc  = $this->input->post('meta_desc');// meta_desc
          $meta_key   = $this->input->post('meta_key');// meta_key
          $nhung_video= $this->input->post('nhung_video');// ma nhung video
          $content    = $this->input->post('content');// content
          $created    = now();// thoi gian

            // luu du lieu can them vao csdl
            $data = array(
            	'name' => $name, 'catalog_id' => $catalog_id, 'image_link' => $image_link, 'image_list' => $image_list, 'number_pd' => intval($number_pd), 'price' => $price, 'discount' => $discount, 'origin' => $origin, 'partner_id' => $partner_id, 'gifts' => $gifts, 'noi_bat' => $noi_bat, 'site_title' => $site_title, 'meta_desc' => $meta_desc, 'meta_key' => $meta_key, 'nhung_video' => $nhung_video, 'content' => $content, 'created' => $created	
            );
            if($this->input->post('slug') == '')
            {
            	$data['slug'] = str_slug($name);
            }else{
            	$data['slug'] = $this->input->post('slug');
            }

            //them moi vao csdl
            if($this->product_model->create($data))
            {
                //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
            }else{
                $this->session->set_flashdata('message', 'Không thêm được');
            }
            //chuyen tới trang danh sách
            redirect(admin_url('product'));
       }	
	}	
	/* load sang view */
    $this->data['temp'] = 'admin/product/add';
    $this->load->view('admin/layout', $this->data);
}

/*ham chinh sua thuc pham*/
function edit()
{
	// lay id thuc pham can chinh sua
	$id = $this->uri->rsegment('3');
	$id = intval($id);
	$product = $this->product_model->get_info($id);
	if(!$product)
	{
		$this->session->set_flashdata('message', 'Không tồn tại thực phẩm này!');
		redirect(admin_url('product'));
	}
	$this->data['product'] = $product;

	// lay danh sach doi tac
	$input = array();
	$partner = $this->partner_model->get_list($input);
	$this->data['partner'] = $partner;

	// lay danh sach san pham
	$input = array('where' => array('parent_id' => 0));
	$catalogs = $this->catalog_model->get_list($input);
	// lap de lay ra danh muc con
	foreach($catalogs as $row)
	{
		$input = array('where' => array('parent_id' => $row->id));
		$subs = $this->catalog_model->get_list($input);
		$row->subs = $subs;
	}
	$this->data['catalogs'] = $catalogs;

	// load form validation
	$this->load->library('form_validation');
	$this->load->helper('form');

	if($this->input->post())
	{
		// tap luat validate
	   $this->form_validation->set_rules('name','Tên thực phẩm','required|max_length[25]');
	   $this->form_validation->set_rules('number_pd','Số lượng','required|max_length[6]');
	   $this->form_validation->set_rules('image', 'Hình ảnh', 'required');
     $this->form_validation->set_rules('price','Giá','required|max_length[9]');
     $this->form_validation->set_rules('catalog','Thể loại','required');
     $this->form_validation->set_rules('partner_id','Nguồn gốc thực phẩm','required');
     $this->form_validation->set_rules('content','Nội dung','required');
       // kiem tra co trung slug hay khong
       if($this->input->post('slug') != '')
       {
       		$this->form_validation->set_rules('slug','Slug','callback_check_slug_edit');	
       }
     
       if($this->form_validation->run())
       {
       		// them vao csdl
       		$name       = $this->input->post('name');// ten thuc pham
       		$catalog_id = $this->input->post('catalog');//  thuoc the loai
       		$image_link = $this->input->post('image');// anh
       		$image_list = json_encode($this->input->post('image_list'));// anh kem theo
       		$number_pd  = $this->input->post('number_pd'); // so luong trong kho
       		$number_pd  = str_replace(',', '', $number_pd);
       		$price      = $this->input->post('price');// gia
          $price      = str_replace(',', '', $price);
          $discount   = $this->input->post('discount');// giam gia
          $discount   = str_replace(',', '', $discount);
          $partner_id = $this->input->post('partner_id'); // nguon goc tu doi tac
          $origin     = $this->input->post('origin'); // nguon goc khac
          $gifts      = $this->input->post('gifts'); // khuyen mai
          $noi_bat    = $this->input->post('noi_bat');// noi bat
          $site_title = $this->input->post('site_title');// the seo_title
          $meta_desc  = $this->input->post('meta_desc');// meta_desc
          $meta_key   = $this->input->post('meta_key');// meta_key
          $nhung_video= $this->input->post('nhung_video');// ma nhung video
          $content    = $this->input->post('content');// content
          $created    = now();// thoi gian

            // luu du lieu can them vao csdl
            $data = array(
            	'name' => $name, 'catalog_id' => $catalog_id, 'number_pd' => intval($number_pd), 'price' => $price, 'discount' => $discount, 'origin' => $origin, 'partner_id' => $partner_id, 'gifts' => $gifts, 'noi_bat' => $noi_bat, 'site_title' => $site_title, 'meta_desc' => $meta_desc, 'meta_key' => $meta_key, 'nhung_video' => $nhung_video, 'content' => $content, 'created' => $created	
            );
            if($this->input->post('slug') == '')
            {
            	$data['slug'] = str_slug($name);
            }else{
            	$data['slug'] = $this->input->post('slug');
            }

            // thay dổi anh khi ng dung cập nhật còn không thì giữ nguyên
            if($image_link != '')
            {
            	$data['image_link'] = $image_link;
            }
            if(!empty($image_list))
            {
            	$data['image_list'] = $image_list;
            }

            //cap nhat vao csdl
            if($this->product_model->update($id, $data))
            {
                //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
            }else{
                $this->session->set_flashdata('message', 'Không cập nhật được');
            }
            //chuyen tới trang danh sách
            redirect(admin_url('product'));
       }	
	}
	/* load sang view */
    $this->data['temp'] = 'admin/product/edit';
    $this->load->view('admin/layout', $this->data);
}

/*ham kiem tra slug add*/
function check_slug_add()
{
    $slug = $this->input->post('slug');
    $where = array('slug' => $slug );
    if($this->product_model->check_exists($where))
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
    $info = $this->product_model->get_info($this->uri->rsegment(3));

     if($this->uri->rsegment('3')){
       $conditional = $this->product_model->get_list(array('where' => array('slug !=' =>$info->slug,'slug'=>$slug)));
      }
     else{
        $conditional = $this->product_model->get_list(array('where' => array('slug'=>$slug)));
      }

     if($conditional){
        $this->form_validation->set_message(__FUNCTION__,'slug ' . '( ' . $slug .' )' . ' đã tồn tại');
        return false;
      }else{
        return true;
      }
}

/*ham xoa 1 thuc pham*/
function delete()
{
  // lay thong tin thuc pham muon xoa
  $id = $this->uri->rsegment('3');
  $id = intval($id);
  $this->_del($id); 
  // tạo nội dung thông báo
  $this->session->set_flashdata('message','Xóa thực phẩm thành công !');
  redirect(admin_url('product'));
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
  $product = $this->product_model->get_info($id);
  if(!$product)
  {
     //tạo ra nội dung thông báo
      $this->session->set_flashdata('message', 'Không tồn tại thực phẩm này !');
      redirect(admin_url('product'));
  }
  // con khong thi thuc hien xoa
  $this->product_model->delete($id);
}





























}	

 ?>