<?php if($stores){$x=0;foreach($stores as $store) {
     $x++;
            include 'views/stores/one-store.php';
            if( $x%3 == 0){
             echo "<div class='clear'></div>";}
            } ?>
    
    			<?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

    <?php }else{ ?>
There are no stores
<?php } ?>