<?php 
class Home extends MY_Controller
{
	function index()
	{
		/*lay slide BCN*/
		$this->load->model('slidebcn_model');
		$input = array('order' => array('sort_order', 'ASC' ), 'limit' => array(5,0));
		$bcn_list = $this->slidebcn_model->get_list($input);
		$this->data['bcn_list'] = $bcn_list;

		/*lay slide main*/
		$this->load->model('slidemain_model');
		$input = array('order' => array('sort_order', 'ASC' ), 'limit' => array(5,0));
		$slide_list = $this->slidemain_model->get_list($input);
		foreach($slide_list as $row)
		{
			$input['where'] = array('catalog_id' => $row->catalog_id);
			$subs = $this->slidemain_model->get_list($input);
			$row->subs = $subs; 
		}
		$this->data['slide_list'] = $slide_list;

		/*lay tam thu doi loi tu cua hang */
		$this->load->model('head_model');
		$input = array();
		$list_head = $this->head_model->get_list($input);
		$this->data['list_head'] = $list_head;

		/*lay cong nghe */
		$this->load->model('tech_model');

		/* lay tin cong nghe phan box gioi thieu*/
		$input_1['where'] = array('order' => 1);  
		$list_tech1 = $this->tech_model->get_list($input_1);
		$this->data['list_tech1'] = $list_tech1;

		$input_2['where'] = array('order' => 2);  
		$list_tech2 = $this->tech_model->get_list($input_2);
		$this->data['list_tech2'] = $list_tech2;

		$input_3['where'] = array('order' => 3);   
		$list_tech3 = $this->tech_model->get_list($input_3);
		$this->data['list_tech3'] = $list_tech3;
		/* lay tin cong nghe phan box gioi thieu*/

		/*load thuc pham moi*/
		$this->load->model('product_model');
		$input['limit'] = array(4,0);
		$list_product = $this->product_model->get_list($input);
		$this->data['list_product'] = $list_product;	

		/*lay thuc pham noi bat*/
		$this->load->model('product_model');
	    $input = array('where' => array('noi_bat' => 1 ), 'limit' => array(2,0));
		$product_noibat = $this->product_model->get_list($input);
		$this->data['product_noibat'] = $product_noibat;

		/*lay ra thuc pham xem nheu*/
		$this->load->model('product_model');
		$input = array('order' => array('view', 'DESC' ), 'limit' => array(5,0));
		$product_view = $this->product_model->get_list($input);
		$this->data['product_view'] = $product_view;

		/*lay banner thuc pham*/
		$this->load->model('banner_thucpham_model');
		$input = array('where' => array('anhien' => 1 ), 'limit' => array(4,0));
		$list_bannerTP = $this->banner_thucpham_model->get_list($input);
		$this->data['list_bannerTP'] = $list_bannerTP;

		/*lay ra admin support*/
		$this->load->model('admin_model');
		$input = array('where' => array('admin_group_id' => 3, 'luachon' => 1) , 'limit' => array(1,0) );
		$list_support = $this->admin_model->get_list($input);
		$this->data['list_support'] = $list_support;


		/*-------------------------lay danh sach tin vs attp ------------------------- */
		$this->load->model('safety_model');
		$input = array('limit' => array(3,0));
		$list_vs = $this->safety_model->get_list($input);
		$this->data['list_vs'] = $list_vs;
		/*-------------------------lay danh sach tin vs attp ------------------------- */

		/*lay ra danh sach thuc pham sach*/
		$this->load->model('catalog_model');
		$input = array('where' => array('parent_id' => 0), 'order' => array('sort_order', 'ASC'));
		$list_thucphamban = $this->catalog_model->get_list($input);
		foreach($list_thucphamban as $row)
		{
		   $input = array('where' => array('parent_id' => $row->id));
           $subs  = $this->catalog_model->get_list($input);
           $row->subs = $subs;
		}
		$this->data['list_thucphamban'] = $list_thucphamban;

		// lay tat ca thuc pham theo catalog ngoai trang chu
		$input = array('limit' =>array(30,0)); 
		$list_pd = $this->product_model->get_list($input);
		$this->data['list_pd'] = $list_pd;

		/*load nội dung thông báo*/
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

		/*mang luu tru du lieu*/
		$this->data["temp"] = "site/home/index"; // giao dien phan box thay doi se duoc hien ra ben ngoai
		$this->load->view("site/layout", $this->data); // load ca phan thay doi lan co dinh sag layout, gd chinhs
	}
} 





 ?>