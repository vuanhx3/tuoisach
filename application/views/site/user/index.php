<?php $this->load->view('site/user/head.php', $this->data)?>
<style type="text/css">
  span.alert_register {color: #197D07; font-size: 13px; font-style: italic; margin-top: 3px;}
</style>

 <div class="container">
    <div class="row">

      			<div class="col-lg-12">
              <div class="header_breadcrumb" >
                <ul class="breadcrumbs">
                  <li><a href="<?php echo base_url(); ?>">Trang chủ &nbsp;</a> <i class="fa fa-angle-right" aria-hidden="true"></i></li>
                  <!-- blog -->
                     <li class="active breadcrumb-title">  Thông tin tài khoản  </li>
                </ul>
              </div>   
            </div>

            <!-- phần box thuc pham moi của web ở trang chủ--> 
            <div id="box_register" >

               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                  <div class="style-form">
                    <div class="style-form-group">
                      <h2><span id="info_user">Thông tin cá nhân</span> / <span id="edit_user"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa</span></h2>
                    </div><!-- style-form-group -->

                    <form accept-charset="UTF-8" action="" id="customer_register" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                <?php if(isset($message) && $message): ?>
                                  <div class="hideit" id="dispalay_error">
                                      <p><strong><i class="fa fa-info-circle" aria-hidden="true"></i> THÔNG BÁO: </strong> <?php echo $message ?> </p>
                                  </div>
                                <?php endif; ?>

                                <script language="javascript">
                                  $(document).ready(function(){
                                     $('.hideit').fadeIn(500).delay(1000).fadeOut(500); 
                                  });
                                </script>

	                              <div class="style-form-group">
	                                <label>Họ và tên:</label>
	                                <input  type="text" value="<?php echo $user->name ?>" class="style-form-text" name="name" required="">
                                  <span class="alert_register"></span>
	                              </div>

	                              <div class="style-form-group">
	                                <label>Số điện thoại: <span>*</span></label>
	                                <input type="number" value="<?php echo $user->phone ?>" class="style-form-text" name="phone"  required="">
                                  <span class="alert_register"></span>
	                              </div>
                            </div><!-- end col-lg-6 -->

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                              <div class="style-form-group">
	                                <label>Email: <span>*</span></label>
	                                <input type="email" value="<?php echo $user->email ?>" class="style-form-text" name="email" required="">
                                  <span class="alert_register"></span>
	                              </div>

	                              <div class="style-form-group">
                                  <label>Địa chỉ: <span>*</span></label>
                                  <input type="text" value="<?php echo $user->address ?>" class="style-form-text" name="address" required="">
                                  <span class="alert_register"></span>
                                </div>
                            </div><!-- end col-lg-6 -->
                        </div><!-- end row -->

                        <div class="style-form-group">
                          <a class="style-form-submit" href="<?php echo base_url(); ?>">Quay lại</a>
                        </div>
                    </form>

                    <!-- chinh sua thong tin thanh vien -->
                    <form accept-charset="UTF-8" action="" id="edit_register" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="style-form-group">
                                  <label>Họ và tên:</label>
                                  <input autofocus="autofocus" type="text" value="<?php echo $user->name ?>" class="style-form-text" name="name" required="">
                                  <span class="alert_register"><?php echo form_error('name'); ?></span>
                                </div>

                                <div class="style-form-group">
                                  <label>Số điện thoại: <span>*</span></label>
                                  <input type="number" value="<?php echo $user->phone ?>" class="style-form-text" name="phone"  required="">
                                  <span class="alert_register"><?php echo form_error('phone'); ?></span>
                                </div>

                                <div class="style-form-group">
                                  <label>Địa chỉ: <span>*</span></label>
                                  <input type="text" value="<?php echo $user->address ?>" class="style-form-text" name="address" required="">
                                  <span class="alert_register"><?php echo form_error('address'); ?></span>
                                </div>
                            </div><!-- end col-lg-6 -->

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="style-form-group">
                                  <label>Email: <span>*</span></label>
                                  <input type="email" value="<?php echo $user->email ?>" class="style-form-text" name="email" required="">
                                  <span class="alert_register"><?php echo form_error('email'); ?></span>
                                </div>

                                <div class="style-form-group">
                                  <label>Mật khẩu mới, nếu thay đổi mới nhập: <span>*</span></label>
                                  <input type="password" class="style-form-text" name="password" >
                                  <span class="alert_register"><?php echo form_error('password'); ?></span>
                                </div>

                                <div class="style-form-group">
                                  <label>Nhập Lại Mật khẩu: <span>*</span></label>
                                  <input type="password" class="style-form-text" name="re_password" >
                                  <span class="alert_register"><?php echo form_error('re_password'); ?></span>
                                </div>
                            </div><!-- end col-lg-6 -->
                        </div><!-- end row -->

                        <div class="style-form-group">
                          <button  class="style-form-submit" type="submit">Cập Nhật</button>
                        </div>
                    </form>
                    

                    <script language="javascript">
                      $(document).ready(function(){
                         $('#edit_user').click(function(){
                           $('#customer_register').hide();
                           $('#edit_register').show();
                           $('.breadcrumb-title').html('Cập nhật thông tin');
                         }); 

                         $('#info_user').click(function(){
                           $('#edit_register').hide();
                           $('#customer_register').show();
                           $('.breadcrumb-title').html('Thông tin thành viên');
                         }); 
                      });
                    </script>


                  </div><!-- style-form -->
                </div><!-- end col-lg-12 col-md-12 col-sm-12 col-xs-12 -->

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 transaction">
                  <div class="account-orders-content">

                    <div class="style-form">
                      
                        <section class="cart">
                            <?php foreach($tran_list as $row)
                                {
                                     $user_id = $row->user_id;
                                     $id_tran = $row->id;
                                     $payment = $row->payment;
                                     $status  = $row->status;
                                }
                            ?>

                            <?php if($user_id == $user->id): ?>
                              <p style="margin-bottom: 10px; position: relative; margin-left: 20px;"> <?php echo 'Đơn hàng của bạn'; ?> </p>
                              <div class="cart_page"> 
                                  <div class=" cart_item">
                                        <form action="<?php echo base_url('cart/update'); ?>" method="post">
                                            <div class="col-lg-12">
                                               <div class="form-cart">
                                                  <div class="table-responsive table-cart">
                                                      <table class="table table-bordered">
                                                          <thead>
                                                              <tr>
                                                                <th>Mã đh</th>
                                                                <th>Mã sp</th>
                                                                <th>Hình ảnh</th> 
                                                                <th>Thông tin sản phẩm</th> 
                                                                <th>Đơn giá</th> 
                                                                <th>Số lượng</th> 
                                                                <th>Thành tiền</th> 
                                                              </tr>
                                                          </thead>

                                                          <tbody>
                                                              
                                                           <?php foreach($list_order as $row): ?>
                                                              <?php if($row->transaction_id == $id_tran ): ?>
                                                                <tr>
                                                                  <td class="one"><?php echo $row->id ?></td>
                                                                  <td class="one"><?php echo $row->product_id ?></td>
                                                                  <td class="image_cart">
                                                                      <a><img src="<?php echo $row->image_link?>" alt="<?php echo $row->name?>"></a>

                                                                  </td>
                                                                  <td class="info_cart"> 
                                                                      Mã phiếu: <span class="info_detail"> <?php echo $id_tran ?> </span> /
                                                                      Tên SP: <span class="info_detail" ><?php  echo $row->name ?></span> / cổng giao dịch: <span class="info_detail" ><?php if($payment == 'offline') echo 'Thanh toán tại nhà'; ?></span> / Trạng thái: <span class="info_detail"> 
                                                                        <?php if($status == 0){
                                                                            echo 'Chưa thanh toán';
                                                                          }elseif($status == 1){
                                                                            echo 'Đã thanh toán';
                                                                          }else{
                                                                            echo 'Thanh toán thất bại';
                                                                            } ?>
                                                                       </span>
                                                                  </td>
                                                                  <td class="ten"><?php echo number_format($row->amount) ?> <sup>đ</sup></td>

                                                                  <td class="ten">
                                                                    <span><?php echo $row->qty ?></span>
                                                                  </td>

                                                                  <td class="pay_cart"><?php echo number_format($row->amount); ?> <sup>đ</sup></td>
                                                                </tr>
                                                              <?php endif; ?>
                                                           <?php endforeach; ?>  
                                                          </tbody>
                                                          
                                                      </table>
                                                  </div><!-- end table-responsive -->
                                               </div>
                                            </div><!-- col-lg-12 -->
                                        </form>
                                        
                                  </div><!-- end container -->
                              </div><!-- end cart_page -->
                            <?php else: ?> 
                               <p style="margin-bottom: 20px; position: relative; margin-left: 5px;"> <?php echo 'bạn chưa có đơn hàng nào'; ?> </p>
                            <?php endif; ?>

                          </section>                        
                      <a class="style-form-submit" href="<?php echo base_url(); ?>">Tôi muốn mua hàng</a>
                      
                    </div><!-- style-form -->

                  </div><!-- account-orders-content -->
                </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 transaction -->

            </div><!-- end box_register -->
              
                
        
        </div> <!-- End outer--> 
    </div><!-- end row -->
  </div><!-- end container -->