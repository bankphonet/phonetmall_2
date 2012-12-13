<div class="transfer rad5">


    <form action="?con=admin&page=ads" method="post" class="bvalidator" enctype="multipart/form-data">
        <label for="title"><?= l('Ad1') ?>:</label>
        <?php if($ads['img1']){ ?>
        <img src="uploads/ads/<?=$ads['img1']?>" width="400" height="50"/>
        <a href="?con=admin&action=delimg&id=1">Delete </a>
            <?php } ?>
        <input type="text" name="url1" id="title" value="<?= $ads['url1'] ?>" class="txtbox" data-bvalidator="url"/>
        
        <input type="file" name="img1" id="title" value="<?= $ads['img1'] ?>" class="txtbox"  style="margin-top: 5px;"/>

      
        
        <label for="title"><?= l('Ad2') ?>:</label>
        <?php if($ads['img2']){ ?><img src="uploads/ads/<?=$ads['img2']?>" width="400" height="50"/>
            <a href="?con=admin&action=delimg&id=2">Delete </a><?php } ?>
        <input type="text" name="url2" id="title" value="<?= $ads['url2'] ?>" class="txtbox" data-bvalidator="url"/>
        
        <input type="file" name="img2" id="title" value="<?= $ads['img2'] ?>" class="txtbox"  style="margin-top: 5px;"/>

      
        
        <label for="title"><?= l('Ad3') ?>:</label>
        <?php if($ads['img3']){ ?><img src="uploads/ads/<?=$ads['img3']?>" width="400" height="50"/>
            <a href="?con=admin&action=delimg&id=3">Delete </a><?php } ?>
        <input type="text" name="url3" id="title" value="<?= $ads['url3'] ?>" class="txtbox" data-bvalidator="url"/>
        
        <input type="file" name="img3" id="title" value="<?= $ads['img3'] ?>" class="txtbox"  style="margin-top: 5px;"/>

        
        <input type="submit" value="SAVE" class="registerbtn" />
      
        
         
    </form>
    
</div>