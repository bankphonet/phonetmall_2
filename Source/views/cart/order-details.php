<div class="cartholder">

	<h1>ORDER #<?=$order['id']?></h1>

	<p class="oinfo"><span><?= l('Date:')?></span><?=date('d M Y - H:i',$order['datetime1'])?> </p>
	<p class="oinfo"><span><?= l('Status')?></span> <strong><?=($order['paied'] == 0) ? l('NOT PAID') : l('PAID') ?><?=($order['cod'] == 1) ? ' ('.l('CASH ON DELIVERY').')' : ''?></strong></p>
	

	<div class="infobox rad5">
		<h2><?= l('Client information:')?></h2>
		<p><?=$order['from_title'].','.$order['from_firstname'].' '.$order['from_lastname']?></p>
		<p>#: <?=$order['from_mobile']?></p>
		<p><?=$order['from_email']?></p>
		<p><?=$order['country'] .'-'.$order['city']?></p>
	</div>

	<div class="infobox rad5">
		<h2><?= l('Shipping information:')?></h2>
		<p><?=$order['shipping_name']?></p>
		<p>#: <?=$order['shipping_mobile']?></p>
		<p>address: <?=$order['shipping_address']?></p>
	</div>

	<div class="infobox rad5">
		<h2><?= l('Seller information:')?></h2>
		<p><?=$order['to_title'].','.$order['to_firstname'].' '.$order['to_lastname']?></p>
		<p>#: <?=$order['to_mobile']?></p>
		<p><?=$order['to_email']?></p>
		<p><?=$order['country_buyer']?></p>
	</div>


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
			<td><a href="?con=items&page=item&id=<?=$item['item_id']?>"><?=$item['item_title']?></a>
                        <br/>
                        <?php
                        if($item['records'])
                        	if($item['coupon'])
	                        	foreach($item['records'] as $rec){
	                            	echo $rec['rec1'].' --- ' .$rec['rec2'].'<br/>';
	                        	}
                        ?>
                        </td>
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
	<div class="clear"></div>

	
	

</div>