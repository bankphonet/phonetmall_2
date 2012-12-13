<div class="pageheader rad5">
    <h1><?= ($id) ? l('EDIT ITEM') : l('CREATE NEW ITEM') ?>:</h1>
</div>

<div class="transfer rad5">


    <form id="additemf" action="?con=items&page=items-form&id=<?= $id ?>&user=<?= $user_id ?>" method="post" class="bvalidator" enctype="multipart/form-data">
        <label for="title"><?= l('Item name') ?>:</label>
        <input type="text" name="title" id="title" value="<?= $item['title'] ?>" class="txtbox" data-bvalidator="required"/>



        <label for="category"><?= l('Category') ?>:</label>

        <select name="category_id" id="category_id" class="txtbox" data-bvalidator="required" onchange="url = '?ajax=subcategory-list&id=' + $(this).val(); $('#subcategory').load(url,function(result){});">
            <option value="" ><?= l('Please Choose Category') ?></option>
            <?= generate_select_options($categories, 'title', 'id', $item['category_id']) ?>
        </select>
        <div id="subcategory_container">
            <label for="lastname"><?= l('Subcategory') ?>:</label>

            <div id="subcategory_clone" style="margin-top:5px;">
                <select name="sub_category_id" id="subcategory" class="txtbox" data-bvalidator="required">
                    <option value="" ><?= l('Please Choose sub-category') ?></option>
                    <?php
                    if ($id)
                        echo generate_select_options($subcategories, 'title', 'id', $item['sub_category_id']);
                    ?>
                </select>
            </div>               



        </div>

        <label for="mobile"><?= l('Description') ?>:</label>
        <textarea name="description" id="description" cols="30" rows="10" class="" data-bvalidator="required"><?= $item['description'] ?></textarea>


        <label for="country"><?= l('Country') ?></label>
        <select id="country_code" class="txtbox" data-bvalidator="required" name="country_code" onchange="url = '?ajax=cities-list&id=' + $(this).val(); $('#city_id').load(url,function(result){});">
            <option value=""><?= l('Please choose country') ?></option>
            <?= generate_select_options($countries, 'title', 'code', $item['country_code']) ?>
        </select>

        <label for="city"><?= l('City') ?></label>
        <select id="city_id" class="txtbox" data-bvalidator="required" name="city_id" onchange="url = '?ajax=area-list&id=' + $(this).val(); $('#area_id').load(url,function(result){});">
            <option value=""><?= l('Please choose city') ?></option>
            <?php
            if ($id)
                echo generate_select_options($cities, 'title', 'id', $item['city_id']);
            ?>
        </select>


        <label for="area"><?= l('Area') ?></label>
        <select id="area_id" class="txtbox" data-bvalidator="required" name="area_id">
            <option value=""><?= l('Please choose area') ?></option>
            <?php
            if ($id)
                echo generate_select_options($areas, 'title', 'id', $item['area_id']);
            ?>
        </select>


        <label for="tel1"><?= l('Telephone') ?>:</label>

        <div id="mailcontainer">
            <input type="text" id="tel1" name="seller_phone" value="<?= $item['seller_phone'] ?>" class="txtbox" data-bvalidator="required,number" />
        </div>

        <div id="for-sale">
        <label for="ship_type"><?= l('Shipping type') ?>:</label>


        <select name="shipping_type" id="ship_type" class="txtbox" onchange ="showShipping ($(this).val ());"  >
           
            <option value="paid" <?= ($item['shipping_type'] == 'paid') ? 'SELECTED' : '' ?>><?= l('Paid') ?></option>
            <option value="owner" <?= ($item['shipping_type'] == 'owner') ? 'SELECTED' : '' ?> onchange=""><?= l('Owner') ?></option>
        </select>


        <div id="shipping_fees" style="display: none;">
            <label for="shipping_fees"><?= l('Shipping Fees') ?>:</label>
            <input type="text" name="shipping_fees" id="shipping_fees" class="txtbox" value="<?= $item['shipping_fees'] ?>"/>
        </div>


		<div id="no-weight">
        <label id="weight1" for="weight"><?= l('Weight (Kilo gram)') ?>:</label>
        <div id="mailcontainer">
            <input type="text" id="weight" name="weight" value="<?= ($item['weight']) ? $item['weight'] : '1' ?>" class="txtbox"  data-bvalidator="required,number" />
        </div>
        </div>
        
        <label for="quantity"><?= l('Quantity') ?>:</label>

        <div id="mailcontainer">
            <input type="text" id="weight" name="quantity" value="<?= ($item['quantity']) ? $item['quantity'] : '1' ?>" class="txtbox"  data-bvalidator="required,number" />
        </div>
        
        <label for="price"><?= l('Price') ?>:</label>

        <div id="mailcontainer">
            <input type="text" id="tel3" name="price" value="<?= $item['price'] ?>" class="txtbox"  data-bvalidator="required,number" />
        </div>


        <label for="descount"><?= l('Discount') ?>:</label>

        <div id="mailcontainer">
            <input type="text" id="tel3" name="descount" value="<?= $item['descount'] ?>" class="txtbox"  />
        </div>
		</div>
		
        <div class="cod-container">
	        <input type="checkbox" id="cod" name="cod" value="<?= ($item['cod']) ? $item['cod'] : 0 ?>" class="chkbox" <?=($item['cod']) ? 'checked' : '' ?>/>
	        <label for="cod" class="codlbl"><?= l('Allow cash on delivery') ?>.</label>
		</div>
		<div class="cod-container">
	        <input type="checkbox" id="coupon" name="coupon" value="<?= ($item['coupon'])? $item['coupon'] : 0 ?>" <?=($item['cod']!=1? 'disabled':'')?> class="chkbox" <?=($item['coupon']) ? 'checked' : '' ?>/>
	        <label for="coupon" class="codlbl"><?= l('Allow coupons') ?>.</label>
		</div>
		
        <label for="descount"><?= l('type') ?>:</label>
        <select name="item_type" id="item-type" class="txtbox">
            <option value="for sale" <?= ($item['item_type'] == 'for sale') ? 'SELECTED' : '' ?> ><?= l('For Sale') ?></option>
            <option value="for rent" <?= ($item['item_type'] == 'for rent') ? 'SELECTED' : '' ?> ><?= l('For rent') ?></option>
            <option value="needed for sale" <?= ($item['item_type'] == 'needed for sale') ? 'SELECTED' : '' ?> ><?= l('Needed for sale') ?></option>
            <option value="needed for rent" <?= ($item['item_type'] == 'needed for rent') ? 'SELECTED' : '' ?> ><?= l('Needed for rent') ?></option>
            <option value="needed job" <?= ($item['item_type'] == 'needed job') ? 'SELECTED' : 'needed job' ?> ><?= l('Needed job') ?></option>
            <option value="vacant job" <?= ($item['item_type'] == 'vacant job') ? 'SELECTED' : '' ?> ><?= l('Vacant job') ?></option>
        </select>

        <label for="cover_photo"><?= l('images') ?>:</label>

        <input type="file" name="image[]" class="txtbox" style="margin-bottom:5px;">
        <input type="file" name="image[]" class="txtbox" style="margin-bottom:5px;">
        <input type="file" name="image[]" class="txtbox" style="margin-bottom:5px;">
        <input type="file" name="image[]" class="txtbox" style="margin-bottom:5px;">


        <?php if ($_GET['store_id'] || $item['store_id']) { ?>
            <input type="hidden" name="store_id" value ="<?= ($_GET['store_id']) ? $_GET['store_id'] : $item['store_id'] ?>" />
        <?php } ?>

        <div class="clear"></div>


        <input type="submit" id="send" value="<?= ($id) ? l('EDIT ITEM') : l('ADD ITEM') ?>" class="registerbtn"/>
    </form>


</div>




<script type="text/javascript">
    function showShipping (type){
        if(type == 'owner'){
            //Show Shipping fees here
            $('#shipping_fees').slideDown ('slow');
            $('#country_code,#city_id,#area_id').attr ('data-bvalidator','');
           
        }else{
            //Hide shipping fees
            $('#shipping_fees').slideUp ('slow');
            $('#country_code,#city_id,#area_id').attr ('data-bvalidator','required');
        }
    }

    $('#ship_type').trigger('change');

</script>
		<script>
		  $("#ship_type").change(function(){
	            if($(this).val()=="owner"){
					$("#no-weight").hide();
	                }else{
	    				$("#no-weight").show();
	                    }
	        });
		  </script>	
		  <script>
		  $("#item-type").change(function(){
	            if($(this).val()=="for sale"){
					$("#for-sale").show();
					
	                }else{
	    				$("#for-sale").hide();
	    				
	                    }
	        });
		  </script>	
		  
		  
		          