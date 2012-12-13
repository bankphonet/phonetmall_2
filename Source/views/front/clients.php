<div class="splash" style="height: 330px;">
	<div class="slider">
		<img src="views/static/images/slide1.png" width="967" height="330" alt="point of sale activities"/>
		<img src="views/static/images/slide2.png" width="967" height="330" alt="point of sale activities"/>
	</div>
</div>

<div class="clear"></div>


<div class="innercontent-holder">
    
        
    <?php if($clients){ foreach($clients as $client){ ?>
	<div class="por-project client-box  rad5 box-shadow">
		<div class="project" style="background: url(uploads/clients/<?=$client['image']?>) center no-repeat">
		</div><!-- project -->

		<div class="details">
                    	
			<a href="#"><h2><?=$client['title']?></h2></a>
		</div>

	</div><!-- por-project client-box  -->
        <?php }}else{ ?>
        There are no clients yet

        <?php } ?>
	







</div>




