<div class="topNav">
	<div class="wrapper">
		<div class="welcome">
			<a href="<?php echo admin_url('admin') ?>" title="admin"><img src="<?php echo public_url('admin/images')?>/icons/color/user.png" alt=""></a>
			<span>Xin chào: <b> <?php echo isset($admin_info->name) ? $admin_info->name : ''; ?> </b></span>
		</div>
		
		<div class="userNav">
			<ul>
			    <li>
			    	<input id="back" style="display: none;" type="button" value="Quay lại trang trước" onclick="history.back(-1)" />
			    </li>
				<li><a href="<?php echo admin_url('home')?>" >
					<img style="margin-top:7px;" src="<?php echo public_url("admin/images")?>/icons/light/home.png">
					<span>Trang chủ</span>
				</a></li>
				
				<!-- Logout -->
				<li><a href="<?php echo admin_url('home/logout') ?>" class="tipS verify_logout">
					<img src="<?php echo public_url("admin/images")?>/icons/topnav/logout.png" alt="">
					<span>Đăng xuất</span>
				</a></li>
				
			</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div><!-- end topNav -->