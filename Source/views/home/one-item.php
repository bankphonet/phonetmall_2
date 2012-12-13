<li class="itemholder shadow" style="margin-left: 7px;">

    <div class="itemcontentdiv">
    	<div class="itemname">
        	<a href="?con=items&page=item&id=<?= $item['id'] ?>" class="name"><?= $item['title'] ?></a>
        	<a id ="addtofav<?= $item['id'] ?>" href="?con=items&action=add-to-favorite&id=<?= $item['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $item['id'] ?>').hide();$('#removefromfav<?= $item['id'] ?>').show ();}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= (!$item['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/estar.png" width="18" height="18" alt="add to favourites" title="add to favourites"/></a>
        	<a id ="removefromfav<?= $item['id'] ?>" href="?con=items&action=remove-from-favorite&id=<?= $item['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $item['id'] ?>').show();$('#removefromfav<?= $item['id'] ?>').hide ();}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= ($item['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/fav.png" width="18" height="18" alt="add to favourites" title="add to favourites"/></a>

    	</div><!-- itemname -->
    <div class="image">
        <a href="?con=items&page=item&id=<?= $item['id'] ?>" ><img src="<?= ($item['image1']) ? 'uploads/items/' . $item['account_id'] . '/' . $item['image1'] : 'views/static/images/thumb.png' ?>" width="100%" height="122px" alt="item name"/></a>
    </div>
    <div class="price">
        <div class="pricetext">
            <?= $item['price'] ?> <?= l('LE')?>
        </div>
        <?php if ($oUser->id != $item['account_id']) { ?>
            <div class="dropto" id="drop<?= $item['id'] ?>">

                <?php if (!$item['drop_request']) { ?>
                    <form class="bvalidator" action="?con=items&action=drop-request&id=<?= $item['id'] ?>" method="post" onsubmit = "<?php if ($oUser->id) { ?> if(!$('#dropto<?= $item['id'] ?>').val())return false; ajax_submit_form ($(this),'#drop<?= $item['id'] ?>');return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;">
                        <input type="text" id="dropto<?= $item['id'] ?>" name="dropto" value="" class="txtbox" data-bvalidator="required,number"/>
                        <input type="submit" value="<?= l('DROP')?>" class="drop" /> <span class="tiptool" title="<b><?= l('Drop the price & it will be sent to seller for approval or change.')?></b>">?!</span>
                    </form>
                <?php } else { ?>

                    <span class= "successmessage"><?= l('Request Sent')?></span>
                <?php } ?>
            </div>
        <?php } ?>
    </div> <!-- price -->
<!-- 
    <div class="shipping">
        <?php //if($item['descount']){ ?><br/><span><?//= l('Discount')?>:</span> <?//= $item['descount'] ?> %<?php //} ?>
    </div>
-->
	</div>
    
    <?php if (!$remove_link) { ?>
       
        <?php if($oUser->id != $item['account_id']){ ?>
        <a href="?page=my-cart&id=<?= $item['id'] ?>" class="addtocart">
            <span></span><?= l('ADD TO SHOPPING CART')?>
        </a>
    <?php }else{ ?>
    <span class="addtocart" style="background: #ffffff;"></span>
    <?php } ?>
    
    <?php } else { ?>
        <a href="?action=remove-from-cart&id=<?= $item['id'] ?>" class="addtocart">
            <span></span><?= l('REMOVE FROM SHOPPING CART')?>
        </a>
    <?php } ?>

    
</li>

