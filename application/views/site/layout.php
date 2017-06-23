<html>
   <head>
     <?php $this->load->view('site/head')?>
   </head>
   
   <body>



		<script language="javascript">
			$(document).ready(function(){
            	$('h3 span').click(function(){
            		$('#popup').fadeOut(1000);
            		$('#popup-full').fadeOut(1000);
            	});

		        //Khi người dùng nhấp chuột vào bất cứ nơi nào bên ngoài phương thức, hãy đóng nó lại
				$(window).on('click', function(event){
				    $('#popup').fadeOut(1000);
            		$('#popup-full').fadeOut(1000);
				});
			});
		</script>

       <a href="#" id="back_to_top" style="display: none;">
		   <img style="width: 50px; " src="<?php echo public_url()?>/site/images/top.jpg">
	   </a>

	   <?php if(isset($message)): ?>
			<div id="popup">
	            <h3> tuoisachvvn <label for=""><span> close </span></label></h3>
	            <div id="main">
	               <div id="message">
	                  <p style="text-align: justify;">
	                    <?php echo $message?></h3>
	                  </p>
	               </div>
	            </div>
	        </div>
	        <div id="popup-full"></div>
	  <?php endif; ?>

	   <div class="wraper">
		      <header id="header">
		         <?php $this->load->view("site/header.php", $this->data)?>
		      </header><!-- End header -->

		      <header>
				<?php $this->load->view("site/menu.php", $this->data)?>	
		      	<!-- import box phan menu -->
		      </header>
		      	<div class="container">
		      	   <div class="row">
				       <div id="wp_main_content" class="wp_inner clearfix pd_mobile">
							<div id="outer">

								<!-- phan load box thay doi cua web -->
								<?php  $this->load->view($temp, $this->data);?>
								
								<div id="box_doitac" class="hide_mb_partner" >
									<?php $this->load->view("site/box_doitac.php", $this->data)?>
								</div><!-- end box_doitac -->

							</div><!-- end outer -->
				       </div><!-- end wp_main_content -->
		          </div><!-- end row -->
        	 </div><!-- end container -->
		      
		      <footer class="footer" id="footer"> 
		      		<?php $this->load->view("site/footer.php", $this->data)?>
		      </footer>

	   </div> <!-- End wrapper --> 
     
   </body>
</html>