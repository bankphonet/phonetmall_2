<div class="projectdetails">
	<div class="projectinfo">
		<h1><?=$project['title']?></h1>
                <p><?=substr(strip_tags($project['description']),0,300)?></p>
	</div>
	<div class="mainimage">
		<img id="mimage" src="<?=($project['image1']) ? 'uploads/portfolio/'.$project['image1'] : 'views/static/images/ferrari.png'?>" width="750" height="300" alt="image"/>
	</div>
	<div class="projectthumbs">
		
                <?php if($project['image1']){ ?>
                <a href="#">
			<img src="uploads/portfolio/<?=$project['image1']?>" width="100" height="100" alt="image" onclick="$('#mimage').attr('src',$(this).attr('src'));return false;"/>
		</a>
                <?php } ?>
            
            
              <?php if($project['image2']){ ?>
                <a href="#">
			<img src="uploads/portfolio/<?=$project['image2']?>" width="100" height="100" alt="image" onclick="$('#mimage').attr('src',$(this).attr('src'));return false;"/>
		</a>
                <?php } ?>
            
            
              <?php if($project['image3']){ ?>
                <a href="#">
			<img src="uploads/portfolio/<?=$project['image3']?>" width="100" height="100" alt="image" onclick="$('#mimage').attr('src',$(this).attr('src'));return false;"/>
		</a>
                <?php } ?>
            
            
              <?php if($project['image4']){ ?>
                <a href="#">
			<img src="uploads/portfolio/<?=$project['image4']?>" width="100" height="100" alt="image" onclick="$('#mimage').attr('src',$(this).attr('src'));return false;"/>
		</a>
                <?php } ?>
            
            
              <?php if($project['image5']){ ?>
                <a href="#">
			<img src="uploads/portfolio/<?=$project['image5']?>" width="100" height="100" alt="image" onclick="$('#mimage').attr('src',$(this).attr('src'));return false;"/>
		</a>
                <?php } ?>
            
            
              <?php if($project['image6']){ ?>
                <a href="#">
			<img src="uploads/portfolio/<?=$project['image6']?>" width="100" height="100" alt="image" onclick="$('#mimage').attr('src',$(this).attr('src'));return false;"/>
		</a>
                <?php } ?>
            
		
	</div>
</div>