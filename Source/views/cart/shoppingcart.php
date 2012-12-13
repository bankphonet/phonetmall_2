<div class="cartholder">

    <h1><?= l('Shopping cart:')?></h1>
    <form action="?page=createorder" method="post" class="bvalidator">
        <?php if ($items) { ?>
            <div class="shippinginfo">

                <h2><?= l('Shipping information:')?></h2>

                <label><?= l('Country')?> :</label>
                <select id="country_code" class="txtbox" data-bvalidator="required" name="country_code" onchange="url = '?ajax=cities-list&id=' + $(this).val(); $('#city_id').load(url,function(result){$('#city_id').val(<?= $_GET['city_id'] ?>);$('#city_id').trigger ('change'); });">
                    <option value=""><?= l('please chose country') ?></option>           
                    <?= $countries ?>
                </select>
                <br class="clear" />

                <label><?= l('City')?> :</label>
                <select id="city_id" class="txtbox" data-bvalidator="required" name="city_id" onchange="if($('#city_id').val ())location.href = '?page=my-cart&country='+$('#country_code').val ()+ '&city_id='+$('#city_id').val ()">
                    <option value=""><?= l('please chose city') ?></option>
                    <?php if ($city_id) echo $cities; ?>
                </select>
                <br class="clear" />

                <label for="name"><?= l('Name') ?>:</label>
                <input type="text" id="name" name="shipping_name" value="" class="txtbox" data-bvalidator="required"/>
                <div class="clear"></div>

                <label for="mobile"><?= l('Mobile') ?>:</label>
                <input type="text" id="mobile" name="shipping_mobile" value="" class="txtbox" data-bvalidator="required"/>
                <div class="clear"></div>

                <label for="address"><?= l('address') ?>:</label>
                <textarea id="address" name="shipping_address" cols="30" rows="10" class="txtbox address" data-bvalidator="required"></textarea>
                <div class="clear"></div>


            </div>
        
            <div class="clear"></div>
            <table cellspacing="3" cellpadding="3" width="980px">
                <tr>
                    <th><?= l('PID')?></th>
                    <th><?= l('PRODUCT')?></th>
                    <th><?= l('QTY.')?></th>
                    <th><?= l('U. PRICE')?></th>
                    <th><?= l('SHIPPING')?></th>
                    <th><?= l('TOTAL')?></th>
                    <th><?= l('REMOVE')?></th>
                </tr>
                <?php
                $total_price = 0;
                $shipping_paied = "";
                $cod_flag = 1;
                foreach ($items as $item) {
                    ?>
                    <tr>
                    <input type="hidden" name="itemid[]" value="<?= $item['id'] ?>" />
                    <input type="hidden" name="account_id" value="<?= $item['account_id'] ?>" />
                    <td><a href="?con=items&page=item&id=<?= $item['id'] ?>"><?= $item['id'] ?></a></td>
                    <td><a href="?con=items&page=item&id=<?= $item['id'] ?>"><?= $item['title'] ?></a></td>
                    <td>
                        <select id="qty" name="quantity[]" onchange="var myval=$(this).val();location.href='?action=update-cart&country=<?=$_GET['country']?>&city_id=<?=$_GET['city_id']?>&itemid=<?= $item['id'] ?>&qty='+myval;">
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <option value="<?= $i ?>" <?= ($i == $item['qty'] ? 'SELECTED' : '' ) ?>><?= $i ?></option>
        <?php } ?>
                        </select>
                    </td>
                    <td><?php
        $item_price_final = 0;
        if ($item['shipping_type'] == 'owner'){
            $item_price_final = $item['shipping_fees']*$item['qty'];
        }
        
            echo $item['price'];
        ?></td>


                    <td><?php
        
        if ($item['shipping_type'] == 'owner')
            echo  $item['shipping_fees'];
        else{
            echo $shp = getShipping ($item['weight'], $item['first_kilo'], $item['extra_kilo'], $item['qty']);
            $shipping_paied = $shipping_paied + $shp;
            $item_price_final = $shp;
             
        }
           
        ?>
                    </td>


                    <td><strong><?php
        echo $itmp = ($item['price'] * $item['qty']) + $item_price_final;
        $total_price = $total_price + $itmp
        ?></strong> </td>
                    <td><a href="?action=remove-from-cart&id=<?= $item['id'] ?>"><?= l('Remove')?></a> </td>
                    </tr>
        <?php if($item['cod']==0) $cod_flag = 0;?>
    <?php } ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= l('TOTAL')?></td>
                    <td><strong><?= $total_price ?></strong> 
                        <input type="hidden" value="<?=$total_price?>" name="total_price"/> 
                        <input type="hidden" value="<?=$shipping_paied?>" name="shipping"/>
                    </td>
                </tr>








            </table>

            <div class="clear"></div>


            <div class="actions">

                <input type="submit" name="payviabankphonet" value="<?= l('PAY VIA BANKPHONET.COM')?>" class="pvbbtn" />
                <?php if($cod_flag == 1){?>
                <input type="submit" name="cod" value="<?= l('CASH ON DELIVERY')?>" class="codbtn" />
                <?php }?>

            </div>
        </form>
    <?php }else { ?>
        <?= l('There are no items in your cart')?>
<?php } ?>
</div>