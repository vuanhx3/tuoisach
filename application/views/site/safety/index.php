<?php $this->load->view('site/news/head.php', $this->data)?>


<div class="col-lg-12">
  <div class="header_breadcrumb" >
    <ul class="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
      <!-- blog -->
      <li class="active breadcrumb-title"> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; Tin vệ sinh an toàn thực phẩm</li>
    </ul>
  </div>   
</div>

<div id="box_sanphammoi" style="width:100%;  float:left;margin-bottom:15px; margin:0 auto; padding-bottom: 20px;">

     <div class="left-product show_mobile ">
            <?php $this->load->view("site/box_sanphammoi/sale_left.php", $this->data) ?><!-- danh sach thuc pham -->
            <div class="box-left">
               <div class="box-news">

                    <div class="title tittle-box-left">
                      <h2>Mẹo vặt & kĩ năng</h2>
                    </div><!-- end box-heading -->

                    <div class="content-box">
                        
                       <?php foreach($list_meovat as $val): ?> 
                        <?php $name = $val->slug; ?>

                          <div class="content-box-mini">
                              <a href="<?php echo base_url($name.'/meo-vat-'.$val->id.'.html'); ?>" class="new-item-mini-image">
                                <img src="<?php echo $val->image_link ?>" alt="<?php echo $val->title ?>">
                              </a>
                              <a href="<?php echo base_url($name.'/meo-vat-'.$val->id.'.html'); ?>" class="new-item-mini-title">
                                <h3><?php echo $val->title ?></h3>
                              </a>
                              <p><?php echo get_date($val->created);?></p>
                          </div><!-- end content-box-mini -->
                      <?php endforeach; ?>
                        
                    </div><!-- end box-content -->

               </div><!-- end box-news -->
            </div><!-- end box-left -->

            <div class="box-left">
                <div class="bog-tag">
                     <div class="title tittle-box-left">
                      <h2>Thẻ Tag</h2>
                    </div><!-- end box-heading -->

                    <div class="content-box">
                    </div><!-- end content-box -->
                </div><!-- end box-tag -->
            </div><!-- end box-left -->
    </div><!--  end left-product show_mobile -->


    <div class="content-product">
          <h1 class="blog-title">Tin tức vệ sinh an toàn thực phẩm</h1>  

          <div class="blog-articles">
              <div class="row">
                   <div class="col-lg-12">

                      <?php foreach($list_vs as $val): ?>
                        <?php $name = $val->slug; ?>
                        <?php if($val->status == 1): ?>
                          <article class="article-item">
                              <a href="<?php echo base_url($name.'/tin-tuc-'.$val->id.'.html'); ?>" class="article-item-image">
                                <img src="<?php echo $val->image_link ?>" alt="<?php echo $val->title ?>">
                              </a>

                              <a href="<?php echo base_url($name.'/tin-tuc-'.$val->id.'.html'); ?>" class="article-item-name">
                                <h3><?php echo $val->title ?></h3>
                              </a>

                              <nav class="article-item-info">
                                  <ul>
                                    <li><time><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_date($val->created);?> </time></li>
                                    <li><i class="fa fa-user" aria-hidden="true"></i> Admin: <?php echo $val->admin_add ?></li>
                                    <li><i class="fa fa-eye" aria-hidden="true"> <?php echo $val->count_view ?> </i></li>
                                  </ul>
                              </nav>
                              
                              <div class="article-item-summary"> <?php echo $val->intro ?> </div>
                          </article>
                        <?php endif; ?>
                      <?php endforeach; ?>

                   </div><!-- end col-lg-12 -->

                   <div class="pagination_page">
                    <?php echo $this->pagination->create_links() ?>
                   </div>
                   <div class="clear"></div>
              </div><!-- end row -->

           </div><!-- end blog-articles -->

          <div style=" width:100%; height: 100px; float: left;"></div>

    </div><!--  end content-product -->

</div><!-- end box-sanpham-moi -->
