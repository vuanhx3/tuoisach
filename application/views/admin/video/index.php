<?php $this->load->view("admin/video/head")?>

<div class="wrapper">

	<?php $this->load->view("admin/message", $this->data) ?>
	<br>
	<div class="widget">
	
		<div class="title">
		    <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
		    <img src="<?php echo public_url("admin")?>/images/icons/dark/list.png" class="titleIcon">
			<h6>Danh sách ban quản trị</h6>
		 	<div class="num f12">Tổng số: <b> <?php echo $total_rows ?> video </b></div>
		</div>
		
		<table id="checkAll" class="sTable mTable myTable" width="100%" cellspacing="0" cellpadding="0">

				<thead class="filter">
                <tr>
                    <td colspan="9">
                        <form method="get" action="<?php echo admin_url('video'); ?>" class="list_filter form">
                            <table width="80%" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 40px;" class="label">
                                            <label for="filter_id">Mã số</label>
                                        </td>
                                        <td class="item"><input
                                            style="width: 55px; text-align: center;" id="filter_id"
                                            value="<?php echo $this->input->get('id'); ?>" name="id" type="text">
                                        </td>

                                        <td style="width: 100px;" class="label">
                                           <label for="filter_id">Tên video</label>
                                        </td>
                                        <td style="width: 155px;" class="item"><input
                                            style="width: 155px;" id="filter_iname" value="<?php echo $this->input->get('name'); ?>" name="name"
                                            type="text">
                                        </td>

                                        <td style="width: 100px;" class="label"><label
                                            for="filter_status">Theo danh mục</label></td>
                                        <td class="item">
                                           <select name="catalog">
                                                <option style="color: blue; font-weight: bold;" value="0">   CHỌN THỰC PHẨM
                                                </option>
                                                  <?php foreach($catalogs as $row_1): ?>
                                                    <?php if (count($row_1->subs) > 0):?>
                                                        <!-- kiem tra danh muc co danh muc con hay khong -->
                                                        <optgroup label="<?php echo $row_1->name ?>">
                                                            <!-- hien thi list the loai TP con -->
                                                            <?php foreach($row_1->subs as $subs): ?>
                                                             <option value="<?php echo $subs->id ?>" <?php
                                                             echo $this->input->get('catalog') == $subs->id ? 'selected': ''; ?>><?php echo $subs->name ?></option>
                                                            <?php endforeach; ?> 
                                                        </optgroup>
                                                    <?php else: ?>
                                                        <!-- con khong hien thi danh muc cha -->
                                                        <option value="<?php echo $row_1->id ?>" <?php echo $this->input->get('catalog') == $row_1->id ? 'selected' : ''; ?>><?php echo $row_1->name ?></option>
                                                    <?php endif; ?>
                                                  <?php endforeach; ?>  
                                           </select>
                                        </td>

                                        <td style="width: 150px">
                                          <input value="Lọc"class="button blueB" type="submit"> 
                                          <input
                                            onclick="window.location.href = '<?php echo admin_url('video'); ?>'; " value="Reset"
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
						<td style="width:20px;">Mã số</td>
						<td style="width:270px;">Tên video / ảnh đại diện</td>
						<td style="width:230px;">link video</td>
						<td>Thuộc thể loại</td>
						<td>Trạng thái</td>
						<td style="width:100px;">Ngày đăng / cập nhật</td>
						<td style="width:50px;">Hành động</td>
					</tr>
				</thead>

				<tfoot class="auto_check_pages">
	                <tr>
	                    <td colspan="9">
	                        <div class="list_action itemActions">
	                            <a url="<?php echo admin_url('video/delete_all');?>" class="button blueB" id="submit" href="#submit"> <span
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
				
				<tbody>
					<!-- Filter -->
					  <?php foreach ($list as $row_1): ?>	
						<tr class="row_<?php echo $row_1->id?>">
						    <td><input type="checkbox" value="<?php echo $row_1->id?>" name="id[]"></td>
						<!-- truong ma so -->
							<td class="textC"><?php echo $row_1->id ?></td>

							<!-- truong ten va hinh anh dai dien video -->
							<td>
								<a id="<?php echo $row_1->id ?>" class="tipS myBtn" title="xem ảnh" ><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i></a>
                                <a style="cursor: pointer;" target="_Blank" title="<?php echo $row_1->name ?>" href="<?php echo admin_url('video/edit/'.$row_1->id); ?>" class="tipS" original-title=""> 
                                  <b><?php echo $row_1->name?></b>
                                </a>
                                <br>
						    	 <i class="fa fa-eye" aria-hidden="true"></i>
								 <?php echo $row_1->view . ' lượt xem' ?>					
								</span>
							</td>
							
							<!-- truong ma nhung link youtube -->
							<td style="width: 325px; height: 190px;">
								 <?php echo $row_1->link ?>				
							</td>
							
							<!-- truong thuoc danh muc nao -->
							<td>
								<span >
								<?php foreach($catalogs as  $row): ?>
									<?php if(count($row->subs) > 0): ?>
									     <?php foreach($row->subs as $subs): ?>
											<?php if($subs->id == $row_1->catalog_id): ?>
												<?php echo $subs->name ?>		
											<?php else: ?>
												<?php echo ''; ?>	
											<?php endif; ?>	
									     <?php endforeach; ?>	
									<?php endif; ?>
								<?php endforeach; ?>
								</span>
							</td>

							<!-- truong trang thai -->
							<td>
								<?php if($row_1->status > 0): ?>
									<?php echo 'Đang hiện'; ?>
								<?php else: ?>
									<?php echo 'Đang ẩn'; ?>	
								<?php endif; ?>
							</td>

 							<!-- ngày tạo, cập nhật sản phẩm  -->
                        	<td class="textC"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_date($row_1->created); ?></td>
							
							<td class="option">
								<a href="<?php echo admin_url('video/edit/'.$row_1->id); ?>" title="Chỉnh sửa" class="tipS ">
								<img src="<?php echo public_url
								("admin")?>/images/icons/color/edit.png" />
								</a>
								
								<a href="<?php echo admin_url('video/delete/'.$row_1->id); ?>" title="xóa" class="tipS verify_action" >
								    <img src="<?php echo public_url
								    ("admin")?>/images/icons/color/delete.png" />
								</a>
							</td>
						</tr>
					<?php endforeach; ?>	
				</tbody>
			</table>
	</div>
</div><!-- end wrapper -->


 <!-- hien thi thong tin ho so ca nhan -->
<div class="wrapper formRow_1">
	<div id="myModal" class="modal">
	  <div class="modal-content">
            <div class="modal-header">
              <span class="close">&times;</span>
              <h3>Thông tin Video</h3>
            </div>

            <div class="modal-body">
				<!-- ham ket qua tu ajax tra ve --> 

            </div><!-- modal-body -->
      </div><!-- modal-content -->
	</div><!-- end modal -->
    <div class="clear"></div>
</div><!-- wrapper -->
<script language="javascript">
	$(document).ready(function(){
			// su kien click show dialog tths
			$('.myBtn').on('click', function(){
				var id    = $(this).attr('id'); // lay id
				$.ajax({
					url: '<?php echo admin_url('video/detail') ?>',
					type:'post',
					data:{
						'id':id	
					},
					dataType:'text',
					success : function(result){
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

 