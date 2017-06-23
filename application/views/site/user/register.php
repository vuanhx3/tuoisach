<?php $this->load->view('site/user/head.php', $this->data)?>
<style type="text/css">
  span.alert_register {color: #197D07; font-size: 13px; font-style: italic; margin-top: 3px;}
</style>

 <div class="container">
    <div class="row">

      			<div class="col-lg-12">
              <div class="header_breadcrumb" >
                <ul class="breadcrumbs">
                  <li><a href="/">Trang chủ</a></li>
                  <!-- blog -->
                     <li class="active breadcrumb-title"> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; Đăng ký</li>
                </ul>
              </div>   
            </div>

            <!-- phần box thuc pham moi của web ở trang chủ--> 
            <div id="box_register" >
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                  <div class="style-form">
                    <div class="style-form-group">
                      <h2>Thông tin cá nhân</h2>
                    </div><!-- style-form-group -->

                    <form accept-charset="UTF-8" action="" id="customer_register" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                              <div class="style-form-group">
	                                <label>Họ và tên:</label>
	                                <input autofocus="autofocus" type="text" value="<?php echo set_value('name') ?>" class="style-form-text" name="name" required="">
                                  <span class="alert_register"><?php echo form_error('name'); ?></span>
	                              </div>

	                              <div class="style-form-group">
	                                <label>Số điện thoại: <span>*</span></label>
	                                <input type="number" value="<?php echo set_value('phone') ?>" class="style-form-text" name="phone"  required="">
                                  <span class="alert_register"><?php echo form_error('phone'); ?></span>
	                              </div>

                                <div class="style-form-group">
                                  <label>Địa chỉ: <span>*</span></label>
                                  <input type="text" value="<?php echo set_value('address') ?>" class="style-form-text" name="address" required="">
                                  <span class="alert_register"><?php echo form_error('address'); ?></span>
                                </div>
                            </div><!-- end col-lg-6 -->

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                              <div class="style-form-group">
                                  <label>Email: <span>*</span></label>
                                  <input type="email" value="<?php echo set_value('email') ?>" class="style-form-text" name="email" required="">
                                  <span class="alert_register"><?php echo form_error('email'); ?></span>
                                </div>

	                              <div class="style-form-group">
	                                <label>Mật khẩu: <span>*</span></label>
	                                <input type="password" class="style-form-text" name="password" required="">
                                  <span class="alert_register"><?php echo form_error('password'); ?></span>
	                              </div>

	                              <div class="style-form-group">
	                                <label>Nhập Lại Mật khẩu: <span>*</span></label>
	                                <input type="password" class="style-form-text" name="re_password" required="">
                                  <span class="alert_register"><?php echo form_error('re_password'); ?></span>
	                              </div>
                            </div><!-- end col-lg-6 -->
                        </div><!-- end row -->

                        <div class="style-form-group">
                          <a class="style-form-submit" href="<?php echo base_url(); ?>">Quay lại</a>
                          <button  class="style-form-submit" type="submit">Đăng ký</button>
                        </div>
                    </form>
                  </div><!-- style-form -->
                </div>
            </div><!-- end box_sanphammoi -->
              
                
        
        </div> <!-- End outer--> 
    </div><!-- end row -->
  </div><!-- end container -->