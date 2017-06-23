<?php $this->load->view('admin/transaction/head', $this->data); ?>

<div class="wrapper">
	<!-- Form -->
	<form enctype="multipart/form-data" method="post" action="" id="form" class="form">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img class="titleIcon" src="<?php echo public_url('admin/images') ?>/icons/dark/edit.png">
					<h6> Kiểm phiếu thanh toán khi nhận hàng </h6>
				</div>
				
               <!-- Các tap hiển thị --> 
				<ul class="tabs">
					<li class="activeTab"><a href="#tab1">Điều chỉnh</a></li>
				</ul>

				<div class="tab_container">
					 <div class="tab_content pd0" id="tab1" style="display: block;">

                <div class="formRow"><!-- truong trang thai -->
                    <label for="param_cat" class="formLeft">Trạng thái: </label>
                    <div class="formRight">
                        <label for="">
                        	<input <?php if($info_tran->status == 1) echo 'checked="checked"' ?> type="radio" name="status" value="1"> Đã thanh toán
                        </label>
                        <label for="">
                        	<input <?php if($info_tran->status == 0) echo 'checked="checked"' ?> type="radio" name="status" value="0"> Chưa thanh toán
                        </label>
                        <div class="clear error" name="content_error"></div>
                    </div>
                    <div class="clear"></div>
                </div>
						
				<div class="formRow hide"></div>
			 </div><!-- end form-row -->


               

				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input class="redB" value="Cập nhật" type="submit"> 
					<input class="basic" value="Hủy bỏ" type="reset">
				</div>

				<div class="clear"></div>
			</fieldset>
	</form>
</div>