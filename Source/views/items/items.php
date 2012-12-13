

<div class="left">


    <a href="?con=items&page=items-form" class="addnew rad5"><span class="add-icon"></span><?= l('ADD NEW ITEM') ?></a>



    <div class="searchbar">
        <h2><span class="search-icon"></span><?= l('SEARCH FOR ITEMS') ?></h2>
        <form action="" method="get">
            <input type="hidden" name="con" value="items" />

            <label for="keyword"><?= l('Keyword') ?>:</label>
            <input type="text" id="keyword" name="keyword" value="<?= ($_GET['keyword']) ? $_GET['keyword'] : l('') ?>" title="<?= l('keyword') ?>" class="txtbox "/>

            <label for="store"><?= l('Store') ?>:</label>
            <input type="text" id="store" name="store" value="<?= ($_GET['store']) ? $_GET['store'] : l('') ?>" title="<?= l('') ?>" class="txtbox clearonfocus"/>


            <select name="category_id" id="category_id" class="txtbox" data-bvalidator="required" onchange="url = '?ajax=subcategory-list&id=' + $(this).val(); $('#subcategory').load(url,function(result){$('#subcategory').val(<?= $_GET['sub_category_id'] ?>);});">
                <?= getCategoriesBox($_GET['category_id']) ?>
            </select>


            <select name="sub_category_id" id="subcategory" class="txtbox" data-bvalidator="required">
                <option value="" ><?= l('Please Chose sub-category') ?></option>
            </select>

            <select name="item_type" id="" class="txtbox">

                <option value=""><?= l('All types') ?></option>
                <option value="for sale" <?= ($_GET['item_type'] == 'for sale') ? 'SELECTED' : '' ?> ><?= l('For Sale') ?></option>
                <option value="for rent" <?= ($_GET['item_type'] == 'for rent') ? 'SELECTED' : '' ?> ><?= l('For rent') ?></option>
                <option value="needed for sale" <?= ($_GET['item_type'] == 'needed for sale') ? 'SELECTED' : '' ?> ><?= l('Wanted for purchase') ?></option>
                <option value="needed for rent" <?= ($_GET['item_type'] == 'needed for rent') ? 'SELECTED' : '' ?> ><?= l('Wanted for rent') ?></option>
                <option value="needed job" <?= ($_GET['item_type'] == 'needed job') ? 'SELECTED' : 'needed job' ?> ><?= l('Needed job') ?></option>
                <option value="vacant job" <?= ($_GET['item_type'] == 'vacant job') ? 'SELECTED' : '' ?> ><?= l('Vacant job') ?></option>
            </select>


            <select id="country_code" class="txtbox" data-bvalidator="required" name="country_code" onchange="url = '?ajax=cities-list&id=' + $(this).val(); $('#city_id').load(url,function(result){$('#city_id').val(<?= $_GET['city_id'] ?>);$('#city_id').trigger ('change'); });">

                <?= getCountriesBox($_GET['country_code']) ?>
            </select>


            <select id="city_id" class="txtbox" data-bvalidator="required" name="city_id" onchange="url = '?ajax=area-list&id=' + $(this).val(); $('#area_id').load(url,function(result){$('#area_id').val(<?= $_GET['area_id'] ?>);});">
                <option value=""><?= l('please chose city') ?></option>

            </select>



            <select id="area_id" class="txtbox" data-bvalidator="required" name="area_id">
                <option value=""><?= l('please chose area') ?></option>

            </select>


            <div class="price">
                <label for="pricefrom"><?= l('Price from') ?>:</label>
                <input type="text" id="pricefrom" name="pricefrom" value="<?= ($_GET['pricefrom']) ? $_GET['pricefrom'] : '' ?>" class="txtbox clearonfocus" title="<?= ('price from') ?>"/>
                <label for="priceto"><?= l('Price to:') ?></label>
                <input type="text" id="priceto" name="priceto" value="<?= ($_GET['priceto']) ? $_GET['priceto'] : '' ?>" class="txtbox clearonfocus" title="<?= ('price to') ?>"/>
            </div>


            <select id="shipping_type" name="shipping_type" class="txtbox">
                <option value=""><?= l('shipping type') ?></option>
                <option value="paid" <?= ($_GET['shipping_type'] == 'paid') ? 'SELECTED' : '' ?>><?= l('Paid') ?></option>
                <option value="owner" <?= ($_GET['shipping_type'] == 'owner') ? 'SELECTED' : '' ?>><?= l('Owner') ?></option>
            </select>

            <div class="clear"></div>

            <input type="submit" value="<?= l('SEARCH') ?>" class="search"/>
        </form>
    </div> <!-- searhbar -->
  <?php if ($ads['img1']) { ?>
    <div class="searchbar">
      
            <a href="<?= $ads['url1'] ?>" target="_blank">
                <img src="<?=thumb('uploads/ads/'. $ads['img1'],250,100)?>" width="250" height="100"/>
            </a>
      
    </div>
  <?php } ?>
    <?php if ($ads['img2']) { ?>
        <div class="searchbar">

            <a href="<?= $ads['url2'] ?>" target="_blank">
                <img src="<?=thumb('uploads/ads/'. $ads['img2'],250,100)?>" width="250" height="100"/>
            </a>

        </div>
    <?php } ?>

    <?php if ($ads['img3']) { ?>
        <div class="searchbar">

            <a href="<?= $ads['url3'] ?>" target="_blank">
                <img src="<?=thumb('uploads/ads/'. $ads['img3'],250,100)?>" width="250" height="100"/>
            </a>

        </div>
    <?php } ?>


</div><!-- left -->


<div class="itemsholder">



    <?php
    if ($items) {
        $x = 0;
        foreach ($items as $item) {
            $x++;
            include 'views/items/one-item.php';
            if ($x % 2 == 0) {
                echo "<div class='clear'></div>";
            }
        }
        ?>
        <?= mypaging($pages_count, $page_no, 'href="?' . extractUrl($_GET) . '&page-no={page}" class="{active}"') ?>


    <?php } else { ?>
        There are no items
    <?php } ?>

</div><!-- itemsholder -->


<script>
    $(document).ready(function(){
        $('#category_id').trigger ('change');
        $('#country_code').trigger ('change');

    });
</script>

