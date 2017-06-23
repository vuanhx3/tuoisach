<!-- hiển thị các list danh sách admin -->
<!-- head -->
<?php $this->load->view('admin/transaction/head', $this->data);?>

<div id="main_transaction" class="wrapper">
<br>
    <!--  Load thông báo -->
     <?php $this->load->view('admin/message', $this->data);?>
<div class="widget">

	<div class="title">    
		<span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
		<h6>
		      Danh sách giao dịch
		</h6>
		<div class="num f12">
			Số lượng: <b> <?php echo $total_rows ?> </b>
		</div>
	</div>

	<table width="100%" cellspacing="0" cellpadding="0" id="checkAll"
		class="sTable mTable myTable">

		<thead class="filter">
			<tr>
				<td colspan="9">
					<form method="get" action="<?php echo admin_url('transaction')?>"
						class="list_filter form">
						<table width="90%" cellspacing="0" cellpadding="0">
							<tbody>

							<tr>
							
								<td style="width: 80px;" class="label">
								   <label for="filter_id">Mã số giao dịch</label>
								</td>
								<td class="item">
							       <input type="text" style="width: 55px; text-align: center;" id="filter_id" value="<?php echo $this->input->get('id');?>" name="id">
								</td>
								
                                <td style="width: 60px;" class="label">
								   <label for="filter_id">Tên Khách Hàng</label>
								</td>
								<td style="width: 155px;" class="item">
							     	<input type="text" style="width: 155px;" id="filter_iname" value="<?php echo $this->input->get('user_name');?>" name="user_name">
								</td>

								<td style="width: 150px">
								   <input type="submit" value="Lọc" class="button blueB">
								   <input type="reset" onclick="window.location.href = '<?php echo admin_url('transaction')?>'; " value="Reset" class="basic">     
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
				<td style="width: 20px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
				<td style="width: 40px;">Mã GD</td>
				<td style="width: 250px;">Tên Khách Hàng</td>
				<td style="width: 200px;">Đơn Hàng</td>
				<td style="width: 140px;">Tổng tiền</td>
				<td style="width: 100px;">Cổng thanh toán</td>
				<td style="width: 100px;">Trạng thái</td>
				<td style="width: 100px;">Ngày tạo</td>
				<td style="width: 50px;">Hành động</td>
			</tr>
		</thead>

		<tfoot class="auto_check_pages">
			<tr>
				<td colspan="9">
					<div class="list_action itemActions">
						<a url="<?php echo admin_url('transaction/delete_all')?>" class="button blueB"
							id="submit" href="#submit"> <span style="color: white;">Xóa hết</span>
						</a>
					</div>

					<div class="pagination">
					   <?php echo $this->pagination->create_links() ?>
					</div>
				</td>
			</tr>
		</tfoot>

		
		<tbody class="list_item">
		
		<?php foreach ($list as $row):?>
			<tr class="row_<?php echo $row->id?>">
			
				<td><input type="checkbox" value="<?php echo $row->id?>" name="id[]"></td>

				<td class="textC"><?php echo $row->id?></td>
				
				<td class="textL">
					 <div style="font-style: italic;" class="f11">
					   <span class="info-custormer">Khách hàng: <?php echo $row->user_name?></span>
					    <br>
					 	<span class="info-custormer">Mail: <?php echo $row->user_email ?></span>
					 	<br>
						<span class="info-custormer">SDT: <?php echo $row->user_phone?></span>
						<br>
						<?php foreach($list_huyen as $row_huyen): ?>
						  <?php if($row_huyen->id == $row->huyen ): ?>
							<span class="info-custormer">Địa chỉ: huyện <?php echo $row_huyen->name ?> </span>
						  <?php endif; ?>
						<?php endforeach; ?>
						,
						<?php foreach($list_tinh as $row_tinh): ?>
						  <?php if($row_tinh->id == $row->tinh ): ?>
							<span class="info-custormer">Tỉnh <?php echo $row_tinh->name ?> </span>
						  <?php endif; ?>
						<?php endforeach; ?>	
					 </div>
				</td>
				
				<td class="textL">
					  <?php 
					     $name = json_decode($row->name);
					     foreach($name as $sub){
					     	echo $sub . '<br>';
					     }
					  ?> 
				</td>

				<td>
					<?php echo number_format($row->amount)?> đ 
				</td>

				
				<td style="color: #69BD43" class="textc" style="width: 150px"><?php echo $row->payment?></td>
				
				
				<td style="color: #69BD43" class="textc accept_check"><?php
				   if ($row->status == 0){
				       echo 'Chưa thanh toán';
				   }elseif ($row->status == 1){
				       echo 'Đã thanh toán';
				   }else {
				       echo 'Thanh toán thất bại';
				   }
				
				?></td>
  
                <!-- ngày tạo, cập nhật giao dịch  --> 
				<td class="textC"> <?php echo get_date($row->created)?> </td>
				

			<td class="option textC">
			   <?php if($row->payment == "offline"): ?>
			     <a class="tipS check_order" href="<?php echo admin_url('transaction/check_offline/'.$row->id)?>" title="check đơn hàng">
			     <img src="<?php echo public_url('admin/images')?>/icons/color/tick.png">
			   <?php endif; ?>

			    </a><a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('transaction/del/'.$row->id)?>">
			     <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
			    </a>
			 </td>
		</tr>

		 <?php endforeach;?>
		 
  </tbody>

	</table>
</div>

</div>