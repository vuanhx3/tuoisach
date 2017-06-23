<?php $this->load->view('admin/content_static/head', $this->data); ?>

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
        								  <input _autocheck="true" value="<?php echo $info->key ?>" id="param_key" name="key" type="text">
        								</span> 
        								<span class="autocheck" name="key_autocheck"></span>
        								<div class="clear error" name="key_error"><?php echo form_error('key') ?></div>
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