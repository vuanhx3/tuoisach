<?php 
class Content_static extends MY_Controller
{
	function __construct()
	{
		// ham khoi tao
		parent::__construct();
		$this->load->model("content_static_model");
	}

	function index()
	{
		$input = array();
		// loc theo ma so
		$id = $this->input->get('id');
		$id = intval($id);
		if(isset($id) && $id > 0){
			$input['where']['id'] = $id;
		}
		// loc du lieu theo keyword
		$key = $this->input->get('key');
		if(isset($key)){
			$input['like'] = array('key', $key);
		}
		$list = $this->content_static_model->get_list($input);
		$this->data['list'] = $list;	

		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post())
		{
			$this->form_validation->set_rules('key','Key bài viết','required');
		    $this->form_validation->set_rules('content', 'Nội dung bài viết', 'required');
		    if($this->form_validation->run()){
		    	$key     = $this->input->post('key');
		    	$content = $this->input->post('content');

		    	$data = array('key' => $key, 'content' => $content, 'created' => now());

		    	// Thêm mới vào cơ sỡ dữ liệu
                if ($this->content_static_model->create($data)){
                    // tạo nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới key thành công !');
                }else {
                    $this->session->set_flashdata('message','Thêm key không thành công !');
                }
                redirect(admin_url('content_static'));
		    }
		}

		// lay thong bao
		$message = $this->session->flashdata('message');
        $this->data['message'] = $message;

		// load sang view
		$this->data['temp'] = 'admin/content_static/index';
		$this->load->view('admin/layout', $this->data);
	}


	/*ham chinh sua content*/
	function edit()
	{
		// lay id can chinh sua
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$info = $this->content_static_model->get_info($id);
		if(!$info){
			$this->session->set_flashdata('message', 'không tồn tại key này');
			redirect(admin_url('content_static'));
		} 
		$this->data['info'] = $info;

		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post())
		{
			$this->form_validation->set_rules('key','Key bài viết','required');
		    $this->form_validation->set_rules('content', 'Nội dung bài viết', 'required');
		    if($this->form_validation->run()){
		    	$key     = $this->input->post('key');
		    	$content = $this->input->post('content');

		    	$data = array('key' => $key, 'content' => $content, 'created' => now());

		    	// Thêm mới vào cơ sỡ dữ liệu
                if ($this->content_static_model->update($id, $data)){
                    // tạo nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật mới key thành công !');
                }else {
                    $this->session->set_flashdata('message','Cập nhật key không thành công !');
                }
                redirect(admin_url('content_static'));
		    }
		}
		// load sang view
		$this->data['temp'] = 'admin/content_static/edit';
		$this->load->view('admin/layout', $this->data);
	}

	/*ham xoa 1*/
	// function delete()
	// {
	// 	$id = $this->uri->rsegment('3');
	// 	$id = intval($id);
	// 	$this->_del($id);
	// 	// thong bao 
	// 	$this->session->set_flashdata("message", "xoa key thành công" );
	// }

	// /*ham xoa nhieu */
	// function delete_all()
	// {
	// 	$ids = $this->input->post('ids');
	// 	foreach($ids as $id)
	//     {
	//       $this->_del($id);
	//     }
	// }

	// /*ham xoa chung cho 1 hoac nhieu*/
	// private function _del($id)
	// {
	// 	$info = $this->content_static_model->get_info($id);
	// 	if(!$info)
	// 	{
	// 		$this->session->set_flashdata('message', 'Không tồn tại key này');
	// 		redirect(admin_url('content_static'));
	// 	}
	// 	// con khong thi xoa
	// 	$this->content_static_model->delete($id);	
	// }
















}

 ?>