<?php 
class Cart extends MY_Controller{


/*ham khoi tao*/
function __construct()
{
	parent::__construct();
	// goi to thu vien shopping cart
	$this->load->model('product_model');
	$this->load->library('cart');
}

// ham them san pham ben trang chu
function add()
{
	$this->load->library('cart');
	// so luong san pham
	$qty = 1;
	$data = array(
		"id"           => $_POST["product_id"],
		"name"         => $_POST["product_name"],
		"price"        => $_POST["product_price"],
		"image_link"   => $_POST["product_img"],
		"slug"         => $_POST["product_slug"],
		'qty'          => $qty
	);

	 // gọi phương thức thêm vào giỏ hàng
    $this->cart->insert($data);
    echo $this->view();
}

// ham them san pham ben trang chi tiet san pham
function add_view()
{
	$this->load->library('cart');
	// so luong san pham
	
	$data = array(
		"id"           => $_POST["product_id"],
		"name"         => $_POST["product_name"],
		"price"        => $_POST["product_price"],
		"image_link"   => $_POST["product_img"],
		"slug"         => $_POST["product_slug"],
		'qty'          => $_POST["product_qty"]
	);

	 // gọi phương thức thêm vào giỏ hàng
    $this->cart->insert($data);

    // tro den thanh phan hien thi nhanh box gio hang
    echo $this->view();
}

function load()
{
	echo $this->view();
}

// ham xoa 1 san pham ben trang chu
function remove()
{
	$row_id = $_POST['row_id'];
	$data = array(
		'rowid' => $row_id,
		'qty'   => 0
	);
	$this->cart->update($data);
	echo $this->view();
}

// ham xoa tat ca san pham
function clear()
{
	$this->cart->destroy();
	echo $this->view();
}

/*ham hien thi san pham trong gio hang ngay tren trang chu*/
function view()
{
	$output = '';
	$output .='
		<div class="table-responsive">
			
			<div class="header-cart_list">
				<ul>
	';

	$count = 0;
	foreach($this->cart->contents() as $items)
	{
		$count++;
		$output .= '
						<li>
						    <div class="list_image">
						    	 <img  src="'. $items["image_link"] .'" alt=""> 
						    </div>

							<div class="right_pd_cart">
								<a href="'. base_url($items['slug'].'/xem-chi-tiet-p'.$items['id'].'.html') .'" > '. $items["name"] .' </a>
							    <p style="color: #8E8E8E;" class="header-cart-list__quantity">'. $items["qty"] . ' x ' . ' <span style="color: #197d07;"> ' . number_format($items["price"]) . ' </span>' . ' <sup style="color: #197d07;">đ</sup> ' . '</p>	
							    <button type="button" name="remove" class="remove_item" id="'. $items["rowid"] .'">  xoa </button>
							</div>
						</li>	
		';
	}

	$output .='
			   </ul>		
		   </div>

		   <br>

		   <div id="action_cart"  align="right">
	            <p>Số lượng :  <span class="number_pd"> '. $this->cart->total_items() .' </span>  </p>
		        <p>Tổng tiền : <span>'. number_format($this->cart->total()) .  ' <sup>đ</sup> ' .'</span></p>
		        <br>
				<button type="button" id="clear_cart_action" class="btn_action_cart">Xóa hết</button>
				<a href=" ' . site_url('order/checkout') . ' " type="button" id="success_cart_action" class="btn_action_cart">Thanh toán</a>
			</div>
			
	    </div>
	';

	if($count == 0)
	{
		$output = "";
	}

	return $output;
}

/*ajax hien thi so luong san pham mua*/
function qty_cart()
{
    echo $total_items = $this->cart->total_items();
}

function load_qty_cart()
{
  echo $this->qty_cart();
}
/*ajax hien thi so luong san pham mua*/


/*hien thi thong tin gio hang*/
function index()
{	
	// thông tin giỏ hàng 
	$carts = $this->cart->contents();
	// tổng số thực phẩm có trong giỏ hàng
	$total_items = $this->cart->total_items();

	$this->data['carts']       = $carts;
	$this->data['total_items'] = $total_items;

	$this->data['temp'] = 'site/cart/index';
    $this->load->view('site/layout', $this->data);
}

/*Cập nhật giỏ hàng*/
function update()
{
	// thông tin giỏ hàng
	$carts = $this->cart->contents();
	foreach($carts as $key => $row)
	{
      $total_qty = $this->input->post('qty_'.$row['id']);
      $data = array('rowid' => $key, 'qty' => $total_qty);
      $this->cart->update($data);
	}
	// chuyển về trang danh sách thông tin giỏ hàng
	redirect(base_url('cart'));
}


/*ham xoa k ajax ben trang gio hang*/
function del()
{
	$id = $this->uri->rsegment(3);
	$id = intval($id);
	if($id > 0)
	{
      /*// lấy toàn bộ dữ liệu thông tin của sản phẩm*/
      $carts = $this->cart->contents();
      foreach($carts as $key => $row)
      {
         if($row['id'] == $id)
         {
           	$data = array('rowid' => $key, 'qty' => 0);
            $this->cart->update($data);
         }
      }
	}else
	{
		/*xóa toàn bộ giỏ hàng*/
		$this->cart->destroy();
	}
	// chuyển về trang danh sách thông tin giỏ hàng
	redirect(base_url('cart'));
}

















}


 ?>