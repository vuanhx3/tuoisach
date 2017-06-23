<!-- header -->
<?php $this->load->view('admin/support/head', $this->data); ?>

<!-- phan noi dung -->
<div class="wrapper">
	
	<form id="form" class="form" enctype="multipart/form-data" method="post" action="">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/edit.png">
					<h6>
						<i class="fa fa-user-plus" aria-hidden="true"></i> Lựa chọn hiển thị cộng tác viên
					</h6>
				</div>
				
                <!-- trường Tên -->
				<div class="formRow">
					<label for="param_luachon" class="formLeft">Lựa chọn:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<select name="luachon" id="luachon">
								<option <?php if($info->luachon == 1) echo 'selected="selected"' ?> value="1">Lựa chọn hiển thị CTV</option>
								<option <?php if($info->luachon == 0) echo 'selected="selected"' ?> value="0">Không lựa chọn hiển thị CTV</option>
							</select>
						</span>
						<span style="color: red;" class="autocheck" name="name_autocheck">(* chỉ lựa chọn hiển thị 1 cộng tác viên *)</span>	
						<div class="clear error" luachon="luachon_error"><?php echo form_error('luachon') ?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formSubmit">
					<input class="redB" value="Cập nhật" type="submit">
					<input class="basic" value="Hủy bỏ" type="reset">
		        </div>
				
			</div><!-- End widget -->
		</fieldset>
	</form>
</div>