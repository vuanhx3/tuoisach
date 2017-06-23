                       <div class="box-left hide_pd_mobile">
                          <div class="title tittle-box-left">
                              <h2><span class="fa fa-bars"></span> Danh mục sản phẩm </h2>
                          </div>
                          <div id="accordian"><!-- The content-box -->
                               <ul class="catalog-main">
                                 <?php foreach($catalog_list as $row): ?>
                                   <?php $name = $row->slug; ?>
                                    <li class="catalog-sub">
                                      <a href="<?php echo base_url($name.'-c'.$row->id.'.html') ?>">
                                      <img style="width:20px; height:20px;" src="<?php echo $row->image_link ?>" alt="<?php echo $row->name ?>">
                                      <?php echo $row->name ?></a><i class="fa fa-caret-down" aria-hidden="true"></i>
                                      <?php if(!empty($row->subs)): ?>
                                        <ul>
                                          <?php foreach($row->subs as $subs): ?>
                                            <?php $name = $subs->slug; ?>
                                            <li><a href="<?php echo base_url($name . '-c' . $subs->id . '.html') ?>"><?php echo $subs->name ?></a></li>
                                          <?php endforeach; ?>
                                        </ul>
                                     <?php endif; ?>
                                    </li>
                                 <?php endforeach; ?> 
                                </ul>
                          </div><!-- End content-box -->
                      </div><!-- End box-left -->

          
                    <?php 
                       $price_from_select = isset($price_from) ? intval($price_from) : 0 ;
                       $price_to_select = isset($price_to) ? intval($price_to) : 0 ;
                     ?>

                      <div class="box-left hide_pd_mobile">
                          <div class="title tittle-box-left">
                            <h2> Tìm kiếm theo giá </h2>
                          </div>

                         <div class="content-box"><!-- The content-box -->
                            <form class="t-form form_action" method="get"  action="<?php echo site_url('product/search_price') ?>" name="search">
                                <div class="form-row">
                                  <label for="param_price_from" class="form-label">Giá từ:<span class="req">*</span></label>
                                    <div class="form-item" >
                                      <select class="input" id="price_from" name="price_from">
                                        <?php for($i = 0; $i <= 1000000; $i += 50000): ?>
                                           <option <?php echo ($price_from_select == $i) ? 'selected' : ''; ?> value="<?php echo $i ?>">
                                               <?php echo number_format($i) ?> đ
                                           </option>
                                         <?php endfor; ?>   
                                       </select>
                                      <div class="clear"></div>
                                      <div class="error" id="price_from_error"></div>
                                    </div>
                                  <div class="clear"></div>
                               </div>
                              <div class="form-row">
                                <label for="param_price_from" class="form-label" >Giá tới:<span class="req">*</span></label>
                                <div class="form-item" >
                                  <select class="input" id="price_to" name="price_to">
                                        <?php for($i = 0; $i <= 1000000; $i += 100000): ?>
                                          <option <?php echo ($price_to_select == $i) ? 'selected' : ''; ?> value="<?php echo $i ?>">
                                                <?php echo number_format($i) ?> đ
                                          </option>
                                        <?php endfor; ?>    
                                       </select>
                                  <div class="clear"></div>
                                  <div class="error" id="price_from_error"></div>
                                </div>
                                <div class="clear"></div>
                              </div>
                              
                              <div class="form-row">
                                <div class="form-item-button">
                                    <input class="button" name="search" value="Tìm kiềm" style="height:30px !important;line-height:30px !important;padding:0px 10px !important" type="submit">
                                </div>
                                <div class="clear"></div>
                               </div>
                           </form>
                         </div><!-- End content-box -->
                    </div><!-- box-left -->