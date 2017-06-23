<?php 
class Head extends MY_Controller
{
	/*ham khoi tao*/
	function __construct()
	{
		parent::__construct();
		$this->load->model("head_model");
		$this->load->model("admin_model");
	}

	/*ham hien thi danh sach new*/
	function index()
	{
		// lay danh sach tin cong nghe
		$input = array();
		$list = $this->head_model->get_list($input);
		$this->data['list'] = $list;

		// lay session admin
		$login = $this->session->userdata('login');
		$admin = $this->admin_model->get_info($login['id']);
		$admin_add = $admin->name;

		/* load thư viên tập luật */
	    $this->load->library('form_validation');
	    $this->load->helper('form');

	    if($this->input->post())
	    {
	     // tạo tra những tập luật của những trường bắt buộc phải nhập
		    $this->form_validation->set_rules('content', 'Nội dung bài viết', 'required');
		    $this->form_validation->set_rules('status', 'Trạng thái', 'required');

		    if($this->form_validation->run())
		    {
		    	$status  = $this->input->post('status');
		    	$content = $this->input->post('content');
		       // lưu dữ liệu cần thêm
		         $data = array(
		         	'content'    => $content,
		             'status'     => $status,
		             'admin_add'  => $admin_add,
		             'created'    => now()
		          );
		            // Thêm mới vào cơ sỡ dữ liệu
	                if ($this->head_model->create($data)){
	                    // tạo nội dung thông báo
	                    $this->session->set_flashdata('message', 'Thêm mới nội dung thành công !');
	                }else {
	                    $this->session->set_flashdata('message','Thêm nội dung không thành công !');
	                }
	                redirect(admin_url('head'));
		    }
	    }

		// lay tong so tin meo vat dang co
		$total_rows = $this->head_model->get_total();
		$this->data['total_rows'] = $total_rows;

        // kiem tra loc du lieu theo ma so
        $id = $this->input->get('id');
        $id = intval($id);
        if(isset($id) && $id > 0)
        {
        	$input['where'] = array('id' => $id);
        }

        // lay danh sach tat ca 
        $input['order'] = array('created', 'DESC');
        $list = $this->head_model->get_list($input);
        $this->data['list'] = $list;

        /*load thong bao*/
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

		// load sang view
		$this->data['temp'] = 'admin/head/index';
		$this->load->view("admin/layout", $this->data);
	}


   /*ham edit bai viet meo vat*/
	function edit()
	{
		// lay id cua bai viet muon sua
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$info = $this->head_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Không tồn tại tâm thư này');
			redirect(admin_url('head'));
		}
		$this->data['info'] = $info;

		// lay session admin
		$login = $this->session->userdata('login');
		$admin = $this->admin_model->get_info($login['id']);
		$admin_add = $admin->name;

		/* load thư viên tập luật */
	    $this->load->library('form_validation');
	    $this->load->helper('form');

	    if($this->input->post())
	    {
	     // tạo tra những tập luật của những trường bắt buộc phải nhập
		    $this->form_validation->set_rules('content', 'Nội dung bài viết', 'required');
		    if($this->form_validation->run())
		    {
		    	$status  = $this->input->post('status');
		    	$content = $this->input->post('content');
		       // lưu dữ liệu cần thêm
		         $data = array(
		             'status'     => $status,
		             'content'    => $content,
		             'admin_add'  => $admin_add,
		             'created'    => now()
		          );
	            // Thêm mới vào cơ sỡ dữ liệu
                if ($this->head_model->update($id, $data)){
                    // tạo nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật bài viết thành công !');
                }else {
                    $this->session->set_flashdata('message','Cập nhật bài viết không thành công !');
                }
                redirect(admin_url('head'));
	       }
	    }
		// load sang view
		$this->data['temp'] = 'admin/head/edit';
		$this->load->view("admin/layout", $this->data);
	}

  /*ham xoa 1 thuc pham*/
	function delete()
	{
	  $id = $this->uri->rsegment('3');// lay thong tin bai viet muon xoa
	  $id = intval($id);
	  $this->_del($id); 
	  // tạo nội dung thông báo
	  $this->session->set_flashdata('message','Xóa nội dung thành công !');
	  redirect(admin_url('head'));
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
	  $news = $this->head_model->get_info($id);
	  if(!$news)
	  {
	     //tạo ra nội dung thông báo
	      $this->session->set_flashdata('message', 'Không tồn tại nội dung này !');
	      redirect(admin_url('head'));
	  }
	  // con khong thi thuc hien xoa
	  $this->head_model->delete($id);
	}

	


}
 ?>