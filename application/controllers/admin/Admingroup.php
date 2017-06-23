<?php 
class Admingroup extends MY_Controller
{

	/*ham khoi tao*/
	function __construct()
	{
		parent::__construct();
		$this->load->model("admingroup_model");
	}

	/*lay danh sanh nhom quyen admin*/
	function index()
	{
		$id = 1;
		$info = $this->admingroup_model->get_info($id);
		$this->data['info'] = $info;

		$input = array();
		$list = $this->admingroup_model->get_list($input);
		$this->data['list'] = $list;

		/* lay thong bao bang session */
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

		// load sang view
		$this->data['temp'] = "admin/admingroup/index";
		$this->load->view("admin/layout", $this->data);
	}

	/*ham them moi nhom quyen*/
	function add()
	{
		// load tap luat
		$this->load->library("form_validation");
		$this->load->helper("form");

		// kiem tra tap luat
		if($this->input->post())
		{
			// validate du lieu
			$this->form_validation->set_rules('name', 'Tên nhóm quyền', 'required|callback_check_name_add');
			$this->form_validation->set_rules('sort_order', 'Thứ tự ', 'required|callback_check_sort_order_add');
			// nhap lieu chinh xac
            if($this->form_validation->run())
            {
            	$name       = $this->input->post('name');
            	$sort_order = $this->input->post('sort_order');
            	$note       = $this->input->post('note');

            	$data = array(
            		'name'       => $name,
            		'sort_order' => $sort_order,
            		'note'       => $note
            	);

               if ($this->admingroup_model->create($data))
               {
                   $this->session->set_flashdata('message', 'Thêm mới nhóm quyền ' . '( ' . $name .' )' . ' thành công');
               }else {
                   $this->session->set_flashdata('message', 'Thêm mới nhóm quyền ' . '( ' . $name .' )' . ' không thành công');
               }
               redirect(admin_url('admingroup'));
            }			
		}

		// load sang view
		$this->data['temp'] = "admin/admingroup/add";
		$this->load->view("admin/layout", $this->data);
	}

	/*ham kiem tra su ton tai cua username*/
	function check_name_add()
	{	
		$name = $this->input->post('name');
		$where = array("name" => $name );
		if($this->admingroup_model->check_exists($where))
		{
			$this->form_validation->set_message(__FUNCTION__,'Nhóm quyền ' . '( ' . $name .' )' . ' đã tồn tại');
			return false;
		}
		return true;
	}

	/*ham kiem tra su ton tai cua email*/
	function check_sort_order_add()
	{
		$sort_order = $this->input->post('sort_order');
		$where = array("sort_order" => $sort_order );
		if($this->admingroup_model->check_exists($where))
		{
			$this->form_validation->set_message(__FUNCTION__,'Thứ tự ' . '( ' . $sort_order .' )' . ' đã tồn tại');
			return false;
		}
		return true;
	}

	/*ham chinh sua nhom quyen*/
	function edit()
	{
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		// load tap luat
		$this->load->library("form_validation");
		$this->load->helper("form");

		$info = $this->admingroup_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message', 'Không tồn tại nhóm quyền này !');
           redirect(admin_url('admingroup'));
		}
		$this->data["info"] = $info;

		// kiem tra tap luat
		if($this->input->post())
		{
			/*kiem tra su ton tai cua name*/
			$name = $this->input->post('name');
			if($name == $info->name)
			{
				$this->form_validation->set_rules('name', 'Tên nhóm quyền', 'required');
			}elseif(isset($name)){
				$this->form_validation->set_rules('name', 'Tên nhóm quyền', 'required|callback_check_name_edit');	
			}else{
				$this->form_validation->set_rules('name', 'Tên nhóm quyền', 'required');
			}

			$sort_order  = $this->input->post('sort_order');
			/*kiem tra su ton tai cua sort_order*/
			if($sort_order == $info->sort_order)
			{
				$this->form_validation->set_rules('sort_order', 'Thứ tự hiển thị', 'required');
			}elseif(isset($sort_order)){
				$this->form_validation->set_rules('sort_order', 'Thứ tự hiển thị', 'required|callback_check_sort_order_edit');
			}else{
				$this->form_validation->set_rules('sort_order', 'Thứ tự hiển thị', 'required');
			}

			/*neu admin nhap password thi cap nhat lai*/		
            $password = $this->input->post('password');
            if ($password){
              $this->form_validation->set_rules('password', 'Mã khôi phục', 'required|trim');
            }

            if($this->form_validation->run())
            {
            	$name = $this->input->post('name');
            	$sort_order = $this->input->post('sort_order');
            	$note = $this->input->post('note');

            	$data = array(
            		'name' => $name,
            		'sort_order' => $sort_order,
            		'note' => $note
            	);
            	// neu admin co cap nhat lai password
               if ($password){
                   $data['password'] = $password;
               }

               if ($this->admingroup_model->update($id, $data))
               {
                   $this->session->set_flashdata('message', 'Chỉnh nhóm quyền ' . '( ' . $name .' )' . ' thành công');
               }else {
                   $this->session->set_flashdata('message', 'Chỉnh nhóm quyền ' . '( ' . $name .' )' . ' không thành công');
               }
               redirect(admin_url('admingroup'));
            }			
		}

		// load sang view
		$this->data['temp'] = "admin/admingroup/edit";
		$this->load->view("admin/layout", $this->data);
	}

	/*ham kiem tra du ton tai cua ten nhom quyen*/
	function check_name_edit()
	{
		$name = $this->input->post('name');
        $info = $this->admingroup_model->get_info($this->uri->rsegment(3));

	     if($this->uri->rsegment('3')){
	       $conditional = $this->admingroup_model->get_list(array('where'=>array('name !=' =>$info->name,'name'=>$name)));
	      }
	     else{
	        $conditional = $this->admingroup_model->get_list(array('where'=>array('name'=>$name)));
	      }
	     if($conditional){
	        $this->form_validation->set_message(__FUNCTION__,'Tên nhóm quyền ' . '( ' . $name .' )' . ' đã tồn tại');
	        return false;
	        }
	     else{
	        return true;
	      }	
	}

	/*ham kiem tra thu tu hien thi*/
	function check_sort_order_edit()
	{
		$sort_order = $this->input->post('sort_order');
        $info = $this->admingroup_model->get_info($this->uri->rsegment(3));

	     if($this->uri->rsegment('3')){
	       $conditional = $this->admingroup_model->get_list(array('where'=>array('sort_order !=' =>$info->sort_order,'sort_order'=>$sort_order)));
	      }
	     else{
	        $conditional = $this->admingroup_model->get_list(array('where'=>array('sort_order'=>$sort_order)));
	      }
	     if($conditional){
	        $this->form_validation->set_message(__FUNCTION__,'Thứ tự nhóm quyền ' . '( ' . $sort_order .' )' . ' đã tồn tại');
	        return false;
	        }
	     else{
	        return true;
	      }	
	}

   /*ham xoa */
   function delete()
   {
   		$id = $this->uri->rsegment('3');
   		$id = intval($id);
   		$info = $this->admingroup_model->get_info($id);
   		if(!$info)
   		{
   			$this->session->set_flashdata('message', 'Không tồn tại nhóm quyền này !');
   		}
   		// thuc hien xoa
   		$this->admingroup_model->delete($id);
   		$this->session->set_flashdata('message', 'Xóa nhóm quyền ' . '( ' . $info->name .' )' . ' thành công !');
   		redirect(admin_url('admingroup'));
   }


}

 ?>