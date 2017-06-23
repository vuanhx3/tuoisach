<div class="titleArea">
	<div id="fixedBox"  class="wrapper" >
		<div class="pageTitle">
			<h5>Ban Quản Trị</h5>
			<span>Quản lý admin</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="<?php echo admin_url('admin/add')?>">
					<img src="<?php echo public_url("admin")?>/images/icons/control/16/add.png">
					<span>Thêm mới</span>
				</a></li>
				
				<li><a href="<?php echo admin_url('admin/index')?>">
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
	      if (top > 120) { //Khoảng cách đã đo được
	        $("#fixedBox").addClass("fix-box");
	      } else {
	        $("#fixedBox").removeClass("fix-box");
	      } 
	    });
	});
</script> -->