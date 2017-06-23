<?php $this->load->view('site/cart/head.php', $this->data)?>

<div class="col-lg-12">
  <div class="header_breadcrumb" >
    <ul class="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
      <!-- blog -->
      <li class="active breadcrumb-title"> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; Giỏ hàng </li>
    </ul>
  </div>   
</div>

<section class="cart">
    <?php if($total_items > 0): ?>
        <div class="cart_page"> 
            <div class="container cart_item">
               <div class="row">
                  <form action="<?php echo base_url('cart/update'); ?>" method="post">
                      <div class="col-lg-12">
                         <div class="form-cart">
                            <div class="table-responsive table-cart">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Hình ảnh</th> 
                                          <th>Thông tin sản phẩm</th> 
                                          <th>Đơn giá</th> 
                                          <th>Số lượng</th> 
                                          <th>Thành tiền</th> 
                                          <th>Xóa</th> 
                                        </tr>
                                    </thead>

                                    <tbody>
                                     <?php $total_amount = 0; ?>
                                     <?php foreach($carts as $row): ?>
                                      <?php $name = $row['slug']  ?>
                                      <?php $total_amount = $total_amount + $row['subtotal']; ?>
                                        <tr>
                                          <td class="one"><?php echo $row['id'] ?></td>
                                          <td class="image_cart">
                                              <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row["id"].'.html'); ?>"><img src="<?php echo $row['image_link'] ?>" alt="<?php echo $row['name'] ?>"></a>
                                          </td>
                                          <td class="info_cart"><?php echo $row['name'] ?></td>
                                          <td class="ten"><?php echo number_format($row["price"]) ?> <sup>đ</sup></td>
                                          <td class="ten">
                                            <input type="text" class="cart-quantity" value="<?php echo $row['qty'] ?>" name="qty_<?php echo $row['id']?>" maxlength="3" size="5" >
                                          </td>
                                          <td class="info_cart"><?php echo number_format($row['subtotal']); ?> <sup>đ</sup></td>
                                          <td class="ten"><a href="<?php echo base_url('cart/del/'.$row['id']); ?>" class="del_item" >xóa</a></td>
                                        </tr>
                                     <?php endforeach; ?>  
                                    </tbody>
                                    
                                    <script language="javascript">
                                      $(document).ready(function(){
                                        $(".remove_item").click(function(){
                                           var row_id = $(this).attr("id");
                                            // xu ly ajax
                                            $.ajax({
                                              url : "<?php echo base_url();?>cart/remove",
                                              method: "POST",
                                              data:{
                                                row_id:row_id
                                              },
                                              cache:false,
                                              success: function(data)
                                              {
                                                $('.cart_page').html(data);
                                              }
                                            });

                                            // $.ajax({
                                            //   url:"<?php echo base_url(); ?>cart/qty_cart",
                                            //   cache:false,
                                            //   success: function(result)
                                            //   {
                                            //     $('.abc').html(result);
                                            //   }
                                            // });
                                        });
                                      });
                                    </script>
                                    
                                    <!-- doan scrip khong cho nhap chu vao o nhập số lượng -->
                                    <script>
                                        $(".cart-quantity").keydown(function (e) {
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
                                          if(isNaN($(".cart-quantity").val())) {
                                            $(".cart-quantity").val(1); 
                                          }
                                        });
                                      </script>

                                </table>
                            </div><!-- end table-responsive -->
                         </div>
                      </div><!-- col-lg-12 -->

                      <div class="col-lg-8">
                        <div class="form-cart-button">
                            <div>
                              <a href="<?php echo base_url(); ?>" class="btn-cart">Tiếp tục mua hàng</a>
                              <button type="submit" class="btn-cart" >Cập nhật</button>
                            </div> 
                        </div><!-- form-cart-button -->
                      </div><!-- col-lg-8 -->
                  </form>
                  
                  <div class="col-lg-4">
                      <div class="table-total">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <td class="text-right">Tổng tiền phải thanh toán: </td>
                              <td><?php echo number_format($total_amount) ?> <sup>đ</sup></td>
                            </tr>
                          </tbody>
                        </table>
                      </div><!-- end table-total -->
                      <a href="<?php echo site_url('order/checkout') ?>" class="pull-right btn-cart">Thanh toán</a>
                  </div><!-- end col-lg-4 -->

               </div><!-- end row --> 
            </div><!-- end container -->
        </div><!-- end cart_page -->
      <?php else: ?>
        <div id="notify_error_cart">
          <h3 style="color: #37474f;"> Không có sản phẩm nào trong giỏ hàng ! - <a href="<?php echo base_url(); ?>" style="color: #69BD43;">Tiếp tục mua hàng</a></h3> 
        </div>
      <?php endif; ?>
    </section>