<?php 
class Admin extends MY_Controller
{
	function __construct()
	{
		// ham khoi tao
		parent::__construct();
		$this->load->model("admin_model");
	}


	/*lay danh sach cac admin*/
	function index()
	{
		$input = array();
		// lay danh sach
		$list = $this->admin_model->get_list($input);
		$this->data["list"] = $list;

		// lay tong so thanh vien
		$total = $this->admin_model->get_total();
		$this->data["total"] = $total;

		/* lay thong bao bang session */
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
   
		$this->data["temp"] = "admin/admin/index"; // du lieu gui sang ben view
		$this->load->view("admin/layout", $this->data);
	}

	

	/*ham them moi admin*/
	function add()
	{
		// load thu vien tap luat 
		$this->load->library("form_validation");
		$this->load->helper("form");

		// neu co du lieu post len thi kiem tra
		if($this->input->post())
		{
			// tap luat
		   $this->form_validation->set_rules('name', 'Họ và Tên', 'required|min_length[6]');
		   $this->form_validation->set_rules('image', 'Ảnh đại diện', 'required');
           $this->form_validation->set_rules('username', 'Tài khoản', 'required|trim|min_length[6]|max_length[12]|callback_check_username_add');
           $this->form_validation->set_rules('date', 'Ngày sinh', 'required');
           $this->form_validation->set_rules('password', 'Mật khẩu', 'required|trim|max_length[8]');
           $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'required|matches[password]');
           $this->form_validation->set_rules('address', 'Địa chỉ', 'required');
           $this->form_validation->set_rules('emails', 'Emails', 'trim|required|valid_email|callback_check_emails_add');
           $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|max_length[12]|numeric');
           $this->form_validation->set_rules('admin_group_id', 'Level', 'required');
           // nhap lieu chinh xac
           if($this->form_validation->run())
           {
           		// them vao csdl
           		$username = $this->input->post("username");
           		$name     = $this->input->post("name");
           		$image_link     = $this->input->post("image");
           		$date     = $this->input->post("date");
           		$password = $this->input->post('password');
                $address  = $this->input->post('address');
                $emails   = $this->input->post('emails');
                $phone    = $this->input->post('phone');
                $admin_group_id = $this->input->post("admin_group_id");	

                $data = array('name' => $name, 'image_link' => $image_link, 'username' => $username, 'date' => $date, 'password' => md5($password), 'address' => $address, 'emails' => $emails, 'phone' => $phone, 'admin_group_id' => $admin_group_id);

                $permissions = $this->input->post('permissions');
                $data['permissions'] = json_encode($permissions);

                // thuc hien  them vao csdl
                if($this->admin_model->create($data))
                {
                	$this->session->set_flashdata('message', 'Thêm mới admin ' . '( ' . $name .' )' . ' thành công');
                }else{
                	$this->session->set_flashdata('message', 'Thêm mới admin ' . '( ' . $name .' )' . ' không thành công');
                }
                redirect(admin_url("admin"));
           }
		}

