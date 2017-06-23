<!-- header -->
<?php $this->load->view('admin/admin/head', $this->data); ?>

<!-- phan noi dung -->
<div class="wrapper">
	
	<form id="form" class="form" enctype="multipart/form-data" method="post" action="">
		<fieldset>
			<div class="widget">
				<div class="title">
					<img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/add.png">
					<h6>
						<i class="fa fa-user-plus" aria-hidden="true"></i> Thêm mới quản trị viên
					</h6>
				</div>
				
                <!-- trường Tên -->
				<div class="formRow">
					<label for="param_name" class="formLeft">Tên:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input _autocheck="true" autofocus="autofocus" id="param_name" value="<?php echo set_value('name') ?>" name="name" type="text"></span>
							 <span class="autocheck" name="name_autocheck">( ít nhất là 6 ký tự trở lên  )</span>
						<div class="clear error" name="name_error"><?php echo form_error('name')?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<!-- Trường Username -->
				<div class="formRow">
					<label for="param_username" class="formLeft">Username:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input _autocheck="true" id="param_username" value="<?php echo set_value("username") ?>" name="username" type="text"></span> 
							<span class="autocheck" name="username_autocheck">( tối thiểu là 6, tối đa là 12 ký tự  )</span>
						<div class="clear error" name="username_error"><?php echo form_error('username')?></div>
					</div>
					<div class="clear"></div>
				</div>

				 <!-- truong hinh anh -->
                <div class="formRow">
                    <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                    <div class="formRight">
                        <div class="left">
                            <!-- <input type="file" name="image" id="image" size="25"> -->
                            <input type="text" style="width:200px; margin-right:0px;" name="image" id="image" value="<?php echo set_value('image')  ?>" size="70">
                        </div>
                        <div class="right">
                            <img src="<?php echo set_value('image') ?>" width="150px" height="130px;" alt=""  style="display: block">
                            <p>Để hiển thị tốt kích thước ảnh tối thiểu <b style="color: #FF0000;">150 X 130</b></p>
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
                            var inputAdd = jQuery(this).parent().find('.formRight').last().clone(true);
                            var lastIdInput = inputAdd.find('input[type=text]').attr('id');
                            lastIdInput = lastIdInput.replace(/[^0-9]/g,'');
                            lastIdInput = parseInt(lastIdInput) + idInput;
                            
                            inputAdd.find('input[type=text]').attr('id','image_list'+lastIdInput);
                            inputAdd.find('input[type=button]').attr('datainput','image_list'+lastIdInput);
                            inputAdd.find('img').remove();
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
				
				<!-- Trường Nhập mật khẩu -->
				<div class="formRow">
					<label for="param_password" class="formLeft">Password:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
						   <input _autocheck="true" id="param_password" value="<?php echo set_value('password') ?>" name="password" type="password">
						</span> 
					    <span class="autocheck" name="password_autocheck">( mật khẩu tối đa là 8 ký tự )</span>
						<div class="clear error" name="password_error"><?php echo form_error('password')?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<!-- Trường nhập lại mật khẩu -->
				<div class="formRow">
					<label for="param_re_password" class="formLeft">Nhập lại mật khẩu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input _autocheck="true" id="param_re_password" name="re_password" type="password"></span> 
							<span class="autocheck" name="re_password_autocheck"></span>
						<div class="clear error" name="re_password_error"><?php echo form_error('re_password')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<!-- Trường nhập ngày sinh -->
				<div class="formRow">
					<label for="param_date" class="formLeft">Ngày sinh:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
							<input _autocheck="true" style="width: 150px;" value="<?php echo set_value('date') ?>" id="param_date" name="date" type="date" min="1980-12-31" max="2000-01-02">
						</span> 
						<span class="autocheck" name="date_autocheck"></span>
						<div class="clear error" name="date_error"><?php echo form_error('date'); ?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<!-- Trường address -->
				<div class="formRow">
					<label for="param_address" class="formLeft">Địa chỉ:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input _autocheck="true" id="param_address" value="<?php echo set_value('address') ?>" name="address" type="text"></span> 
							<span class="autocheck" name="address_autocheck">( tối thiểu là 6, tối đa là 12 ký tự  )</span>
						<div class="clear error" name="address_error"><?php echo form_error('address')?></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<!-- Trường emails -->
				<div class="formRow">
					<label for="param_emails" class="formLeft">Emails:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo">
						  <input _autocheck="true" placeholder="abc.address@gmail.com" id="param_emails" value="<?php echo set_value('emails') ?>" name="emails" type="text">
						</span> 
							<span class="autocheck" name="emails_autocheck"></span>
						<div class="clear error" name="emails_error"><?php echo form_error('emails')?></div>
					</div>
					<div class="clear"></div>
				</div>
				
			   <!-- Trường phone -->
				<div class="formRow">
					<label for="param_phone" class="formLeft">Số điện thoại:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input _autocheck="true" id="param_phone" value="<?php echo set_value('phone') ?>" name="phone" type="text"></span> 
							<span class="autocheck" name="phone_autocheck"></span>
						<div class="clear error" name="phone_error"><?php echo form_error('phone')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<!-- Truong phan quyen -->
				<div class="formRow">
                    <label class="col-sm-2 control-label" class="formLeft">Cấp bậc : *</label>
                    <div class="formRight">
                         <select name="admin_group_id" id="level" class="left" >
                            <option style="color: blue; font-weight: bold;" value="">------level-----</option> 
                            <option value="2"> admin  </option>
                            <option value="3"> editor </option>
                        </select>
                        <span class="autocheck" name="cat_autocheck"></span>
                        <div class="clear error" name="cat_error"><?php echo form_error('admin_group_id') ?></div>
                    </div>

                  <div class="clear"></div>
                </div>


				
				 <!-- phan phan quyen id="form_hide" -->
					<div class="formRow">
						<label for="param_permission" class="formLeft">Phân quyền <span class="req">*</span></label>
						<div class="formRight">
						<label for=""><input type="checkbox" id="select_all"/> Chọn Hết </label>
							<?php foreach($config_permissions as $controller => $actions): ?>
								<div class="permission">
									<label for=""><b><?php echo $controller ?>:</b></label>
									<?php foreach($actions as $sub): ?>
										<label  for=""> <input class="checkbox" type="checkbox" name="permissions[<?php echo $controller ?>][]" value="<?php echo $sub ?>" /> <?php echo $sub ?> </label>
									<?php endforeach; ?>
								</div>
							<?php endforeach; ?>
						</div><!-- end formRight -->
						<div class="clear"></div>
					</div><!-- end form_hide -->
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
					<script type="text/javascript">
					$(document).ready(function(){
					    $('#select_all').on('click',function(){
					        if(this.checked){
					            $('.checkbox').each(function(){
					                this.checked = true;
					            });
					        }else{
					             $('.checkbox').each(function(){
					                this.checked = false;
					            });
					        }
					    });
					    
					    // kiem tra checked lan 2 de bỏ check 
					    $('.checkbox').on('click',function(){
					        if($('.checkbox:checked').length == $('.checkbox').length){
					            $('#select_all').prop('checked',true);
					        }else{
					            $('#select_all').prop('checked',false);
					        }
					    });
					});
					</script>
					
                 <!-- <script language="javascript">
                	$(document).ready(function(){
                		$('#level ').change(function() {
                		   var id = $(this).val();
                		   if(id == 3)
                		   {
                		   	 $('#form_hide').fadeIn();
                		   }else{
                		   	 $('#form_hide').fadeOut();
                		   }
                		});
                	});
                </script> -->
               
				
				<div class="formSubmit">
					<input class="redB" value="Thêm Mới" type="submit">
					<input class="basic" value="Hủy bỏ" type="reset">
		        </div>
				
			</div><!-- End widget -->
		</fieldset>
	</form>
</div>