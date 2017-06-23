<!-- header -->
<?php $this->load->view('admin/admingroup/head', $this->data); ?>

<!-- phan noi dung -->
<div class="wrapper">
	
	<form id="form" class="form" enctype="multipart/form-data" method="post" action="">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/edit.png">
					<h6>
						<i class="fa fa-user-plus" aria-hidden="true"></i> Chỉnh sửa nhóm phân quyền
					</h6>
				</div>
				
                <!-- trường Tên -->
				<div class="formRow">
					<label for="param_name" class="formLeft">Tên nhóm quyền :<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input _autocheck="true" id="param_name" value="<?php echo $info->name ?>" name="name" type="text"></span>
							 <span class="autocheck" name="name_autocheck"></span>
						<div class="clear error" name="name_error"><?php echo form_error('name')?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				

			  <!-- truong hien thi thu tu  -->
              <div  class="formRow ">
                  <label for="param_sort_order" class="formLeft">Chọn vị trí hiển thị : <span class="req">*</label>
                  <div class="formRight">
                    <span class="oneTwo">
                      <select _autocheck="true" id="param_sort_order" name="sort_order">
                          <option style="color: blue; font-weight: bold;" value="">CHỌN VỊ TRÍ</option>
                          <option value="1" <?php if($info->sort_order == 1) echo 'selected' ?>>vị trí 1</option>
                          <option value="2" <?php if($info->sort_order == 2) echo 'selected' ?>>vị trí 2</option>
                          <option value="3" <?php if($info->sort_order == 3) echo 'selected' ?>>vị trí 3</option>
                          <option value="4" <?php if($info->sort_order == 4) echo 'selected' ?>>vị trí 4</option>
                          <option value="5" <?php if($info->sort_order == 5) echo 'selected' ?>>vị trí 5</option>
                          <option value="6" <?php if($info->sort_order == 6) echo 'selected' ?>>vị trí 6</option>
                          <option value="7" <?php if($info->sort_order == 7) echo 'selected' ?>>vị trí 7</option>
                          <option value="8" <?php if($info->sort_order == 8) echo 'selected' ?>>vị trí 8</option>
                          <option value="9" <?php if($info->sort_order == 9) echo 'selected' ?>>vị trí 9</option>
                      </select>
                    </span>
                    <span class="autocheck" name="sort_order_autocheck"> </span>
                    <div class="clear error" name="sort_order_error"> <?php echo form_error('sort_order')?> </div>
                  </div>
                  <div class="clear"></div>
                </div>

                <!-- Trường ghi chu -->
				<div class="formRow">
                  <label for="param_note" class="formLeft">Ghi chú nhóm phân quyền : </label>
                  <div class="formRight">
                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_desc" name="note"><?php echo $info->note ?></textarea></span>
                    <span class="autocheck" name="note_autocheck"></span>
                    <div class="clear error" name="note_error"></div>
                  </div>
                  <div class="clear"></div>
              </div>

				<!-- kiểm tra Trường mã khôi phục chỉ hiển thị khi đó là root admin -->
				<?php if($info->id == 1 && $info->root == 1 ): ?>
					<div class="formRow">
	                  <label for="param_password" class="formLeft">Mã khôi phục thêm, xóa:</label>
	                  <div class="formRight">
	                    <span class="oneTwo">
	                    <input type="password" _autocheck="true" name="password" id="param_password" value="">
	                    </span>
	                    <span class="autocheck" name="password_autocheck"> (* Nếu muốn thay đổi mã khôi phục thì mới nhập *) </span>
	                    <div class="clear error" name="password_titleerror"><?php echo form_error('password') ?></div>
	                  </div>
	                  <div class="clear"></div>
	                </div>
				<?php else: ?>
					<?php echo ''; ?>
				<?php endif; ?>
				
				
                
				
				<div class="formSubmit">
					<input class="redB" value="Cập nhật" type="submit">
					<input class="basic" value="Hủy bỏ" type="reset">
		        </div>
				
			</div><!-- End widget -->
		</fieldset>
	</form>
</div>