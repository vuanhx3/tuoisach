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
                     <li class="active breadcrumb-title"> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; Đăng nhập </li>
                </ul>
              </div>   
            </div>

             <!-- phần box thuc pham moi của web ở trang chủ--> 
            <div id="box_register" >
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="style-form">
                      <div class="style-form-group">
                        <h2>Thông tin cá nhân</h2>
                      </div>
                      <form accept-charset="UTF-8" action="" id="customer_login" method="post">
                          <div id="alert_login">
                            <!-- thong bao loi dang nhap -->
                          </div>

                          <div class="style-form-group">
                            <label>Email: <span>*</span></label>
                            <input type="text" id="email" class="style-form-text" name="email" required="">
                          </div>
                          <div class="style-form-group">
                            <label>Mật khẩu: <span>*</span></label>
                            <input type="password" id="password" class="style-form-text" name="password" required="">
                          </div>
                          <div class="style-form-group">
                            <a class="form-link" href="javascript:void(0)" onclick="showRecovery()">Bạn quên mật khẩu</a>
                          </div>
                          <div class="style-form-group">
                            <button class="style-form-submit" id="submit" type="button">Đăng nhập</button>
                          </div>
                      </form>
                      
                    </div><!-- end style-form -->
                </div><!-- box-1 -->

                  <script language="javascript">
                    $(document).ready(function(){
                       $('#submit').click(function(){
                           var email    = $('#email ').val();
                           var password = $('#password').val();
                            
                           $.ajax({
                              url: "<?php echo site_url('user/submit') ?>",
                              type:"post",
                              data:{'email':email, 'password':password},
                              dataType: "json",
                              success:function(data)
                              {
                                var html = "";

                                if(data['status'] == true){
                                  html+= '<div id="dispalay_error">';
                                  html+=' <i class="fa fa-info-circle" aria-hidden="true"></i> Bạn đã đăng nhập thành công';
                                  html+='</div>';
                                   $("#alert_login").html(html);
                                   window.location.replace("<?php echo site_url('user') ?>");
                                }

                                if(data['status'] == false){
                                  //lỗi sau khi kiểm tra dữ liêu trong data
                                  html+= '<div id="dispalay_error">';
                                  html+=' <i class="fa fa-info-circle" aria-hidden="true"></i>  Tên tài khoản hoặc mật khẩu không đúng';
                                  html+='</div>';
                                   $("#alert_login").html(html);
                                }

                                if(data['status'] == "error_form"){
                                  html+= '<div id="dispalay_error">';
                                  html+=' <i class="fa fa-info-circle" aria-hidden="true"></i> Bạn cần nhập đầy đủ các trường'; 
                                  html+='</div>';
                                 $("#alert_login").html(html);  
                               }  

                              }
                           });
                       });
                    });
                  </script> 

                   <script language="javascript">
                      $(document).ready(function(){
                          $("#alert_login").click(function()
                          {
                            $(this).fadeOut();
                          }); 
                      });
                    </script>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="style-form" id="info-form" style="display: block;">
                        <div class="style-form-group">
                          <h2>Bạn chưa có tài khoản</h2>
                        </div>
                        <div class="style-form-group">
                          <p>Đăng ký tài khoản ngay để có thể mua hàng nhanh chóng và dễ dàng hơn  ! Ngoài ra còn có rất nhiều chính sách và ưu đãi cho các thành viên</p>
                        </div>
                        <div class="style-form-group">
                          <a href="<?php echo site_url('user/register')?>" class="style-form-submit">Đăng ký</a>
                        </div>
                    </div><!-- end style-form-group -->

                    <div class="style-form" id="recovery-form" style="display: none;">
                        <form accept-charset="UTF-8" action="" id="recover_customer_password" method="post">
                            <input name="FormType" type="hidden" value="recover_customer_password">
                            <input name="utf8" type="hidden" value="true">
                            <div class="style-form-group">
                              <h2>Quên mật khẩu</h2>
                            </div>
                            <div class="style-form-group">
                              <p>Hãy điền Email xuống phía dưới và nhận thông tin qua Email để có thể lấy lại mật khẩu.</p>
                            </div>
                            
                            <div class="style-form-group">
                              <label>Email: <span>*</span></label>
                              <input type="email" class="style-form-text" name="Email" required="">
                            </div>
                            <div class="style-form-group">
                              <button class="style-form-submit" type="submit">Gửi thông tin</button>
                              <a class="style-form-submit" onclick="showRecovery()">Hủy</a>
                            </div>
                        </form>
                    </div><!-- end style-form -->

                    <script language="javascript">
                      function showRecovery() {
                        $("#info-form").toggle();
                        $("#recovery-form").toggle();
                      }
                    </script>
                </div><!-- box-1 -->
            </div><!-- end box_register -->
              
                
        
        </div> <!-- End outer--> 
    </div><!-- end row -->
  </div><!-- end container -->