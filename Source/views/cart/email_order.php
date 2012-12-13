Dear <?=$order['from_firstname']?>

This is your order information at phonetmall.com
<?php if($order['items']){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th><?= l('SN')?></th>
			<th><?= l('PRODUCT')?></th>
			<th><?= l('ADDRESS')?></th>
			<th><?= l('SHIPPING')?></th>
			<th><?= l('QTY.')?></th>
			<th><?= l('U. PRICE')?></th>
			<th><?= l('SH.PRICE')?></th>
			<th><?= l('TOTAL')?></th>
		</tr>
                <?php $sn = 1;foreach ($order['items'] as $item){ ?>
		<tr>
			<td><?=$sn?></td>
			<td><a href="<?=BASE_URL?>?con=items&page=item&id=<?=$item['item_id']?>"><?=$item['item_title']?></a></td>
			<td><?=$item['country'].'-'.$item['city']?></td>
			<td><?=$item['shipping_type']?></td>
			<td><?=$item['quantity']?></td>
			<td><?=$item['item_price']?></td>
			<td><?=$item['shipping_price']?></td>
			<td><strong><?=($item['item_price'] * $item['quantity']) + $item['shipping_price'] ?></strong> </td>
		</tr>
                   <?php $sn ++ ;} ?>
	</table>
<?php } ?>

Phonetmall.com