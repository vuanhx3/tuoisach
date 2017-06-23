<!-- head -->
<?php $this->load->view('admin/slidemain/head'); ?>

<div class="wrapper">
        <br>
        <!--  Load thông báo -->
        <?php $this->load->view('admin/message', $this->data); ?>

	<div id="main_product" class="widget">
		<div class="title">
			<img src="<?php echo public_url("admin")?>/images/icons/dark/list.png" class="titleIcon"><h6> Danh sách Slide </h6>
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
								<a href="<?php echo admin_url('slidemain/edit/'.$row1->id); ?>" class="tipS" original-title="Chỉnh sửa">
								<img src="<?php echo public_url("admin")?>/images/icons/color/edit.png"></a>
								
								<a href="<?php echo admin_url('slidemain/delete/'.$row1->id); ?>" class="tipS verify_action" original-title="Xóa">
									<img src="<?php echo public_url("admin")?>/images/icons/color/delete.png">
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
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Slug</a>
                             <input  type="text" readonly="readonly"  value="<?php echo $row1->slug ?>" /> 
                        </div>

                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Vị trí</a>
                             <select  name="sort_order"  >
                                   <option  value="<?php echo $row1->sort_order ?>"> <?php echo $row1->sort_order ?> </option>
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
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Info về slide</a>
                             <input type="text" readonly="readonly"  value="<?php echo $row1->info ?>" /> 
                        </div>

                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-calendar" aria-hidden="true"></i> Đăng / cập nhật</a>
                             <span><?php echo get_date($row1->created); ?></span>
                        </div><div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-user" aria-hidden="true"></i>  Author</a>
                             <span><?php echo $row1->author ?></span>
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
                                        <a href="<?php echo admin_url('slidemain/edit/'.$sub->id); ?>" class="tipS" original-title="Chỉnh sửa">
                                        <img src="<?php echo public_url("admin")?>/images/icons/color/edit.png"></a>
                                        
                                        <a href="<?php echo admin_url('slidemain/delete/'.$sub->id); ?>" class="tipS verify_action" original-title="Xóa">
                                            <img src="<?php echo public_url("admin")?>/images/icons/color/delete.png">
                                        </a>
                                     </div>
                                    </li>
                               </ul>
                            </div><!-- end slide_left -->

                            <div class="slide_right">
                                 <div class="slide_td"> 
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Tên Slide</a>
                                     <input  type="text" readonly="readonly"  value="<?php echo $sub->name ?>" /> 
                                </div>

                                 <div class="slide_td"> 
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Slug</a>
                                     <input  type="text" readonly="readonly"  value="<?php echo $sub->slug ?>" /> 
                                </div>

                                <div class="slide_td">  
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Vị trí</a>
                                     <select  name="sort_order"  >
                                           <option  value="<?php echo $sub->sort_order ?>"> <?php echo $sub->sort_order ?> </option>
                                     </select>
                                </div>

                                <div class="slide_td">  
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Trạng thái </a>
                                     <?php if($sub->anhien > 0): ?>
                                        <span>đang hiện</span>
                                     <?php else: ?>
                                        <span>đang ẩn</span>
                                     <?php endif; ?>
                                </div>

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

                                <div class="slide_td">  
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Info về slide</a>
                                     <input type="text" readonly="readonly"  value="<?php echo $sub->info ?>" /> 
                                </div>

                                <div class="slide_td">  
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-calendar" aria-hidden="true"></i> Đăng / cập nhật</a>
                                     <span><?php echo get_date($sub->created); ?></span>
                                </div><div class="slide_td">    
                                     <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-user" aria-hidden="true"></i>  Author</a>
                                     <span><?php echo $sub->author ?></span>
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