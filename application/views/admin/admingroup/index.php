<?php $this->load->view("admin/admingroup/head")?>

<div class="wrapper">
	 <br>
	 <div style="display: none;" class="nNote nInformation hideit  info_restore">
         <p><strong>Thông báo: Khôi phục mặc định thành công ! </strong></p>
     </div>
	<div class="widget">
		<div class="title">
		   <img src="<?php echo public_url("admin")?>/images/icons/color/withdraw.png" class="titleIcon">
			<h6>Qui định nhóm quyền</h6>
			<a style="float: right;" name="<?php echo $info->password ?>" href="#login-box" title="khôi phục mặc định" class="tipS restore" >
			   <h6>khôi phục</h6>
				<img src="<?php echo public_url("admin")?>/images/icons/color/toolbox.png" class="titleIcon">
			</a>
		</div>
		
		<form action="" method="get" class="form" name="filter">
			<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
				<tbody>
					<div id="content">
						<p style="padding: 10px 10px; line-height: 2em; font-size: 14px;">
							<b>Tuoisachvvn</b> qui định quyền quản trị website chia làm 3 bậc root_admin, admin tổng và editor với lần lượt có các chức năng quyền hạn như sau:
							<br>
							* Thứ 1: root_admin là admin mặc định không thay thế được, đó là admin mặc định của website. <br>
							* Thứ 2: admin tổng có chức năng quyền hạn quản lý tất cả mọi thứ trong website. <br>
							* Thứ 3: Editor là admin thực thi các quyền được phân giao từ admin tổng theo nhóm quyền vd: đăng sản phẩm, thêm sửa xóa bài viết.... <br>
							* Thứ 4: Các bộ phận được giao hãy làm tốt nghĩa vụ của mình không nên đi quá giới hạn quyền được giao. <br>
						</p>
					</div>
				</tbody>
			</table>
		</form>
	</div>
</div><!-- end wrapper -->



<!-- box kiem tra ma khoi phuc -->
<div id="login-box" class="login">
    <p class="login_title"> Nhập mã kiểm tra </p>
    <a class="close">
    	<img src="<?php echo public_url('admin')?>/images/icons/dark/close.png" class="img-close" title="Close Window" alt="Close" />
    </a>
    <form method="post" class="login-content" action="#">
	    <label class="password">
		    <span>Mã code</span>
		    <input autofocus="autofocus" id="password" name="password" value="" type="password" placeholder="mã kiểm tra">
	    </label>
	    <button id="btn_restore" class="button submit-button" type="button">Kiểm tra</button>
	    <p id="restore_fail"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Mã code không đúng, hãy nhập lại !</p>
	    <p id="restore_fail1"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Bạn chưa nhập mã code !</p>
    </form>
</div>

<!-- jquery hien modal nhap ma khoi phuc them va xoa -->
<script language="javascript">
	$(document).ready(function(){
		$('.restore').on('click', function(){

			//lấy giá trị thuộc tính href - chính là phần tử "#login-box"
       		 var loginBox = $(this).attr('href');
       		//cho hiện hộp đăng nhập trong 300ms
        	$(loginBox).fadeIn("slow");
        	// them phan tu id="over" vao sau body 
        	$('body').append('<div id="over"></div>');
        	$('#over').fadeIn(300);
        	var password = $('#password').val();
        	return false;
		});
		// su kien click nut kiem tra
		$('#btn_restore').on('click', function(){
			var password = $('.restore').attr('name');
			var restore  = $('#password').val();
			if(restore == password)
			{
				$('#over, .login').fadeOut(300, function(){
			   	  	$('#over').remove();
			   	});
			   	$('.info_restore').css('display', 'block');
			   	$('.hide_permission').css('display', 'block');

			}else if(restore == ''){
				$('#restore_fail1').css('display', 'block');
				$('#restore_fail').css('display', 'none');
			}else{
				$('#restore_fail').css('display', 'block');
				$('#restore_fail1').css('display', 'none');
			}
		});
		// su kien nhan phim enter
		$(document).keypress(function(event){
			var password = $('.restore').attr('name');
			var restore  = $('#password').val();
		    var keycode = (event.keyCode ? event.keyCode : event.which);
		    if(keycode == '13'){
	          if(restore == password)
				{
					$('#over, .login').fadeOut(300, function(){
				   	  	$('#over').remove();
				   	});
				   	$('.info_restore').css('display', 'block');
				   	$('.hide_permission').css('display', 'block');

				}else if(restore == ''){
					$('#restore_fail1').css('display', 'block');
					$('#restore_fail').css('display', 'none');
				}else{
					$('#restore_fail').css('display', 'block');
					$('#restore_fail1').css('display', 'none');
				}
				return false;
		    }
		});
		// khi click thi dong box lai
	   $(document).on('click', "a.close, #over", function(){
	   	  $('#over, .login').fadeOut(300, function(){
	   	  	$('#over').remove();
	   	  });
	   	  	$('#restore_fail1').css('display', 'none');
		    $('#restore_fail').css('display', 'none');
	   	  return false;
	   });
	});
