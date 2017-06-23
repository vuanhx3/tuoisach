<div class="titleArea">
	<div id="fixedBox"  class="wrapper" >
		<div class="pageTitle">
			<h5>Danh Mục Thực Phẩm</h5>
			<span>Quản lý danh mục thực phẩm</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="<?php echo admin_url('catalog/add')?>">
					<img src="<?php echo public_url("admin")?>/images/icons/control/16/add.png">
					<span>Thêm mới</span>
				</a></li>

				<li><a href="javascript:location.reload(true)">
					<img src="<?php echo public_url("admin")?>/images/loaders/loader2.gif">
					<span>Tải lại</span>
				</a></li>
				
				<li><a href="<?php echo admin_url('catalog/index')?>">
					<img src="<?php echo public_url("admin")?>/images/icons/control/16/list.png">
					<span>Danh sách</span>
				</a></li>
			</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div>

<div class="line"></div>

<!-- <script language="javascript">
	$(document).ready(function() {
	   $(window).bind("scroll", function(e) {
	        var top = $(window).scrollTop();
	      if (top > 100) { //Khoảng cách đã đo được
	        $("#fixedBox").addClass("fix-box");
	      } else {
	        $("#fixedBox").removeClass("fix-box");
	      } 
	    });
	});
</script> -->