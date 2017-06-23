<?php $this->load->view('site/news/head.php', $this->data)?>


<div class="col-lg-12">
  <div class="header_breadcrumb" >
    <ul class="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
      <!-- blog -->
      <li> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; <a href="<?php echo site_url('news'); ?>">Mẹo nhỏ nơi góc bếp</a></li>
      <li class="active breadcrumb-title"><span>&rarr; <?php echo $new_info->title ?></span></li>
    </ul>
  </div>   
</div>

<div id="box_sanphammoi" style="width:100%;  float:left;margin-bottom:15px; margin:0 auto; padding-bottom: 20px;">
	 <div class="left-product show_mobile ">
            <?php $this->load->view("site/box_sanphammoi/sale_left.php", $this->data) ?><!-- danh sach thuc pham -->
            <div class="box-left">
               <div class="box-news">

                    <div class="title tittle-box-left">
                      <h2>Tin Nổi Bật</h2>
                    </div><!-- end box-heading -->

                    <div class="content-box">
                        
                       <?php foreach($list_attp as $val): ?> 
                        <?php $name = $val->slug; ?>

                          <div class="content-box-mini">
                              <a href="<?php echo base_url($name.'/tin-tuc-'.$val->id.'.html'); ?>" class="new-item-mini-image">
                                <img src="<?php echo $val->image_link ?>" alt="<?php echo $val->title ?>">
                              </a>
                              <a href="<?php echo base_url($name.'/tin-tuc-'.$val->id.'.html'); ?>" class="new-item-mini-title">
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
                    	<ul class="tags">
                    	  <?php $name = $new_info->slug;  ?>

                    	  <?php $tag = @json_decode($new_info->tags); ?>
                        <?php if(count($tag) > 0): ?>
                        	  <?php foreach($tag as $val): ?>
              						    <li><a href="<?php echo base_url($name.'/meo-vat-'.$new_info->id.'.html'); ?>" class="tag"><?php echo $val ?></a></li>
              						  <?php endforeach; ?>
                       <?php else: ?>
                           <?php echo ""; ?>
                       <?php endif; ?>
          						</ul>	
                    </div><!-- end content-box -->
                </div><!-- end box-tag -->
            </div><!-- end box-left -->
    </div><!--  end left-product show_mobile -->	


    <div class="content-product">
    	<article class="content-detail">
    		  <a  class="article-item-image">
	            <img src="<?php echo $new_info->image_link ?>" alt="<?php echo $new_info->title ?>">
	          </a>	
	          <h1 class="active-title"><?php echo $new_info->title; ?></h1>

	           <nav class="article-item-info">
                  <ul>
                    <li><time><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_date($new_info->created);?> </time></li>
                    <li><i class="fa fa-user" aria-hidden="true"></i> Admin: <?php echo $new_info->admin_add ?></li>
                    <li><i class="fa fa-eye" aria-hidden="true"> <?php echo $new_info->count_view ?> </i></li>
                  </ul>
               </nav>

              <div class="article-body">
              		<div class="wrap-detail">
              			<?php echo $new_info->content ?>
              		</div><!-- end wrap-detail -->
                  
              </div><!-- end article-body -->

              <div class="article-related"><!-- hien thi cac bai viet khác -->
              		<div class="row">
                      <div class="col-lg-12">
                        <h2>Bài viết liên quan</h2>
                      </div>
                      <?php foreach($news_article as $val): ?>
                        <?php $name = $val->slug; ?>
                        <?php if($val->id != $new_info->id): ?>
                            <div class="col-lg-4 col-md-4 article-new-box">
                                <a href="<?php echo base_url($name.'/meo-vat-'.$val->id.'.html'); ?>" class="owl-new-item-image">
                                  <img src="<?php echo $val->image_link ?>" alt="<?php echo $val->title ?>">
                                </a>

                                <a href="<?php echo base_url($name.'/meo-vat-'.$val->id.'.html'); ?>" class="owl-news-item__name">
                                   <h3><?php echo $val->title ?></h3>
                                </a>

                                <nav class="owl-news-item__info">
                                  <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_date($val->created);?> </li>
                                    <li><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $val->count_view ?> Lượt xem</li>
                                  </ul>
                                </nav>

                                <div class="owl-news-item__summary">
                                  <p><?php echo $val->intro ?><a href="<?php echo base_url($name.'/meo-vat-'.$val->id.'.html'); ?>">&nbsp;[Đọc tiếp]</a></p>
                                </div>
                            </div><!-- end col-lg-4 -->
                        <?php endif; ?>
                      <?php endforeach; ?>
                  </div><!-- end row -->
              </div><!-- end article-related -->
    	</article>	
    </div><!-- end  content-product-->



</div><!-- end box_sanphammoi -->