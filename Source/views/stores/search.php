<div class="searchholderbar">
    
	<div class="searchbar">
		<a href="#" class="showhide"><img src="views/static/images/showsearch.png" width="28" height="28" alt="show/hide"/></a>
	<h2><?= l('Search for stores')?></h2>
         <form action="" method="get">
         <input type="hidden" name="con" value="stores" />
         <input type="hidden" name="search_flag" value="1" />
	<input type="text" id="keyword" name="keyword" value="<?=($_GET['keyword']) ? $_GET['keyword'] : l('keyword')?>" title="keyword" class="txtbox clearonfocus"/>


	<select name="category_id" id="category_id" class="txtbox" data-bvalidator="required" onchange="url = '?ajax=subcategory-list&id=' + $(this).val(); $('#subcategory1').load(url,function(result){$('#subcategory1').val(<?=$_GET['sub_category_id']?>);});">
           
            <?= getCategoriesBox((($_GET['category_id']) ? $_GET['category_id'] : ''))  ?>
        </select>


	 <select name="sub_category_id" id="subcategory1" class="txtbox" data-bvalidator="required">
                    <option value="" ><?= l('Please Chose sub-category') ?></option>
          </select>



	<select id="country_code" class="txtbox" data-bvalidator="required" name="country_code" onchange="url = '?ajax=cities-list&id=' + $(this).val(); $('#city_id1').load(url,function(result){$('#city_id1').val(<?=$_GET['city_id']?>);$('#city_id1').trigger ('change'); });">
            
                <?= getCountriesBox ($_GET['country_code']) ?>
        </select>


	<select id="city_id1" class="txtbox" data-bvalidator="required" name="city_id" onchange="url = '?ajax=area-list&id=' + $(this).val(); $('#area_id1').load(url,function(result){$('#area_id1').val(<?=$_GET['area_id']?>);});">
            <option value=""><?= l('Please choose city') ?></option>
           
        </select>


	 
        <select id="area_id1" class="txtbox" data-bvalidator="required" name="area_id">
            <option value=""><?= l('Please choose area') ?></option>
           
        </select>

	


	<div class="clear"></div>

	<input type="submit" value="<?= l('SEARCH')?>" class="search"/>
        </form>

</div> <!-- searhbar -->




<div class="searchbar" style="width: 580px; margin-<?= l('left')?>: 10px;">
	<a href="#" class="showhide" style="width: 560px;"><img src="views/static/images/showsearch.png" width="28" height="28" alt="show/hide"/></a>
	<h2><?= l('Search for items')?></h2>
        <form action="" method="get">
         <input type="hidden" name="con" value="items" />
	<input type="text" id="keyword" name="keyword" value="<?=($_GET['keyword']) ? $_GET['keyword'] : l('keyword')?>" title="<?=l('keyword')?>" class="txtbox clearonfocus"/>
	<input type="text" id="keyword" name="store" value="<?=($_GET['store']) ? $_GET['store'] : l('Store')?>" title="<?=l('Store')?>" class="txtbox clearonfocus" style="margin-left: 40px;"/>


	<select name="category_id" id="category_id" class="txtbox" data-bvalidator="required" onchange="url = '?ajax=subcategory-list&id=' + $(this).val(); $('#subcategory').load(url,function(result){$('#subcategory').val(<?=$_GET['sub_category_id']?>);});">
          
            <?= getCategoriesBox (($_GET['category_id']) ? $_GET['category_id'] : '')  ?>
        </select>


	 <select name="sub_category_id" id="subcategory" class="txtbox" data-bvalidator="required" style="margin-left: 40px;">
                    <option value="" ><?= l('Please Chose sub-category') ?></option>
          </select>

                 <select name="item_type" id="" class="txtbox">

            <option value=""><?= l('All types')?></option>
            <option value="for sale" <?=($_GET['item_type'] == 'for sale') ? 'SELECTED' : ''?> ><?= l('For Sale') ?></option>
            <option value="for rent" <?=($_GET['item_type'] == 'for rent') ? 'SELECTED' : ''?> ><?= l('For rent') ?></option>
            <option value="needed for sale" <?=($_GET['item_type'] == 'needed for sale') ? 'SELECTED' : ''?> ><?= l('Wanted for purchase') ?></option>
            <option value="needed for rent" <?=($_GET['item_type'] == 'needed for rent') ? 'SELECTED' : ''?> ><?= l('Wanted for rent') ?></option>
            <option value="needed job" <?=($_GET['item_type'] == 'needed job') ? 'SELECTED' : 'needed job'?> ><?= l('Needed job') ?></option>
            <option value="vacant job" <?=($_GET['item_type'] == 'vacant job') ? 'SELECTED' : ''?> ><?= l('Vacant job') ?></option>
        </select>


	<select id="country_code" class="txtbox" data-bvalidator="required" name="country_code" onchange="url = '?ajax=cities-list&id=' + $(this).val(); $('#city_id').load(url,function(result){$('#city_id').val(<?=$_GET['city_id']?>);$('#city_id').trigger ('change'); });" style="margin-left: 40px;">
            
                <?= getCountriesBox ($_GET['country_code']) ?>
        </select>


	<select id="city_id" class="txtbox" data-bvalidator="required" name="city_id" onchange="url = '?ajax=area-list&id=' + $(this).val(); $('#area_id').load(url,function(result){$('#area_id').val(<?=$_GET['area_id']?>);});">
            <option value=""><?= l('Please choose city') ?></option>

        </select>



        <select id="area_id" class="txtbox" data-bvalidator="required" name="area_id" style="margin-left: 40px;">
            <option value=""><?= l('Please choose area') ?></option>

        </select>


	<div class="price">
		<input type="text" id="pricefrom" name="pricefrom" value="<?=($_GET['pricefrom']) ? $_GET['pricefrom'] : l('price from')?>" class="txtbox clearonfocus" title="<?=('price from')?>"/>
		<input type="text" id="pricefrom" name="priceto" value="<?=($_GET['priceto']) ? $_GET['priceto'] : l('price to')?>" class="txtbox clearonfocus" title="<?=('price to')?>" style="margin-left: 40px;"/>
	</div>


	<select id="shipping_type" name="shipping_type" class="txtbox">
            <option value=""><?= l('Shipping type')?></option>
            <option value="paid" <?=($_GET['shipping_type'] == 'paid') ? 'SELECTED' : ''?>><?= l('Paid') ?></option>
            <option value="owner" <?=($_GET['shipping_type'] == 'owner') ? 'SELECTED' : ''?>><?= l('Owner') ?></option>
        </select>

	<div class="clear"></div>

	<input type="submit" value="<?= l('SEARCH')?>" class="search" style="margin-left: 200px;"/>
        </form>
</div> <!-- searhbar -->
</div>


<div class="right" style="margin-left: 400px;">
    
    	
</div>


<script type="text/javascript">


	$(function(){

		$('.showhide').toggle(function() {
  $(this).parent().find('input, .txtbox').hide();
			$(this).parent().css("height","55");
}, function() {
  $(this).parent().find('input, .txtbox').show();
			$(this).parent().css("height","345");
});


	});



</script>