<li class="itemholder shadow" style="margin-left: 7px;">

    <div class="itemcontentdiv">
    	<div class="itemname">
        	<a href="?con=items&page=item&id=<?= $item['id'] ?>" class="name"><?= $item['title'] ?></a>
        	<a id ="addtofav<?= $item['id'] ?>" href="?con=items&action=add-to-favorite&id=<?= $item['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $item['id'] ?>').hide();$('#removefromfav<?= $item['id'] ?>').show ();}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= (!$item['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/estar.png" width="18" height="18" alt="add to favourites" title="add to favourites"/></a>
        	<a id ="removefromfav<?= $item['id'] ?>" href="?con=items&action=remove-from-favorite&id=<?= $item['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $item['id'] ?>').show();$('#removefromfav<?= $item['id'] ?>').hide ();}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= ($item['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/fav.png" width="18" height="18" alt="add to favourites" title="add to favourites"/></a>

    	</div><!-- itemname -->
    <div class="image">
        <a href="?con=items&page=item&id=<?= $item['id'] ?>" ><img src="<?= ($item['image1']) ? 'uploads/items/' . $item['account_id'] . '/' . $item['image1'] : 'views/static/images/thumb.png' ?>" width="100%" height="122px" alt="item name"/></a>
    </div>
    <div class="price">
        <div class="pricetext">
            <?= $item['price'] ?> <?= l('LE')?>
        </div>
        <?php if ($oUser->id != $item['account_id']) { ?>
            <div class="dropto" id="drop<?= $item['id'] ?>">

                <?php if (!$item['drop_request']) { ?>
                    <form class="bvalidator" action="?con=items&action=drop-request&id=<?= $item['id'] ?>" method="post" onsubmit = "<?php if ($oUser->id) { ?> if(!$('#dropto<?= $item['id'] ?>').val())return false; ajax_submit_form ($(this),'#drop<?= $item['id'] ?>');return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;">
                        <input type="text" id="dropto<?= $item['id'] ?>" name="dropto" value="" class="txtbox" data-bvalidator="required,number"/>
                        <input type="submit" value="<?= l('DROP')?>" class="drop" /> <span class="tiptool" title="<b><?= l('Drop the price & it will be sent to seller for approval or change.')?></b>">?!</span>
                    </form>
                <?php } else { ?>

                    <span class= "successmessage"><?= l('Request Sent')?></span>
                <?php } ?>
            </div>
        <?php } ?>
    </div> <!-- price -->
<!-- 
    <div class="shipping">
        <?php //if($item['descount']){ ?><br/><span><?//= l('Discount')?>:</span> <?//= $item['descount'] ?> %<?php //} ?>
    </div>
-->
	</div>
    
    <?php if (!$remove_link) { ?>
       
        <?php if($oUser->id != $item['account_id']){ ?>
        <a href="?page=my-cart&id=<?= $item['id'] ?>" class="addtocart">
            <span></span><?= l('ADD TO SHOPPING CART')?>
        </a>
    <?php }else{ ?>
    <span class="addtocart" style="background: #ffffff;"></span>
    <?php } ?>
    
    <?php } else { ?>
        <a href="?action=remove-from-cart&id=<?= $item['id'] ?>" class="addtocart">
            <span></span><?= l('REMOVE FROM SHOPPING CART')?>
        </a>
    <?php } ?>

    
</li>







<!-- <section class="diagonal-divider clearfix">
	<header class="section-details clearfix">
		<h2 class="section-title"><a href="/collections/frontpage" title="">Frontpage</a></h2>
	</header>    
	<ul class="product-grid" id="secondary-grid">
		<li style="height: 213px; " class="generated-height">
			<div class="product-grid-item " id="product-153233182">
				<a href="?con=items&page=item&id=<?= $item['id'] ?>" class="product-link" title="Minty">
					<span class="product-price"><?//= $item['price'] ?> <?= l('LE')?></span>
					<img src="<?= ($item['image1']) ? 'uploads/items/' . $item['account_id'] . '/' . $item['image1'] : 'views/static/images/thumb.png' ?>" class="product-photo" alt="Minty">
				</a>
				<div class="product-information" style="height: 16px; ">
					<a href="?con=items&page=item&id=<?= $item['id'] ?>"><?= $item['title'] ?></a>
				</div>
			</div>    
        </li>
	</ul>
</section> -->