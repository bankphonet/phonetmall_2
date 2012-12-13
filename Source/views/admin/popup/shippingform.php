<div class="cartholder">

    <h1>Manage shipping-cost </h1>
    <form action="?con=admin&ajax=shipping-form&id=<?= $id ?>" method="post" class="bvalidator">
        <label>From Country :</label> 
        <select id="country_code" class="txtbox" data-bvalidator="required" name="" onchange="url = '?con=admin&ajax=cities-list&id=' + $(this).val(); $('#city_id').load(url,function(result){$('#city_id').val(<?= $_GET['city_id'] ?>);$('#city_id').trigger ('change'); });">
            <option value=""><?= l('please chose country') ?></option>           
            <?= $countries ?>
        </select>
        <br class="clear" />

        <label>From City :</label>
        <select id="city_id" class="txtbox" data-bvalidator="required" name="from_city" >
            <option value=""><?= l('please chose city') ?></option>
<?php if($id)echo $cities; ?>
        </select>
        <br class="clear" />


        <label>To Country :</label> 
        <select id="country_code2" class="txtbox" data-bvalidator="required" name="" onchange="url = '?con=admin&ajax=cities-list&id=' + $(this).val(); $('#city_id2').load(url,function(result){$('#city_id2').val(<?= $_GET['city_id'] ?>);$('#city_id2').trigger ('change'); });">
            <option value=""><?= l('please chose country') ?></option>           
            <?= $countries2 ?>
        </select>
        <br class="clear" />

        <label>To City :</label>
        <select id="city_id2" class="txtbox" data-bvalidator="required" name="to_city" >
            <option value=""><?= l('please chose city') ?></option>
            <?php if($id)echo $cities2; ?>

        </select>


        <br class="clear" />

        <label>First Kilo :</label> 
        <input type="text" class ="txtbox" name="first_kilo" value="<?= $cost['first_kilo'] ?>" id="" class="txtbox"  data-bvalidator="required"/>
        <br class="clear" />

        <label>Extra Kilos :</label> 
        <input type="text" name="extra_kilo" value="<?= $cost['extra_kilo'] ?>" id="" class="txtbox"  data-bvalidator="required"/>
        <br class="clear" />

        <input type="submit" value="SAVE" />
    </form>
</div>
