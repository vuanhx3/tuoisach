<div id="leftSide" style="padding-top:30px;">
		        <!-- Account panel -->
				<div class="sideProfile">
					<a href="#" title="" class="profileFace">
					<?php if(isset($admin_info->image_link)): ?>
						<img width="40" src="<?php echo $admin_info->image_link ?>"></a>
					<?php else: ?>
					   <img width="40" src="<?php echo public_url("admin/images")?>/user.png"></a>
				    <?php endif; ?>
					<span>Xin chào: <strong>
					   <?php if($admin_info->admin_group_id == 1)
					    {
					    	echo "root_admin";
					   	}elseif($admin_info->admin_group_id == 2){
					   		echo "admin tổng";
					   	}else{
					   		echo "editor";
					   	} ?>
					</strong></span>
					<span><?php echo isset($admin_info->name) ? $admin_info->name : ''?></span>
					<div class="clear"></div>
				</div><!-- end sideProfile -->

				<div class="logo"><a href="<?php echo admin_url() ?>"><img src="<?php echo public_url('admin') ?>/images/logo1.png" alt=""></a></div>

				<div class="sidebarSep"></div>		    
			    <!-- Left navigation -->
			
				<ul id="menu" class="nav">

						 <li class="home">
			
							<a href="<?php echo admin_url()?>" class="active" id="current">
								<span>Bảng điều khiển</span>
								<strong></strong>
							</a>
						 </li>


						<li class="tran">
								<a href="#" class="exp inactive">
									<span>Quản lý bán hàng</span>
									<strong>2</strong>
								</a>
							
								<ul class="sub" style="display: none;">
									<li>
										<a href="<?php echo admin_url('transaction')  ?>">
											Giao dịch							</a>
									</li>
														<li>
										<a href="<?php echo admin_url('order')  ?>">
											Đơn hàng sản phẩm							</a>
									</li>
								</ul>
							</li>


							<li class="product">
			
								<a href="#" class="exp inactive">
									<span>Thực Phẩm</span>
									<strong>3</strong>
								</a>
								
								<ul class="sub" style="display: none;">
									<li>
										<a href="<?php echo admin_url('product') ?>">
											Thực phẩm							</a>
									</li>
														<li>
										<a href="<?php echo admin_url('catalog') ?>">
											Danh mục thực phẩm							</a>
									</li>
														<li>
										<a href="admin/comment.html">
											Phản hồi							</a>
									</li>
								</ul>
							
							</li>


							<li class="account">
									<a href="#" class="exp inactive">
										<span>Tài khoản</span>
										<strong>3</strong>
									</a>
				
									<ul class="sub" style="display: none;">
											<li>
												<a href="<?php echo admin_url('admin') ?>">Ban quản trị</a>
											</li>
											<li>
												<a href="<?php echo admin_url('admingroup') ?>"> Nhóm quản trị</a>
											</li>
																<li>
												<a href="<?php echo admin_url('user') ?>"> Thành viên </a>
											</li>
									</ul>
							</li>


							<li class="support">
								<a href="#" class="exp inactive">
									<span>Hỗ trợ và liên hệ</span>
									<strong>2</strong>
								</a>
									<ul class="sub" style="display: none;">
										<li>
											<a href="<?php echo admin_url('support') ?>">
												Hỗ trợ support						</a>
										</li>
															<li>
											<a href="admin/contact.html">
												Liên hệ							</a>
										</li>
									</ul>
							</li>


							<li class="content">
								<a href="#" class="exp inactive">
									<span>Nội dung</span>
									<strong>6</strong>
								</a>
							
									<ul class="sub" style="display: none;">
											<li>
												<a href="<?php echo admin_url('head') ?>">	
													Đôi lời từ cửa hàng
												</a>
											</li>
											<li>
												<a href="<?php echo admin_url('tech') ?>">	
													Công nghệ bán hàng 
												</a>
											</li>
											<li>
												<a href="<?php echo admin_url('slidemain') ?>">	
													Slide Main
												</a>
											</li>
											<li>
												<a href="<?php echo admin_url('slidebcn') ?>">	
													Slide thành tựu
												</a>
											</li>
											<li>
												<a href="<?php echo admin_url('banner_thucpham') ?>">
													Banner thực phẩm
												</a>
											</li>
											
											<li>
												<a href="<?php echo admin_url('video') ?>"> Video </a>
											</li>
									</ul>
							</li>

							<li class="content">
								<a href="#" class="exp inactive">
									<span>Quảng lý trang</span>
									<strong>6</strong>
								</a>
							
									<ul class="sub" style="display: none;">
										<li>
											<a href="<?php echo admin_url('info') ?>">	
												Thông tin cửa hàng
											</a>
										</li>
										<li>
											<a href="<?php echo admin_url('about_us') ?>">	
												Giới thiệu về cửa hàng
											</a>
										</li>
										<li>
											<a href="<?php echo admin_url('quidinh') ?>">	
												Qui định và chính sách
											</a>
										</li>
										<li>
											<a href="<?php echo admin_url('news') ?>">
												Tin mẹo vặt						
											</a>
										</li>
									    <li>
											<a href="<?php echo admin_url('safety') ?>">Tin an toàn TP</a>
										</li>
										<li>
											<a href="<?php echo admin_url('partner') ?>">Đơn vị đối tác</a>
										</li>
									</ul>
							</li>

							<li class="content">
								<a href="#" class="exp inactive">
									<span>Khác ...</span>
									<strong>2</strong>
								</a>
							
									<ul class="sub" style="display: none;">
										<li>
											<a href="<?php echo admin_url('homepage') ?>">	
												Logo homepage
											</a>
										</li>
										<li>
											<a href="<?php echo admin_url('content_static') ?>">	
												Content static
											</a>
										</li>
									</ul>
							</li>

							

							<li class="support">
								<a href="<?php echo admin_url('ckfinder/gallery/html')?>">
									<span>Quản lý thư viện</span>
									<strong></strong>
								</a>			
							</li>
		
					</ul>
			
	</div><!-- end left-side -->
 <div class="clear"></div>
