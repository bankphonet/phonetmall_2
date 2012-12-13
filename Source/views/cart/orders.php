<div class="cartholder">

    <?php if($orders){ ?>
	<h1><?= l( (!$type)? 'Buying orders:' : 'Selling orders:' )?></h1>

        <form action="" method="GET">
            <input type="hidden" name="page" value="orders" />
            <?php if($type){ ?>
            <input type="hidden" name="type" value="<?=$type?>" /><?php } ?>
            <input type="text" value="<?=($_GET['keyword']) ? $_GET['keyword'] : l('id/name/email/key/mobile/tid')?>" name="keyword" title="<?=l('id/name/email/key/mobile/tid')?>" class="txtbox clearonfocus" />
            <input type="submit" value="SEARCH" class="btnsearch" />
        </form>
        
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th><?= l('OID')?></th>
			<th><?= l('TRNSACTION ID')?></th>
			<th><?= l('DATE')?></th>
			<th><?=($type)? l('BUYER NAME') : l('SELLER NAME') ?></th>
			<th><?=($type)? l('BUYER EMAIL') : l('SELLER EMAIL') ?></th>
			<th><?= l('AMOUNT')?></th>
			<th><?= l('Details')?></th>
		</tr>
                <?php foreach ($orders as $order){ ?>
		<tr>
			<td><a href="?page=orderdetails&id=<?=$order['id']?>"><?=$order['id']?></a></td>
			<td><?=($order['cod'])? 'C.O.D' : $order['tid']?></td>
			<td><?=date('d M Y',$order['datetime1'])?></td>
			<td><?=($type)? $order['from_firstname'].','.$order['from_lastname']: $order['to_firstname'].','.$order['to_lastname'] ?></td>
			<td><?=($type) ? $order['from_email']:$order['to_email'] ?></td>
			<td><?=$order['amount']?></td>
			<td><a href="?page=orderdetails&id=<?=$order['id']?>"><?= l('Order details')?> </a></td>
		</tr>
                <?php } ?>
                
		




	</table>

	<div class="clear"></div>

	     	<?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

	<?php }else{ ?>
        <?= l('There are no orders')?>
        <?php } ?>

</div>