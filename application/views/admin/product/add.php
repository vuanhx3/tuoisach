<?php $this->load->view('admin/product/head', $this->data); ?>

<div class="wrapper">
    <!-- Form -->
    <form enctype="multipart/form-data" method="post" action="<?php echo admin_url('product/add'); ?>" id="form" class="form">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/add.png">
                    <h6> Thêm mới Sản phẩm</h6>
                </div>

                <ul class="tabs">
                    <li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
                    <li class=""><a href="#tab2">SEO Onpage</a></li>
                    <li class=""><a href="#tab3">Nội dung</a></li>
                </ul>

                <div class="tab_container">
                    
                 <div class="tab_content pd0" id="tab1" style="display: block;">
                    <!-- truogn ten thuc pham -->
                       <div class="formRow">
                            <label for="param_name" class="formLeft">Tên thực phẩm:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input type="text" value="<?php echo set_value('name') ?>" _autocheck="true" id="param_name" name="name"></span>
                                <span class="autocheck" name="name_autocheck">(* Tên thực phẩm quy định tối đa là 25 ký tự *)</span>
                                <div class="clear error" name="name_error"><?php echo form_error('name'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                    <!-- truong the loai thuc pham -->
                        <div class="formRow">
                            <label for="param_cat" class="formLeft">Thuộc thể loại:<span class="req">*</span></label>
                            <div class="formRight">
                                <select name="catalog"  class="left" >
                                    <option disabled="disabled" style="color: blue; font-weight: bold;" value="">CHỌN THỰC PHẨM</option> 
                                        <!-- kiem tra danh muc co danh muc con hay khong -->
                                      <?php foreach($catalogs as $row): ?>
                                        <?php if(count($row->subs) >= 1): ?>
                                            <optgroup label="<?php echo $row->name ?>">
                                                <!-- lap lay dm con -->
                                                <?php foreach($row->subs as $subs): ?>
                                                     <option value="<?php echo $subs->id ?>"> <?php echo $subs->name ?> </option>
                                                <?php endforeach; ?>     
                                            </optgroup>
                                        <?php else: ?>    
                                            <!-- mac dinh se la danh muc con -->
                                            <option value="<?php echo $row->id ?>"> <?php echo $row->name ?> </option>
                                        <?php endif; ?>
                                      <?php endforeach; ?>
                                </select>
                                <span class="autocheck" name="cat_autocheck"></span>
                                <div class="clear error" name="cat_error"><?php echo form_error('catalog')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>


                        <!-- truong slug -->
                        <div class="formRow">
                            <label for="param_slug" class="formLeft">Slug:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input type="text" value="<?php echo set_value('slug') ?>" _autocheck="true" id="param_slug" name="slug"></span>

                                <span class="autocheck" name="slug_autocheck">(* Nhập slug nếu muốn thay đổi *)</span>
                                <div class="clear error" name="slug_error"><?php echo form_error('slug')?></div>
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
                                    <img src="<?php echo set_value('image') ?>" width="200px" height="130px;" alt=""  style="display: block">
                                    <p>Để hiển thị tốt kích thước ảnh tối thiểu <b style="color: #FF0000;">600 X 400</b></p>
                                </div>
                                <input type="button" id="btn" datainput="image" onclick="BrowseServer(this)" value="Browse" style="display: inline-block;">
                                <input type="button" id="btn-delete-image"  value="Delete" style="display: inline-block;">

                                <div class="clear error" name="image_error"><?php echo form_error('image')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>


                        <!-- truong anh kem theo -->
                        <div class="formRow">
                            <label class="formLeft">Ảnh kèm theo:</label>
                            <div class="formRight">
                                <div class="left">
                                    <!-- <input type="file" name="image" id="image" size="25"> -->
                                    <input type="text" name="image_list[]" id="image_list1" value="" size="50">
                                </div>
                                <input type="button" id="btn" datainput="image_list1" onclick="BrowseServer(this)" value="Browse" style="display: inline-block;">
                                <input type="button" id="btn-delete-image"  value="Delete" style="display: inline-block;">

                                <div class="clear error" name="image_list_error"></div>
                            </div>
                            <span class="add-image btn-add-image">Add image</span>
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
                           
                        
                        <!-- truong so luong thuc pham trong kho -->
                        <div class="formRow">
                            <label for="param_name" class="formLeft">Số lượng thực phẩm trong kho:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo">
                                      <input style="width:100px;" class="format_number" maxlength="6" placeholder="đơn vị kg" _autocheck="true" value="<?php echo set_value('number_pd'); ?>" id="param_number_pd" name="number_pd" type="text"> (kg)  
                                    </span> 
                                    <span class="autocheck" name="number_pd_autocheck">(* Số lượng không vượt quá 10.000 kg *)</span>
                                    <div class="clear error" name="number_pd_error"><?php echo form_error('number_pd')?></div>
                                </div>
                            <div class="clear"></div>
                        </div>    


                        <!-- truong gia -->
                        <div class="formRow">
                            <label for="param_price" class="formLeft"> Giá : <span class="req">*</span>
                            </label>
                            <div class="formRight">
                                <span class="oneTwo">
                                    <input _autocheck="true" placeholder=".....vnđ" class="format_number" value="<?php echo set_value('price'); ?>" id="param_price" style="width: 100px" name="price" type="text" maxlength="11"> 
                                    <img src="<?php echo public_url('admin/crown')?>/images/icons/notifications/information.png" style="margin-bottom: -8px" original-title="Giá bán sử dụng để giao dịch" class="tipS">
                                </span> 
                                <span class="autocheck" name="price_autocheck"></span>
                                <div class="clear error" name="price_error"><?php echo form_error('price') ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- truogn giam gia -->
                        <div class="formRow">
                            <label for="param_discount" class="formLeft"> Giá được giảm : </span>
                            </label>
                            <div class="formRight">
                                <span class="oneTwo">
                                    <input _autocheck="true" placeholder=".....vnđ" class="format_number" value="<?php echo set_value('discount'); ?>" id="discount" style="width: 100px" name="discount" type="text" maxlength="11"> 
                                    <img src="<?php echo public_url('admin/crown')?>/images/icons/notifications/information.png" style="margin-bottom: -8px" original-title="Giá được giảm, triết khấu" class="tipS">
                                </span> 
                                <span class="autocheck" name="discount_autocheck"></span>
                                <div class="clear error" name="discount_error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        
                       <!-- truong nguon goc  -->
                        <div class="formRow">
                            <label style="width:15%;" for="param_origin" class="formLeft">Nguồn gốc TP: <span class="req">*</label>
                            <div class="formRight">

                                <select name="partner_id"  class="left" >
                                    <option style="color: blue; font-weight: bold; value="">---------- Nguồn TP từ đối tác ----------</option> 
                                      <?php foreach($partner as $row): ?>
                                        <option  value="<?php echo $row->id ?>"> <?php echo $row->title ?> </option>
                                      <?php endforeach; ?>
                                </select>

                                 <button id="btn_partner">khác...</button>

                                <span style="display: none;" id="hide_partner" class="oneTwo">
                                    <textarea autofocus="autofocus" cols="" rows="5" _autocheck="true" id="param_origin" name="origin">
                                        <?php echo set_value('origin'); ?>
                                    </textarea>
                                </span> 
                                <span class="autocheck" name="partner_id_autocheck"></span>
                                <div class="clear error" name="partner_id_error"><?php echo form_error('partner_id'); ?></div>
                            </div><!-- end formRight -->
                            <div class="clear"></div>
                        </div>
                        
                        <!-- truong qua khuyen mai -->
                        <div class="formRow">
                            <label for="param_gifts" class="formLeft">Quà khuyến mại:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_gifts" name="gifts"><?php echo set_value('gifts')?></textarea></span>
                                <span class="autocheck" name="gifts_autocheck"></span>
                                <div class="clear error" name="gifts_error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>


                        <!-- Nổi bật -->
                        <div class="formRow">
                            <label for="param_warranty" class="formLeft">
                                Đặt làm thực phẩm nổi bật :
                            </label>
                            <div class="formRight">
                                <select name="noi_bat" id="noi_bat">
                                    <option value="0">Không</option>
                                    <option value="1">Có</option>
                                </select>
                                <div class="clear error" name="hsx_error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow hide"></div>
                     </div>  


                    
                     <div class="tab_content pd0" id="tab2" style="display: none;">
                        <!-- truong site_title -->
                            <div class="formRow">
                                <label for="param_site_title" class="formLeft">Title:</label>
                                <div class="formRight">
                                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_site_title" name="site_title"></textarea></span>
                                    <span class="autocheck" name="site_title_autocheck"></span>
                                    <div class="clear error" name="site_title_error"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="formRow">
                                <label for="param_meta_desc" class="formLeft">Meta description:</label>
                                <div class="formRight">
                                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_desc" name="meta_desc"></textarea></span>
                                    <span class="autocheck" name="meta_desc_autocheck"></span>
                                    <div class="clear error" name="meta_desc_error"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="formRow">
                                <label for="param_meta_key" class="formLeft">Meta keywords:</label>
                                <div class="formRight">
                                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_key" name="meta_key"></textarea></span>
                                    <span class="autocheck" name="meta_key_autocheck"></span>
                                    <div class="clear error" name="meta_key_error"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                         <div class="formRow hide"></div>
                     </div>



                    <div class="tab_content pd0" id="tab3" style="display: none;">
                        <div class="formRow">
                            <label for="param_nhung_video" class="formLeft">Mã nhúng Video:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_iframe" name="nhung_video"></textarea></span>
                                <span class="autocheck" name="nhung_video_autocheck"></span>
                                <div class="clear error" name="nhung_video_error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label for="param_meta_key" class="formLeft">Giới thiệu sản phẩm:  <span class="req">*</label>
                            <div class="formRight">
                                <span class="">
                                <textarea class="content" id="content" name="content"></textarea>
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
                        <input type="submit" class="redB" value="Thêm mới">
                        <input type="reset" class="basic" value="Hủy bỏ">
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
</div>
<div class="clear mt30"></div>
