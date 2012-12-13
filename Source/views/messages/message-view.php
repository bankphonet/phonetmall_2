<div class="transfer rad5" style="width:750px">
	<h1><a href="?page=inbox" class="<?= ($page == 'outbox') ? 'current' : ''; ?>">Return to Inbox</a></h1>
	<!-- <div class="message-container">
		<div class="subject"><span class=""><?=$message['subject']?></span></div>
		<div class="sender"><label class="inline">From: </label><span class=""><?=$message['firstname'].' '.$message['lastname']?></span></div>
		<div class="date"><label class="inline">Date: </label><span class=""><?=$message['date']?></span></div>
		<div class="type"><span class=""><a href="?con=<?=$message['type_name']?>s&page=<?=$message['type_name']?>&id=<?=$message["{$message['type_name']}_id"]?>"><?=$message["{$message['type_name']}_title"]?></a></span></div>
		<div class="body"><span class=""><?=$message['message']?></span></div>
	</div> -->
	<div style="margin-bottom: 10px;"><div class="type"><span class=""><a href="?con=<?=$message['type_name']?>s&page=<?=$message['type_name']?>&id=<?=$message["{$message['type_name']}_id"]?>"><?=$message["{$message['type_name']}_title"]?></a></span></div></div>
	
	<div class="replies-container transfer rad5">
		<?php if($replies){?>
			<div class="reply">
				<div><span class="reply-title"><?//=$reply['subject']?></span></div>
				<div><label class="inline">Date: </label><span class="message-info"><?=$message['date']?></span></div>
				<div><span class="message-info"><?=$message['firstname'].' '.$message['lastname']?>: </span><span class="reply-body"><?=$message['message']?></span></div>
				<div><span class="reply-body"><?//=$reply['message']?></span></div>
			</div>
			<?php foreach ($replies as $reply){?>
			<div class="reply">
				<div><span class="reply-title"><?//=$reply['subject']?></span></div>
				<div><label class="inline">Date: </label><span class="message-info"><?=$reply['date']?></span></div>
				<div><span class="message-info"><?=$reply['firstname'].' '.$reply['lastname']?>: </span><span class="reply-body"><?=$reply['message']?></span></div>
				<div><span class="reply-body"><?//=$reply['message']?></span></div>
			</div>
			<?php }?>
		<?php } else echo "No replies yet";?>
	</div>
	<div class="message-reply">
		<form method="post" action="" class="bvalidator">
			<input type="hidden" name="parent_id" value="<?=$message['message_id']?>">
			<input type="hidden" name="subject" value="Re: <?=$message['subject']?>">
			<input type="hidden" name="type" value="<?=$message['type_name']?>">
			<input type="hidden" name="id" value="<?=$message['item_store_id']?>">
			<input type="hidden" name="page" value="sendreply">
			<label>Reply: </label><textarea name="message" rows="10" cols="70" data-bvalidator="required"></textarea>
			<input type="submit" value="Reply" class="registerbtn" style="float: none;">
		</form>
	</div>
	<div class="clear"></div>
</div>