<div class="left">


	<a href="?con=stores&page=store-form" class="addnew"> <span class="add-icon"></span><?= l('OPEN NEW STORE')?></a>

	<div class="searchbar">
	<h2><?= l('Search for stores')?></h2>
         <form action="" method="get">
         <input type="hidden" name="con" value="stores" />
         <input type="hidden" name="search_flag" value="1" />
	<input type="text" id="keyword" name="keyword" value="<?=($_GET['keyword']) ? $_GET['keyword'] : l('keyword')?>" title="keyword" class="txtbox clearonfocus"/>


	<select name="category_id" id="category_id" class="txtbox" data-bvalidator="required" onchange="url = '?ajax=subcategory-list&id=' + $(this).val(); $('#subcategory').load(url,function(result){$('#subcategory').val(<?=$_GET['sub_category_id']?>);});">
            <option value="" ><?= l('Please Choose Category') ?></option>
            <?= generate_select_options($categories, 'title', 'id', (($_GET['category_id']) ? $_GET['category_id'] : ''))  ?>
        </select>


	 <select name="sub_category_id" id="subcategory" class="txtbox" data-bvalidator="required">
                    <option value="" ><?= l('Please Choose sub-category') ?></option>
          </select>



	<select id="country_code" class="txtbox" data-bvalidator="required" name="country_code" onchange="url = '?ajax=cities-list&id=' + $(this).val(); $('#city_id').load(url,function(result){$('#city_id').val(<?=$_GET['city_id']?>);$('#city_id').trigger ('change'); });">
            <option value=""><?= l('please choose country') ?></option>
                <?= generate_select_options($countries, 'title', 'code', $_GET['country_code']) ?>
        </select>


	<select id="city_id" class="txtbox" data-bvalidator="required" name="city_id" onchange="url = '?ajax=area-list&id=' + $(this).val(); $('#area_id').load(url,function(result){$('#area_id').val(<?=$_GET['area_id']?>);});">
            <option value=""><?= l('please choose city') ?></option>
           
        </select>


	 
        <select id="area_id" class="txtbox" data-bvalidator="required" name="area_id">
            <option value=""><?= l('please choose area') ?></option>
           
        </select>

	


	<div class="clear"></div>

	<input type="submit" value="<?= l('SEARCH')?>" class="search"/>
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



	<?php if($stores){$x=0;foreach($stores as $store) {
     $x++;
            include 'views/stores/one-store.php';
            if( $x%2 == 0){
             echo "<div class='clear'></div>";}
            } ?>
    
    			<?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

    <?php }else{ ?>
There are no stores
<?php } ?>
</div><!-- itemsholder -->

<script>
    $(document).ready(function(){
       $('#category_id').trigger ('change'); 
       $('#country_code').trigger ('change'); 
       
       
       
    });
    </script>