		/*laod config phan quyen*/
		$this->config->load('permissions', true);
		$config_permissions = $this->config->item('permissions');
		$this->data['config_permissions'] = $config_permissions;
		$this->data["temp"] = "admin/admin/add";
		$this->load->view("admin/layout", $this->data);
	}

	/*ham kiem tra su ton tai cua username*/
	function check_username_add()
	{	
		$username = $this->input->post('username');
		$where = array("username" => $username );
		if($this->admin_model->check_exists($where))
		{
			$this->form_validation->set_message(__FUNCTION__,'username ' . '( ' . $username .' )' . ' đã tồn tại');
			return false;
		}
		return true;
	}

	/*ham kiem tra su ton tai cua email*/
	function check_emails_add()
	{
		$emails = $this->input->post('emails');
		$where = array("emails" => $emails );
		if($this->admin_model->check_exists($where))
		{
			$this->form_validation->set_message(__FUNCTION__,'emails ' . '( ' . $emails .' )' . ' đã tồn tại');
			return false;
		}
		return true;
	}


	/*ham chinh sua admin*/
	function edit()
	{
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		// load tap luat
		$this->load->library("form_validation");
		$this->load->helper("form");
		// lay thong tin cua admin
		$info = $this->admin_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên !');
           redirect(admin_url('admin'));
		}
		$info->permissions = json_decode($info->permissions);
		$this->data["info"] = $info;
		// kiem tra tap luat
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Họ và Tên', 'required|min_length[6]');
			$this->form_validation->set_rules('image', 'Ảnh đại diện', 'required');
			$this->form_validation->set_rules('date', 'Ngày sinh', 'required');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'required');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|max_length[12]|numeric');
            $this->form_validation->set_rules('admin_group_id', 'Level', 'required');
            /* tao luat neu username va emails trung voi u,m hien tai thi update con trung vs u,m khac thi k update */
            $username = $this->input->post('username');
            $emails   = $this->input->post('emails');
            /*thuc hien kiem tra username*/
            if($username == $info->username)
            {
            	$this->form_validation->set_rules('username', 'Tài khoản', 'required|trim|min_length[6]|max_length[12]');
            }elseif (isset($username)) {
            	$this->form_validation->set_rules('username', 'Tài khoản', 'required|trim|min_length[6]|max_length[12]|callback_check_username_edit');
            }else{
            	$this->form_validation->set_rules('username', 'Tài khoản', 'required|trim|min_length[6]|max_length[12]');
            }

            /*thuc hien kiem tra emails*/	
            if( $emails == $info->emails){
               $this->form_validation->set_rules('emails', 'Emails', 'trim|required|valid_email');
            }elseif (isset($emails)){
               $this->form_validation->set_rules('emails', 'Emails', 'trim|required|valid_email|callback_check_emails_edit');
            }else {
               $this->form_validation->set_rules('emails', 'Emails', 'trim|required|valid_email');
            }

            /*neu admin nhap password thi cap nhat lai*/		
            $password = $this->input->post('password');
            if ($password){
              $this->form_validation->set_rules('password', 'Mật khẩu', 'required|trim|max_length[8]');
              $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'required|matches[password]');
            }


            if($this->form_validation->run())
            {
            	// chinh sua dl
               $name           = $this->input->post('name');
               $username       = $this->input->post('username');
               $date           = $this->input->post('date');
               $image_link     = $this->input->post('image');
               $address        = $this->input->post('address');
               $emails         = $this->input->post('emails');
               $phone          = $this->input->post('phone');
               $admin_group_id = $this->input->post("admin_group_id");	

               $data = array('name' => $name,'username' => $username, 'date' => $date, 'address' => $address,'emails' => $emails ,'phone' => $phone, 'admin_group_id' => $admin_group_id);
               // neu admin co cap nhat lai password
               if ($password){
                   $data['password'] = md5($password);
               }
               // thay dổi anh khi ng dung cập nhật còn không thì giữ nguyên
               if($image_link != ''){
               		$data['image_link'] = $image_link;
               }

               /*phan quyen*/
               $permissions = $this->input->post('permissions');
               $data['permissions'] = json_encode($permissions);

               if ($this->admin_model->update($id, $data))
               {
                   $this->session->set_flashdata('message', 'Chỉnh sửa admin ' . '( ' . $name .' )' . ' thành công');
               }else {
                   $this->session->set_flashdata('message', 'Chỉnh sửa admin ' . '( ' . $name .' )' . ' không thành công');
               }
               redirect(admin_url('admin'));
            }
		}

		/*laod config phan quyen*/
		$this->config->load('permissions', true);
		$config_permissions = $this->config->item('permissions');
		$this->data['config_permissions'] = $config_permissions;

		$this->data["temp"] = "admin/admin/edit";
		$this->load->view("admin/layout", $this->data);
	}

	/*ham kiem tra su ton tai cua username*/
	function check_username_edit()
	{
		$username = $this->input->post('username');
        $info = $this->admin_model->get_info($this->uri->rsegment(3));

	     if($this->uri->rsegment('3')){
	       $conditional = $this->admin_model->get_list(array('where'=>array('username !=' =>$info->username,'username'=>$username)));

	      }
	     else{
	        $conditional = $this->admin_model->get_list(array('where'=>array('username'=>$username)));
	      }

	     if($conditional){
	        $this->form_validation->set_message(__FUNCTION__,'username ' . '( ' . $username .' )' . ' đã tồn tại');
	        return false;
	        }
	     else{
	        return true;
	      }
	}

	/*ham kiem tra su ton tai cua email*/
	function check_emails_edit()
	{
		$emails = $this->input->post('emails');
        $info = $this->admin_model->get_info($this->uri->rsegment(3));

	     if($this->uri->rsegment('3')){
	       $conditional = $this->admin_model->get_list(array('where'=>array('emails !=' =>$info->emails,'emails'=>$emails)));

	      }
	     else{
	        $conditional = $this->admin_model->get_list(array('where'=>array('emails'=>$emails)));
	      }

	     if($conditional){
	        $this->form_validation->set_message(__FUNCTION__,'emails ' . '( ' . $emails .' )' . ' đã tồn tại');
	        return false;
	        }
	     else{
	        return true;
	      }
	}


	/*ham xoa admin*/
	function delete()
	{
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$info = $this->admin_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này !');			
		}
		// thuc hien xoa
       $this->admin_model->delete($id);
       $this->session->set_flashdata('message', 'Xóa admin ' . '( ' . $info->name .' )' . ' thành công');
       redirect(admin_url('admin')); 
	}

	/*ham xem chi tiet ho so admin*/
	function detail()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : false;
		$id = intval($id);
		$info = $this->admin_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên !');
           redirect(admin_url('admin'));
		}
		$info->permissions = json_decode($info->permissions);
		$this->data["info"] = $info;

		// load phan quyen permission trong config
		$this->config->load('permissions', true);
		$config_permissions = $this->config->item('permissions');
		$this->data['config_permissions'] = $config_permissions;

		// load sang view
		$this->data["temp"] = "admin/admin/detail";
		$this->load->view("admin/dialog", $this->data);
	}



















}









 ?>