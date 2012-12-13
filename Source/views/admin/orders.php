<div class="cartholder">

	<h1>Manage orders:</h1>
        
        <form action="?con=admin" method="get">
            Email Or Mobile :
            <input type="hidden" name="con" value="admin" />
            <input type="text" name="email" id="" value="<?=$_GET['email']?>" />
            <select name="type">
                <option value="buyer" <?=($_GET['type'] == 'buyer')? 'SELECTED' : '' ?>>Buyer</option>
                <option value="seller" <?=($_GET['type'] == 'seller')? 'SELECTED' : '' ?>>Seller</option>
            </select>
            <input type="submit" value="FILTER" />
            <input type="button"  onclick="location.href='<?=BASE_URL?>?con=admin';" value="CLEAR FILTER" />
        </form><br/>
        
        <?php if($orders){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>OID</th>
			<th>TRNSACTION ID</th>
			<th>DATE</th>
			<th>BUYER</th>
			<th>SELLLER</th>
			<th>AMOUNT</th>
			<th>Details</th>
		</tr>

                <?php foreach ($orders as $order){ ?>
		<tr>
			<td><a href="?page=orderdetails&id=<?=$order['id']?>"><?=$order['id']?></a></td>
			<td><?=$order['tid']?></td>
			<td><?=date ('d M Y',$order['datetime1'])?></td>
			<td><a href="#"><?=$order['from_email']?></a></td>
			<td><a href="#"><?=$order['to_email']?></a></td>
			<td><?=$order['amount']?></td>
			<td><a href="?page=orderdetails&id=<?=$order['id']?>">Order details </a></td>
		</tr>
                <?php } ?>
                
		
                
		




	</table>
            			<?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

        <?php }else{ ?>
        There are no orders
        <?php } ?>
        
	<div class="clear"></div>


</div>