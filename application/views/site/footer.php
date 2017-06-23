
              <div class="wp_inner">
                  <div class="footer_container">
                      <div class="row_footer_box">
                           <div id="r1" class="row_box">
                             <h2>giới thiệu</h2>
                              <?php foreach($list_footer as $row): ?>
                                <?php if($row->id == 3): ?>
                                  <p>
                                     <?php echo $row->content ?> 
                                  </p>
                                <?php endif; ?>
                              <?php endforeach; ?>
                           </div> 

                           <div id="r2" class="row_box">
                             <h2>về chúng tôi</h2>
                             <ul>
                             <?php foreach($list_about as $row): ?>
                              <?php $name = $row->slug; ?>
                                <li><a href="#"><?php echo $row->title ?></a></li>
                              <?php endforeach; ?> 
                             </ul>
                           </div>

                           <div id="r3" class="row_box">
                             <h2>thông tin</h2>
                             <ul>
                                <?php foreach($list_info as $row): ?>
                                  <?php $name = $row->slug; ?>
                                 <li><a href="#"><?php echo $row->title ?></a></li>
                                <?php endforeach; ?>
                             </ul>
                           </div>

                           <div id="r4" class="row_box">
                             <h2>quy định và chính sách</h2>
                             <ul>
                               <?php foreach($list_quidinh as $row): ?>
                                  <?php $name = $row->slug; ?>
                                 <li><a href="#"><?php echo $row->title ?></a></li>
                                <?php endforeach; ?>
                             </ul>
                           </div>
                      </div><!-- end row_box -->
                  </div><!-- end row_footer_box -->
              </div><!-- end footer_conainer -->

              <div class="clearfix"></div>
                    
              <div class="footer_copy wp_inner">
                     <p>Author: Tuoisachvvn-vutheanh @Copyright 2017</p>
              </div><!-- footer_copy -->

