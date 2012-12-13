<div class="innercontent-holder" style="padding:5px;">
	
        <div class="projectinfo">
		<h1><?=$project['title']?></h1>
                <p><?=nl2br($project['description'])?></p>
	</div>
	<br/>
	<div class="projectthumbs">
		
            Click any image to delete <br/><br/>
                <?php if($project['image1']){ ?>
                <a href="?con=admin&action=del-image&project=<?=$project['id']?>&id=1" onclick ="var x=confirm('Are you sure ?'); if(!x) return false; ">
			<img src="uploads/portfolio/<?=$project['image1']?>" width="100" height="100" alt="image" />
		</a>
                <?php } ?>
            
            
              <?php if($project['image2']){ ?>
                <a href="?con=admin&action=del-image&project=<?=$project['id']?>&id=2" onclick="var x = confirm ('Are you sure ?');if(!x)return false;">
			<img src="uploads/portfolio/<?=$project['image2']?>" width="100" height="100" alt="image" />
		</a>
                <?php } ?>
            
            
              <?php if($project['image3']){ ?>
                <a href="?con=admin&action=del-image&project=<?=$project['id']?>&id=3" onclick="var x = confirm ('Are you sure ?');if(!x)return false;">
			<img src="uploads/portfolio/<?=$project['image3']?>" width="100" height="100" alt="image" />
		</a>
                <?php } ?>
            
            
              <?php if($project['image4']){ ?>
                <a href="?con=admin&action=del-image&project=<?=$project['id']?>&id=4" onclick="var x = confirm ('Are you sure ?');if(!x)return false;">
			<img src="uploads/portfolio/<?=$project['image4']?>" width="100" height="100" alt="image" />
		</a>
                <?php } ?>
            
            
              <?php if($project['image5']){ ?>
                <a href="?con=admin&action=del-image&project=<?=$project['id']?>&id=5" onclick="var x = confirm ('Are you sure ?');if(!x)return false;">
			<img src="uploads/portfolio/<?=$project['image5']?>" width="100" height="100" alt="image" />
		</a>
                <?php } ?>
            
            
              <?php if($project['image6']){ ?>
                <a href="?con=admin&action=del-image&project=<?=$project['id']?>&id=6" onclick="var x = confirm ('Are you sure ?');if(!x)return false;">
			<img src="uploads/portfolio/<?=$project['image6']?>" width="100" height="100" alt="image" />
		</a>
                <?php } ?>
            
		
	</div>
</div>