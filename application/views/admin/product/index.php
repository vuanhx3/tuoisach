<?php $this->load->view('admin/product/head', $this->data);?>

<div id="main_product" class="wrapper">
    <br>
    <!--  Load thông báo -->
    <?php $this->load->view('admin/message', $this->data); ?>
    
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6> <i class="fa fa-book fa-2x" aria-hidden="true"></i> Danh sách thực phẩm</h6>
            <div class="num f12">
                Số lượng: <b> <?php echo $total_rows?> thực phẩm </b>
            </div>
        </div>

        <table id="checkAll" class="sTable mTable myTable" width="100%"
            cellspacing="0" cellpadding="0">

            <thead class="filter">
                <tr>
                    <td colspan="9">
                        <form method="get" action="<?php echo admin_url('product'); ?>" class="list_filter form">
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
                                           <label for="filter_id">Tên thực phẩm</label>
                                        </td>
                                        <td style="width: 155px;" class="item"><input
                                            style="width: 155px;" id="filter_iname" value="<?php echo $this->input->get('name'); ?>" name="name"
                                            type="text">
                                        </td>

                                        <td style="width: 100px;" class="label"><label
                                            for="filter_status">Loại Thực Phẩm</label></td>
                                        <td class="item">
                                           <select name="catalog">
                                                <option style="color: blue; font-weight: bold;" value="0">   CHỌN THỰC PHẨM
                                                </option>
                                                  <?php foreach($catalogs as $row): ?>
                                                    <?php if (count($row->subs) > 0):?>
                                                        <!-- kiem tra danh muc co danh muc con hay khong -->
                                                        <optgroup label="<?php echo $row->name ?>">
                                                            <!-- hien thi list the loai TP con -->
                                                            <?php foreach($row->subs as $subs): ?>
                                                             <option value="<?php echo $subs->id ?>" <?php
                                                             echo $this->input->get('catalog') == $subs->id ? 'selected': ''; ?>><?php echo $subs->name ?></option>
                                                            <?php endforeach; ?> 
                                                        </optgroup>
                                                    <?php else: ?>
                                                        <!-- con khong hien thi danh muc cha -->
                                                        <option value="<?php echo $row->id ?>" <?php echo $this->input->get('catalog') == $row->id ? 'selected' : ''; ?>><?php echo $row->name ?></option>
                                                    <?php endif; ?>
                                                  <?php endforeach; ?>  
                                           </select>
                                        </td>

                                        <td style="width: 150px">
                                          <input value="Lọc"class="button blueB" type="submit"> 
                                          <input
                                            onclick="window.location.href = '<?php echo admin_url('product'); ?>'; " value="Reset"
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
                    <td style="width: 20px;">Mã số</td>
                    <td style="width: 200px;">Tên</td>
                    <td style="width: 60px;">Giá đã triết khấu</td>
                    <td style="width: 150px;">Nguồn thực phẩm</td>
                    <td style="width: 60px;">Trạng thái</td>
                    <td style="width: 60px;">Quà khuyến mại</td>
                    <td style="width: 60px;">Ngày tạo</td>
                    <td style="width: 60px;">Hành động</td>
                </tr>
            </thead>

            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="9">
                        <div class="list_action itemActions">
                            <a url="<?php echo admin_url('product/delete_all');?>" class="button blueB" id="submit" href="#submit"> <span
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
                  <?php foreach ($list_one as $row):?> 
                    <tr class="row_<?php echo $row->id?>">
                        <td><input type="checkbox" value="<?php echo $row->id?>" name="id[]"></td>
    
                        <td class="textC"><?php echo $row->id?></td>
    
                        <td>
                            <div class="image_thumb">
                                 <a class="lightbox cboxElement" title="<?php echo $row->name ?>" href="<?php echo $row->image_link ?>">
                                    <img src="<?php echo $row->image_link?>" height="50">
                                 </a>
                                 <div class="clear"></div>
                            </div> 
                            <a target="_blank" href="<?php echo admin_url('product/edit/'.$row->id); ?>" class="tipS" original-title=""> <b><?php echo $row->name?></b>
                            </a>
                            <div class="f11">
                                Đã bán: <?php echo $row->buyed?> | Xem: <?php echo $row->view?> <br> Đánh giá: <?php echo $row->rate_count?> | Tổng điểm: <?php echo $row->rate_total?> <br> Số
                                lượng trong kho: <?php echo $row->number_pd?> kg
                            </div>
                        </td>
                        
                        <!-- trường giá -->    
                        <td class="textc">
                          <?php if ($row->discount > 0):?>
                             <?php $price_new = $row->price - $row->discount ;?> 
                                <!-- hien thi so tien ma duoc giam gia truoc -->
                                 <input class="price format_number" style="text-align: center; padding: 7px 7px;width:90px; color: blue; font-weight: bold; font-size: 13px;" type="text" readonly="readonly"  value="<?php echo number_format($price_new)?> " /> đ

                                <!-- hien thi so tien ban dau -->
                                 <p style="text-align: center; text-decoration: line-through; font-size: 13px; padding:5px 0px;"><?php echo number_format($row->price)?> đ</p>
                          <?php else :?>         
                            <!-- mac dinh so tien ban dau -->
                           <input class="price format_number" style="text-align: center; padding: 7px 7px;width:90px; color: blue; font-weight: bold; font-size: 13px;" type="text" readonly="readonly"  value="<?php echo number_format($row->price)?> " /> đ
                          <?php endif;?>    
                        </td>
    
                    <!-- truong nguồn gốc --> 
                        <td class="textL">
                          <?php foreach($partner as $row_dt): ?>
                              <?php if($row->partner_id == $row_dt->id): ?>
                                <?php echo '<b>Thuộc đối tác : </b>' . $row_dt->title?>
                               <?php endif; ?> 
                           <?php endforeach; ?> 
                           <br>
                            <?php echo $row->origin ?>
                        </td>

                        

                    <!-- trường quà khuyến mại -->
                        <?php if($row->number_pd > 0): ?>
                              <td class="textc"><?php echo 'còn hàng' ?></td>
                        <?php else: ?>
                               <td class="textc"><?php echo 'hết hàng' ?></td> 
                        <?php endif; ?> 

                    <!-- trường trạng thái -->
                        <td class="textL"><?php echo $row->gifts?></td>
    
                    <!-- ngày tạo, cập nhật sản phẩm  -->
                        <td class="textC"><?php echo get_date($row->created); ?></td>
    
                        <td class="option textC">
                            <a  href="admin/tran/view/21.html" title="xem nhanh thực phẩm" class="lightbox tipS">
                                <img src="<?php echo public_url("admin/images")?>/icons/color/view.png" />
                            </a>

                            <a class="tipS" href="<?php echo admin_url('product/edit/'.$row->id); ?>" original-title="Chỉnh sửa"> <img src="<?php echo public_url()?>/admin/images/icons/color/edit.png"></a> 
                            
                            <a class="tipS verify_action" href="<?php echo admin_url('product/delete/'.$row->id); ?>" original-title="Xóa"> <img src="<?php echo public_url()?>/admin/images/icons/color/delete.png"> </a>
                        </td>
                    </tr>
                  <?php endforeach;?>   
            </tbody>
        </table>
    </div>
</div>