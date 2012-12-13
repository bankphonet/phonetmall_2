<div class="cartholder">

	<h1>Manage Categories:</h1>
        <a href="?con=admin&ajax=shipping-form" class="fancybox">Add Cost</a>
        <?php if($all_cost){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>ID</th>
			<th>FROM</th>
			<th>TO</th>
			
			<th>1st KILO</th>
			<th>Extra</th>
			<th>Action</th>
		</tr>
                <?php foreach ($all_cost as $cat) { ?>
		<tr>
			<td><?=$cat['id']?></td>
			<td><?=$cat['from_country'].' , ' .$cat['from_city']?></td>
			<td><?=$cat['to_country'].' , ' .$cat['to_city']?></td>
			<td><?=$cat['first_kilo']?></td>
			<td><?=$cat['extra_kilo']?></td>
			<td><a href="?con=admin&ajax=shipping-form&id=<?=$cat['id']?>" class="fancybox">Edit</a> | <a href="?con=admin&action=deletecost&code=<?=$cat['id']?>" onclick="var x= confirm ('Are you sure');if(!x)return false;">Delete</a></td>
			
			</tr>
                <?php } ?>
		
	</table>
    <?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

        <?php } ?>
	<div class="clear"></div>


</div>