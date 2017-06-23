<?php $this->load->view('admin/news/head', $this->data);?>

<div id="main_news" class="wrapper">
    <br>
    <!--  Load thông báo -->
    <?php $this->load->view('admin/message', $this->data); ?>
    
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6> <i class="fa fa-book fa-2x" aria-hidden="true"></i> Danh sách thực phẩm</h6>
            <div class="num f12">
                Số lượng: <b> <?php echo $total_rows?> bài viết </b>
            </div>
        </div>

        <table id="checkAll" class="sTable mTable myTable" width="100%"
            cellspacing="0" cellpadding="0">

            <thead class="filter">
                <tr>
                    <td colspan="9">
                        <form method="get" action="<?php echo admin_url('news'); ?>" class="list_filter form">
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
                                            onclick="window.location.href = '<?php echo admin_url('news'); ?>'; " value="Reset"
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
                    <td style="width: 250px;">Tên bài viết</td>
                    <td style="width: 150px;">Giới thiệu ngắn</td>
                    <td style="width: 60px;">Trạng thái</td>
                    <td style="width: 80px;">Hành động</td>
                </tr>
            </thead>

            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="9">
                        <div class="list_action itemActions">
                            <a url="<?php echo admin_url('news/delete_all');?>" class="button blueB" id="submit" href="#submit"> <span
                                style="color: white;">Xóa hết</span>
                            </a>
                        </div>
                        
                        <!-- noi hien thi link phan trang -->
                        <div class="pagination">
                          <?php echo $this->pagination->create_links() ?>
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
                        <td style="width:460px;">
                            <div class="image_news">
                                <a class="lightbox cboxElement" title="<?php echo $row->title ?>" href="<?php echo $row->image_link ?>">
                                  <img src="<?php echo $row->image_link?>" >
                                </a>
                                <div class="clear"></div>
                            </div> 
                            <div class="news_title">
                                <a target="_blank" href="<?php echo admin_url('news/edit/'.$row->id); ?>" class="tipS" original-title=""> <b><?php echo $row->title?></b>
                                 </a>
                                    <br>
                                 <span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_date($row->created);  ?> | <i class="fa fa-user" aria-hidden="true"></i> By: <?php echo $row->admin_add ?> | <i class="fa fa-eye" aria-hidden="true"></i> <?php echo $row->count_view ?> lượt xem </span>
                            </div>
                        </td>
                         
                        <!-- truong gioi thieu ngan -->
                         <td style="width:300px;" class="textc">
                             <p>
                                 <?php echo $row->intro ?>
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
                            <a id="<?php echo $row->id ?>"  title="xem nhanh nội dung" class="tipS view_content">
                                <img src="<?php echo public_url("admin/images")?>/icons/color/view.png" />
                            </a>

                            <a class="tipS" href="<?php echo admin_url('news/edit/'.$row->id); ?>" original-title="Chỉnh sửa"> <img src="<?php echo public_url()?>/admin/images/icons/color/edit.png"></a> 
                            
                            <a class="tipS verify_action" href="<?php echo admin_url('news/delete/'.$row->id); ?>" original-title="Xóa"> <img src="<?php echo public_url()?>/admin/images/icons/color/delete.png"> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    </div>
</div>


<!-- hien thi content nhanh -->
<div class="wrapper formRow">
    <div id="myModal" class="modal">
      <div class="modal-content">
            <div class="modal-header">
              <span class="close">&times;</span>
              <h3>Nội dung </h3>
            </div>

            <div class="modal-body">
                <!-- noi nhan ket qua tu ajax tra ve -->

            </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- end modal -->
    <div class="clear"></div>
</div><!-- wrapper -->

<script language="javascript">
       $(document).ready(function(){
            $('.view_content').on('click', function(){
               var id = $(this).attr('id'); // lay id de xem noi dung cua id do
               /*xu ly ajax*/
               $.ajax({
                    url: '<?php echo admin_url('news/viewcontent') ?>',
                    type: 'post',
                    data: {
                      'id' : id
                    },
                    dataType: 'text',
                    success: function(result)
                    {
                        $('.modal-body').html(result);
                    }
               });
               $('#myModal').css('display', 'block');
            });
            modal = $('#myModal');
            // lay phan tu span
            var span  = $('.close'); 
            // su kien dong dialog
            span.on('click', function(){
                 $('#myModal').css('display', 'none');
            });
            //Khi người dùng nhấp chuột vào bất cứ nơi nào bên ngoài phương thức, hãy đóng nó lại
            $(window).on('click', function(event){
                    if (event.target == modal) {
                        modal.css('display', 'none');
                    }
            });
       }); 
</script>

