
<div class="clear"></div>


<div class="innercontent-holder">
    
         <?php
						if ($notify_msg)
							echo '<div class="notify-msg clear">' . $notify_msg . '</div>';
						if ($error_msg)
							echo '<div class="error-msg clear">' . $error_msg . '</div>';
                     ?>
    
    <div style="float:right;padding:5px;">
        <a href="?con=admin&page=clients-form">ADD NEW CLIENT </a>
    </div>
    
    
    <?php if($clients){ foreach($clients as $client){ ?>
	<div class="por-project client-box  rad5 box-shadow">
		<div class="project" style="background: url(uploads/clients/<?=$client['image']?>) center no-repeat">
		</div><!-- project -->

		<div class="details">
                    	
			<a href="#"><h2><?=$client['title']?></h2></a>
		</div>
                <div style="float:right;">
                        <a href="?con=admin&page=clients-form&id=<?=$client['id']?>"><img src="views/static/images/edit.png" /></a>
                        <a href="?con=admin&action=delete-client&id=<?=$client['id']?>" onclick ="var x=confirm('Are you sure ?'); if(!x) return false; "><img src="views/static/images/delete.png" /></a>
                        </div>

	</div><!-- por-project client-box  -->
        <?php }}else{ ?>
        There are no clients yet

        <?php } ?>
	







</div>




