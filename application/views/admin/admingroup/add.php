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
						<span class="oneTwo"><input _autocheck="true" id="param_name" value="<?php echo set_value('name') ?>" name="name" type="text"></span>
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
                          <option value="1" >vị trí 1</option>
                          <option value="2" >vị trí 2</option>
                          <option value="3" >vị trí 3</option>
                          <option value="4" >vị trí 4</option>
                          <option value="5" >vị trí 5</option>
                          <option value="6" >vị trí 6</option>
                          <option value="7" >vị trí 7</option>
                          <option value="8" >vị trí 8</option>
                          <option value="9" >vị trí 9</option>
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
                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_desc" name="note"><?php echo set_value('note') ?></textarea></span>
                    <span class="autocheck" name="note_autocheck"></span>
                    <div class="clear error" name="note_error"></div>
                  </div>
                  <div class="clear"></div>
              </div>

				<div class="formSubmit">
					<input class="redB" value="Thêm mới" type="submit">
					<input class="basic" value="Hủy bỏ" type="reset">
		        </div>
				
			</div><!-- End widget -->
		</fieldset>
	</form>
</div>