<div class="cartholder">

    <?php if($drop_requests){ ?>
	<h1><?=(!$type)? l('Buying') : l('Selling') ?> <?= l('drop requests:')?></h1>

	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th><?= l('ID')?></th>
			
			<th><?= l('DATE')?></th>
			<th><?=($type)? l('BUYER NAME') : l('SELLER NAME') ?></th>
			<th><?=($type)? l('BUYER EMAIL') : l('SELLER EMAIL') ?></th>
			<th><?= l('ITEM')?></th>
			<th><?= l('DROPPED PRICE')?></th>
			<th><?=($type)? l('Actions'):l('Status')?></th>
		</tr>
                <?php foreach ($drop_requests as $drop){ ?>
		<tr>
			<td><?=$drop['id']?></td>
			<td><?=date('d M Y',$drop['datetime1'])?></td>
			<td><?=($type)? $drop['from_firstname'].','.$drop['from_lastname']: $drop['to_firstname'].','.$drop['to_lastname'] ?></td>
			<td><?=($type) ? $drop['from_email']:$drop['to_email'] ?></td>
			<td><a href="?con=items&page=item&id=<?=$drop['item_id']?>"><?=$drop['item_title']?></a></td>
			<td><?=$drop['dop_value']?></td>
			<td>
                            <?php
                            if(!$type){
                                if($drop['approved'] == 0)
                                    echo l('In Progress');
                                if($drop['approved'] == 1)
                                    echo l('approved');
                                if($drop['approved'] == 2)
                                    echo l('rejected');
                                
                            }else{
                                if($drop['approved'] == 0){
                                ?>
                            
                            <a href="?action=acceptrequest&id=<?=$drop['id']?>">Accept</a> |
                            <a href="?action=rejectrequest&id=<?=$drop['id']?>">Reject</a> |
                            <a href="?action=changeprice&id=<?=$drop['id']?>" class="fancybox">Change Price</a>
                            <?php
                            }else{
                                
                                echo l('Done !');
                            }}
                            
                            ?>
                            
                        </td>
		</tr>
                <?php } ?>
                
		




	</table>

	<div class="clear"></div>

	     	<?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

	<?php }else{ ?>
        <?= l('There are no drop requests')?>
        <?php } ?>

</div>