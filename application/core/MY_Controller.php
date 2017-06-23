<?php 

Class MY_Controller extends CI_Controller
{
	// bien toan cuc gui du lieu sang ben view
	public $data = array();

	function __construct()
	{
		// khoi tao va ke thua tu ci_controller
		parent::__construct();
		$this->load->library('session');
		// uri duong dan tren url
		$controller = $this->uri->segment(1);
		switch ($controller) {
			
			case 'admin':
				{
					# code... xu ly du lieu khi truy cap trang admin
					$this->__check_login();
					$login = $this->session->userdata('login');

					// lay ra thong tin admin dang nhap
					$this->load->model('admin_model');
					$admin_info = $this->admin_model->get_info($login['id']);
					$this->data['admin_info'] = $admin_info;

					 /*
	                //nếu đăng nhập vào admin rùi mà admin nhập linh tinh trên url thì redirect về trang home
	                */
	                $controller2 = $this->uri->rsegment(1);
	                    $controller2 = ucfirst(strtolower($controller2)) . '.php';
	                    if(!file_exists(FCPATH . 'application/controllers/admin/' . $controller2))
	                    {
	                        redirect(admin_url('home'));
	                    } 

					break;
				}
			
			default:
				{
					# code... mac dinh xu ly dl trang nguoi dung  
					/*-------------------------------phan gio hang-------------------------------*/
					$this->load->library('cart');
					$this->data['total_items'] = $this->cart->total_items();

					/*-------------------------------load homepage------------------------------- */
					$this->load->model('homepage_model');
					$id = 1;
					$homepage = $this->homepage_model->get_info($id);
					$this->data['homepage'] = $homepage;

					// lay thong tin thanh vien khi da dang nhap
					$user_id_login = $this->session->userdata('user_id_login');
					if($user_id_login)
					{
						$this->load->model('user_model');
						$user_info = $this->user_model->get_info($user_id_login);
						$this->data['user_info'] = $user_info;
					}

					/*----------------------lay danh sach danh muc  thuc pham----------------------*/
					$this->load->model('catalog_model');
					$input = array();
					$input['where'] = array('parent_id' => 0);
					$input['order'] = array('sort_order', 'ASC');
					$catalog_list = $this->catalog_model->get_list($input);
					// lap de lay danh muc con
					foreach($catalog_list as $row)
					{
						$input['where'] = array('parent_id' => $row->id);
						$subs = $this->catalog_model->get_list($input);
						$row->subs = $subs; 
					}
					$this->data['catalog_list'] = $catalog_list;

					/*lay box doi tac*/
					$this->load->model('partner_model');
					$input = array('limit' => array(4,0));
					$list_partner = $this->partner_model->get_list($input);
					$this->data['list_partner'] = $list_partner;

					/*-------------------------lay danh sach tin vs attp ------------------------- */
					$this->load->model('safety_model');
					$input = array('limit' => array(5,0));
					$list_attp = $this->safety_model->get_list($input);
					$this->data['list_attp'] = $list_attp;
					/*-------------------------lay danh sach tin vs attp ------------------------- */

					/*-------------------------lay danh sach tin meo vat------------------------- */
					$this->load->model('news_model');
					$input = array('limit' => array(5,0));
					$list_meovat = $this->news_model->get_list($input);
					$this->data['list_meovat'] = $list_meovat;
					/*-------------------------lay danh sach tin vs attp ------------------------- */

					/*-----------------------------------hien thi footer---------------------------*/
					// phan gioi thieu
					$this->load->model('content_static_model');
					$input = array(); 	
					$list_footer  = $this->content_static_model->get_list($input);
					$this->data['list_footer'] = $list_footer;

					// phan ve chung toi
					$this->load->model('about_us_model');
					$input = array(); 	
					$list_about  = $this->about_us_model->get_list($input);
					$this->data['list_about'] = $list_about;

					// ve phan thong tin
					$this->load->model('info_model');
					$input = array(); 	
					$list_info  = $this->info_model->get_list($input);
					$this->data['list_info'] = $list_info;

					// ve phan qui dinh va chinh sach
					$this->load->model('quidinh_model');
					$input['where'] = array('status' => 1); 	
					$list_quidinh  = $this->quidinh_model->get_list($input);
					$this->data['list_quidinh'] = $list_quidinh;

					/*-----------------------------------hien thi footer---------------------------*/

				break;
				}
		}
	}


	// ham kiem tra trang thai dang nhap cua admin
	private function __check_login()
	{
		/*lay ra duong dan */
		$controller = $this->uri->rsegment('1');
		$controller = strtolower($controller);
		$login = $this->session->userdata('login');
        $this->data['login'] = $login;
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if(!$login && $controller != 'login')
        {
        	redirect(admin_url('login'));
        }
         //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if($login && $controller == 'login')
        {
            redirect(admin_url('home/index'));
        }else if(!in_array($controller, array('login', 'home'))) // phan nay laf admin nao cung vao dc
        {
        	// lay ra admin_group dc luu session 
        	$admin_group = $this->session->userdata('admin_group');
        	$root_admin  = $this->config->item('root_admin');
        	if($admin_group != $root_admin) // neu ma admin_group ma khac voi root_admin = 1 ti ktq
        	{
        		// kiem tra quyen tai day
            	$permissions_admin = $this->session->userdata('permissions');
            	// lay ra controller hien tai
            	$controller = $this->uri->rsegment(1);
            	$action     = $this->uri->rsegment(2);

            	// dat bien co
            	$check = true;
            	// kiem tra neu khong ton tai key vd admin, product... controller quyen do
            	if(!isset($permissions_admin->{$controller})) 
            	{
            		$check = false;
            	}

            	// tiep den kiem tra cac action vd nhu add, edit, delete cos trong quyen cua admin k
            	$permissions_action = $permissions_admin->{$controller};
            	if(!in_array($action, $permissions_action))
            	{
            		$check = false;
            	}
            	if(!$check)
            	{
            		$this->session->set_flashdata('message','Bạn không có quyền vào trang này !');
             		redirect(admin_url());
            	}
        	}

        }
	}

	
}


















 ?>