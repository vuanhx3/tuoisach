<?php 
class Product extends MY_Controller
{
	 function __construct(){
        parent::__construct();
        // load model sản phẩm
        $this->load->model('product_model');
        $this->load->model('catalog_model');
        $this->load->model('safety_model');
        $this->load->model('news_model');
    }

    /*hien thi danh sach catalog thuc pham*/
    function catalog()
    {
    	// lay id the loai
    	$id = $this->uri->rsegment('3');
    	$id = intval($id);
    	// kiem tra xem thong tin danh muc the loai
    	$catalog = $this->catalog_model->get_info($id);
    	if(!$catalog)
    	{
    		redirect();
    	}
    	// gui thong tin catalog sang ben view
    	$this->data['catalog'] = $catalog;

        // lay danh muc dieu huong sang danh muc cha 
        $input = array('where' => array('parent_id' => 0));
        $list_catalog = $this->catalog_model->get_list($input);
        // lap de lay ra danh muc con
        foreach($list_catalog as $row)
        {
            $input = array('where' => array('parent_id' => $row->id));
            $subs = $this->catalog_model->get_list($input);
            $row->subs = $subs;
        }
        $this->data['list_catalog'] = $list_catalog;

    	$input = array();
    	// kiem tra day la danh muc con hay danh muc cha
    	if($catalog->parent_id == 0)
    	{
    		$input_catalog = array('where' => array('parent_id' => $id));
    		$catalog_subs = $this->catalog_model->get_list($input_catalog);

    		if(!empty($catalog_subs))// nneu danh muc hien tai co danh muc con
    		{
    			$catalog_subs_id = array();
    			foreach ($catalog_subs as $sub)
                {
                    $catalog_subs_id[] = $sub->id;
                }
                    // lấy tất cả sản phẩm thuôc danh mục con đó
                    $this->db->where_in('catalog_id', $catalog_subs_id);
    		}else{
    			// nếu không có danh mục con thì ta lấy trược tiếp các danh mục thuộc danh mục đó
                  $input['where'] = array('catalog_id' => $id);
    		}
    	}else{
    		$input['where'] = array('catalog_id' => $id); 
    	}

    	 // lay tổng số lượng tất cả sản phẩm có trong danh mục đó
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;

        // load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca san pham tren 1 website;
        $config['base_url']     = base_url('product/catalog/'.$id); // link hien thi ra danh sach san pham
        $config['per_page']   = 16; // so luong hien thi tren 1 trang
        $config['suffix'] = '.html'; 
        $config['uri_segment']= 4; // phan doan hien thi ra so trang tren url
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';
        // khoi tao phan trang
        $this->pagination->initialize($config);
        
        // lấy phân đoạn là trang hiển thị danh sách san phẩm
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'], $segment );

        // lay danh sach thuc pham
        if (isset($catalog_subs_id)){
            $this->db->where_in('catalog_id', $catalog_subs_id);
        }
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;



        /*lay danh sach thuc pham sap xep theo gia tu nho-lon*/ 
        $input = array();
        // kiem tra day la danh muc con hay danh muc cha
        if($catalog->parent_id == 0)
        {
            $input_catalog = array('where' => array('parent_id' => $id));
            $catalog_subs = $this->catalog_model->get_list($input_catalog);
            if(!empty($catalog_subs))// nneu danh muc hien tai co danh muc con
            {
                $catalog_subs_id = array();
                foreach ($catalog_subs as $sub)
                {
                    $catalog_subs_id[] = $sub->id;
                }
                    // lấy tất cả sản phẩm thuôc danh mục con đó
                    $this->db->where_in('catalog_id', $catalog_subs_id);
            }else{
                // nếu không có danh mục con thì ta lấy trược tiếp các danh mục thuộc danh mục đó
                  $input['where'] = array('catalog_id' => $id);
            }
        }else{
            $input['where'] = array('catalog_id' => $id); 
        }

         // lay tổng số lượng tất cả sản phẩm có trong danh mục đó
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;

        // load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca san pham tren 1 website;
        $config['base_url']     = base_url('product/catalog/'.$id); // link hien thi ra danh sach san pham
        $config['per_page']   = 16; // so luong hien thi tren 1 trang
        $config['suffix'] = '.html'; 
        $config['uri_segment']= 4; // phan doan hien thi ra so trang tren url
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';
        // khoi tao phan trang
        $this->pagination->initialize($config);
        
        // lấy phân đoạn là trang hiển thị danh sách san phẩm
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'], $segment );

        // lay danh sach thuc pham
        if (isset($catalog_subs_id)){
            $this->db->where_in('catalog_id', $catalog_subs_id);
        }

        $input['order'] = array('price', 'ASC');
        $list_asc = $this->product_model->get_list($input);
        $this->data['list_asc'] = $list_asc;


        /*lay danh sach thuc pham sap xep theo gia tu lon-nho*/ 
         $input = array();
        // kiem tra day la danh muc con hay danh muc cha
        if($catalog->parent_id == 0)
        {
            $input_catalog = array('where' => array('parent_id' => $id));
            $catalog_subs = $this->catalog_model->get_list($input_catalog);
            if(!empty($catalog_subs))// nneu danh muc hien tai co danh muc con
            {
                $catalog_subs_id = array();
                foreach ($catalog_subs as $sub)
                {
                    $catalog_subs_id[] = $sub->id;
                }
                    // lấy tất cả sản phẩm thuôc danh mục con đó
                    $this->db->where_in('catalog_id', $catalog_subs_id);
            }else{
                // nếu không có danh mục con thì ta lấy trược tiếp các danh mục thuộc danh mục đó
                  $input['where'] = array('catalog_id' => $id);
            }
        }else{
            $input['where'] = array('catalog_id' => $id); 
        }

         // lay tổng số lượng tất cả sản phẩm có trong danh mục đó
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;

        // load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca san pham tren 1 website;
        $config['base_url']     = base_url('product/catalog/'.$id); // link hien thi ra danh sach san pham
        $config['per_page']   = 16; // so luong hien thi tren 1 trang
        $config['suffix'] = '.html'; 
        $config['uri_segment']= 4; // phan doan hien thi ra so trang tren url
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';
        // khoi tao phan trang
        $this->pagination->initialize($config);
        
        // lấy phân đoạn là trang hiển thị danh sách san phẩm
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'], $segment );

        // lay danh sach thuc pham
        if (isset($catalog_subs_id)){
            $this->db->where_in('catalog_id', $catalog_subs_id);
        }

        $input['order'] = array('price', 'DESC');
        $list_desc = $this->product_model->get_list($input);
        $this->data['list_desc'] = $list_desc;



        /*lay ra tin thực phẩm bẩn*/
        $input_safety = array('limit' => array(5,0));
        $list_safety = $this->safety_model->get_list($input_safety);
        $this->data['list_safety'] = $list_safety;

    	// load sang view
    	$this->data['temp'] = 'site/product/catalog';
    	$this->load->view('site/layout', $this->data);

    }




