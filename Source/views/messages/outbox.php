<div class="cartholder">
	<h1><a href="?page=inbox" class="<?= ($page == 'outbox') ? 'current' : ''; ?>"><?=l('Inbox')?></a> / Outbox</h1>
	<?php if ($messages){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>To</th>
			<th>Subject</th>
			<th>Actions</th>
		</tr>
		<?php foreach ($messages as $message){ ?>
		<tr>
			<td><?=$message['firstname'].' '.$message['lastname']?></td>
			<td><?=$message['subject']?></td>
			<td><a href="?con=items&page=items-form&user=<?=$message['id']?>">Read</a> - <a href="?con=stores&page=store-form&user=<?=$message['id']?>">Reply</a></td>
		</tr>
		<?php } ?>
	</table>
	<?php }else{  ?>
        There are no messages !
	<?php } ?>
	<div class="clear"></div>
</div>