<div class="splash" style="height: 330px;">
	<div class="slider">
		<img src="views/static/images/slide1.png" width="967" height="330" alt="point of sale activities"/>
		<img src="views/static/images/slide2.png" width="967" height="330" alt="point of sale activities"/>
	</div>
</div>

<div class="clear"></div>


<div class="innercontent-holder">

    
    <?php if($portfolio){ foreach($portfolio as $rec){ ?>
	<div class="por-project rad5 box-shadow">
		<div class="project" <?php if($rec['image1']){ ?>style="background: url(uploads/portfolio/<?=$rec['image1']?>) center no-repeat" <?php } ?> >
                        
			<div class="project-hover">
				<div class="zoomer">
					<a href="?ajax=project-details&id=<?=$rec['id']?>" onclick="fancybox($(this));return false" class="fancybox">
					<div class="zoomtool"></div>
					</a>
				</div>
			</div>
		</div><!-- project -->

		<div class="details">
			<a href="#"><h2><?=$rec['title']?></h2></a>
			<p>
                            <?=nl2br($rec['description'])?>
			</p>
		</div>

	</div><!-- por-project -->

        <?php }}else{  ?>
        There are no portfolio yet
        <?php } ?>

	




</div>




