<div id="box_slide">
		<?php $this->load->view("site/slide/slide.php", $this->data)?>
</div><!-- end box-slide -->


<!-- phan gioi thieu tam thu cua hang -->
<div id="box_gioithieu">
		<?php $this->load->view("site/box_gioithieu/box_gioithieu.php", $this->data) ?>
</div><!-- end box_gioithieu -->


<!-- phan san pham mơi -->
<div id="box_sanphammoi">
	<div class="left-product hide_pd_mobile ">
		<?php $this->load->view("site/box_sanphammoi/sale_left.php", $this->data) ?>
	</div><!-- end left-product -->

	<div class="content-product">
		<?php $this->load->view("site/box_sanphammoi/sale_right.php", $this->data) ?>
	</div><!-- end content-product -->
</div><!-- end box_sanphammoi -->


<!-- pahn danh sach thuc pham ban -->
<div id="box_sanphammoi">
	<div class="left-product meovat">
		<?php $this->load->view("site/box_sanphamban/box_left.php", $this->data) ?>
	</div><!-- end left-product meovat -->

	<div class="content-product">
		<?php $this->load->view("site/box_sanphamban/box_right.php", $this->data) ?>
	</div><!-- end content-product -->
</div><!-- end box_sanphammoi -->