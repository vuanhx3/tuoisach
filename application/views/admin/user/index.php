<!-- head -->
<?php $this->load->view('admin/user/head', $this->data);?>

<div id="main_member" class="wrapper">
<br>
    <!--  Load thông báo -->
    <?php $this->load->view('admin/message', $this->data);?>
<div class="widget">

	<div class="title">    
		<span class="titleIcon"><input type="checkbox" title="titleCheck" id="titleCheck"></span>
		<h6><i class="fa fa-bars" aria-hidden="true"></i> Danh sách thành viên</h6>
		<div class="num f12">
			Số lượng: <b> <?php echo $total?> </b>
		</div>
	</div>

	<table width="100%" cellspacing="0" cellpadding="0" id="checkAll"
		class="sTable mTable myTable">

		<thead class="filter">
			<tr>
				<td colspan="10">
					<form method="get" action="<?php echo admin_url('user')?>"
						class="list_filter form">
						<table width="80%" cellspacing="0" cellpadding="0">
							<tbody>

							<tr>
								<td style="width: 40px;" class="label">
								   <label for="filter_id">Mã số</label>
								</td>
								<td class="item">
							       <input type="text" style="width: 55px; text-align: center;" id="filter_id" value="<?php echo $this->input->get('id');?>" name="id">
								</td>
				
								<td style="width: 150px">
								   <input type="submit" value="Lọc" class="button blueB">
								   <input type="reset" onclick="window.location.href = '<?php echo admin_url('user')?>'; " value="Reset" class="basic">     
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
				<td style="width: 21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
				<td style="width: 21px;">Mã số</td>
				<td>Tên thành viên</td>
				<td>Email</td>
				<td>Phone</td>
				<td>Ngày thêm</td>
				<td style="width: 100px;">Hành động</td>
			</tr>
		</thead>

		<tfoot class="auto_check_pages">
			<tr>
				<td colspan="8">
					<div class="list_action itemActions">
						<a url="<?php echo admin_url('member/delete_all')?>" class="button blueB"
							id="submit" href="#submit"> <span style="color: white;">Xóa hết</span>
						</a>
					</div>
				</td>
			</tr>
		</tfoot>

		
		<tbody class="list_item">
		
		<?php foreach ($list as $row):?>
			<tr class="row_<?php echo $row->id?>">
				<td><input type="checkbox" value="<?php echo $row->id?>" name="id[]"></td>

				<td class="textC"><?php echo $row->id?></td>
                
                <!-- Tên thành viên -->
				<td class="textC"><?php echo $row->name?></td>

				
				<!-- Email -->
				<td class="textC"><?php echo $row->email?></td>
  
				
				<!-- Phone -->
				<td class="textC"><?php echo $row->phone?></td>  
				
  
                <!-- ngày tạo, cập nhật sản phẩm  --> 
				<td class="textC"> <?php echo get_date($row->created)?> </td>
				

			<td class="option textC">
				
			    <a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('user/del/'.$row->id)?>">
			     <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
			    </a>
			    
			 </td>
		</tr>
		 <?php endforeach;?>
		 
  </tbody>

	</table>
</div>

</div>