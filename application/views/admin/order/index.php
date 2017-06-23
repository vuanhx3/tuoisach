<!-- hiển thị các list danh sách admin -->
<!-- head -->
<?php $this->load->view('admin/order/head', $this->data);?>

<div id="main_transaction" class="wrapper">
<br>
    <!--  Load thông báo -->
     <?php $this->load->view('admin/message', $this->data);?>
<div class="widget">

	<div class="title">    
		<span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
		<h6>
		      Danh sách chi tiết đơn hàng
		</h6>
		<div class="num f12">
			Số lượng đơn hàng: <b> <?php echo $total_rows ?> </b>
		</div>
	</div>

	<table width="100%" cellspacing="0" cellpadding="0" id="checkAll"
		class="sTable mTable myTable">

		<thead class="filter">
			<tr>
				<td colspan="9">
					<form method="get" action="<?php echo admin_url('order')?>"
						class="list_filter form">
						<table width="90%" cellspacing="0" cellpadding="0">
							<tbody>

							<tr>
							
								<td style="width: 40px;" class="label">
								   <label for="filter_id">Mã số đơn hàng </label>
								</td>
								<td class="item">
							       <input type="text" style="width: 55px; text-align: center;" id="filter_id" value="<?php echo $this->input->get('id');?>" name="id">
								</td>

								<td style="width: 150px">
								   <input type="submit" value="Lọc" class="button blueB">
								   <input type="reset" onclick="window.location.href = '<?php echo admin_url('order')?>'; " value="Reset" class="basic">     
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
				<td style="width: 40px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
				<td style="width: 40px;">Mã đơn hàng</td>
				<td style="width: 40px;">Mã số giao dịch</td>
				<td style="width: 40px;">Mã thực phẩm</td>
				<td style="width: 70px;">Tên thực phẩm</td>
				<td style="width: 70px;">Số lượng thực phẩm</td>
				<td style="width: 70px;">Số tiền giao dịch</td>
				<td style="width: 70px;">Trạng thái</td>
				<td style="width: 70px;">Hành động</td>
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
    					
    					<!-- truowngma don hang -->
    					<td class="textC"><?php echo $row->id?></td>
    					
    				   <!-- truong ma giao dich -->
    					<td class="textC">
    						<?php echo $row->transaction_id?>				
    				    </td>
						
						<!-- truong ma san pham -->
    				    <td class="textC">
    						<?php echo $row->product_id?>				
    				    </td>

						<!-- truong ten san pham -->
						<?php foreach($list_pd as $row_pd): ?>
						   <?php if($row_pd->id == $row->product_id): ?>
    				         <td class="textC"> <?php echo $row_pd->name ?> </td>
    				       <?php endif; ?>
						<?php endforeach; ?>

						<!-- truong so luong thuc pham -->
    				    <td class="textC">
    						<?php echo $row->qty?> <sup>kg</sup>				
    				    </td>
    					
    					<!-- truong tong so tien san pham  -->
    					<td class="textc red"><?php echo number_format($row->amount)?> đ</td>
    					
    					<td class="status textC">
    						<span class="pending">
								<?php foreach($list_tran as $row_tran): ?>
									 <?php if($row->transaction_id == $row_tran->id ): ?>
										 <?php 
			    						      if ($row_tran->status == 0){
			    						          echo 'Chờ xử lý...';
			    						      }elseif ($row_tran->status == 1){
			    						          echo 'Đã thanh toán';
			    						      }else {
			    						          echo 'Thanh toán thất bại';
			    						      }
			    						    
			    						    ?>	
									 <?php endif; ?>			
								<?php endforeach; ?>
    						</span>
    					</td>
    					
    					<td class="textC">
    						   <a class="tipS verify_action" href="<?php echo admin_url('transaction/del/'.$row->id)?>"    original-title="Xóa">
    						    <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png">
    						   </a>
    					</td>
    				</tr>
		 <?php endforeach;?>
		 
  </tbody>

	</table>
</div>

</div>