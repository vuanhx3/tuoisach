<!-- head -->
<?php $this->load->view('admin/video/head', $this->data)?>

<div class="wrapper">
	   	<!-- Form -->
		<form enctype="multipart/form-data" method="post" action="" id="form" class="form">
			<fieldset>
				<div class="widget">
				    <div class="title">
  						<img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/edit.png">
  						<h6>Chỉnh sửa thông tin video</h6>
					  </div><!-- end title -->

             <ul class="tabs">
                  <li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
              </ul>
							
      	<div class="tab_container">
      				<div class="tab_content pd0" id="tab1" style="display: block;">
              
               <!-- truong ten video -->
              <div class="formRow">
                  <label for="param_name" class="formLeft">Tên video:<span class="req">*</span></label>
                  <div class="formRight">
                    <span class="oneTwo">
                    <input type="text" _autocheck="true" id="param_site_title" name="name" value="<?php echo $info->name ?>">
                    </span>
                    <span class="autocheck" name="name_autocheck"></span>
                    <div class="clear error" name="name_error"><?php echo form_error('name')?></div>
                  </div>
                  <div class="clear"></div>
              </div> 

              <!-- truong anh -->
              <div class="formRow">
                <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                <div class="formRight">
                  <div class="left">
                      <input type="text" name="image" id="image" value="<?php echo $info->images ?>" size="50">
                      <?php if($info->images != ''): ?>
                      <img src="<?php echo $info->images ?>" width="200px" height="130px;" alt=""  style="display: block">
                    <?php endif; ?>
                  </div>
                  <input type="button" id="btn-browse-image" datainput="image" onclick="BrowseServer(this)" value="Browse" style="display: inline-block;">
                  <input type="button" id="btn-delete-image"  value="Delete" style="display: inline-block;">
                  <div class="clear error" name="image_error"><?php echo form_error('image')?></div>
                  
                </div><!-- end formRight -->
                <div class="clear"></div>
                <script>
                  jQuery(document).ready(function($) {
                      $( document ).on( 'click', '#btn-delete-image', function() {
                      var deleteSure = confirm("Bạn chắc chắn muốn xóa");

                      if (deleteSure == true) {
                        console.log(jQuery(this).parent().parent().find('.formRight'));
                        if(jQuery(this).parent().parent().find('.formRight').length == 1){
                          jQuery(this).parent().find('img').remove();
                          jQuery(this).parent().find('input[type=text]').attr('value','');
                        }
                        else
                          jQuery(this).parent().remove();
                      }
                      
                    });
                  });
                </script>
            </div><!-- end formRow -->

            <!-- truong the loai thuc pham -->
              <div class="formRow">
                  <label for="param_cat" class="formLeft">Thuộc thể loại:<span class="req">*</span></label>
                  <div class="formRight">
                      <select name="catalog"  class="left" >
                          <option style="color: blue; font-weight: bold;" value="">CHỌN THỰC PHẨM</option> 
                              <!-- kiem tra danh muc co danh muc con hay khong -->
                            <?php foreach($catalogs as $row): ?>
                              <?php if(count($row->subs) >= 1): ?>
                                  <optgroup label="<?php echo $row->name ?>">
                                      <!-- lap lay dm con -->
                                      <?php foreach($row->subs as $subs): ?>
                                          <option <?php if($subs->id == $info->catalog_id) echo 'selected'; ?> value="<?php echo $subs->id ?>"> <?php echo $subs->name ?> </option>
                                      <?php endforeach; ?>     
                                  </optgroup>
                              <?php else: ?>    
                                  <!-- mac dinh se la danh muc con -->
                                  <option <?php if($subs->id == $info->catalog_id) echo 'selected'; ?> value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                      </select>
                      <span class="autocheck" name="cat_autocheck"></span>
                      <div class="clear error" name="cat_error"><?php echo form_error('catalog')?></div>
                  </div>
                  <div class="clear"></div>
              </div>

              <div class="formRow">
                  <label for="param_name" class="formLeft">Nhúng mã video:<span class="req">*</span></label>
                  <div class="formRight">
                    <span class="oneTwo">
                    <textarea type="text" _autocheck="true" id="param_link" name="link" cols="79" rows="5">
                      <?php echo $info->link ?>
                    </textarea>
                    </span>
                    <span class="autocheck" name="chat_box_autocheck"></span>
                    <div class="clear error" name="chat_box_error"><?php echo form_error('link')?></div>
                  </div>
                  <div class="clear"></div>
              </div>

            <!-- truong trang thai -->
             <div class="formRow"><!-- truong trang thai -->
                <label for="param_cat" class="formLeft">Trạng thái: <span class="req">*</label>
                <div class="formRight">
                    <label for="status">
                        <input <?php if($info->status == 1) echo'checked="checked"' ?> type="radio" name="status" value="1"> Hiện
                    </label>
                    <label for="status">
                        <input <?php if($info->status == 0) echo'checked="checked"' ?> type="radio" name="status" value="0"> Ẩn
                    </label>
                    <div class="clear error" name="meta_key_error"><?php echo form_error('status') ?></div>
                </div>
                <div class="clear"></div>
            </div>

       
       <div class="formRow hide"></div>
      </div><!-- tab1 -->

      </div><!-- End tab_container-->
	        		
        		<div class="formSubmit">
           			<input type="submit" class="redB" value="Cập nhật">
           		</div>
        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
<div class="clear mt30"></div>
