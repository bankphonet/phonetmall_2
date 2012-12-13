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
<button id="send-message">Send Message</button>
<!-- End of Message Box -->
<div class="store-view">
    <?php if ($store) { ?>
        <div class="coverphoto" style="background: <?= ($store['cover_photo']) ? 'url(uploads/stores/' . $store['account_id'] . '/' . $store['cover_photo'] . ')' : 'url(views/static/images/coverphoto.jpg)' ?> center top;">
            <div class="store-name"><?= $store['title'] ?> <?= ($store['account_id'] == $oUser->id || $oUser->admin == 1) ? '- <a href="?con=stores&page=store-form&id=' . $store['id'] . '&user=' . $store['account_id'] . '">EDIT</a>' : '' ?></div>
            <div class="clear"></div>
            <div class="item-search">
            <form  name="search-item" method="get">
				<label for="search" class="searchlabel">Search:</label>
				<input type="text" id="search-item" name="keyword" class="search-home"  value="<?=($_GET['keyword']) ? $_GET['keyword'] : ("search item in store")?>">
				<input type="hidden" name="con" value="stores">
				<input type="hidden" name="page" value="store">
				<input type="hidden" name="id" value="<?=$_GET["id"]?>">
            	<input type="submit" value="Search" class="search-button">
            
            
            </form>
            
            
            
            
            </div>
            <div class="profile-pic"><?= ($store['profile_photo']) ? '<img src="uploads/stores/' . $store['account_id'] . '/' . $store['profile_photo'] . '" width=130 height=110 />' : '' ?></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="store-info rad5">

            <?= ($store['trusted'] == 1) ? '<img src="views/static/images/trusted.png" width="32" height="32" alt="trusted" class="tiptool" title="Trusted store"/>' : '' ?>
			
            <div class="clear"></div>
            <a href="?con=stores&category_id=<?= $store['category_id'] ?>"><?= $store['cat_title'] ?></a> 


            <?php foreach ($store['sub_categories'] as $sub) { ?>

                <a href="?con=stores&sub_category_id=<?= $sub['id'] ?>"><?= $sub['sub_cat_title'] ?></a>

            <?php } ?>


            <a href="?con=stores&country_code=<?= $store['country_code'] ?>"><?= $store['cn_title'] ?></a> <a href="?con=stores&city_id=<?= $store['city_id'] ?>"><?= $store['city_title'] ?></a> <a href="?con=stores&area_id=<?= $store['area_id'] ?>"><?= $store['area_title'] ?></a>

            <div class="clear"></div>

            <p class="description"><?= detectUrl($store['description']) ?></p>
            <div class="clear"></div>


        </div>
        <div class="store-contact rad5">
            <a id ="addtofav<?= $store['id'] ?>" href="?con=stores&action=add-to-favorite&id=<?= $store['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $store['id'] ?>').hide();$('#removefromfav<?= $store['id'] ?>').show ();$('#fv').html(parseInt($('#fv').html())+1)}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= (!$store['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/estar.png" width="24" height="24" alt="add to favourites" title="add to favourites"/></a>
            <a id ="removefromfav<?= $store['id'] ?>" href="?con=stores&action=remove-from-favorite&id=<?= $store['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $store['id'] ?>').show();$('#removefromfav<?= $store['id'] ?>').hide ();$('#fv').html(parseInt($('#fv').html())-1)}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= ($store['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/fav.png" width="24" height="24" alt="add to favourites" title="add to favourites"/></a>

            <div class="clear"></div>
            <span id='fv'><?=$store['nfavorites']?></span> <?= l('Person favorite this store')?>
            <div class="clear"></div>
            <span class="phone"><?= ($store['tel1']) ? l('Tel') . ' : ' . $store['tel1'] : '' ?>
                <?= ($store['tel2']) ? ' , ' . $store['tel2'] : '' ?>
                <?= ($store['tel3']) ? ' , ' . $store['tel3'] : '' ?>
            </span>
            <div class="clear"></div>
            <a href="?con=stores&page=store-map&id=<?= $store['id'] ?>" class="fancybox" style="font-size: 12px;"><?= l('View location map')?></a>
            <div class="sociallinks">
                <a href="<?= BASE_URL . "?con=stores&page=store&id=" . $store['id'] ?>" class="fb"><img src="views/static/images/fb.png" width="24" height="24" alt="share on facebook"/></a>
                <a href="<?= BASE_URL . "?con=stores&page=store&id=" . $store['id'] ?>" class="tweet"><img src="views/static/images/tw.png" width="24" height="24" alt="share on twitter"/></a>
            </div>
            <br/>
            <?php if ($oUser->id == $store['account_id']) { ?><a href="?con=items&page=items-form&store_id=<?= $store['id'] ?>" class="addnew">ADD NEW ITEM</a><?php } ?>
        </div>

        <br class="clear">



        <div class="clear"></div>

        <?php
        if ($items) {
            $x = 0;
            foreach ($items as $item) {
                $x++;
                include 'views/items/one-item.php';
                if ($x % 3 == 0) {
                    echo "<div class='clear'></div>";
                }
            }
            ?>
        <div class="clear"></div>
        <?= mypaging($pages_count, $page_no, 'href="?' . extractUrl($_GET) . '&page-no={page}" class="{active}"') ?>

        <?php } else { ?>
            <div class="nocontent">
                NO ITEMS YET IN THIS STORE
            </div>
        <?php } ?>

<?php } else { ?>

        There is no store
<?php } ?>
</div>

<div class="clear"></div>
<script src='http://maps.google.com/maps/api/js?sensor=true&language=ar&region=EG' type='text/javascript'></script>