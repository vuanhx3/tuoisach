    <link rel="shortcut icon" href="<?php echo !empty($homepage->favicon) ? $homepage->favicon : ''?>" type="image/png" />
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo !empty($homepage->site_desc) ? $homepage->site_desc : ''?>" />
    <meta name="keyword" content="<?php echo !empty($homepage->site_key) ? $homepage->site_key : ''?>" />
    <meta name="robots" content="INDEX,FOLLOW" />    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo  !empty($homepage->site_title) ? $homepage->site_title : '';?>" />
    <meta property="og:image" content="<?php echo  !empty($homepage->image_link) ? $homepage->image_link : '';?>" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="<?php echo  !empty($homepage->site_desc) ? $homepage->site_desc : '';?>" />
    <title>
        <?php echo  !empty($homepage->site_title) ? $homepage->site_title : 'Tuoisachvvn';?>
    </title>
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/reset.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/box_tinhot.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/awesome/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/top_menu_2.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/form_login.css" type="text/css"> 
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/slide_tp.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/box_gioithieu.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/box_sanphammoi.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/box_sanpham_ban.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/box_doitac.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/royalslider/royalslider.css" type="text/css">
    <link type="text/css" href="<?php echo public_url()?>/site/royalslider/skins/minimal-white/rs-minimal-white.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/danhmucthucpham.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/popup.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/responsive.css" type="text/css">
    <link rel="stylesheet" href="<?php echo public_url()?>/site/css/responsive_thucpham.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" />  

      
    <script language="javascript" src="<?php echo public_url()?>/site/js/jqurey/jquery-v2.0.js"></script>
    <script type="text/javascript" src="<?php echo public_url()?>/site/js/category_acordition.js"></script>
    <script language="javascript" src="<?php echo public_url()?>/site/js/main.js"></script>
    <script src="<?php echo public_url()?>/site/js/api-ajax.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script language="javascript" src="<?php echo public_url()?>/site/js/jquery-box-tin-meovat.min.js"></script>
    <script language="javascript" src="<?php echo public_url()?>/site/royalslider/jquery.royalslider.min.js">
    </script>
         <script language="javascript">
	        $(document).ready(function(){
		        $('#back_to_top').click(function() {
		            $('html, body').animate({scrollTop:0},"slow");
		       });
		       // go top
		       $(window).scroll(function() {
		            if($(window).scrollTop() != 0) {
		                $('#back_to_top').fadeIn();
		            } else {
		                $('#back_to_top').fadeOut();
		            }
		       });
	        });
	</script>


