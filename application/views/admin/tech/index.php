<?php $this->load->view('admin/tech/head', $this->data);?>

<?php if(count($list) <= 2): ?>
<!-- cho them moi -->
<div class="wrapper">
    <!-- Form -->
    <form enctype="multipart/form-data" method="post" action="" id="form" class="form">
        <fieldset>
            <div class="widget">

                <div class="title">
                    <img class="titleIcon" src="<?php echo public_url('admin/images') ?>/icons/dark/add.png">
                    <h6>Thêm mới bài viết  </h6>
                </div><!-- title -->
                
               <!-- Các tap hiển thị --> 
                <ul class="tabs">
                    <li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
                </ul>

                <div class="tab_container">
                    <div class="tab_add">

                       <div class="formRow-add">
                           <label for="title" class="formLeft">Tên công nghệ áp dụng:<span class="req">*</span></label>
                           <div class="formRight-add">
                                <span class="oneAdd">
                                  <input _autocheck="true" value="" id="title" name="title" type="text">
                                </span> 
                                <span class="autocheck" name="title_autocheck"></span>
                                <div class="clear error" name="title_error"><?php echo form_error('title') ?></div>
                            </div>
                       </div><!-- end formRow-add --> 

                       <div style="width: 40%; " class="formRow-add">
                           <label for="param_content" class="formLeft">Nội dung:<span class="req">*</span></label>
                           <div class="formRight-add">
                               <span class="oneAdd"><textarea cols="" rows="4" _autocheck="true" id="param_content" name="content"></textarea></span>
                               <span class="autocheck" name="content_autocheck"></span>
                               <div class="clear error" name="content_error"><?php echo form_error('content') ?></div>
                            </div>
                       </div><!-- end formRow-add --> 


                       <div style="width: 15%; padding-left:20px;" class="formRow-add">
                           <label for="param_status" class="formLeft">Trạng thái:<span class="req">*</span></label>
                           <div class="formRight-add">
                                <label for="">
                                    <input type="radio" name="status" value="1"> Hiện
                                </label>
                                <label for="">
                                    <input type="radio" name="status" value="0"> Ẩn
                                </label>
                                 <span class="autocheck" name="content_autocheck"></span>
                                <div class="clear error" name="content_error"><?php echo form_error('status') ?></div>
                            </div>
                       </div><!-- end formRow-add -->

                    </div><!-- tab-add -->                 
                </div><!-- End tab_container-->

                <div class="formSubmit">
                    <input class="redB" value="Lưu" type="submit"> 
                    <input class="basic" value="Hủy bỏ" type="reset">
                </div>

                <div class="clear"></div>
            </fieldset>
    </form>
</div>
<?php else: ?>
    <?php echo ''; ?>
<?php endif; ?>    


<div id="main_tech" class="wrapper">
    <br>
    <!--  Load thông báo -->
    <?php $this->load->view('admin/message', $this->data); ?>
    
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6> <i class="fa fa-book fa-2x" aria-hidden="true"></i> Danh sách công nghệ <span style="color: #197D07;">(* tối đa là 3 Tin *)</span></h6>
            <div class="num f12">
                Số lượng: <b> <?php echo $total_rows?> bài viết </b>
            </div>
        </div>

        <table id="checkAll" class="sTable mTable myTable" width="100%"
            cellspacing="0" cellpadding="0">

            <thead class="filter">
                <tr>
                    <td colspan="9">
                        <form method="get" action="<?php echo admin_url('tech'); ?>" class="list_filter form">
                            <table width="80%" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 120px;" class="label">
                                            <label for="filter_id">Mã số  bài viết</label>
                                        </td>
                                        <td class="item"><input
                                            style="width: 55px; text-align: center;" id="filter_id"
                                            value="<?php echo $this->input->get('id'); ?>" name="id" type="text">
                                        </td>

                                        <td style="width: 120px;" class="label">
                                            <label for="filter_title">Tên  bài viết</label>
                                        </td>
                                        <td class="item"><input
                                            style="width: 150px; text-align: center;" id="filter_title"
                                            value="<?php echo $this->input->get('title'); ?>" name="title" type="text">
                                        </td>

                                        <td style="width: 180px">
                                          <input value="Lọc"class="button blueB" type="submit"> 
                                          <input
                                            onclick="window.location.href = '<?php echo admin_url('tech'); ?>'; " value="Reset"
                                            class="basic" type="reset">
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </form>
                    </td>
                </tr>
            </thead>

            <thead>
                <tr>
                    <td style="width: 20px;"><img src="<?php echo public_url()?>/admin/images/icons/tableArrows.png"></td>
                    <td style="width: 30px;">Mã số</td>
                    <td style="width: 150px;">Tên bài viết</td>
                    <td style="width: 250px;">Nội dung</td>
                    <td style="width: 60px;">Trạng thái</td>
                    <td style="width: 80px;">Hành động</td>
                </tr>
            </thead>

            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="9">
                        <div class="list_action itemActions">
                            <a url="<?php echo admin_url('tech/delete_all');?>" class="button blueB" id="submit" href="#submit"> <span
                                style="color: white;">Xóa hết</span>
                            </a>
                        </div>
                    </td>
                </tr>
            </tfoot>

            <tbody class="list_item">
              <?php foreach($list as $row): ?>
                    <tr class="row_<?php echo $row->id?>">
                        <td><input type="checkbox" value="<?php echo $row->id?>" name="id[]"></td>
    
                        <td class="textC"><?php echo $row->id?></td>
    
                        <!-- truong ten bai viet -->
                        <td style="width:300px;">
                            <div class="tech_title">
                                <a target="_blank" href="<?php echo admin_url('tech/edit/'.$row->id); ?>" class="tipS" original-title=""> <b><?php echo $row->title?></b>
                                 </a>
                                 <br>
                                 <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_date($row->created);  ?> | <i class="fa fa-user" aria-hidden="true"></i> By: <?php echo $row->admin_add ?>
                            </div>
                        </td>
                         
                        <!-- truong gioi thieu ngan -->
                         <td style="width:460px;" class="textc">
                             <p>
                                 <?php echo $row->content ?>
                             </p>
                         </td>

                          <td class="textc">
                            <?php if($row->status >= 1): ?>
                                <?php echo 'đang hiện'; ?>
                            <?php else: ?>
                                <?php echo 'đang ẩn'; ?>
                            <?php endif; ?>
                         </td>
    
                        <td class="option textC">
                            <a class="tipS" href="<?php echo admin_url('tech/edit/'.$row->id); ?>" original-title="Chỉnh sửa"> <img src="<?php echo public_url()?>/admin/images/icons/color/edit.png"></a> 
                            
                            <a class="tipS verify_action" href="<?php echo admin_url('tech/delete/'.$row->id); ?>" original-title="Xóa"> <img src="<?php echo public_url()?>/admin/images/icons/color/delete.png"> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    </div>
</div>




