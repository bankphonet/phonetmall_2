<div class="cartholder">

	<h1>Manage Items:</h1>
        <?php if($items){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>ID</th>
			<th>ITEM NAME</th>
			<th>CATEGORY</th>
			<th>SUB CATEGORY</th>
			<th>SELLER</th>
			<th>PRICE</th>
			<th>Action</th>
		</tr>
                <?php foreach ($items as $item) { ?>
		<tr>
			<td><a href="?con=items&page=item&id=<?=$item['id']?>"><?=$item['id']?></a></td>
			<td><a href="?con=items&page=item&id=<?=$item['id']?>"><?=$item['title']?></a></td>
			<td><?=$item['cat_title']?></td>
			<td>SUB CATEGORY</td>
			<td><a href="#"><?=$item['email']?></a></td>
			<td>255.00</td>
			<td><a href="?con=items&page=items-form&id=<?=$item['id']?>&user=<?=$item['account_id']?>">EDIT</a>
                           
                            - <a href="?con=items&action=del-item&id=<?=$item['id']?>&user=<?=$item['account_id']?>&ref=admin">DELETE</a>
                                <?php if($item['promoted'] == 0){ ?>
                            - <a href="?con=admin&action=promote&id=<?=$item['id']?>&p=1">PROMOTE</a>
                                <?php }else{  ?>
                          - <a href="?con=admin&action=promote&id=<?=$item['id']?>&p=0">UN-PROMOTE</a>
            
                            <?php } ?>
                        </td>
		</tr>
                <?php } ?>
		
	</table>
                 <?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

        <?php } ?>
	<div class="clear"></div>


</div>