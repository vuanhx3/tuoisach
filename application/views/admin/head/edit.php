<?php $this->load->view('admin/head/head', $this->data); ?>

<div class="wrapper">
	<!-- Form -->
	<form enctype="multipart/form-data" method="post" action="" id="form" class="form">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img class="titleIcon" src="<?php echo public_url('admin/images') ?>/icons/dark/edit.png">
					<h6>  Chỉnh sửa nội dung</h6>
				</div>
				
               <!-- Các tap hiển thị --> 
				<ul class="tabs">
					<li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
				</ul>

				<div class="tab_container">
					 <div class="tab_content pd0" id="tab1" style="display: block;">
						
						<div class="formRow"><!-- truogn noi dung -->
                            <label for="param_meta_key" class="formLeft">Nội dung tâm thư  <span class="req">*</label>
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
			  </div>

				</div><!-- End tab_container-->

				<div class="formSubmit">
					<input class="redB" value="Cập nhật" type="submit"> 
					<input class="basic" value="Hủy bỏ" type="reset">
				</div>

				<div class="clear"></div>
			</fieldset>
	</form>
</div>