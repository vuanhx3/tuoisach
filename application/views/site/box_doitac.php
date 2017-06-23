<div class="partner">
      <div class="partner-top">
         <div class="tittle-box-center">
           <span>
             <h2>
              <a style="cursor: pointer;">ĐỐI TÁC CỦA Tuoisachvvn</a>
             </h2>
           </span>
        </div>
     </div><!-- End partner-top--> 

     <div class="partner-bottom">
      <?php foreach($list_partner as $row): ?>
         <div class="img-partner">
            <img src="<?php echo $row->image_link ?>" alt="<?php echo $row->title ?>">
         </div><!-- end partner-botom --> 
      <?php endforeach; ?>
     </div><!-- end partner-bottom -->
 </div><!-- end partner -->