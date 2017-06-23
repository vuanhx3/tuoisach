<?php 
class Transaction extends MY_Controller
{

   function __construct(){
        parent::__construct();
        // load thu muc transaction_model vao
        $this->load->model('transaction_model');
        $this->load->model('huyen_model');
        $this->load->model('tinh_model');
    }

    function index()
    {
    	// lay tong so giao dich
    	$total_rows = $this->transaction_model->get_total();
    	$this->data['total_rows'] = $total_rows;

    	// lay danh sach huyen
    	$list_huyen = $this->huyen_model->get_list();
    	$this->data['list_huyen'] = $list_huyen;

    	// lay danh sach tinh
    	$list_tinh = $this->tinh_model->get_list();
    	$this->data['list_tinh'] = $list_tinh;

    	// load thu vien phan trang
    	$this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca giao dịch tren 1 website;
        $config['base_url']     = admin_url('transaction/index'); // link hien thi ra danh sach giao dịch
        $config['per_page']   = 20; // so luong hien thi tren 1 trang 
        $config['uri_segment']= 4; // phan doan hien thi ra so trang tren url
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';
        // khoi tao phan trang
        $this->pagination->initialize($config);

        // lấy phân đoạn là trang hiển thị danh sách giao dịch
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input = array();
        $input['limit'] = array($config['per_page'], $segment ); 

        // kiem tra loc du lieu theo id
        $id = $this->input->get('id');
        $id = intval($id);
        $input['where'] = array();
        if ($id > 0){
            $input['where']['id'] = $id;
        }    
        /* lọc theo tên */
        $user_name = $this->input->get('user_name');
        if ($user_name){
            $input['like'] = array('user_name', $user_name);
        }
        // lay danh sach giao dịch
        $list = $this->transaction_model->get_list($input);
        $this->data['list'] = $list;
        
        // load thong bao
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

    	// su dung layout master de load sang view
        $this->data['temp'] = 'admin/transaction/index';
        $this->load->view('admin/layout', $this->data);
    }




    // ham xu lys ajax thanh toan cho offline
    function check_offline()
    {
        $id = $this->uri->rsegment('3');
        $id = intval($id);
        $info_tran = $this->transaction_model->get_info($id);
        if(!$info_tran)
        {
            $this->session->set_flashdata('message', 'Không tồn tại đơn hàng này');
            redirect(admin_url('transaction'));
        }
        $this->data['info_tran'] = $info_tran;

        if($this->input->post())
        {
            $status = $this->input->post('status');
            $data = array('status' => $status);
            $this->transaction_model->update($id, $data);

            redirect(admin_url('transaction'));
        }

        $this->data['temp'] = 'admin/transaction/check_offline';
        $this->load->view('admin/layout', $this->data);
    }

      /**
     * Hàm xóa dữ liệu
     *
     *   */
    function del(){
    
        // lấy thông tin giao dịch để xóa từ id
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        // tạo nội dung thông báo
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('transaction'));
    }
    


     /**
     * Xóa nhiều giao dịch
     *   */
    function delete_all(){
        // lấy id muốn xóa có chức năng làm ẩn các <tr/> chứa id bị check
        $ids = $this->input->post('ids');
        foreach ($ids as $id){
            $this->_del($id);
        }
    }
    
    
    /**
     *
     *   Xóa giao dịch ( đây là hàm xóa chung cho xóa 1 và xóa nhiều giao dịch )
     *   */
    private function _del($id){
        $transaction = $this->transaction_model->get_info($id);
        // kiểm tra xem có giao dịch này để xóa không
        if (!$transaction){
            // tạo nội dung thông báo
            $this->session->set_flashdata('message','Không tồn tại giao dịch này !');
            redirect(admin_url('transaction'));
        }
        // còn không thực hiện xóa giao dịch
        $this->transaction_model->delete($id);
        
    }




}

 ?>