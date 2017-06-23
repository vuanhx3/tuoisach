<!-- head -->
<?php $this->load->view('admin/homepage/head', $this->data)?>

<div class="wrapper">
	<br>
    <?php $this->load->view('admin/message', $this->data);?>
    
	<div class="widget">
	
		<div class="title">
			<img src="<?php echo public_url("admin")?>/images/icons/dark/edit.png" class="titleIcon">
			<h6>Cài đặt thông tin cho homepage</h6>
		</div>
		
		<div class="homepage">
			<?php foreach($list as $row): ?>
			<div class="homepage_box">
				<div class="homepage_left">
					<!-- truong hotline -->
					 <div class="row_home">	
                	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Hotline </a>
                         <input  type="text" readonly="readonly"  value="<?php echo $row->hotline ?>" /> 
                     </div>
					
					<!-- truong email -->
                     <div class="row_home">	
                	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Email </a>
                         <input  type="text" readonly="readonly"  value="<?php echo $row->email ?>"/>
                     </div>

                     <!-- truong site_title -->
                     <div class="row_home">	
                	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> site_title </a>
                         <input  type="text" readonly="readonly"  value="<?php echo $row->site_title ?>"/>
                     </div>

                     <!-- truong site_desc -->
                     <div class="row_home">	
                	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> site_desc </a>
                         <input  style="width: 350px;" type="text" readonly="readonly"  value="<?php echo $row->site_desc ?>"/>
                     </div>

                     <!-- truong site_key -->
                     <div class="row_home">	
                	   	 <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> site_key </a>
                         <input  style="width: 350px;" type="text" readonly="readonly"  value="<?php echo $row->site_key ?>"/>
                     </div>

				</div><!-- end homepage_left -->

				<div class="homepage_right">
					<div class="image_link">
					   <a class="lightbox cboxElement" title="<?php echo $row->site_title ?>" href="<?php echo $row->image_link ?>">
						  <img src="<?php echo $row->image_link ?>" alt="">
					   </a>	
						<p><i class="fa fa-picture-o" aria-hidden="true"></i> Ảnh logo web</p>	
					</div>

					<div class="image_link">
					  <a class="lightbox cboxElement" title="<?php echo $row->site_title ?>" href="<?php echo $row->image_link ?>">
					  	<img src="<?php echo $row->favicon ?>" alt="">
					  </a>
						<p><i class="fa fa-picture-o" aria-hidden="true"></i> Ảnh logo seo</p>	
					</div>
				</div><!-- end homepage_right -->
			</div><!-- end homepage_box -->

			<div style="padding-top: 20px; width: 95%; padding:10px 1%;" class="formSubmit">
				<a href="<?php echo admin_url('homepage/edit/'.$row->id); ?>">
                  <input type="submit" class="redB" value="Chỉnh sửa">
				</a>	
            </div>
		  <?php endforeach; ?>	
		</div>
	</div>
</div>

<div class="clear mt30"></div>
