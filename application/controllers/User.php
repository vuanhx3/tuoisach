<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MY_Controller
{

  // ham khoi tao
	function __construct(){
        parent::__construct();
        // load model user
        $this->load->model('user_model');
        $this->load->model('order_model');
        $this->load->model('transaction_model');
        $this->load->model('product_model');
        $this->load->library('form_validation'); 
        $this->load->helper(array('form','url'));
    }

    /*-----------------------------------------------ham dang ky thanh vien-----------------------------------------------*/
    function register()
    {
      /*kiểm tra nếu thanh viên đã đăng nhập rồi thì ta chuyển đến phàn thông tin tài khoản của thành viên đó*/
      if($this->session->userdata('user_id_login'))
      {
        redirect(site_url('user'));
      }

      // load thong bao
      $message = $this->session->flashdata('message');
      $this->data['message'] = $message;

      // du lieu duoc post len
      if($this->input->post())
      {
        $this->form_validation->set_rules('name', 'Họ và tên', 'required');
        $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|numeric|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
        $this->form_validation->set_rules('address', 'Địa chỉ', 'required');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]|max_length[50]');
        $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'required|matches[password]');

        if($this->form_validation->run())
        {
          $name     = $this->input->post('name');
          $phone    = $this->input->post('phone');
          $email    = $this->input->post('email');
          $address  = $this->input->post('address');
          $password = $this->input->post('password');
          $password = md5($password); 

          $data = array('name' => $name, 'phone' => $phone, 'email' => $email, 'address' => $address,  'password' => $password, 'created' => now());

          if($this->user_model->create($data))
          {
              $this->session->set_flashdata('message', 'Đăng ký thành viên ' . '( ' . $name .' )' . ' thành công!');
              // luu session cho thanh vien sau khi dang ky xong
               $where = array('email' => $email, 'password' => $password);
               $user = $this->user_model->get_info_rule($where);
               $this->session->set_userdata('user_id_login', $user->id);

          }else{
              $this->session->set_flashdata('message', 'Đăng ký thành viên ' . '( ' . $name .' )' . ' không thành công!');
          } 
          redirect(site_url());
        } 

      }
      // load sang view
       $this->data['temp'] = 'site/user/register';
       $this->load->view('site/layout', $this->data);
    }



    /*ham kiem tra email*/
    function check_email()
    {
      $email = $this->input->post('email');
      $where = array('email' => $email);
      if($this->user_model->check_exists($where))
      {
        $this->form_validation->set_message(__FUNCTION__, 'Email này đã tồn tại !');
        return false;
      }
      return true;
    }

    /*------------------------------------------ham hien thi form dang nhap------------------------------------------*/
    function login()
    {
      /*kiểm tra nếu thanh viên đã đăng nhập rồi thì ta chuyển đến phàn thông tin tài khoản của thành viên đó*/
      if($this->session->userdata('user_id_login'))
      {
        redirect(site_url('user'));
      }
      // hien thi form dang nhap sang ben view
       $this->data['temp'] = 'site/user/login';
       $this->load->view('site/layout', $this->data);
    }


    /*ham gui va  nhan xu ly ajax form dang nhap*/
    function submit()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required');

        if($this->form_validation->run() != FALSE)
        {
           $email    = $this->input->post('email');
           $password = $this->input->post('password');
           

           $where = array('email' => $email, 'password' => md5($password));
           $user = $this->user_model->get_info_rule($where);

           if($user != false)
           {
              $data = array("status" => true );
              // luu session thong tin tv dang nhap dung
              $this->session->set_userdata('user_id_login', $user->id);
           }else{
              $data = array("status" => false );
           }

        }else{
            $data =array("status" => 'error_form');
        }

        echo json_encode($data);// trả kết quả trở dang json
        die;
    }


    /*----------------------------------------ham dang xuat----------------------------------------*/
    function logout()
    {
      if($this->session->userdata('user_id_login'))
      {
          $this->session->unset_userdata('user_id_login');
      }
      redirect();
    }


    /*-------------------------------------ham hien thi thong tin / chinh sua thanh vien-------------------------------------*/
    function index()
    {

      $message = $this->session->flashdata('message');
      $this->data['message'] = $message;

      // kiem tra thanh vien da dang nhap chua
      if(!$this->session->userdata('user_id_login'))
      {
        redirect(site_url('user/login'));
      }

      // con da dang nhap r thi lay thong tin
      $user_id = $this->session->userdata('user_id_login');
      $user = $this->user_model->get_info($user_id);

      if(!$user)
      {
        redirect();
      }
      $this->data['user'] = $user;


      // cap nhat thong tin thanh viem
      if($this->input->post())
      {
        $this->form_validation->set_rules('name', 'Họ và tên', 'required');
        $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|numeric|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_index');
        $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

        $password = $this->input->post('password');
        if($password)
        {
             $this->form_validation->set_rules('password', 'Mật khẩu', 'required|trim|min_length[6]|max_length[50]');
             $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'required|matches[password]');
        }
        if($this->form_validation->run())
        {
          $name    = $this->input->post('name');
          $email   = $this->input->post('email');
          $phone   = $this->input->post('phone');
          $address = $this->input->post('address');

          $data = array('name' => $name, 'email' => $email, 'phone' => $phone, 'address' => $address);
          $password = md5($password);
          if($password)
          {
            $data['password'] = $password;
          }

         if ($this->user_model->update($user_id, $data))
          {
             $this->session->set_flashdata('message', 'Chỉnh sửa thành viên ' . '( ' . $name .' )' . ' thành công');
          }else {
             $this->session->set_flashdata('message', 'Chỉnh sửa thành viên ' . '( ' . $name .' )' . ' không thành công');
          }
          redirect(site_url('user'));
        }
      }

      // hien thi don hang cua thanh vien
      $list_order = $this->order_model->get_list();
      $this->data['list_order'] = $list_order;

      // lay danh sach giao dich
      $tran_list = $this->transaction_model->get_list();
      $this->data['tran_list'] = $tran_list;
                                                
      $this->data['temp'] = 'site/user/index';
      $this->load->view('site/layout', $this->data);
    }


    /*ham kiem tra email edit*/
    function check_email_index()
    {
      $action = $this->uri->rsegment(1);
      $email = $this->input->post('email');
      $where = array('email' => $email);

      // dat bien co
      $check = true;
      if($action == 'user')
      {
         $user_id = $this->session->userdata('user_id_login');
         $user = $this->user_model->get_info($user_id);

         if($user->email == $email )
         {
           $check = false;
         }
      }

      // kiem tra ton tai cua email
      if($check && $this->user_model->check_exists($where))
      {
          $this->form_validation->set_message(__FUNCTION__, 'Tài khoản ' . $email . ' đã tồn tại !');
          return FALSE;
      }
      return TRUE;

    }


    /*-------------------------------------ham chinh sua thong tin thanh vien-------------------------------------*/
  



    













}

 ?>