<?php $this->load->view('admin/catalog/head') ?>

<div class="wrapper">
    <br>
	<?php $this->load->view("admin/message", $this->data) ?>
    
	<div class="widget">
		<div class="title">
			<span class="titleIcon">
				<div class="checker" id="uniform-titleCheck">
	    			<span>
	    			   <input type="checkbox" name="titleCheck" id="titleCheck" style="opacity: 0;">
	    			</span>
				</div>
			</span>
			<h6> <i class="fa fa-book fa-2x" aria-hidden="true"></i> Danh sách danh mục sản phẩm</h6>
		 	<div class="num f12">Tổng số: <b> <?php echo count($list);?> </b> danh mục</div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">

			<thead class="filter">
				<tr>
					<td colspan="9">
						<form method="get" action="<?php echo admin_url('catalog'); ?>" class="list_filter form">
							<table width="80%" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td style="width: 40px;" class="label">
									    	<label for="filter_id">Mã số</label>
										</td>
										<td class="item"><input style="width: 55px; text-align: center;" id="filter_id" value="<?php echo $this->input->get('id'); ?>" name="id" type="text">
										</td>

										<td style="width: 70px;" class="label">
										   <label for="filter_id">Tên Danh Mục</label>
										</td>
										<td style="width: 155px;" class="item"><input style="width: 155px;" id="filter_iname" value="<?php echo $this->input->get('name'); ?>" name="name" type="text">
									    </td>

									    <td style="width: 150px">
										  <input value="Lọc" class="button blueB" type="submit"> 
										  <input onclick="window.location.href = '<?php echo admin_url('catalog'); ?>'; " value="Reset" class="basic" type="reset">
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
					<td style="width:10px;"><img src="<?php echo public_url("admin")?>/images/icons/tableArrows.png"></td>
					<td style="width:80px;">Mã số</td>
					<td style="width:80px;">Thứ tự</td>
					<td>Tên danh mục</td>
					<td>Meta description</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
			<tbody>
			   <?php foreach($catalog_list as $row): ?>
			   	 <?php if(!empty($row->subs)): ?> 
			   	 	<!-- kiem tra co thang danh muc con hay khong roi show ra danh muc cha -->
					<tr class="row_<?php echo $row->id?>">
						<td><input type="checkbox" name="id[]" value="<?php echo $row->id?>" /></td>
						
						<td class="textC"><?php echo $row->id?></td>

                        <td class="textC"><?php echo $row->sort_order?></td>
                        
						<td>
							<span class="tipS" style="font-weight: bold" original-title="<?php echo $row->name ?>">
								<?php echo $row->name ?> 
								<?php if($row->box_vitri == 1): ?>
									<span style="color: #197D07;"><i class="fa fa-square" aria-hidden="true"></i> Vị trí box 1</span>
								<?php else: ?>
									<span style="color: #197D07;"><i class="fa fa-square" aria-hidden="true"></i> Vị trí box 2</span>
								<?php endif; ?>
											
							</span>
						</td>

						<?php if(!empty($row->meta_desc)): ?>
							<td>
								<span class="tipS" original-title="<?php echo $row->meta_desc ?>">
									<?php echo $row->meta_desc ?>			
								</span>
							</td>
						<?php else: ?>
							<td>
							<span class="tipS" >
								<?php echo 'Chưa có thẻ meta_description';?>
							</span>
						</td>
						<?php endif;?>
					    						
						
						<td class="option">
							<a href="<?php echo admin_url('catalog/edit/'.$row->id); ?>" class="tipS " original-title="Chỉnh sửa">
							   <img src="<?php echo public_url("admin")?>/images/icons/color/edit.png">
							</a>
							
							<a href="<?php echo admin_url('catalog/delete/'.$row->id); ?>" class="tipS verify_action" original-title="Xóa">
							    <img src="<?php echo public_url("admin")?>/images/icons/color/delete.png">
							</a>
						</td>
					</tr>

				    <?php foreach($row->subs as $sub): ?>
				    	<!-- lap thang $row->subs de lay danh muc con -->
						<tr class="row_<?php echo $sub->id ?>">
							<td><input type="checkbox" name="id[]" value="<?php echo $sub->id ?>" /></td>
							
							<td class="textC"><?php echo $sub->id ?></td>

	                        <td class="textC"><?php echo $sub->sort_order ?></td>
	                        
							<td>
								<span class="tipS" style="padding-left:40px" original-title="<?php echo $sub->name ?>">
									<?php echo $sub->name ?>		
								</span>
							</td>

							<?php if(!empty($sub->meta_desc)): ?>
							<td>
								<span class="tipS" original-title="<?php echo $sub->meta_desc ?>">
									<?php echo $sub->meta_desc ?>			
								</span>
							</td>
							<?php else: ?>
								<td>
								<span class="tipS" >
									<?php echo 'Chưa có thẻ meta_description';?>
								</span>
							</td>
							<?php endif;?>
						    						
							
							<td class="option">
								<a href="<?php echo admin_url('catalog/edit/'.$sub->id); ?>" class="tipS " original-title="Chỉnh sửa">
								   <img src="<?php echo public_url("admin")?>/images/icons/color/edit.png">
								</a>
								
								<a href="<?php echo admin_url('catalog/delete/'.$sub->id); ?>" class="tipS verify_action" original-title="Xóa">
								    <img src="<?php echo public_url("admin")?>/images/icons/color/delete.png">
								</a>
							</td>
						</tr>
					<?php endforeach;?>		

			    <?php  else:?>
			    	<!-- con neu khong co danh muc con thi chi show danh muc cha -->
			    	<tr class="row_<?php echo $row->id?>">
						<td><input type="checkbox" name="id[]" value="<?php echo $row->id?>" /></td>
						
						<td class="textC"><?php echo $row->id?></td>

                        <td class="textC"><?php echo $row->sort_order?></td>
                        
						<td>
							<span class="tipS" style="font-weight: bold" original-title="<?php echo $row->name ?>">
								<?php echo $row->name ?>			
							</span>
						</td>

						<?php if(!empty($row->meta_desc)): ?>
							<td>
								<span class="tipS" original-title="<?php echo $row->meta_desc ?>">
									<?php echo $row->meta_desc ?>			
								</span>
							</td>
						<?php else: ?>
							<td>
							<span class="tipS" >
								<?php echo 'Chưa có thẻ meta_description';?>
							</span>
						</td>
						<?php endif;?>
					    						
						
						<td class="option">
							<a href="<?php echo admin_url('catalog/edit/'.$row->id); ?>" class="tipS " original-title="Chỉnh sửa">
							   <img src="<?php echo public_url("admin")?>/images/icons/color/edit.png">
							</a>
							
							<a href="<?php echo admin_url('catalog/delete/'.$row->id); ?>" class="tipS verify_action" original-title="Xóa">
							    <img src="<?php echo public_url("admin")?>/images/icons/color/delete.png">
							</a>
						</td>
					</tr>
				<?php endif;?>	
			 <?php endforeach;?>		
			</tbody>

			<tfoot>
				<tr>
					<td colspan="7">
					     <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('catalog/del_all') ?>">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>
					     <div class="pagination">  

					     </div>
					</td>
				</tr>
			</tfoot>
			
		</table>
	</div>
</div>