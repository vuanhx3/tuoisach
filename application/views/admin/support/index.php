<?php $this->load->view("admin/support/head")?>

<div class="wrapper">
	<?php $this->load->view("admin/message", $this->data) ?>
	<br>
	<div class="widget">
	
		<div class="title">
		    <img src="<?php echo public_url("admin")?>/images/icons/dark/list.png" class="titleIcon">
			<h6>Danh sách cộng tác viên support</h6>
		 	<div class="num f12">Tổng số: <b> <?php echo count($editor);?> cộng tác viên </b></div>
		</div>
		
		<form action="" method="get" class="form" name="filter">
			<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
				<thead>
					<tr>
						<td style="width:80px;">Mã số</td>
						<td>Tên CTV</td>
						<td>Email</td>
						<td>Số điện thoại</td>
						<td>Lựa chọn CTV</td>
						<td style="width:100px;">Hành động</td>
					</tr>
				</thead>
				
				<tbody>
					<!-- Filter -->
					  <?php foreach ($editor as $row): ?>	
						<tr>
							<td class="textC"><?php echo $row->id ?></td>
							<td>
								<div class="image_thumb">
									 <a class="lightbox cboxElement" title="<?php echo $row->name ?>" href="<?php echo $row->image_link ?>">
	                                   <img src="<?php echo $row->image_link?>" style="width: 150px; height: 130px;" >
	                                  </a>
                                  <div class="clear"></div>
                                </div>
                                <a style="cursor: pointer;" title="chi tiết thông tin cá nhân" id="<?php echo $row->id ?>" class="tipS myBtn" original-title=""> 
                                  <b><?php echo $row->name?></b>
                                </a>
                                <br>
                                <?php if($row->admin_group_id == 1): ?>
									<span title="<?php echo $row->username ?>" class="tipS">
									<i class="fa fa-user-times" aria-hidden="true"></i>
									 <?php echo "root admin"; ?>					
									</span>
							    <?php elseif($row->admin_group_id == 2) :?>
							    	<span title="<?php echo $row->username ?>" class="tipS">
									<i class="fa fa-users" aria-hidden="true"></i>
									 <?php echo "admin tổng"; ?>					
									</span>
								<?php else: ?>
									<span title="<?php echo $row->username ?>" class="tipS">
							    	 <i class="fa fa-user" aria-hidden="true"></i>
									 <?php echo "editor"; ?>					
									</span>
								<?php endif;?>
							</td>
							
							
							<td>
								<span title="<?php echo $row->emails ?>" class="tipS">
								 <?php echo $row->emails ?>					
								</span>
							</td>

							<td>
								<span title="<?php echo $row->phone ?>" class="tipS">
								 <?php echo $row->phone ?>					
								</span>
							</td>

							<!-- lua chon lam nguoi support hien thi -->
							<td>
								<?php if($row->luachon == 1): ?>
									<input type="checkbox" checked="checked"  disabled="disabled">	
								<?php else: ?>
									<input type="checkbox" disabled="disabled" >	
								<?php endif; ?>
							</td>

							
							<td class="option">
								<a href="<?php echo admin_url('support/edit/'.$row->id); ?>" title="Chỉnh sửa" class="tipS ">
								<img src="<?php echo public_url
								("admin")?>/images/icons/color/edit.png" />
								</a>
								
							</td>
						</tr>
					<?php endforeach; ?>	
				</tbody>
			</table>
		</form>
	</div>
</div><!-- end wrapper -->


<!-- hien thi thong tin ho so ca nhan -->
<div class="wrapper formRow">
	<div id="myModal" class="modal">
	  <div class="modal-content">
            <div class="modal-header">
              <span class="close">&times;</span>
              <h3>Thông tin nhanh cá nhân</h3>
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
			// su kien click show dialog tths
			$('.myBtn').on('click', function(){
				var id    = $(this).attr('id'); // lay id
				$.ajax({
					url: '<?php echo admin_url('admin/detail') ?>',
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

