<?php 
class Order extends MY_Controller
{

// ham khoi tao
 function __construct(){
      parent::__construct();
      $this->load->model('transaction_model');
      $this->load->model('order_model');
      $this->load->model('tinh_model');
      $this->load->model('huyen_model');
 }


// ham hien thi thanh toan
 function checkout()
 {
 	  // lay danh sach cac tinh
     $input['order'] = array('id', 'ASC');
     $list_tinh = $this->tinh_model->get_list($input);
     $this->data['list_tinh'] = $list_tinh;

    // load gio hang
    $carts = $this->cart->contents();
    // load cart sang view
    $this->data['carts'] = $carts;

    /*kiểm tra xem giỏ hàng có ản phẩm hay không, neu khong co thi khong cho vao*/
	$total_items = $this->cart->total_items();
	if($total_items <= 0)
	{
	 	redirect();
	}

	/*lấy tổng số tiền cần thanh toán*/
	 $total_amount = 0;
	 foreach($carts as $row)
	 {
	 	$total_amount = $total_amount + $row['subtotal'];
	 }
	 $this->data['total_amount'] = $total_amount;

	  // lưu tên thực phẩm dưới dạng mảng
     foreach($carts as $row)
		{
	       $name[] = $row['name'];
		}
     $name = json_encode($name);

	$user_id = 0;
	 $user = '';
		 // nếu thành viên đã đăng nhập thì lấy thông tin thành viên
	 if($this->session->userdata('user_id_login'))
	 {
	 	$user_id = $this->session->userdata('user_id_login');
	 	$user = $this->user_model->get_info($user_id);
	 }
	 $this->data['user'] = $user;

	 $this->load->library('form_validation');
	 $this->load->helper('form');
	 if($this->input->post())
	 {
	 	   $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	       $this->form_validation->set_rules('name', 'Họ và Tên', 'required');
	       $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|max_length[12]|numeric');
	       $this->form_validation->set_rules('tinh', 'Chọn tỉnh', 'required');
	       $this->form_validation->set_rules('huyen', 'Chọn huyện', 'required');
	       $this->form_validation->set_rules('note', 'Ghi chú');

	       if($this->form_validation->run())
	       {
	       	 $payment = $this->input->post('payment');
	       	 $data = array(
				'status'       => 0, // trạng thái chua thanh toan
				'user_id'      => $user_id, //id thành viên mua hàng nếu đã đăng nhập
				'user_name'    => $this->input->post('name'),	
				'user_email'   => $this->input->post('email'),	
				'user_phone'   => $this->input->post('phone'),
	            'message'      => $this->input->post('note'),// ghi chú mua hàng
	            'tinh'		   => $this->input->post('tinh'),	
	            'huyen'		   => $this->input->post('huyen'),	
	            'name'         => $name, // lưu tên thực phẩm
	            'amount'       => $total_amount, // tổng số tiền thanh toán
	            'payment'      => $payment, // cổng thanh toán
	            'created'      => now()
              ); 
		       	 // thêm dữ liệu vào bảng transaction
                $this->transaction_model->create($data);

                /*lấy id của giao dịch vừa thêm vào*/
                $transaction_id = $this->db->insert_id();
                /*thêm vào bẳng order, chi tiết đơn hàng*/
                foreach($carts as $row){
                	$data = array(
                      'transaction_id' => $transaction_id,
                      'product_id'     => $row['id'],
                      'name'           => $row['name'], 
                      'image_link'     => $row['image_link'],
                      'qty'            => $row['qty'],
                      'amount'         => $row['subtotal'],
                      'status'         => '0', 
                	);
                	$this->order_model->create($data);
                }
                // xóa toàn bộ giỏ hàng
                $this->cart->destroy();

                if($payment == 'offline')
                {
                    // tạo nội dung thông báo
	                   $this->session->set_flashdata('message','Bạn đã đặt hàng thành công, chúng tối sẽ kiểm tra và gửi hàng cho bạn !');
	                   redirect(site_url());
                }elseif(in_array($payment, array('baokim', 'nganluong'))) // nếu thanh toán bằng cổng thanh toán
                {
                	// load thư viện thanh toán
	                 $this->load->library('payment/'.$payment.'_payment');   
	                 // chuyển sang trang công thanh toán
	                 $this->{$payment.'_payment'}->payment($transaction_id, $total_amount);
                }
	       }
	 }
 	$this->data['temp'] = 'site/order/checkout';
 	$this->load->view('site/layout', $this->data);
 }


 // ham xu ly ajax tinh-huyen
 function huyen()
 {
 	$idTinh =  $_POST['idTinh'] ;

 	$input = array();
 	$list_huyen = $this->huyen_model->get_list($input);

 	$output = '';
 	foreach($list_huyen as $row)
 	{
 		if($row->idtinh == $idTinh)
 		{
 			$output .= '<option value="'. $row->id .'"> ' . $row->name . ' </option>';
 		}
 	}

 	if($idTinh == 0)
 	{
 		$output = '<option value="">--- Chọn quận huyện ---</option>';
 	}
 	
 	echo $output;
 }

 
// ham nhan ket qua tra ve tu bao kim
 function result()
 {
 	 // load thư viện thanh toán
    $this->load->library('payment/baokim_payment');
    
    // id của giao dịch
    $transaction_id = $this->input->post('order_id');
    
    // lấy thông tin của giao dịch
    $transaction = $this->transaction_model->get_info($transaction_id);
    if (!$transaction){
        redirect();
    }
    // còn nếu đã lấy dc thoongt in giao dich, cta sẽ gọi tới hàng kiêm tra trạng thái thanh toán bên bảo kim
    $status = $this->baokim_payment->result($transaction_id, $transaction->amount);
    if ($status == true){
        // cập nhật lại lại trang thái giao dịch thanh toán đơn hàng
        $data = array();
        $data['status'] = 1;
        $this->transaction_model->update($transaction_id, $data);
    }elseif ($status == false){
        // cập nhật lại trạng thái đơn hàng
        $data = array();
        $data['status'] = 2;
        $this->transaction_model->update($transaction_id, $data);
    }
 }








}

 ?>