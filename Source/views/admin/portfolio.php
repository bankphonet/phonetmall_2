

<div class="clear"></div>


<div class="innercontent-holder">
    
       <?php
						if ($notify_msg)
							echo '<div class="notify-msg clear">' . $notify_msg . '</div>';
						if ($error_msg)
							echo '<div class="error-msg clear">' . $error_msg . '</div>';
                     ?>
    
    <div style="float:right;padding:5px;">
        <a href="?con=admin&page=portfolio-form">ADD PROJECT TO PORTFOLIO </a>
    </div>
    
    <div class="clear"></div>
    
    <?php if($portfolio){ foreach($portfolio as $rec){ ?>
	<div class="por-project rad5 box-shadow">
		<div class="project" <?php if($rec['image1']){ ?>style="background: url(uploads/portfolio/<?=$rec['image1']?>) center no-repeat" <?php } ?> >
                        
			<div class="project-hover">
				<div class="zoomer">
					<a href="?con=admin&page=project-details&id=<?=$rec['id']?>" >
					<div class="zoomtool"></div>
					</a>
				</div>
			</div>
		</div><!-- project -->

		<div class="details">
			<a href="#"><h2><?=$rec['title']?></h2></a>
			<p>
                            <?= nl2br ($rec['description'])?>
			</p>
                        <div style="float:right;">
                        <a href="?con=admin&page=portfolio-form&id=<?=$rec['id']?>"><img src="views/static/images/edit.png" /></a>
                        <a href="?con=admin&action=delete-project&id=<?=$rec['id']?>" onclick ="var x=confirm('Are you sure ?'); if(!x) return false; "><img src="views/static/images/delete.png" /></a>
                        </div>
                        
		</div>

	</div><!-- por-project -->

        <?php }}else{  ?>
        There are no portfolio yet
        <?php } ?>

	




</div>




