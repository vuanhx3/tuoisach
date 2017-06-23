<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Tuoisachvvn</title>

<meta name="robots" content="noindex, nofollow" />

<link rel="shortcut icon" href="<?php echo public_url('admin')?>/images/icon.png" type="image/x-icon"/>
 <link rel="stylesheet" href="<?php echo public_url()?>/site/css/awesome/css/font-awesome.css" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin/crown') ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin')?>/css/css.css" media="screen" />
<!-- css box hien thi thong bao dang modal -->
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin')?>/css/dialog.css" media="screen" />
<!-- css luat khoi phuc mac dinh trong admin_group -->
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin')?>/css/restore.css" media="screen" />

<!-- css thẻ tag -->
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin')?>/css/tagsinput.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin')?>/css/back_to_top.css" media="screen" />


<script type="text/javascript">
	var admin_url 	= '';
	var base_url 	= '';
	var public_url 	= '';
</script>

<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/spinner/jquery.mousewheel.js"></script>

<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/uniform.js"></script>

<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/jquery.tagsinput.min.js"></script>

<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/autogrowtextarea.js"></script>

<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/jquery.maskedinput.min.js"></script>

<!-- js thẻ tag -->
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/tagsinput.js"></script>

<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/forms/jquery.inputlimiter.min.js"></script>

<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/tables/resizable.min.js"></script>

<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/plugins/ui/jquery.sourcerer.js"></script>
<!-- js cac thong bao xoa thành công..., dang xuât -->
<script type="text/javascript" src="<?php echo public_url('admin/crown') ?>/js/custom.js"></script>



<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/scrollTo/jquery.scrollTo.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/number/jquery.number.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/formatCurrency/jquery.formatCurrency-1.4.0.min.js"></script>
<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/zclip/jquery.zclip.js"></script>

<script type="text/javascript" src="<?php echo public_url()?>/js/jquery/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo public_url()?>/js/jquery/colorbox/colorbox.css" media="screen" />

<script type="text/javascript" src="<?php echo public_url()?>/js/custom_admin.js" type="text/javascript"></script>

<script>
	var ckeditor_config = {
        base_url : '<?php echo $this->config->base_url('admin') ?>/',
        connector_path : 'ckfinder/gallery/connector',
        html_path : 'ckfinder/gallery/editorhtml'
    };
</script>
<script src="<?php echo $this->config->base_url() ?>public/ckfinder/ckfinder.js"></script>
<script src="<?php echo $this->config->base_url() ?>public/ckeditor/ckeditor.js"></script>
<script>
	function BrowseServer(event)
{	
	// var a = event.target;
	
	var event  = jQuery(event).attr('datainput');
	// console.log(event);
	var finder = new CKFinder();
	finder.event = event;
	finder.basePath = '../';	
	finder.selectActionFunction = SetFileField;
	finder.popup();
}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField( fileUrl )
{
	// console.log(this.config.event);
	document.getElementById( this.config.event ).value = fileUrl;
}
</script>

<!-- back-to-top -->
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

<!-- hien nut quay tro lai -->
<script language="javascript">
	$(document).ready(function(){
		$(window).scroll(function() {
            if($(window).scrollTop() != 0) {
                $('#back').fadeIn();
            } else {
                $('#back').fadeOut();
            }
       });
	});
</script>