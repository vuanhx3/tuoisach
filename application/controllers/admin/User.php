<?php
class User extends My_Controller{
    function __construct(){
        parent::__construct();
        // load thư viện vào
        $this->load->model('user_model');
    }
    
    function index(){
        // lấy tổng số tất cả các TV
        $total = $this->user_model->get_total();
        $this->data['total'] = $total;
        
        /* loc theo id */
        $id = $this->input->get('id');
        $id = intval($id);
        $input['where'] = array();
        if ($id > 0){
            $input['where']['id'] = $id;
        }
        // lọc theo tên
        $name = $this->input->get('name');
        if($name)
        {
            $input['like'] = array('name', $name);
        }
        
        // lấy danh sách tất cả  các thành viên
        $list = $this->user_model->get_list($input);
        $this->data['list'] = $list;
        
        // load thong bao
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        // load sang view
        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/layout', $this->data);
    }
    
    /**
     * Hàm xóa thành viên
     *
     *   */
    function del(){
        // lấy thông tin thành viên để xóa từ id
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        // tạo nội dung thông báo
        $this->session->set_flashdata('message', 'Xóa thành viên thành công');
        redirect(admin_url('user'));
    }
    
    /**
     * Xóa nhiều thành viên
     *   */
    function delete_all(){
        // lấy tất cả id thành viên muốn xóa có chức năng làm ẩn các <tr/> chứa id bị check
        $ids = $this->input->post('ids');
        foreach ($ids as $id){
            $this->_del($id);
        }
    }
    
    /**
     *
     *   Xóa thành viên( đây là hàm xóa chung cho xóa 1 và xóa nhiều thành viên )
     *   */
    private function _del($id){
        $member = $this->user_model->get_info($id);
        // kiểm tra xem có thành viên này để xóa không
        if (!$member){
            // tạo nội dung thông báo
            $this->session->set_flashdata('message','Không tồn tại thành viên này !');
            redirect(admin_url('user'));
        }
        // còn không thực hiện xóa thành viên
        $this->user_model->delete($id);
    }
    
    
}