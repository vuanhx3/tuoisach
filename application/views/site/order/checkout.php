<?php $this->load->view('site/order/head.php', $this->data)?>
 <form class="form-payment" action="<?php echo site_url('order/checkout')?>" method="post" enctype="multipart/form-data">
          <div class="header-checkout">
              <div class="wrap">
                  <div class="shop-logo ">
                      <a href="<?php echo base_url(); ?>">
                          <img class="logo__image " alt="<?php echo $homepage->site_desc ?>" src="<?php echo $homepage->image_link ?>">
                      </a>
                  </div>
              </div><!-- end wrap -->
          </div><!-- end header-checkout -->

          <div class="main_checkout">
             <div class="row">

                <div class="col-md-4 col-sm-12 customer_info">
                   <div class="form-group">
                     <h2>Thông tin mua hàng</h2>
                   </div><!-- end form_group -->

				         <?php if(isset($user_info)): ?>	
                   <?php echo ''; ?>
                 <?php else: ?>
				         	 <div class="form-group">
                     <a style="color: #2a9dcc!important;" href="<?php echo base_url('user/register') ?>">Đăng ký tài khoản mua hàng</a>
                     <span style="padding: 0px 5px;"> / </span>
                     <a style="color: #2a9dcc!important;" href="<?php echo base_url('user/login') ?>">Đăng nhập</a>
                   </div><!-- end form-group -->	
                 <?php endif; ?>  

                   <hr class="divider">

                   

                   

                   <div class="billing">
                          <div class="form-group">
                              <a style="color: #2a9dcc!important; cursor: pointer;" >Thông tin thanh toán và nhận hàng</a>
                          </div><!-- end form-group -->

                          <div class="form-group has-error">
                            <input type="email" class="form-control" value="<?php echo isset($user->email) ? $user->email : '' ?>" name="email" placeholder="Email" required >

                             <div class="help-block with-errors">
                                <ul class="list-unstyled">
                                  <li> <?php echo form_error('email'); ?> </li>
                                </ul>
                             </div><!-- has-error -->
                         </div><!-- end form-group -->

                          <!-- truong ho va ten -->
                          <div class="form-group has-error">
                              <input type="text" class="form-control" value="<?php echo isset($user->name) ? $user->name : '' ?>" name="name" placeholder="Họ và tên" required >

                              <div class="help-block with-errors">
                                <ul class="list-unstyled">
                                  <li> <?php echo form_error('name'); ?> </li>
                                </ul>
                              </div><!-- has-error -->
                          </div><!-- end form-group -->
                          

                          <!-- truong so dien thoai -->
                          <div class="form-group has-error">
                              <input type="text" value="<?php echo isset($user->phone) ? $user->phone : '' ?>"  name="phone" id="phone-transaction" class="form-control" placeholder="Số điện thoại" required="">

                              <div class="help-block with-errors">
                                <ul class="list-unstyled">
                                  <li> <?php echo form_error('phone'); ?> </li>
                                </ul>
                              </div><!-- has-error -->
                          </div>


                          <!-- truong chon tinh thanh -->
                          <div class="form-group has-error">
                              <div class="next-select__wrapper">
                                  <select id="tinh"  name="tinh" class="form-control next-select" required="" >
                                      <option value="">--- Chọn Tỉnh thành ---</option>
                                      <?php foreach($list_tinh as $row): ?>
                                        <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                                      <?php endforeach; ?>
                                  </select>
                              </div><!-- next-select__wrapper -->

                              <div class="help-block with-errors">
                                 <ul class="list-unstyled">
                                   <li> <?php echo form_error('tinh'); ?> </li>
                                 </ul>
                              </div><!-- help-block with-errors -->
                          </div>

                          <script language="javascript">
                            $(document).ready(function(){
                               $("#tinh").change(function(){
                                  var id = $(this).val();
                                  $.ajax({
                                    url:"<?php echo base_url(); ?>order/huyen",
                                    method:"POST",
                                    data:{
                                      idTinh:id
                                    },
                                    cache:false,
                                    success: function(data)
                                    {
                                      $('#huyen').html(data);
                                    }
                                  });
                               });
                            });
                          </script>

                          <!-- script khong cho nhap string vao truong do dien thoai -->
                          <script language="javascript">
                              // doan code khong cho nhap string  
                              $(document).ready(function(){
                                  $("#phone-transaction").keydown(function (e) {
                                   // Allow: backspace, delete, tab, escape, enter and .
                                   if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                     // Allow: Ctrl+A, Command+A
                                     (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
                                     // Allow: home, end, left, right, down, up
                                     (e.keyCode >= 35 && e.keyCode <= 40)) {
                                     // let it happen, don't do anything
                                     return;
                                   }
                                   // Ensure that it is a number and stop the keypress
                                   if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                     e.preventDefault();
                                   }
                                   if(isNaN($(".product__quantity input").val())) {
                                     $(".product__quantity input").val(1); 
                                   }
                                 });
                                
                              });
                          </script>

                          <!-- truong chon huyen -->
                          <div class="form-group has-error">
                              <div class="next-select__wrapper">
                                  <select id="huyen" name="huyen" class="form-control next-select " required=""  >
                                      <option value="">--- Chọn quận huyện ---</option>
                                  </select>
                              </div><!-- next-select__wrapper -->

                              <div class="help-block with-errors">
                                 <ul class="list-unstyled">
                                   <li> <?php echo form_error('huyen'); ?> </li>
                                 </ul>
                              </div><!-- help-block with-errors -->
                          </div><!-- end form-group -->
                          
                          <div class="form-group">
                              <textarea name="note" value="" class="form-control" placeholder="Ghi chú"><?php echo set_value('note'); ?></textarea>
                          </div><!-- end form-group -->   
                   </div><!-- end billing -->
                </div><!-- col-md-4 col-sm-12 -->


                <div class="col-md-4 col-sm-12">
                   <div class="shipping">
                      <div class="form-group">
                          <h2>
                            <label style="margin-bottom:15px;" class="control-label">Vận chuyển</label>
                          </h2>
                          <div class="next-select__wrapper">
                             <select class="form-control next-select" name="shipping" > 
                                <option value="">Giao hàng tận nơi - 40.000₫ / 30km trở đi</option>
                             </select> 
                          </div>
                      </div><!-- end form-group -->
                   </div><!-- end shipping -->

                    <div class="form-group payment-method has-error">
                        <h2>
                          <label style="margin-bottom:15px;" class="control-label">Thanh toán</label>
                        </h2>

                        <div class="next-select__wrapper">
                          <div class="form-item">
                              <select class="form-control next-select" name="payment" required>
                                 <option value="">----- Chọn cổng thanh toán -----</option>
                                 <option value="offline">Thanh toán khi nhận hàng</option>
                                 <option value="baokim">Bảo Kim</option>
                                 <option value="nganluong">Ngân Lượng</option>
                              </select>
                              <div class="image-payment">
                                  <img src="http://localhost/webfood/public/site/images/payment/baokim.png" alt="Bảo kim">
                                  <img src="http://localhost/webfood/public/site/images/payment/nganluong.png" alt="Ngân lượng">
                              </div>
                              <div class="error" id="payment_error"></div>
                          </div><!-- end fomr-item -->  
                        </div><!-- end next-select__wrapper -->
                   </div><!-- end form-group -->
                </div><!-- col-md-4 col-sm-12 -->


                <div class="col-md-4 col-sm-12 order_info">
                   <div class="order-summary">
                      <div class="order-header">
                          <h2>
                            <label class="control-label" >Đơn hàng</label>
                            <label class="control-label" >(<?php echo $total_items ?>)</label>
                          </h2>
                      </div><!-- end order-header -->

                      <div class="order-items">
                           <div class="summary-body">
                              <div class="summary-product-list">
                                  <ul class="product_list">
                                    <?php foreach($carts as $row): ?>
                                        <li class="product product-has-image clearfix">
                                            <div class="product-thumbnail pull-left">
                                                <div class="product-thumbnail__wrapper">
                                                   <img src="<?php echo $row['image_link'] ?>" alt="<?php echo $row['name'] ?>" class="product-thumbnail__image">
                                                </div>
                                                <span class="product-thumbnail__quantity" aria-hidden="true"><?php echo $row['qty'] ?></span>
                                            </div>

                                            <div class="product-info pull-left">
                                                <span class="product-info-name">
                                                    <strong><?php echo $row['name'] ?></strong>
                                                </span>
                                            </div>

                                            <strong class="product-price pull-right">
                                               <?php echo number_format($row['subtotal']) ?> <sup>đ</sup>
                                            </strong>
                                        </li>
                                    <?php endforeach; ?>
                                  </ul>
                              </div><!-- summary-product-list -->
                           </div><!-- summary-body --> 

                            <div class="summary-section">
                               <a style="color: #2a9dcc;" href="javascript:void(0)" class="more" > Nhập mã giảm giá </a>

                               <div class="form-group hide-code">
                                  <div class="input-group">
                                    <input  name="code" type="text" class="form-control" placeholder="Nhập mã giảm giá">
                                    <span class="input-group-btn">
                                        <button bind-event-click="caculateShippingFee()" class="btn btn-primary event-voucher-apply" type="button">Áp dụng</button>
                                    </span>
                                  </div><!-- input-group -->
                               </div><!-- end form-group -->
                            </div><!-- end summary-section -->   
                      </div> <!-- order-items --> 


                      <div class="summary-section">
                          <div class="total_line total_subtotal clearfix">
                               <span class="total-line-name pull-left">
                                  Tạm tính
                               </span>   

                               <span class="total-line-subprice pull-right"> <?php echo number_format($total_amount); ?> <sup>đ</sup> </span>
                          </div><!-- total_line -->

                          <div class="total_line total_shipping clearfix">
                               <span class="total-line-name pull-left">
                                  Phí vận chuyển
                               </span>   
                              
                               <?php $price_ship = 40000; ?>
                               <span class="total-line-subprice pull-right"><?php echo number_format($price_ship) ?> <sup>đ</sup></span>
                          </div><!-- total_line -->

                          <div class="total-line-total clearfix">
                              <span class="total-line-name pull-left">Tổng cộng</span>
                              <span class="total-line-price pull-right"> <?php echo number_format(($total_amount + $price_ship))   ?> <sup>đ</sup> </span>
                          </div><!-- total-line-total -->    
                      </div><!-- summary-section -->

                   </div><!-- end order-summary -->


                  <div class="form-group clearfix">
                     <input type="submit" class="btn btn-primary col-md-12 mt10 btn-checkout" value="Thanh toán" name="submit">
                  </div>

                </div><!-- col-md-4 col-sm-12 order_info -->
             </div>
          </div><!-- end main_checkout -->

          <div class="trim_main"></div>
 </form> 