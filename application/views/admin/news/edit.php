<?php $this->load->view('admin/news/head', $this->data); ?>

<div class="wrapper">
    <!-- Form -->
    <form enctype="multipart/form-data" method="post" action="" id="form" class="form">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/add.png">
                    <h6> Chỉnh sửa tin mẹo vặt </h6>
                </div>

                <ul class="tabs">
                    <li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
                    <li class=""><a href="#tab2">Nội dung</a></li>
                </ul>

                <div class="tab_container">
                    
                 <div class="tab_content pd0" id="tab1" style="display: block;">
                    <!-- truogn ten meo vat -->
                       <div class="formRow">
                            <label for="param_title" class="formLeft">Tên bài viết:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input type="text" value="<?php echo $info->title ?>" _autocheck="true" id="param_title" name="title"></span>
                                <span class="autocheck" name="title_autocheck"></span>
                                <div class="clear error" name="title_error"><?php echo form_error('title'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- truong slug -->
                        <div class="formRow">
                            <label for="param_slug" class="formLeft">Slug:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input type="text" value="<?php echo $info->slug ?>" _autocheck="true" id="param_slug" name="slug"></span>
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
                                    <input type="text" name="image" id="image" value="<?php echo $info->image_link ?>" size="70">
                                   <?php if($info->image_link != ''): ?>
                                    <img src="<?php echo $info->image_link ?>"  width="200px" height="130px;" alt=""  style="display: block">
                                    <?php endif ?>
                                    <p>Để hiển thị tốt kích thước ảnh tối thiểu <b style="color: #FF0000;">600 X 400</b></p>
                                </div>
                                <input type="button" id="btn" datainput="image" onclick="BrowseServer(this)" value="Browse" style="display: inline-block;">
                                <input type="button" id="btn-delete-image"  value="Delete" style="display: inline-block;">

                                <div class="clear error" name="image_error"><?php echo form_error('image')?></div>
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
                         

                         <!-- truong site_title -->
                         <div class="formRow">
                                <label for="param_site_title" class="formLeft">Seo title:</label>
                                <div class="formRight">
                                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_site_title" name="site_title"><?php echo $info->site_title ?></textarea></span>
                                    <span class="autocheck" name="site_title_autocheck"></span>
                                    <div class="clear error" name="site_title_error"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="formRow">
                                <label for="param_meta_desc" class="formLeft">Meta description:</label>
                                <div class="formRight">
                                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_desc" name="meta_desc"><?php echo $info->meta_desc ?></textarea></span>
                                    <span class="autocheck" name="meta_desc_autocheck"></span>
                                    <div class="clear error" name="meta_desc_error"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="formRow">
                                <label for="param_meta_key" class="formLeft">Meta keywords:</label>
                                <div class="formRight">
                                    <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_key" name="meta_key"><?php echo $info->meta_key ?></textarea></span>
                                    <span class="autocheck" name="meta_key_autocheck"></span>
                                    <div class="clear error" name="meta_key_error"></div>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="formRow"><!-- truong trang thai -->
                                <label for="param_cat" class="formLeft">Trạng thái: </label>
                                <div class="formRight">
                                    <label for="">
                                        <input <?php if($info->status == 1) echo 'checked="checked"' ?> type="radio" name="status" value="1"> Hiện
                                    </label>
                                    <label for="">
                                        <input <?php if($info->status == 0) echo 'checked="checked"' ?> type="radio" name="status" value="0"> Ẩn
                                    </label>
                                    <div class="clear error" name="meta_key_error"><?php echo form_error('status') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                             
                            <?php $tags = json_decode($info->tags); ?>   
                            <div class="formRow"><!-- truong the tag -->
                                <label for="param_cat" class="formLeft">Thẻ tags: <span class="req">*</label>
                                <div class="formRight">

                                    <ul class="tag_new">
                                        <?php if(count($tags) > 0): ?>
                                            <?php foreach($tags as $key => $val): ?>
                                               <li class="addedTag"> <?php echo $val ?>
                                                   <span onclick="$(this).parent().remove();" class="tagRemove">x</span>
                                                   <input type="hidden" name="tags[]" value="<?php echo $val ?>">
                                               </li>
                                            <?php endforeach;?>
                                        <?php else: ?>   
                                                <li class="addedTag"> 
                                                   <input type="hidden" name="tags[]" value="">
                                               </li>
                                        <?php endif;?>
                                    
                                            <li class="tagAdd taglist">  
                                                 <input type="text" id="search-field">
                                            </li>
                                    </ul>                
                                </div>
                                <div class="clear"></div>
                            </div><!-- end formrow -->
                            
                    <div class="formRow hide"></div>
                </div>


                <div class="tab_content pd0" id="tab2" style="display: none;">
                    
                    <!-- truong intro -->
                    <div class="formRow">
                        <label for="param_intro" class="formLeft">Giới thiệu ngắn:</label>
                        <div class="formRight">
                            <span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_iframe" name="intro"><?php echo $info->intro ?></textarea></span>
                            <span class="autocheck" name="intro_autocheck">(* Nhập giới thiệu nếu muốn thay đổi *)</span>
                            <div class="clear error" name="intro_error"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <!-- truong content -->
                    <div class="formRow">
                        <label for="param_meta_key" class="formLeft">Nội dung bài viết:  <span class="req">*</label>
                        <div class="formRight">
                            <span class="">
                            <textarea class="content" id="content" name="content"><?php echo $info->content ?></textarea>
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
                    <input type="submit" class="redB" value="Cập nhật">
                    <input type="reset" class="basic" value="Hủy bỏ">
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>
<div class="clear mt30"></div>
