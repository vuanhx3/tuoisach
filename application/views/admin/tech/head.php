<div class="titleArea">
	<div id="fixedBox"  class="wrapper" >
		<div class="pageTitle">
			<h5>Danh sách tin công nghệ bán hàng</h5>
			<span>Quản lý tin</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="javascript:location.reload(true)">
					<img src="<?php echo public_url("admin")?>/images/loaders/loader2.gif">
					<span>Tải lại</span>
				</a></li>
				
				<li><a href="<?php echo admin_url('tech/index')?>">
					<img src="<?php echo public_url("admin")?>/images/icons/control/16/list.png">
					<span>Danh sách</span>
				</a></li>
			</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div>

<div class="line"></div>

<script type="text/javascript">
(function($)
{
	$(document).ready(function()
	{
		var main = $('#form');
		
		// Tabs
		main.contentTabs();
	});
})(jQuery);
</script>

<!-- boc hien thi muc nguon goc thuc pham -->
<script language="javascript">
	$(document).ready(function(){
		$('#btn_partner').on('click', function(){
			$('#hide_partner').fadeIn();
			return false;
		});
	});
</script>


