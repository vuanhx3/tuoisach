<!-- head -->
<?php $this->load->view('admin/banner_thucpham/head'); ?>

<div class="wrapper">
        <br>
        <!--  Load thông báo -->
        <?php $this->load->view('admin/message', $this->data); ?>

	<div id="main_product" class="widget">
		<div class="title">
			<img src="<?php echo public_url("admin")?>/images/icons/dark/list.png" class="titleIcon"><h6> Danh sách Banner TP <span style="color: #197D07;">(* tối đa là 5 Banner *)</span> </h6>
			<div class="num f12">
                Số lượng: <b> <?php echo count($list); ?> Slide </b>
            </div>
		</div>

		 <ul class="tabs">
            <li class="activeTab"><a href="#tab0">Slide All</a></li>
            <!-- các slide con -->
			<?php foreach($list_catalog_title as $row): ?>
             	<li class=""><a href="#tab<?php echo $row->id ?>"> slide <?php echo $row->name ?> </a></li>
            <?php endforeach; ?>	
        </ul>
		
		<div class="tab_container">
		 <!-- tab 0 cua slide main -->
			<div class="tab_content pd0" id="tab0" style="display: block;">
				<div class="gallery">
				  <?php foreach($list as $row1): ?>	
                   <div class="box_slide">
                   	  <div class="slide_left">
                    	 <ul>
	                        <li id="1">
	                         <a class="lightbox cboxElement" title="<?php echo $row1->name ?>" href="<?php echo $row1->image_link ?>">
							     <img src="<?php echo $row1->image_link ?>" width="100%" height="210px">
							 </a>
	                    
		                     <div class="actions" style="display: none;">
								<a href="<?php echo admin_url('banner_thucpham/edit/'.$row1->id); ?>" class="tipS" original-title="Chỉnh sửa">
								<img src="<?php echo public_url("admin")?>/images/icons/color/edit.png"></a>
								</a>
		                     </div>
	                        </li>
                       </ul>
                    </div><!-- end slide_left -->

                    <div class="slide_right">
                    	 <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Tên Slide</a>
                             <input  type="text" readonly="readonly"  value="<?php echo $row1->name ?>" /> 
                        </div>


                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Vị trí</a>
                             <select  name="sort_order"  >
                                   <option  value="<?php echo $row1->vitri ?>"> <?php echo $row1->vitri ?> </option>
                             </select>
                        </div>

                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Trạng thái </a>
                    	   	 <?php if($row1->anhien > 0): ?>
                                <span>đang hiện</span>
	                         <?php else: ?>
	                         	<span>đang ẩn</span>
	                         <?php endif; ?>
                        </div>

                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Thuộc thể loại</a>
                             <select name="sort_order"  >
                             	<?php foreach($list_catalog as $sub): ?>
                             		<?php if($row1->catalog_id == $sub->id ): ?>
                                   		<option value="<?php echo $sub->name ?>"> <?php echo $sub->name ?> </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>   
                             </select>
                        </div>
                        

                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-calendar" aria-hidden="true"></i> Đăng / cập nhật</a>
                             <span><?php echo get_date($row1->created); ?></span>
                        </div><div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-user" aria-hidden="true"></i>  Author</a>
                             <span><?php echo $row1->admin_add ?></span>
                        </div>
                    </div><!-- end slide_right -->
                   </div><!-- end box-slide --> 
                   <div class="clear" style="height:20px"></div>
				<?php endforeach;?>
        	 </div><!-- end gallery -->	    
			</div>
		<!-- tab0 cua slide main -->

		
		<!-- tab con -->
        <?php foreach($list as $row): ?>
			<div class="tab_content pd0" id="tab<?php echo $row->catalog_id?>" style="display: none;">
				<div class="gallery">
                      <?php if(count($row->sub) > 0): ?>
                       <?php foreach($row->sub as $sub): ?>    
                           <div class="box_slide">
                              <div class="slide_left">
                                 <ul>
                                    <li id="1">
                                     <a class="lightbox cboxElement" title="<?php echo $sub->name ?>" href="<?php echo $sub->image_link ?>">
                                         <img src="<?php echo $sub->image_link ?>" width="100%" height="210px">
                                     </a>
                                
                                     <div class="actions" style="display: none;">
                                        <a href="<?php echo admin_url('banner_thucpham/edit/'.$sub->id); ?>" class="tipS" original-title="Chỉnh sửa">
                                        <img src="<?php echo public_url("admin")?>/images/icons/color/edit.png"></a>
                                     </div>
                                    </li>
                               </ul>
                            </div><!-- end slide_left -->

                            <div class="slide_right">
                               <!-- truong ten slide -->
                                <div class="slide_td"> 
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Tên Slide</a>
                                     <input  type="text" readonly="readonly"  value="<?php echo $sub->name ?>" /> 
                                </div>

                                <!-- truong vi tri -->
                                <div class="slide_td">  
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Vị trí</a>
                                     <select  name="sort_order"  >
                                           <option  value="<?php echo $sub->vitri ?>"> <?php echo $sub->vitri ?> </option>
                                     </select>
                                </div>
                                
                                <!-- truong trang thai -->
                                <div class="slide_td">  
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Trạng thái </a>
                                     <?php if($sub->anhien > 0): ?>
                                        <span>đang hiện</span>
                                     <?php else: ?>
                                        <span>đang ẩn</span>
                                     <?php endif; ?>
                                </div>
                                
                                <!-- truong the loai -->
                                <div class="slide_td">  
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Thuộc thể loại</a>
                                     <select name="sort_order"  >
                                        <?php foreach($list_catalog as $sub_ct): ?>
                                            <?php if($sub->catalog_id == $sub_ct->id ): ?>
                                                <option value="<?php echo $sub_ct->name ?>"> <?php echo $sub_ct->name ?> </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>   
                                     </select>
                                </div>
                                
                                <!-- truong cap nhat -->
                                <div class="slide_td">  
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-calendar" aria-hidden="true"></i> Đăng / cập nhật</a>
                                     <span><?php echo get_date($sub->created); ?></span>
                                </div><div class="slide_td">    
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-user" aria-hidden="true"></i>  Author</a>
                                     <span><?php echo $sub->admin_add ?></span>
                                </div>
                            </div><!-- end slide_right -->
                         </div><!-- end box-slide --> 
                       <div class="clear" style="height:20px"></div>
                    <?php endforeach; ?>
                    <?php endif;?>
        	   </div><!-- end gallery -->	
			</div><!-- tab_content -->
         <?php endforeach; ?>   
		<!-- tab con -->
               
			
	    	

		</div><!-- end tab_container -->
	</div><!-- end widget -->
</div>