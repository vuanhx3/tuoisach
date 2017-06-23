<?php 

class Safety extends MY_Controller
{

// ham khoi tao
 function __construct(){
      parent::__construct();
      $this->load->model('safety_model');
 }


// ham hien thij list tin meo vat 
 function index()
 {
 	/*lấy tổng số tin mẹo vặt*/
   $total_rows = $this->safety_model->get_total();
   $this->data['total_rows'] = $total_rows;
   
   /*lấy id tin mẹo vặt hiển thị trên URL*/
   $id = intval($this->uri->rsegment(3));
   
   /*phân trang*/
   $this->load->library('pagination');
    $config = array();
  	$config['total_rows'] = $total_rows; // tong tat ca san pham tren 1 website;
  	$config['base_url']     = base_url('safety/index/'.$id); // link hien thi ra danh sach san pham
  	$config['per_page']   = 10; // so luong hien thi tren 1 trang
  	$config['suffix'] = '.html'; 
  	$config['uri_segment']= 4; // phan doan hien thi ra so trang tren url
  	$config['next_link'] = 'Trang kế tiếp';
  	$config['prev_link'] = 'Trang trước';
     $this->pagination->initialize($config);

   $segment = $this->uri->segment(4);
   $segment = intval($segment);
   $input = array('limit' => array($config['per_page'], $segment));

   /*hiển tị danh sách tin mẹo vặt*/
   $list_vs = $this->safety_model->get_list($input);
   $this->data['list_vs'] = $list_vs; 

   $this->data['temp'] = 'site/safety/index';
   $this->load->view('site/layout', $this->data);	
 }



/*ham ghiwen thi chi tiet bai viet*/
function view()
{
	// lấy id bài viết muốn xem
  	$id = intval($this->uri->rsegment(3));
  	/*lấy thông tin bài viết*/
  	$new_info = $this->safety_model->get_info($id);
  	if(!$new_info)
  	{
 		redirect(base_url('safety'));
  	}
    
  	/*load sàn view*/
  	$this->data['new_info'] = $new_info;

  	/* hiển thị bài viết khác */
    $input['limit'] = array(3,0);
    $input['order'] = array('id', 'random');
    $safety_article = $this->safety_model->get_list($input);
    $this->data['safety_article'] = $safety_article;

  	/*cập nhật số lượt view cho bài viết*/
  	$data = array();
  	$data['count_view'] = $new_info->count_view + 1;
  	$this->safety_model->update($new_info->id, $data);

  	// load sang view
  	$this->data['temp'] = 'site/safety/view';
  	$this->load->view('site/layout', $this->data);
}





















}


 ?>