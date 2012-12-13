<div class="itemholder storeholder" style="margin-left: 7px;">

	<div class="itemname">
		<a href="?con=stores&page=store&id=<?= $store['id'] ?>" class="name">
			<?= ($store['trusted'] == 1) ? '<img src="views/static/images/trusted.png" width="32" height="32" alt="trusted" class="tiptool" title="'. l('Trusted store').'" style="float:'.l(left).';"/>' : '' ?>
			<?= $store['title'] ?></a>

		<a id ="addtofav<?= $store['id'] ?>" href="?con=stores&action=add-to-favorite&id=<?= $store['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $store['id'] ?>').hide();$('#removefromfav<?= $store['id'] ?>').show ();}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= (!$store['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/estar.png" width="24" height="24" alt="add to favourites" title="add to favourites"/></a>
		<a id ="removefromfav<?= $store['id'] ?>" href="?con=stores&action=remove-from-favorite&id=<?= $store['id'] ?>" class="fav" onclick= "<?php if ($oUser->id) { ?> ajax_call($(this),function(result){if(result >= 0){$('#addtofav<?= $store['id'] ?>').show();$('#removefromfav<?= $store['id'] ?>').hide ();}});return false;<?php } else { ?>location.href = '?page=login&unts=1&ref=<?= getURL() ?>' <?php } ?>;return false;" style="<?= ($store['fav']) ? '' : 'display:none' ?>" ><img src="views/static/images/fav.png" width="24" height="24" alt="add to favourites" title="add to favourites"/></a>

	</div><!-- itemname -->


	<div class="image">
		<a href="?con=stores&page=store&id=<?= $store['id'] ?>" ><img src="<?= ($store['profile_photo']) ? 'uploads/stores/' . $store['account_id'] . '/' . $store['profile_photo'] : 'views/static/images/project-thumbnail.png' ?>" width="300" height="125" alt="item name"/>
	</div>






	<div class="itemdetail">
		<a href="?con=stores&category_id=<?= $store['category_id'] ?>"><?= $store['cat_title'] ?></a>
	</div>

	<div class="itemdetail " style="height: 36px; overflow: hidden;">
		<?php foreach ($store['sub_categories'] as $sub) {
 ?>
				<a href="?con=stores&sub_category_id=<?= $sub['id'] ?>"><?= $sub['sub_cat_title'] ?></a>
<?php } ?>
		</div>

		<br class="clear"/>
		<div class="itemdetail">
			<a href="?con=stores&country_code=<?= $store['country_code'] ?>"><?= $store['cn_title'] ?></a>
		</div>
		<div class="itemdetail">
			<a href="?con=stores&city_id=<?= $store['city_id'] ?>"><?= $store['city_title'] ?></a>
		</div>
		<div class="itemdetail">
			<a href="?con=stores&area_id=<?= $store['area_id'] ?>"><?= $store['area_title'] ?></a>
		</div>


		<div class="sociallinks">
			<a href="<?= BASE_URL ?>?con=stores&page=store&id=<?= $store['id'] ?>" class="fb"><img src="views/static/images/fb.png" width="24" height="24" alt="share on facebook"/></a>
			<a href="<?= BASE_URL ?>?con=stores&page=store&id=<?= $store['id'] ?>" class="tweet"><img src="views/static/images/tw.png" width="24" height="24" alt="share on twitter"/></a>
	</div>


</div>