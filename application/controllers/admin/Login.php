<?php 
class Login extends MY_Controller
{
	function index()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		// kiem tra tap luat khi co du lieu post len
		if($this->input->post())
		{
			$this->form_validation->set_rules('login', 'login', 'callback_check_login');
			if($this->form_validation->run())
			{
				// sau khi dang nhap thanh cong lay  ra thong tin theo id roi luu session
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$password = md5($password);

				$this->load->model('admin_model');
				$where = array('username' => $username, 'password' => $password);
				$admin = $this->admin_model->get_info_rule($where);
				//sau khi lấy ra thông tin admin đăng nhập gắn session cho nó
				$this->session->set_userdata('login', array('id' => $admin->id, 'username' => $admin->username, 'image_link' => $admin->image_link , 'name' => $admin->name, 'admin_group_id' => $admin->admin_group_id, 'permissions' => json_decode($admin->permissions)));	

				redirect(admin_url('home'));
			}
		}
		$this->load->view("admin/login/index");
	}


	/*
     * Kiem tra username va password co chinh xac khong
     */
	function check_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5($password);
		/*load model*/
		$this->load->model('admin_model');

		$where = array('username' => $username, 'password' => $password);
		$admin = $this->admin_model->get_info_rule($where);
		/*kiem tra bang ham check_exists trong model */
		if($admin)
		{	
			// luu session quyen cua admin do
			$this->session->set_userdata('permissions', json_decode($admin->permissions));
			// set session admin mac dinh co admin_group_id = 1
			$this->session->set_userdata('admin_group', $admin->admin_group_id);

			return true;
		}
		$this->form_validation->set_message(__FUNCTION__, 'Tài Khoản hoặc Mật Khẩu không đúng !');
		return false;
	}



}



 ?>