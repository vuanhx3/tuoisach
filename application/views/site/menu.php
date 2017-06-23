      <div class="menu_bar">
        <a class="bt-menu"><span class="fa fa-bars"></span>Menu</a>
      </div>
      
      <nav class="wp_nav clearfix nav_menu">
        <ul>
           <li class="active index-li"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> TRANG CHỦ </a></li>

            <li class="#"><a href="<?php echo site_url('safety'); ?>"> AN TOÀN THỰC PHẨM</a></li>

            <li class=""><a href="<?php echo site_url('news'); ?>"> MẸO &amp; KĨ NĂNG</a></li>  

            <li class="submenu1">
               <a href="#"> THỰC PHẨM </a>
               <ul class="children1">
                  <?php foreach($catalog_list as $row): ?>
                    <?php
                      $name = str_slug($row->name);
                      $name = strtolower($name); 
                    ?>
                      <li>
                         <a href="<?php echo base_url($name.'-c'.$row->id.'.html') ?>">
                           <img style="width: 20px; height:20px; margin-right: 5px;" src="<?php echo $row->image_link ?>" ><?php echo $row->name ?>
                         </a>
                      </li>
                   <?php endforeach; ?> 
               </ul>
            </li>

            <li class="submenu1">
               <a href="#"> MÓN NGON </a>
               <ul class="children1">
                     <li> <a href="#">Thịt bò <span class="fa fa-angle-right"></span></a> </li>
                     <li><a href="#">Thịt lợn<span class="fa fa-angle-right"></span></a></li>
                     <li><a href="#">Mẹo vặt<span class="fa fa-angle-right"></span></a></li>
               </ul>
            </li>


            <li class=""><a href="&lt;?php echo site_url('partner'); ?&gt;"> ĐƠN VỊ ĐỐI TÁC</a></li>

          </ul>
      </nav>

       <!-- <script language="javascript">
         $(document).ready(function(){
           // kiem tra xem nav cach top la bao nhieu
            var navOffset = $('.nav_menu').offset().top;

           $(window).scroll(function(){
               var numscroll = $(window).scrollTop();

               if(numscroll >= navOffset)
               {
                 $('.nav_menu').addClass('fixed');
               }else{
                 $('.nav_menu').removeClass('fixed');
               }
           }); 
         });
      </script> -->
