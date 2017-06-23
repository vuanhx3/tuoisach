<?php $this->load->view('admin/slidebcn/head', $this->data); ?>

<div class="wrapper">
  <!-- Form -->
  <form enctype="multipart/form-data" method="post" action="" id="form" class="form">
    <fieldset>
      <div class="widget">
        <div class="title">
          <img class="titleIcon" src="<?php echo public_url('admin/images') ?>/icons/dark/edit.png">
          <h6>  Chỉnh sửa Slide</h6>
        </div>
        
        <!-- Các tap hiển thị --> 
        <ul class="tabs">
          <li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
        </ul>

        <div class="tab_container">
           <div class="tab_content pd0" id="tab1" style="display: block;">

            <div class="formRow"><!-- truong ten -->
              <label for="param_name" class="formLeft">Tên Slide:<span class="req">*</span></label>
                  <div class="formRight">
                    <span class="oneTwo">
                      <input _autocheck="true" value="<?php echo set_value('name') ?>" id="param_name" name="name" type="text">
                    </span> 
                    <span class="autocheck" name="name_autocheck"></span>
                    <div class="clear error" name="name_error"><?php echo form_error('name') ?></div>
                  </div>
              <div class="clear"></div>
            </div>

            <!-- truong slug -->
                <div class="formRow">
                    <label for="param_slug" class="formLeft">Slug:</label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" value="<?php echo set_value('slug') ?>" _autocheck="true" id="param_slug" name="slug"></span>

                        <span class="autocheck" name="slug_autocheck">(* Nhập slug nếu muốn thay đổi *)</span>
                        <div class="clear error" name="slug_error"><?php echo form_error('slug') ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

             <!-- truong hinh anh -->
                        <div class="formRow">
                            <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                            <div class="formRight">
                                <div class="left">
                                    <!-- <input type="file" name="image" id="image" size="25"> -->
                                    <input type="text" name="image" id="image" value="<?php echo set_value('image') ?>" size="70">
                                        <img src="<?php echo set_value('image') ?>" width="420px" height="240px" alt=""  style="display: block"> 
                                    <p style="color: #FF0000;">Để hiển thị tốt kích thước ảnh tối thiểu 420 X 240</p>
                                </div>
                                <input type="button" id="btn" datainput="image" onclick="BrowseServer(this)" value="Browse" style="display: inline-block;">
                                <input type="button" id="btn-delete-image"  value="Delete" style="display: inline-block;">
                                <div class="clear error" name="image_error"><?php echo form_error('image') ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <script>
                            jQuery(document).ready(function($) {
                                var idInput = 1;
                                jQuery('.btn-add-image').on('click',function(){
                                    var inputAdd = jQuery(this).parent().find('.formRight').eq(0).clone(true);
                                    var lastIdInput = inputAdd.find('input[type=text]').attr('id');
                                    lastIdInput = lastIdInput.replace(/[^0-9]/g,'');
                                    lastIdInput = parseInt(lastIdInput) + idInput;
                                    
                                    inputAdd.find('input[type=text]').attr('id','image_list'+lastIdInput);
                                    inputAdd.find('input[type=button]').attr('datainput','image_list'+lastIdInput);
                                    inputAdd.find('input[type=text]').attr('value','');
                                    inputAdd.insertBefore(this);
                                    idInput++;
                                });
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

                        <div class="formRow"><!-- truong the loai -->
                            <label for="param_cat" class="formLeft">Thuộc thể loại:<span class="req">*</span></label>
                            <div class="formRight">
                                <select name="info_id"  class="left" >
                                    <option style="color: blue; font-weight: bold;" value="">------CHỌN THỂ LOẠI------</option> 
                                    <?php foreach($list_info as $sub): ?>
                                        <option value="<?php echo $sub->id ?>"><?php echo $sub->title ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="autocheck" name="cat_autocheck"></span>
                                <div class="clear error" name="cat_error"><?php echo form_error('info_id') ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
            
                    <div  class="formRow" id="hide_select"><!-- truong vi tri -->
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
                                  <option value="10">vị trí 10</option>
                                  <option value="11">vị trí 11</option>
                                  <option value="12">vị trí 12</option>
                                  <option value="13">vị trí 13</option>
                                  <option value="14">vị trí 14</option>
                                  <option value="15">vị trí 15</option>
                                  <option value="16">vị trí 16</option>
                                  <option value="17">vị trí 17</option>
                                  <option value="18">vị trí 18</option>
                                  <option value="19">vị trí 19</option>
                                  <option value="20">vị trí 20</option>
                              </select>
                            </span>
                            <span class="autocheck" name="sort_order_autocheck"> </span>
                            <div class="clear error" name="sort_order_error"> <?php echo form_error('sort_order') ?> </div>
                          </div>
                          <div class="clear"></div>
                        </div>


                    <div class="formRow"><!-- truong trang thai -->
                        <label for="param_cat" class="formLeft">Trạng thái: </label>
                        <div class="formRight">
                            <label for="">
                              <input type="radio" name="anhien" value="1"> Hiện
                            </label>
                            <label for="">
                              <input type="radio" name="anhien" value="0"> Ẩn
                            </label>
                        </div>
                        <div class="clear"></div>
                    </div>
            
            <div class="formRow hide"></div>
           </div>

          <div class="formRow hide"></div>
        </div>

        </div><!-- End tab_container-->

        <div class="formSubmit">
          <input class="redB" value="Thêm mới" type="submit"> 
          <input class="basic" value="Hủy bỏ" type="reset">
        </div>

        <div class="clear"></div>
      </fieldset>
  </form>
</div>