<!-- Title area -->
<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Bảng điều khiển</h5>
			<span>Trang quản lý hệ thống</span>
		</div>
		
		<div class="clear"></div>
	</div>
</div>

<div class="line"></div>

<div class="statsRow">
    <div class="wrapper">
        <div class="controlB">
            <ul>
                <li><a href="#" title=""><img src="<?php echo public_url('admin') ?>/images/icons/control/32/comment.png" alt=""><span>Soạn thư</span></a></li>

                <li><a href="http://localhost/traodoinoibo/congviec/giaoviec" title=""><img src="<?php echo public_url('admin') ?>/images/icons/control/32/add.png" alt=""><span>Thêm công việc</span></a></li>

                <li><a href="#" title=""><img src="<?php echo public_url('admin') ?>/images/icons/control/32/lichphong.png" alt=""><span>Lịch phòng</span></a></li>

                <li><a href="#" title=""><img src="<?php echo public_url('admin') ?>/images/icons/control/32/statistics.png" alt=""><span>Xem truy cập</span></a></li>

                <li><a href="#" title=""><img src="<?php echo public_url('admin') ?>/images/icons/control/32/database.png" alt=""><span>Sao lưu dữ liệu</span></a></li>

            </ul>
        </div>
    </div>
</div>

<br>
<!-- Message -->

<!-- Main content wrapper -->
<div class="wrapper">
	<br>
    <!--  Load thông báo -->
    <?php $this->load->view('admin/message', $this->data); ?>
    
	<div class="widgets">
	     <!-- Stats -->
			<!-- Amount -->
			<div class="oneTwo">
				<div class="widget">
					<div class="title">
						<img src="<?php echo public_url("admin/images")?>/icons/dark/money.png" class="titleIcon" />
						<h6>Doanh số</h6>
					</div>
					
					<table cellpadding="0" cellspacing="0" width="100%" class="sTable myTable">
						<tbody>
							
								<tr>
										<td class="fontB blue f13">Tổng doanh số</td>
										<td class="textR webStatsLink red" style="width:120px;">44,000,000 đ</td>
								</tr>
							    
							    <tr>
										<td class="fontB blue f13">Doanh số hôm nay</td>
										<td class="textR webStatsLink red" style="width:120px;">0 đ</td>
								</tr>
								
							    <tr>
										<td class="fontB blue f13">Doanh số theo tháng</td>
										<td class="textR webStatsLink red" style="width:120px;">
										0 đ
										</td>
								</tr>
							    
						</tbody>
					</table>
				</div><!-- widget -->
			</div><!-- one two -->


			<!-- User -->
			<div class="oneTwo">
				<div class="widget">
					<div class="title">
						<img src="<?php echo public_url("admin/images")?>/icons/dark/users.png" class="titleIcon" />
						<h6>Thống kê dữ liệu</h6>
					</div>
					
					<table cellpadding="0" cellspacing="0" width="100%" class="sTable myTable">
						<tbody>
							
							<tr>
								<td>
									<div class="left">Tổng số giao dịch</div>
									<div class="right f11"><a href="<?php echo admin_url('transaction'); ?>">Chi tiết</a></div>
								</td>
								
								<td class="textC webStatsLink"> <?php echo $total_rows ?> </td>
							</tr>
							
							<tr>
								<td>
									<div class="left">Tổng số sản phẩm</div>
									<div class="right f11"><a href="<?php echo admin_url('product'); ?>">Chi tiết</a></div>
								</td>
								
								<td class="textC webStatsLink"> <?php echo $total_product; ?> </td>
							</tr>
							
							<tr>
								<td>
									<div class="left">Tổng số bài viết</div>
									<div class="right f11"><a href="<?php echo admin_url('news'); ?>">Chi tiết</a></div>
								</td>
								
								<td class="textC webStatsLink"> <?php echo $total_new; ?> </td>
							</tr>
							
							<tr>
								<td>
									<div class="left">Tổng số thành viên</div>
									<div class="right f11"><a href="<?php echo admin_url('user'); ?>">Chi tiết</a></div>
								</td>
								
								<td class="textC webStatsLink"> <?php echo $total_user; ?> </td>
							</tr>
							<tr>
								<td>
									<div class="left">Tổng số liên hệ</div>
									<div class="right f11"><a href="admin/contact.html">Chi tiết</a></div>
								</td>
								
								<td class="textC webStatsLink">
									0					</td>
							</tr>
						</tbody>
					</table>
				</div><!-- widget -->
			</div><!-- one two -->

			<div class="clear"></div>
					
					<!-- Giao dich thanh cong gan day nhat -->
					
			<div class="widget">
				<div class="title">
					<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
					<h6>Danh sách Giao dịch</h6>
				</div>
				
				<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
					<thead>
						<tr>
							<td style="width:60px;">Mã số</td>
							<td style="width:150px;">Khách hàng</td>
							<td style="width:100px;">Số tiền</td>
							<td style="width:100px;">Hình thức</td>
							<td style="width:100px;">Giao dịch</td>
							<td style="width:75px;">Ngày tạo</td>
							<td style="width:55px;">Hành động</td>
						</tr>
					</thead>
					
		 			<tfoot class="auto_check_pages">
						<tr>
							<td colspan="8">
								 <div class="list_action itemActions">
										<a href="#submit" id="submit" class="button blueB" url="admin/tran/del_all.html">
											<span style='color:white;'>Xóa hết</span>
										</a>
								 </div>
							</td>
						</tr>
					</tfoot>
					
					<tbody class="list_item">
                                <?php foreach($list as $row): ?>
                			        <tr class="row_<?php echo $row->id ?>">
                        					<td class="textC"><?php echo $row->id ?></td>
                        					
                        					<td>
                        						<?php echo $row->user_name ?>			
                        				    </td>
                        					
                        					<td class="textc red"><?php echo number_format($row->amount)?> đ</td>
                        					
                        					<td class="textc">
                        					  <?php echo $row->payment?>				
                        					</td>
                        					
                        					
                        					<td class="status textC">
                        						<span class="pending">
                        						    <?php 
                                                      if ($row->status == 0){
                                                          echo 'Chờ xử lý...';
                                                      }elseif ($row->status == 1){
                                                          echo 'Đã thanh toán';
                                                      }else {
                                                          echo 'Thanh toán thất bại';
                                                      }
                                                    
                                                    ?>  						
                        						</span>
                        					</td>
                        					
                        					<td class="textC"> <?php echo get_date($row->created)?></td>
                        					
                        					<td class="textC">
                        							<a class="lightbox cboxElement" href="<?php echo admin_url('transaction'.'?'.'id='.$row->id); ?>">
                        								<img src="<?php echo public_url('admin')?>/images/icons/color/view.png">
                        							</a>
                        							
                        						   <a class="tipS verify_action" href="<?php echo admin_url('transaction/del/'.$row->id)?>" original-title="Xóa">
                        						    <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png">
                        						   </a>
                        					</td>
                    				</tr>
                                 <?php endforeach; ?>
                			 </tbody>
					</tbody>
				</table>
			</div><!-- widget -->

        </div><!-- widget -->
</div><!-- wrapper -->
<div class="clear mt30"></div>