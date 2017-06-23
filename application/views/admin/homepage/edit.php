<!-- head -->
<?php $this->load->view('admin/homepage/head', $this->data)?>

<div class="wrapper">
	   	<!-- Form -->
		<form enctype="multipart/form-data" method="post" action="" id="form" class="form">
			<fieldset>
				<div class="widget">
				    <div class="title">
  						<img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/add.png">
  						<h6>Chỉnh sữa thông tin homepage</h6>
					  </div><!-- end title -->

             <ul class="tabs">
                  <li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
                  <li class=""><a href="#tab2">Mã nhúng</a></li>
                  <li class=""><a href="#tab3">Nội dung</a></li>
              </ul>
							
      	<div class="tab_container">
      				<div class="tab_content pd0" id="tab1" style="display: block;">
              
              <!-- truong anh -->
              <div class="formRow">
                <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                <div class="formRight">
                  <div class="left">
                      <input type="text" name="image" id="image" value="<?php echo $info->image_link ?>" size="50">
                      <?php if($info->image_link != ''): ?>
                      <img src="<?php echo $info->image_link ?>" width="100px" alt=""  style="display: block">
                      <?php endif ?>
                  </div>
                  <input type="button" id="btn-browse-image" datainput="image" onclick="BrowseServer(this)" value="Browse" style="display: inline-block;">
                  <input type="button" id="btn-delete-image"  value="Delete" style="display: inline-block;">
                  <div class="clear error" name="image_error"></div>
                  
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

            <div class="formRow">
              <label class="formLeft">Ảnh favicon:<span class="req">*</span></label>
              <div class="formRight">
                <div class="left">
                    <input type="text" name="favicon" id="favicon" value="<?php echo $info->favicon ?>" size="50">
                    
                    <?php if($info->favicon != ''): ?>
                    <img src="<?php echo $info->favicon ?>" width="100px" alt=""  style="display: block">
                    <?php endif ?>
                </div>
                <input type="button" id="btn-browse-image" datainput="favicon" onclick="BrowseServer(this)" value="Browse" style="display: inline-block;">
                <input type="button" id="btn-delete-image"  value="Delete" style="display: inline-block;">
                <div class="clear error" name="image_error"></div>
                
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
            
            <!-- truong hotline -->
            <div class="formRow">
                <label for="param_name" class="formLeft">Hotline:</label>
                <div class="formRight">
                  <span class="oneTwo">
                  <input type="text" _autocheck="true" id="param_site_title" name="hotline" value="<?php echo $info->hotline?>">
                  </span>
                  <span class="autocheck" name="name_autocheck"></span>
                  <div class="clear error" name="name_error"><?php echo form_error('hotline')?></div>
                </div>
                <div class="clear"></div>
            </div>
            
            <!-- truogn email -->
            <div class="formRow">
                <label for="param_name" class="formLeft">Email:</label>
                <div class="formRight">
                  <span class="oneTwo">
                  <input type="text" _autocheck="true" id="param_site_title" name="email" value="<?php echo $info->email;?>">
                  </span>
                  <span class="autocheck" name="email_autocheck"></span>
                  <div class="clear error" name="email_error"><?php echo form_error('email')?></div>
                </div>
                <div class="clear"></div>
            </div>
            
            <!-- truong chat-box -->
            <div class="formRow">
              <label for="param_name" class="formLeft">Chat_box:</label>
              <div class="formRight">
                <span class="oneTwo">
                <textarea type="text" _autocheck="true" id="param_chat_box" name="chat_box" cols="79" rows="5">
                  <?php echo !empty($info->chat_box) ? $info->chat_box : ''?>
                </textarea>
                </span>
                <span class="autocheck" name="chat_box_autocheck"></span>
                <div class="clear error" name="chat_box_error"><?php echo form_error('chat_box')?></div>
              </div>
              <div class="clear"></div>
          </div>
        <div class="formRow hide"></div>
      </div><!-- end tab1 -->

      <div class="tab_content pd0" id="tab2" style="display: block;">	
          <div class="formRow">
            <label for="param_name" class="formLeft">Google analytic head:</label>
            <div class="formRight">
              <span class="oneTwo">
              <textarea type="text" _autocheck="true" id="param_analytic" name="analytic" cols="79" rows="5">
                <?php echo !empty($info->analytic) ? $info->analytic : ''?>
              </textarea>
              </span>
              <span class="autocheck" name="analytic_autocheck"></span>
              <div class="clear error" name="analytic_error"><?php echo form_error('analytic')?></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label for="param_name" class="formLeft">Liên kế html body:</label>
            <div class="formRight">
              <span class="oneTwo">
              <textarea type="text" _autocheck="true" id="param_analytic_2" name="analytic_2" cols="79" rows="5">
                <?php echo !empty($info->analytic_2) ? $info->analytic_2 : ''?>
              </textarea>
              </span>
              <span class="autocheck" name="analytic_autocheck"></span>
              <div class="clear error" name="analytic_error"><?php echo form_error('analytic')?></div>
            </div>
            <div class="clear"></div>
        </div>



        <div class="formRow">
            <label for="param_name" class="formLeft">Nhúng mã page_face:</label>
            <div class="formRight">
              <span class="oneTwo">
              <textarea type="text" _autocheck="true" id="param_page_face" name="page_face" cols="79" rows="5">
                <?php echo !empty($info->page_face) ? $info->page_face : ''?>
              </textarea>
              </span>
              <span class="autocheck" name="chat_box_autocheck"></span>
              <div class="clear error" name="chat_box_error"><?php echo form_error('page_face')?></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label for="param_name" class="formLeft">Nhúng mã Video_youtube:</label>
            <div class="formRight">
              <span class="oneTwo">
              <textarea type="text" _autocheck="true" id="param_video_youtube" name="video_youtube" cols="79" rows="5">
                <?php echo !empty($info->video_youtube) ? $info->video_youtube : ''?>
              </textarea>
              </span>
              <span class="autocheck" name="chat_box_autocheck"></span>
              <div class="clear error" name="chat_box_error"><?php echo form_error('video_youtube')?></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <label for="param_name" class="formLeft">Nhúng mã Google_map:</label>
            <div class="formRight">
              <span class="oneTwo">
              <textarea type="text" _autocheck="true" id="param_google_map" name="google_map" cols="79" rows="5">
                <?php echo !empty($info->google_map) ? $info->google_map : ''?>
              </textarea>
              </span>
              <span class="autocheck" name="analytic_autocheck"></span>
              <div class="clear error" name="analytic_error"><?php echo form_error('google_map')?></div>
            </div>
            <div class="clear"></div>
        </div>
      <div class="formRow hide"></div>
      </div><!-- tab2 -->




      <div class="tab_content pd0" id="tab3" style="display: block;"> 
            <div class="formRow hide"></div>
               <div class="formRow">
                <label for="param_name" class="formLeft">Site_title:<span class="req">*</span></label>
                <div class="formRight">
                  <span class="oneTwo">
                  <input type="text" _autocheck="true" id="param_site_title" name="site_title" value="<?php echo $info->site_title?>">
                  </span>
                  <span class="autocheck" name="name_autocheck"></span>
                  <div class="clear error" name="name_error"><?php echo form_error('site_title')?></div>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="formRow">
              <label for="param_name" class="formLeft">Site_description:<span class="req">*</span></label>
              <div class="formRight">
                <span class="oneTwo">
                <input type="text" _autocheck="true" id="param_site_desc" name="site_desc" value="<?php echo $info->site_desc?>">
                </span>
                <span class="autocheck" name="name_autocheck"></span>
                <div class="clear error" name="name_error"><?php echo form_error('site_desc')?></div>
              </div>
              <div class="clear"></div>
            </div>

            <div class="formRow">
              <label for="param_name" class="formLeft">Site_keyword:<span class="req">*</span></label>
              <div class="formRight">
                <span class="oneTwo">
                <input type="text" _autocheck="true" id="param_site_key" name="site_key" value="<?php echo $info->site_key?>">
                </span>
                <span class="autocheck" name="name_autocheck"></span>
                <div class="clear error" name="name_error"><?php echo form_error('site_key')?></div>
              </div>
              <div class="clear"></div>
            </div>      

            <!-- truong dia ban kinh doanh -->
              <div class="formRow">
                  <label for="param_meta_key" class="formLeft">Địa điểm kinh doanh:  <span class="req">*</label>
                  <div class="formRight">
                      <span class="">
                      <textarea class="content" id="content" name="diachi"><?php echo $info->diachi ?></textarea>
                      </span>
                  
                      <div class="clear error" name="diachi_error"><?php echo form_error('diachi')?></div>
                  </div>
                  <div class="clear"></div>
              </div>
              <script>CKEDITOR.replace( 'content' );</script>
          
              <div class="formRow hide"></div>
          </div>

      </div><!-- tab3 -->      

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
