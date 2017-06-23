<?php 
class Support extends MY_Controller
{

	function __construct()
	{
		// ham khoi tao
		parent::__construct();
		$this->load->model("admin_model");
	}

	/*ham hien thi danh sach admin support*/
	function index()
	{
		// lay danh sach admin có quyen la editor de hien thi danh sach ctv
		$input = array('where' => array('admin_group_id' => 3));
		$editor = $this->admin_model->get_list($input);
		$this->data['editor'] = $editor;

		// load thong bao
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;

		$this->data["temp"] = "admin/support/index"; // du lieu gui sang ben view
		$this->load->view("admin/layout", $this->data);
	}

	/*ham cap nhat lua chon*/
	function edit()
	{
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$info = $this->admin_model->get_info($id);
		$this->data['info'] = $info;

		// load thu vien
		$this->load->library('form_validation');
		$this->load->helper('form');
		
		if($this->input->post())
		{
			$this->form_validation->set_rules('luachon', 'Lựa chọn CTV', 'required');
			if($this->form_validation->run())
			{
				$data['luachon'] = $this->input->post('luachon');
				if($this->admin_model->update($id, $data))
				{
					$this->session->set_flashdata('message', 'cập nhật CTV thành công!');
				}else{
					$this->session->set_flashdata('message', 'cập nhật CTV không thành công!');	
				}
				redirect(admin_url('support'));
			}
		}

		$this->data["temp"] = "admin/support/edit"; // du lieu gui sang ben view
		$this->load->view("admin/layout", $this->data);
	}



























}

 ?>