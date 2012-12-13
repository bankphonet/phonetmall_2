<div class="itemholder" style="margin-left: 7px;">
	
    <div class="itemcontentdiv">

    <div class="itemname">
        <a href="?con=items&page=item&id=<?= $item['id'] ?>" class="name"><?= $item['title'] ?></a>


        <a id ="addtofav<?= $item['id'] ?>" href="?con=items&action=add-to-favorite&id=<?= $item['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $item['id'] ?>').hide();$('#removefromfav<?= $item['id'] ?>').show ();}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= (!$item['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/estar.png" width="18" height="18" alt="add to favourites" title="add to favourites"/></a>
        <a id ="removefromfav<?= $item['id'] ?>" href="?con=items&action=remove-from-favorite&id=<?= $item['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $item['id'] ?>').show();$('#removefromfav<?= $item['id'] ?>').hide ();}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= ($item['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/fav.png" width="18" height="18" alt="add to favourites" title="add to favourites"/></a>

    </div><!-- itemname -->


    <div class="image">
        <a href="?con=items&page=item&id=<?= $item['id'] ?>" ><img src="<?= ($item['image1']) ? 'uploads/items/' . $item['account_id'] . '/' . $item['image1'] : 'views/static/images/thumb.png' ?>" width="300" height="125" alt="item name"/></a>
    </div>

    <div class="price">

        <div class="pricetext">
            <?= $item['price'] ?> <?= l('LE')?>
        </div>
        <?php if ($oUser->id != $item['account_id']) { ?>
        <?php if ($item['item_type']== 'for sale' ) { ?>
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
            <?php }?>
        <?php } ?>


    </div> <!-- price -->




    <div class="itemdetail">
        <a href="?con=items&item_type=<?= $item['item_type'] ?>"><?= l($item['item_type']) ?></a>
    </div>


    <div class="itemdetail">
        <a href="?con=items&category_id=<?= $item['cat_id'] ?>"><?= $item['cat_title'] ?></a>
    </div>
    <div class="itemdetail">
        <a href="?con=items&sub_category_id=<?= $item['sub_cat_id'] ?>"><?= $item['subcat_title'] ?></a>
    </div>
    <div class="itemdetail">
        <a href="?con=items&country_code=<?= $item['country_code'] ?>"><?= $item['cn_title'] ?></a>
    </div>
    <div class="itemdetail">
        <a href="?con=items&city_id=<?= $item['city_id'] ?>"><?= $item['city_title'] ?></a>
    </div>
    <div class="itemdetail">
        <a href="?con=items&area_id=<?= $item['area_id'] ?>"><?= $item['area_title'] ?></a>
    </div>

    <div class="shipping">
            <?php if ($item['item_type']== 'for sale' ) { ?>

        <span><?= l('Shipping type:')?></span> <?= l($item['shipping_type'] .' shipping') ?> <span style="color: red;font-size: 12px;"class="tiptool" title="<?= l("In case of <b>paid</b> shipping we're responsible for delivery and refund. <br /> In case of <b>owner</b> shipping we're not responsible for delivery or refund.")?>">?!</span>
        <?php if($item['descount']){ ?><br/><span><?= l('Discount')?>:</span> <?= $item['descount'] ?> %<?php } ?> <?php }?>
    </div>

    <div class="itemdetail">
        <a href="?con=stores&page=store&id=<?= $item['st_id'] ?>"><strong><?= $item['st_title'] ?></strong></a>
    </div>



	</div>
    <div class="sociallinks">
        <a href="<?=BASE_URL."?con=items&page=item&id=".$item['id']?>" class="fb"><img src="views/static/images/fb.png" width="24" height="24" alt="share on facebook"/></a>
        <a href="<?=BASE_URL."?con=items&page=item&id=".$item['id']?>" class="tweet"><img src="views/static/images/tw.png" width="24" height="24" alt="share on twitter"/></a>
    </div>
    <?php if (!$remove_link) { ?>
       
        <?php if($oUser->id != $item['account_id']){ ?>
		<?php if ($item['item_type']== 'for sale' ) {?>
        <a href="?page=my-cart&id=<?= $item['id'] ?>" class="addtocart">
            <span></span><?= l('ADD TO SHOPPING CART')?>
        </a>
        <?php }?> 
    <?php }else{ ?>
    <span class="addtocart" style="background: #ffffff;"></span>
    <?php } ?>
    
    <?php } else { ?>
        <a href="?action=remove-from-cart&id=<?= $item['id'] ?>" class="addtocart">
            <span></span><?= l('REMOVE FROM SHOPPING CART')?>
        </a>
    <?php } ?>

    
</div>
