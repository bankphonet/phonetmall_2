<div class="cartholder">
	<h1><?=l('Inbox')?> :</h1>
	<?php if ($messages){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>From</th>
			<th>Subject</th>
			<th>Date</th>
			<th>In/Out</th>
		</tr>
		<?php foreach ($messages as $message){ ?>
		<?php 		//if(){?>
		<tr class="<?php if(!$message['read_flag'] && $message['sender_id']!=$_SESSION['phonetmall_id']) echo 'unread-message'?>">
			<td><?=$message['firstname'].' '.$message['lastname']?></td>
			<td><a href="?page=readmessage&id=<?=($message['parent_id']==0)?$message['message_id']:$message['parent_id']?>"><?=$message['subject']?></a></td>
			<td><?=$message['date']?></td>
			<td><?=($message['receiver_id']==$_SESSION['phonetmall_id'])? 'In' : 'Out'?></td>
		</tr>
		<?php 		//}?>
		<?php } ?>
	</table>
	<?php }else{  ?>
        There are no messages !
	<?php } ?>
	<div class="clear"></div>
</div>