    /*ham xem chi tiet thuc pham*/
    function view()
    {   
        // lay id thuc pham muon xem chi tiet
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            redirect();
        }
        $this->data['product'] = $product;

        // cap nhat so luot xem cho san pham
        $data = array();
        $data['view'] = $product->view + 1;
        $this->product_model->update($product->id, $data);

        // lay danh sach anh kem theo
        $list_img = @json_decode($product->image_list);
        $this->data['list_img'] = $list_img;

        // lay ten danh muc dieu huong
        $list_catalog = $this->catalog_model->get_list();
        $this->data['list_catalog'] = $list_catalog;

        // lay danh sach tin meo vat
        $input_news = array('limit' => array(5,0));
        $list_news = $this->news_model->get_list($input_news);
        $this->data['list_news'] = $list_news;

        // lay danh sach thuc pham lien quan
        $id = $product->catalog_id;
        $catalog = $this->catalog_model->get_info($id);
        if(!$catalog)
        {
            redirect();
        }
        $input = array('limit' => array(4,0));
        if($catalog->parent_id == 0)
        {
            $input_catalog = array('where' => array('parent_id' => $id));
            $catalog_subs = $this->catalog_model->get_list($input_catalog);

            if(!empty($catalog_subs))// neu danh muc hien tai co danh muc con
            {
                $catalog_subs_id = array();
                foreach ($catalog_subs as $sub)
                {
                    $catalog_subs_id[] = $sub->id;
                }
                // lay tat ca san pham thuoc danh muc con do
                $this->db->where_in('catalog_id', $catalog_subs_id);    
            }else {
                // nếu không có danh mục con thì ta lấy trưc tiếp các danh mục thuộc danh mục đó
                  $input['where'] = array('catalog_id' => $id);
            }
        }else{
              $input['where'] = array('catalog_id' => $id);
        }
        $list_lienquan = $this->product_model->get_list($input);
        $this->data['list_lienquan'] = $list_lienquan;

        // load sang view
        $this->data['temp'] = 'site/product/view';
        $this->load->view('site/layout', $this->data);
    }


   /*tìm kiếm theo tên*/
   function search()
   {
     if ($this->uri->rsegment('3') == 1){
            // lấy dữ liệu từ autocomplete
            $key = $this->input->get('term');
        }else {
            $key = $this->input->get('key-search');
        }
        
        // gửi sang bên view
        $this->data['key'] = trim($key);
        $input = array();
        $input['like'] = array('name', $key); 
      
        // lấy ra danh sách thuộc danh mục đó
        // lay tổng số lượng tất cả sản phẩm có trong danh mục đó
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        
        // load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca san pham tren 1 website;
        $config['base_url']     = base_url('product/search/'.$key); // link hien thi ra danh sach san pham
        $config['per_page']   = 50; // so luong hien thi tren 1 trang
        $config['uri_segment']= 4; // phan doan hien thi ra so trang tren url
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';
        // khoi tao phan trang
        $this->pagination->initialize($config);
        
        // lấy phân đoạn là trang hiển thị danh sách san phẩm
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'], $segment );
        
        
        // lưu danh sách tên giống nhau cho tìm kiếm và gửi sang bên view
        $list = $this->product_model->get_list($input);
        $this->data['list']  = $list; 
        
        if ($this->uri->rsegment('3') == 1){
            // xử lý autocomplete
            $result = array();
            foreach ($list as $row){
                $item = array('id' => $row->id, 'label' => $row->name, 'value' => $row->name);
                $result[] = $item;
            }
            //dữ liệu trả về dưới dạng json
            die(json_encode($result));
            
        }else {
            // gửi sang view
            $this->data['temp'] = 'site/product/search';
            $this->load->view('site/layout', $this->data);
        }
   }


   // ham tim kiem theo gia san pham
   function search_price()
   {
    $price_from = intval($this->input->get('price_from'));
    $this->data['price_from'] = $price_from;
    $price_to = intval($this->input->get('price_to'));
    $this->data['price_to'] = $price_to;

    // loc theo gia
    $input = array();
    $input['where'] = array('price >= ' => $price_from, 'price <= ' => $price_to);
    $list = $this->product_model->get_list($input);
    $this->data['list'] = $list;

     // gửi sang view
    $this->data['temp'] = 'site/product/search_price';
    $this->load->view('site/layout', $this->data);
   }



















}
 ?>
