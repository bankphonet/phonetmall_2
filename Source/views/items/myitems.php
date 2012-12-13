<?php if($items){$x=0;foreach($items as $item) {
            $x++;
            include 'views/items/one-item.php';
            if( $x%3 == 0){
             echo "<div class='clear'></div>";}
		
 }?>
 
 
 <?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>
 
 <?php }else{ ?>
There are no items
    <?php } ?>

