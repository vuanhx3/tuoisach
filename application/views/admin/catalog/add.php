<!-- head -->
<?php $this->load->view('admin/catalog/head', $this->data)?>

<div class="wrapper">
      <div class="widget">
           <div class="title">
           <img class="titleIcon" src="<?php echo public_url('admin/images') ?>/icons/dark/add.png">
		     	<h6> Thêm mới danh mục sản phẩm / Mục có (*) là mục bắt buộc</h6>
		</div>

      <form id="form" class="form" enctype="multipart/form-data" method="post" action="">
          <fieldset>
                
                <div class="formRow">
                	<label for="param_name" class="formLeft">Tên Danh mục:<span class="req">*</span></label>
                	<div class="formRight">
                		<span class="oneTwo"><input type="text" _autocheck="true" autofocus="autofocus" id="param_name" value="<?php echo set_value('name')?>" name="name"></span>
                		<span class="autocheck" name="name_autocheck"> </span>
                		<div class="clear error" name="name_error"><?php echo form_error('name'); ?></div>
                	</div>
                	<div class="clear"></div>
                </div>

               <div class="formRow">
                  <label for="param_slug" class="formLeft">Tên không dấu:</label>
                  <div class="formRight">
                    <span class="oneTwo">
                    <input type="text" _autocheck="true" id="param_slug" value="<?php echo set_value('slug')?>" name="slug">
                    </span>
                    <span class="autocheck" name="slug_autocheck"> (* Nếu muốn thay đổi thì mới nhập *) </span>
                    <div class="clear error" name="sseo_titleerror"><?php echo form_error('slug'); ?></div>
                  </div>
                  <div class="clear"></div>
                </div>


                <div class="formRow">
                      <label for="param_name" class="formLeft">Thuộc Danh mục sản phẩm: </label>
                      <div class="formRight">
                        <span class="oneTwo">
                            <select _autocheck="true" id="param_parent_id"  name="parent_id">
                                 <option value="0">Danh mục cha</option>
                                 <?php foreach($list as $row): ?>
                                   <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                                 <?php endforeach;?>  
                            </select>
                        </span>
                        <span class="autocheck" name="parent_id_autocheck"></span>
                        <div class="clear error" name="parent_id_error"></div>
                      </div>
                      <div class="clear"></div>
                </div>

                <!-- doan js cho hien thi sort_order neu la dm cha con khong thi an -->
                <script language="javascript">
                  $(document).ready(function(){
                    $('#param_parent_id').change(function(){
                      var vl = $(this).val();
                      if(vl != 0)
                      {
                        $('.hide_select').fadeOut();
                      }else{
                        $('.hide_select').fadeIn();
                      }
                    });
                  });
                </script>

                <div  class="formRow hide_select" >
                  <label for="param_sort_order" class="formLeft">Chọn vị trí hiển thị :<span class="req">*</span></label>
                  <div class="formRight">
                    <span class="oneTwo">
                      <select _autocheck="true"  id="param_sort_order" name="sort_order">
                          <option style="color: blue; font-weight: bold;" value="">CHỌN VỊ TRÍ</option> 
                          <option value="1">vị trí 1</option>
                          <option value="2">vị trí 2</option>
                          <option value="3">vị trí 3</option>
                          <option value="4">vị trí 4</option>
                          <option value="5">vị trí 5</option>
                          <option value="6">vị trí 6</option>
                          <option value="7">vị trí 7</option>
                          <option value="8">vị trí 8</option>
                          <option value="9">vị trí 9</option>
                      </select>
                    </span>
                    <span class="autocheck" name="sort_order_autocheck"> </span>
                    <div class="clear error" name="sort_order_error"> <?php echo form_error('sort_order')?> </div>
                  </div>
                  <div class="clear"></div>
                </div>

                <div  class="formRow hide_select" >
                <label for="param_sort_order" class="formLeft">Hiển thị trong box :<span class="req">*</span></label>
                   <div class="formRight">
                    <span class="oneTwo">
                      <label for="#">
                        <input type="radio" name="box_vitri" value="1"> Box 1
                      </label>
                      <label for="#">
                        <input type="radio" name="box_vitri" value="2"> Box 2
                      </label>
                    </span>
                    <span class="autocheck" name="sort_order_autocheck"> </span>
                    <div class="clear error" name="sort_order_error"> <?php echo form_error('box_vitri') ?> </div>
                  </div>
                  <div class="clear"></div>
                </div>

                
                <div class="formRow hide_select" >
                  <label class="formLeft">Hình ảnh icon:</label>
                  <div class="formRight">
                    <div class="left">
                        <!-- <input type="file" name="image" id="image" size="25"> -->
                        <input type="text" name="image" id="image" value="<?php echo set_value('image') ?>" size="80">
                         <img src="<?php echo set_value('image') ?>" width="150px" height="100px;" alt=""  style="display: block">
                        <p>Icon dành cho danh mục cha kích thước 40 X 40</p>
                    </div>
                    <input type="button" id="btn-browse-image" datainput="image" onclick="BrowseServer(this)" value="Browse" style="display: inline-block;">
                    <input type="button" id="btn-delete-image"  value="Delete" style="display: inline-block;">
                    <div class="clear error" name="image_error"></div>
                    
                  </div>
                  <div class="clear"></div>
                  <script>
                    jQuery(document).ready(function($) {
                      $( document ).on( 'click', '#btn-delete-image', function() {
                      var deleteSure = confirm("Bạn có chắc chắn muốn xóa");

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
                </div>


                <div class="formRow " >
                  <label class="formLeft">Hình ảnh đại diện cho danh mục:</label>
                  <div class="formRight">
                    <div class="left">
                        <!-- <input type="file" name="image" id="image" size="25"> -->
                        <input type="text" name="avatar" id="avatar" value="<?php echo set_value('avatar') ?>" size="80">
                         <img src="<?php echo set_value('avatar') ?>" width="150px" height="100px;" alt=""  style="display: block">
                        <p style="color: red;">Kích thước ảnh 900 X 250</p>
                    </div>
                    <input type="button" id="btn-browse-image" datainput="avatar" onclick="BrowseServer(this)" value="Browse" style="display: inline-block;">
                    <input type="button" id="btn-delete-image"  value="Delete" style="display: inline-block;">
                    <div class="clear error" name="avatar_error"></div>
                    
                  </div>
                  <div class="clear"></div>
                  <script>
                    jQuery(document).ready(function($) {
                      $( document ).on( 'click', '#btn-delete-image', function() {
                      var deleteSure = confirm("Bạn có chắc chắn muốn xóa");

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
                </div>


                <div class="formRow">
                  <label for="param_seo_title" class="formLeft">Seo title:</label>
                  <div class="formRight">
                    <span class="oneTwo">
                    <input type="text" _autocheck="true" id="param_seo_title" value="<?php echo set_value('seo_title')?>" name="seo_title">
                    <p></p>
                    </span>
                    <span class="autocheck" name="seo_title_autocheck">(* Nếu không nhập sẽ lấy tên danh mục sản phẩm làm title *)</span>
                    <div class="clear error" name="seo_title_error"></div>
                  </div>
                  <div class="clear"></div>
                </div>


                <div class="formRow">
                  <label for="param_meta_desc" class="formLeft">Meta description:</label>
                  <div class="formRight">
                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_desc" name="meta_desc"><?php echo set_value('meta_desc')?></textarea></span>
                    <span class="autocheck" name="meta_desc_autocheck"></span>
                    <div class="clear error" name="meta_desc_error"></div>
                  </div>
                  <div class="clear"></div>
                </div>
            
              <div class="formRow">
                  <label for="param_meta_desc" class="formLeft">Meta keyword:</label>
                  <div class="formRight">
                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_desc" name="meta_key"><?php echo set_value('meta_key')?></textarea></span>
                    <span class="autocheck" name="meta_key_autocheck"></span>
                    <div class="clear error" name="meta_key_error"></div>
                  </div>
                  <div class="clear"></div>
              </div>

             <div class="formRow">
                <label for="param_meta_key" class="formLeft">Giới thiệu ngắn: <span class="req">*</span></label>
                <div class="formRight">
                  <span class="">
                  <textarea class="tong_quan" id="tong_quan" name="content"><?php echo set_value('content')?></textarea>
                  </span>
                  <div class="clear error" name="meta_key_error"> <?php echo form_error('content'); ?> </div>
                </div>
                <div class="clear"></div>
            </div>
<script>CKEDITOR.replace( 'tong_quan' );</script>

                
        <div class="formSubmit">
     			<input type="submit" class="redB" value="Thêm mới">
     	</div>
    </fieldset>
  </form>
  
  </div>
</div>
