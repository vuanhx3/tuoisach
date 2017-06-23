<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/head.php") ?>
</head>

	<body>
	    <!-- back-to-top -->
	 	<a href="#" id="back_to_top" style="display: none;">
		   <img style="width: 50px; " src="<?php echo public_url()?>/admin/images/top.jpg">
	    </a>

		<div id="left_content">
			<?php $this->load->view("admin/left_content.php")?>
		</div><!-- end left_content -->

		<div id="rightSide">
			<?php $this->load->view("admin/header.php")?>

				<!-- phan cpntent thay doi -->
					<?php  $this->load->view($temp, $this->data) ?>
				<!-- phan cpntent thay doi -->

			<?php $this->load->view("admin/footer.php")?>	
		</div><!-- end rightSide -->
	</body>
	
</html>