</script>


<!-- danh sach nhom quyen -->
<div class="wrapper">
    <br>
	<?php $this->load->view("admin/message", $this->data) ?>
	<br>
	<div class="widget">
	
		<div class="title">
		    <img src="<?php echo public_url("admin")?>/images/icons/dark/list.png" class="titleIcon">
			<h6>Danh sách nhóm phân quyền</h6>
		 	<div class="num f12">Tổng số: <b> <?php echo count($list);?> nhóm </b></div>
		</div>
		
		<form action="" method="get" class="form" name="filter">
			<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
				<thead>
					<tr>
						<td style="width:120px;">Mã số</td>
						<td>Tên nhóm quyền</td>
						<td>Thứ tự</td>
						<td>Ghi chú</td>
						<td style="width:100px;">Hành động</td>
					</tr>
				</thead>
				
				<tbody>
					<!-- Filter -->
					  <?php foreach ($list as $row): ?>	
						<tr>
							
							<td class="textC"><?php echo $row->id ?></td>
							
							<td>
							 <?php if($row->id == 1 && $row->root == 1): ?>
								<span title="<?php echo $row->name ?>" class="tipS">
								  <?php echo $row->name ?> <b>(root admin)	</b>				
								</span>
							  <?php elseif($row->id == 1): ?>
							  	<span title="<?php echo $row->name ?>" class="tipS">
								  <?php echo $row->name ?> <b>(admin tổng)	</b>				
								</span>
							  <?php else: ?>
							  	<span title="<?php echo $row->name ?>" class="tipS">
								  <?php echo $row->name ?>					
								</span>	
							  <?php endif; ?>	
							</td>

							<td>
								<span  title="<?php echo $row->sort_order ?>" class="tipS">
								 <?php echo $row->sort_order ?>					
								</span>
							</td>

							<td>
								<?php if($row->note == '' ): ?>
									<span  class="tipS">
									  <?php echo 'chưa có ghi chú' ?>					
									</span>
								<?php else: ?>
									<span title="<?php echo $row->note ?>" class="tipS">
									 <?php echo $row->note ?>					
									</span>
								<?php endif; ?>
							</td>
							
							
							<td class="option">
								 <a href="<?php echo admin_url('admingroup/edit/'.$row->id); ?>" title="Chỉnh sửa" class="tipS ">
								<img src="<?php echo public_url
								("admin")?>/images/icons/color/edit.png" />
								</a>
								
								<?php if($row->id == 1 && $row->root == 1): ?>
									<a style="width: 20px; float: right; margin-right: 20px;"  title="admin này không xóa được !" class="tipS hide_permission" >
									    <img src="<?php echo public_url
									    ("admin")?>/images/icons/color/delete.png" />
									</a>
							    <?php else: ?>
							    	<a style="width: 20px; float: right; margin-right: 20px;" href="<?php echo admin_url('admingroup/delete/'.$row->id); ?>" title="Xóa" class="tipS verify_action hide_permission" >
								    <img src="<?php echo public_url
								    ("admin")?>/images/icons/color/delete.png" />
									</a>
							    <?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>	
				</tbody>
			</table>
		</form>
	</div>
</div><!-- end wrapper -->

<div class="wrapper">

</div><!-- end wrapper  -->

