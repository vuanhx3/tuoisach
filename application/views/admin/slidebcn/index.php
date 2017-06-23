<!-- head -->
<?php $this->load->view('admin/slidebcn/head'); ?>

<div class="wrapper">
    <br>
    <!--  Load thông báo -->
    <?php $this->load->view('admin/message', $this->data); ?>

	<div id="main_product" class="widget">
		<div class="title">
			<img src="<?php echo public_url("admin")?>/images/icons/dark/list.png" class="titleIcon"><h6> Danh sách Slide </h6>
			<div class="num f12">
                Số lượng: <b> <?php echo count($list);?> Slide </b>
            </div>
		</div>

		 <ul class="tabs">
            <li class="activeTab"><a href="#tab0">Slide All</a></li>
        </ul>
		
		<div class="tab_container">

		 <!-- tab 0 cua slide main -->
			<div class="tab_content pd0" id="tab0" style="display: block;">
				<div class="gallery">
				  <?php foreach($list as $row): ?>	
                   <div class="box_slide">
                   	  <div class="slide_left">
                    	 <ul>
	                        <li id="1">
	                          <a class="lightbox cboxElement" title="<?php echo $row->name ?>" href="<?php echo $row->image_link ?>">
							     <img src="<?php echo $row->image_link ?>" width="100%" height="210px">
							  </a>
	                    
		                     <div class="actions" style="display: none;">
								<a href="<?php echo admin_url('slidebcn/edit/'.$row->id); ?>" class="tipS" original-title="Chỉnh sửa">
								<img src="<?php echo public_url("admin")?>/images/icons/color/edit.png"></a>
								
								<a href="<?php echo admin_url('slidebcn/delete/'.$row->id); ?>" class="tipS verify_action" original-title="Xóa">
									<img src="<?php echo public_url("admin")?>/images/icons/color/delete.png">
								</a>
		                     </div>
	                        </li>
                       </ul>
                    </div><!-- end slide_left -->

                    <div class="slide_right">
                    	 <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Tên BCN</a>
                             <input  type="text" readonly="readonly"  value="<?php echo $row->name ?>" /> 
                        </div>

                         <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Slug</a>
                             <input  type="text" readonly="readonly"  value="<?php echo $row->slug ?>" /> 
                        </div>

                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Vị trí</a>
                             <select  name="sort_order"  >
                                   <option  value="<?php echo $row->sort_order ?>"> <?php echo $row->sort_order ?> </option>
                             </select>
                        </div>

                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Trạng thái </a>
                    	   	 <?php if($row->anhien > 0): ?>
                                <span>đang hiện</span>
	                         <?php else: ?>
	                         	<span>đang ẩn</span>
	                         <?php endif; ?>
                        </div>

                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Thuộc thể loại</a>
                             <select name="sort_order"  >
                             	<?php foreach($list_info as $sub): ?>
                             		<?php if($row->info_id == $sub->id ): ?>
                                   		<option value="<?php echo $sub->title ?>"> <?php echo $sub->title ?> </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>   
                             </select>
                        </div>

                        <div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-calendar" aria-hidden="true"></i> Đăng / cập nhật</a>
                             <span><?php echo get_date($row->created); ?></span>
                        </div><div class="slide_td">	
                    	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-user" aria-hidden="true"></i>  Author</a>
                             <span><?php echo $row->author ?></span>
                        </div>
                    </div><!-- end slide_right -->
                   </div><!-- end box-slide --> 
                   <div class="clear" style="height:20px"></div>
				<?php endforeach;?>
        	 </div><!-- end gallery -->	    
			</div>
		<!-- tab0 cua slide main -->

		
	    	

		</div><!-- end tab_container -->
	</div><!-- end widget -->
</div>