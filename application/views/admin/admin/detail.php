
        <!-- nhan xu ly ajax tu modal trang index -> function detail -> view detail de xu ly xong gui lai trang index -->
                <div class="img_modal">
                  <img  src="<?php echo $info->image_link ?>">
                 </div><!-- img_modal -->

                <div class="detail_modal">
                     <p>
                        <i class="fa fa-user" aria-hidden="true"></i> <b> <?php echo $info->name ?> </b><br>
                        <i>(<?php echo $info->username ?>)</i>
                    </p>
                    <p>
                      <?php if($info->admin_group_id == 1): ?>
                          <i class="fa fa-user-times" aria-hidden="true"></i> <span>Admin root</span><br>
                          <i>(Có quyền hạn tất cả, admin mặc định không thay thế được)</i>
                       <?php elseif($info->admin_group_id == 2): ?>
                          <i class="fa fa-users" aria-hidden="true"></i> <span>Admin </span><br>
                          <i>(Có quyền hạn tất cả)</i>
                       <?php else: ?>
                          <i class="fa fa-user" aria-hidden="true"></i> <span>Chuyên viên</span><br>
                          <i>(Đăng thực phẩm, viết bài...Thêm, sửa, xóa...)</i>
                       <?php endif; ?> 
                    </p>
                    <p><i class="fa fa-birthday-cake" aria-hidden="true"></i> <?php echo $info->date ?></p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $info->emails  ?> </p>
                    <p><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $info->phone  ?> </p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $info->address  ?> </p>
                    <p>
                        <i class="fa fa-crosshairs" aria-hidden="true"></i> <span>Phân quyền</span><br>
                        <?php if($info->admin_group_id == 1): ?>
                           <i>( Admin có quyền hạn tất cả, admin mặc định )</i>
                        <?php elseif($info->admin_group_id == 2): ?>
                           <i>( Admin, admin có quyền hạn public )</i>
                         <?php elseif($info->admin_group_id == 3): ?>
                             <label for="param_permission" style="width: 100%;">Các quyền của admin : <span class="req">*</span></label>
                             <div class="form_permission">
                                <?php foreach($config_permissions as $controller => $actions): ?> 
                                   <?php 
                                      $permissions_sub = array();
                                      if(isset($info->permissions->{$controller}))
                                      {
                                        // lap cac key cua quyen vd nhu admin, catalog...
                                        $permissions_sub = $info->permissions->{$controller};
                                      }
                                    ?> 
                                    <div class="box_permission">
                                      <label for=""><b><?php echo $controller ?>:</b></label>
                                      <div class="permission">
                                        <!-- lap cac  action trong key -->
                                        <?php foreach($actions as $sub): ?>
                                          <label  for=""> <input type="checkbox" name="permissions<?php echo $controller ?>[]" value="<?php echo $sub ?>" <?php echo (in_array($sub, $permissions_sub)) ? 'checked' : '' ?> disabled="disabled" />
                                              <?php echo $sub; ?>
                                            </label>
                                        <?php endforeach; ?>
                                      </div><!-- end permission -->
                                      </div>
                                  <?php endforeach; ?>
                                </div><!-- box_permission -->
                         <?php else: ?>
                            <i>( Admin chưa được phân quyền )</i>
                        <?php endif; ?>
                        
                    </p>
               </div><!-- detail_modal -->
            
