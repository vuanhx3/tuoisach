<?php $this->load->view('admin/tech/head', $this->data); ?>

<div class="wrapper">
	<!-- Form -->
	<form enctype="multipart/form-data" method="post" action="" id="form" class="form">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img class="titleIcon" src="<?php echo public_url('admin/images') ?>/icons/dark/edit.png">
					<h6>  Chỉnh sửa bài viết</h6>
				</div>
				
               <!-- Các tap hiển thị --> 
				<ul class="tabs">
					<li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
				</ul>

				<div class="tab_container">
					 <div class="tab_content pd0" id="tab1" style="display: block;">

    						<div class="formRow"><!-- truong ten -->
    							<label for="param_title" class="formLeft">Tên bài viết:<span class="req">*</span></label>
        							<div class="formRight">
        								<span class="oneTwo">
        								  <input _autocheck="true" value="<?php echo $info->title ?>" id="param_title" name="title" type="text">
        								</span> 
        								<span class="autocheck" name="title_autocheck"></span>
        								<div class="clear error" name="title_error"><?php echo form_error('title') ?></div>
        							</div>
    							<div class="clear"></div>
    						</div>
						
    						<div class="formRow"><!-- truogn noi dung -->
                    <label for="param_meta_key" class="formLeft">Nội dung bài  <span class="req">*</label>
                    <div class="formRight">
                        <span class="">
                          <textarea class="content" id="content" name="content">
                                <?php echo $info->content ?>
                          </textarea>
                        </span>
                        <div class="clear error" name="content_error"><?php echo form_error('content')?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <script>CKEDITOR.replace( 'content' );</script>

                <div class="formRow"><!-- truong trang thai -->
                    <label for="param_cat" class="formLeft">Trạng thái: </label>
                    <div class="formRight">
                        <label for="">
                        	<input <?php if($info->status == 1) echo 'checked="checked"' ?> type="radio" name="status" value="1"> Hiện
                        </label>
                        <label for="">
                        	<input <?php if($info->status == 0) echo 'checked="checked"' ?> type="radio" name="status" value="0"> Ẩn
                        </label>
                        <div class="clear error" name="content_error"><?php echo form_error('status')?></div>
                    </div>
                    <div class="clear"></div>
                </div>
						
				<div class="formRow hide"></div>
			   </div><!-- end form-row -->


               <div  class="formRow" id="hide_select"><!-- truong vi tri -->
                  <label for="param_order" class="formLeft">Chọn vị trí hiển thị :<span class="req">*</span></label>
                  <div class="formRight">
                    <span class="oneTwo">
                      <select _autocheck="true"  id="param_order" name="order">
                          <option value="1" <?php if($info->order == 1) echo 'selected' ?>>vị trí 1</option>
                          <option value="2" <?php if($info->order == 2) echo 'selected' ?>>vị trí 2</option>
                          <option value="3" <?php if($info->order == 3) echo 'selected' ?>>vị trí 3</option>
                      </select>
                    </span>
                    <span class="autocheck" name="order_autocheck"> </span>
                    <div class="clear error" name="order_error">  </div>
                  </div>
                  <div class="clear"></div>
                </div><!-- struogn vi tri -->

				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input class="redB" value="Cập nhật" type="submit"> 
					<input class="basic" value="Hủy bỏ" type="reset">
				</div>

				<div class="clear"></div>
			</fieldset>
	</form>
</div>