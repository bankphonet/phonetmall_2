<!-- Start of Message Box -->
<div id="dialog-form" title="Send Message">
    <p class="validateTips">All form fields are required.</p>
    <form class="bvalidator">
    <fieldset>
        <label for="subject" style="margin-right:40px;">Subject</label>
        <input type="text" name="subject" id="subject" class="text ui-widget-content ui-corner-all" data-bvalidator="required" size="40"/>
        <div class="clearfix" style="margin: 10px;"></div>
        <label for="message" style="margin-right:30px;">Message</label>
        <textarea rows="5" cols="42" name="message" id="message" value="" class="text ui-widget-content ui-corner-all" data-bvalidator="required"></textarea>
    </fieldset>
    </form>
</div>
<!-- End of Message Box -->

<div class="item-view">
    <?php if($item){ ?>
    <div class="left-item">
        <h1><span><?= l(strtoupper($item['item_type'])) ?>:</span> <?= $item['title'] ?></h1>
        <div class="clear"></div>

        <div class="item-info">
            <a href="?con=items&category_id=<?= $item['cat_id'] ?>"><?= $item['cat_title'] ?></a>
            <a href="?con=items&sub_category_id=<?= $item['sub_cat_id'] ?>"><?= $item['subcat_title'] ?></a>
           
            <a href="?con=items&country_code=<?= $item['country_code'] ?>"><?= $item['cn_title'] ?></a>
            <a href="?con=items&city_id=<?= $item['city_id'] ?>"><?= $item['city_title'] ?></a>
            <a href="?con=items&area_id=<?= $item['area_id'] ?>"><?= $item['area_title'] ?></a>


        </div>

        <div class="item-info">
        <?php if ($item['item_type']== 'for sale' ) { ?>
            <?= l('shipping type:') ?>
            <a href="?con=items&shipping_type=<?= $item['shipping_type'] ?>"><?= l($item['shipping_type']) ?> </a><span style="color: red;font-size: 12px;"class="tiptool" title="<?= l("In case of <b>paid</b> shipping we're responsible for delivery and refund. <br /> In case of <b>owner</b> shipping we're not responsible for delivery or refund.") ?>">?!</span>
		 <?php } ?>
        </div>
        <?php if ($item['seller_phone']) { ?>
        <div class="item-info">
            <?= l('seller phone:') ?> <?= $item['seller_phone'] ?>
        </div>
        
        <?php } ?>

        <div class="item-info">

            <img src="<?= ($item['image1']) ? thumb('uploads/items/'.$item['account_id'] . '/' .$item['image1'], 555, 300) : 'views/static/images/big-no-image.png' ?>" width="555" height="300" alt=""/>

        </div>

        <div class="images-holder rad5">




            <?php if ($item['image1']) { ?>
            <div class="oneimage">
                <a rel="gallery" href="uploads/items/<?= $item['account_id'] . '/' . $item['image1'] ?>" >
                    <img  src="uploads/items/<?= $item['account_id'] . '/' . $item['image1'] ?>" width="120" height="100" alt="image"/>
                </a>
            </div>
            <?php } ?>

            <?php if ($item['image2']) { ?>
            <div class="oneimage">
                <a rel="gallery" href="uploads/items/<?= $item['account_id'] . '/' . $item['image2'] ?>" >
                    <img  src="uploads/items/<?= $item['account_id'] . '/' . $item['image2'] ?>" width="120" height="100" alt="image"/>
                </a>
            </div>
            <?php } ?>
            <?php if ($item['image3']) { ?>
            <div class="oneimage">
                <a rel="gallery" href="uploads/items/<?= $item['account_id'] . '/' . $item['image3'] ?>" >
                    <img  src="uploads/items/<?= $item['account_id'] . '/' . $item['image3'] ?>" width="120" height="100" alt="image"/>
                </a>
            </div>
            <?php } ?>
            <?php if ($item['image4']) { ?>
            <div class="oneimage">
                <a rel="gallery" href="uploads/items/<?= $item['account_id'] . '/' . $item['image4'] ?>" >
                    <img  src="uploads/items/<?= $item['account_id'] . '/' . $item['image4'] ?>" width="120" height="100" alt="image"/>
                </a>
            </div>
            <?php } ?>


        </div>


        <div class="item-info">
            <p>
                <?= nl2br($item['description']) ?>
            </p>
        </div><!-- item-info -->








    </div>
    <div class="right-item">
        <div class="price rad5"><span><?= l('price') ?>:</span> <?= $item['price'] ?> <?= l('LE') ?> </div>
        <?php if($oUser->id != $item['account_id']){ ?>
        	<?php if ($item['item_type']== 'for sale') {?>
        <a href="?page=my-cart&id=<?= $item['id'] ?>" class="addtocart">
            <img src="views/static/images/<?= l('add2cartinner') ?>.png" width="270" height="40" alt=""/>
        </a>
        <?php }?>
        <?php } ?>

        <div class="sociallinks">
            <a href="<?= BASE_URL."?con=items&page=item&id=".$item['id'] ?>" class="fb"><img src="views/static/images/fb.png" width="24" height="24" alt="share on facebook"/></a>
            <a href="<?= BASE_URL."?con=items&page=item&id=".$item['id'] ?>" class="tweet"><img src="views/static/images/tw.png" width="24" height="24" alt="share on twitter"/></a>
        </div>
        <?php if($oUser->id != $item['account_id']){ ?>
        <?php if ($item['item_type']== 'for sale' ){ ?>
        <div class="dropto" id="drop<?= $item['id'] ?>">
            <br/>
            <?php if(!$item['drop_request']){ ?>
            <form class="bvalidator" action="?con=items&action=drop-request&id=<?= $item['id'] ?>" method="post" onsubmit = "<?php if($oUser->id){ ?> if(!$('#dropto').val())return false; ajax_submit_form ($(this),'#drop<?= $item['id'] ?>');return false;<?php } else{ ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;">
                <input type="text" id="dropto" name="dropto" value="" class="txtbox" data-bvalidator="required"/>
                <input type="submit" value="<?= l('DROP') ?>" class="drop" />
                <span class="tiptool" title="<b><?= l('Drop the price & it will be sent to seller for approval or change.') ?></b>">?!</span>
            </form>
            <?php } else { ?>

            <span class= "successmessage"><?= l('Request Sent') ?></span>
            <?php } ?>
        </div>
        <?php }?>
        <?php } ?>

        <div class="actions">
            <a id ="addtofav<?= $item['id'] ?>" href="?con=items&action=add-to-favorite&id=<?= $item['id'] ?>" class="fav" onclick= "<?php if($oUser->id){ ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $item['id'] ?>').hide();$('#removefromfav<?= $item['id'] ?>').show ();$('#fv').html(parseInt($('#fv').html())+1)}});return false;<?php } else{ ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= (!$item['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/estar.png" width="24" height="24" alt="add to favourites" title="add to favourites"/><?= l('Add to favorites') ?></a>
            <a id ="removefromfav<?= $item['id'] ?>" href="?con=items&action=remove-from-favorite&id=<?= $item['id'] ?>" class="fav" onclick= "<?php if($oUser->id){ ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $item['id'] ?>').show();$('#removefromfav<?= $item['id'] ?>').hide ();$('#fv').html(parseInt($('#fv').html())-1)}});return false;<?php } else{ ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= ($item['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/fav.png" width="24" height="24" alt="add to favourites" title="add to favourites"/><?= l('Remove from favorites') ?></a>

            <div class="clear"></div>
            <span id='fv'><?= $item['nfavorites'] ?></span> <?= l('Person favorite this item') ?>
            <div class="clear"></div>

            <?php if ($oUser->id == $item['account_id'] || $oUser->admin == 1) { ?>
            <a href="?con=items&page=items-form&id=<?= $item['id'] ?>&user=<?= $item['account_id'] ?>" style="margin: 10px 0; float: left;">
                <img src="views/static/images/edit.png" width="24" height="24" alt="addto" title="addto"/>
                <?= l('EDIT ITEM') ?></a>
            <div class="clear"></div>
<!--             <a href="?con=items&action=del-item&id=<?= $item['id'] ?>&user=<?= $item['account_id'] ?>">
                <img src="views/static/images/delete.png" width="24" height="24" alt="delete" title="delete"/><?= l('DELETE ITEM') ?></a> -->
            <?php } ?>
        </div>



        <?php if ($store) { ?>
        <div class="storeinfor rad5">

            <?php if ($store['trusted']) { ?><div class="trusted">trusted store</div><?php } ?>
            <div class="storename"><a href="?con=stores&page=store&id=<?= $store['id'] ?>"><?= $store['title'] ?></a></div>
            <div class="storename">
                <p>
                    <?= mb_substr($store['description'], 0, 200) ?>
                </p>
                <a href="?con=stores&page=store&id=<?= $store['id'] ?>" class="more">more...</a>
            </div>


            <div class="category">
                <a href="?con=stores&category_id=<?= $store['category_id'] ?>"><?= $store['cat_title'] ?></a>

                <?php foreach ($store['sub_categories'] as $sub) { ?>

                <a href="?con=stores&sub_category_id=<?= $sub['id'] ?>"><?= $sub['sub_cat_title'] ?></a>

                <?php } ?>
            </div>
            <div class="category">
                <p><?= ($store['tel1']) ? l('Tel').' : '.$store['tel1'] : '' ?></p>
                <p><?= ($store['tel2']) ? l('Tel').' : '.$store['tel2'] : '' ?></p>
                <p><?= ($store['tel3']) ? l('Tel').' : '.$store['tel3'] : '' ?></p>

            </div>

        </div>
        <button id="send-message" style="margin-top: 10px;">Send Message</button>
        <?php } ?>


        <?php if($oUser->id == $item['account_id']){ ?>

       
        <div class="clear"></div>
        
        <?php if($item['quantity'] != $item['records']){ ?>
        <div>
        <form class="bvalidator" action="?con=items&action=addrecord&id=<?= $item['id'] ?>" method="post">
            <input type="text" id="dropto" name="rec1" value="" class="txtbox" style="width:80px;" data-bvalidator="required"/>
            <input type="text" id="dropto" name="rec2" value="" class="txtbox" style="width:80px;" data-bvalidator="required"/>
            <input type="submit" value="<?= l('ADD RECORD') ?>" class="drop" />
            <span class="tiptool" title="<b><?= l('Add records to your item') ?></b>">?!</span>
        </form>
        </div>
        <?php }?>
        
        <?php } ?>
        
        
        <?php if($oUser->id == $item['account_id'] || $oUser->admin == 1){ ?>
            <?php if($records){ ?>  
       
        <div class="clear"></div>
        <table>
            <tr>
            <td>#</td>
            <td>Record1 </td>
            <td>Record2 </td>
            <td>Delete </td>
            </tr>
          <?php foreach($records as $record){ ?>
                 <tr class="<?=($record['account_id'] != 0) ? 'paied' : ''?>">
            <td><?=$record['id']?></td>
            <td><?=$record['rec1']?> </td>
            <td><?=$record['rec2']?> </td>
            <td>
            <?php if($record['account_id'] == 0 && $oUser->id = $item['account_id']){ ?>
            <a href="?con=items&action=delrecord&id=<?=$item['id']?>&rec_id=<?=$record['id']?>"> <?=l('Delete')?> </a>
            <?php }else{ ?>
            <a href="?page=orderdetails&id=<?=$record['order_id']?>"><?=$record['order_id']?></a>
            <?php } ?>
            </td>
                 </tr>
            <?php } ?>
            
            </table>
        <?php }} ?>
            
        
    </div>
    <?php }else{ ?>
    There is no item
<?php } ?>
</div>