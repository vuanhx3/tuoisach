                    <div  class="top_left_tab">
                          <div class="circle-text-box">
                               <div class="circle-headline">
                                  <img src="<?php echo $homepage->image_link ?>" alt="<?php echo $homepage->site_desc ?>">
                                <h2>Tuoisachvvn là ai ?</h2>
                               </div><!-- circle-headline -->

                               <div class="circle_content">
                                 <?php foreach($list_head as $row): ?>
                                   <p> <?php echo $row->content ?> </p>
                                 <?php endforeach; ?>
                               </div>   
                          </div><!-- circle-text-box  -->
                      <div class="clear pb20"></div>  
                     </div><!-- End top_left_tab -->
            
                     <div  class="top_right_tab">
                          <script language="javascript">
                             $(document).ready(function(){
                               $(".tab").on("click", function(){
                                  //xoa class acrive di
                                  $('.active').removeClass('active');
                                  // add class active vao li dang click
                                  $(this).addClass('active');
                                  // an the div cua noi dung co class content khi chuyen sang li khac
                                  $('.content').slideUp('normal');
                                  var $title = $(this).attr('title');
                                  $('#' + $title).slideDown('normal');
                               });
                             });
                          </script>
                           <div class="tab_area">
                              <ul class="tab_title">
                                <?php foreach($list_tech1 as $row):  ?>
                                   <li><a title="tab-<?php echo $row->order?> " class="tab active"><?php echo $row->title ?></a></li>
                                 <?php endforeach;  ?>

                                 <?php foreach($list_tech2 as $row):  ?>
                                   <li><a title="tab-<?php echo $row->order?> " class="tab "><?php echo $row->title ?></a></li>
                                 <?php endforeach;  ?> 

                                 <?php foreach($list_tech3 as $row):  ?>
                                   <li><a title="tab-<?php echo $row->order?> " class="tab "><?php echo $row->title ?></a></li>
                                 <?php endforeach;  ?>  
                              </ul>
                              <?php foreach($list_tech1 as $row): ?>
                                  <div id="tab-<?php echo $row->order?>" class="content">
                                    <p><?php echo $row->content ?></p>
                                  </div>
                               <?php endforeach; ?> 

                               <?php foreach($list_tech2 as $row): ?>
                                  <div id="tab-<?php echo $row->order?>" class="content">
                                    <p><?php echo $row->content ?></p>
                                  </div>
                               <?php endforeach; ?> 

                               <?php foreach($list_tech3 as $row): ?>
                                  <div id="tab-<?php echo $row->order?>" class="content">
                                    <p><?php echo $row->content ?></p>
                                  </div>
                               <?php endforeach; ?> 
                          </div><!-- End tabs -->     
                     <div class="clear pb20"></div>  
                  </div><!-- End top_right_tab -->