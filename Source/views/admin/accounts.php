<div class="cartholder">

	<h1>Manage Accounts:</h1>

        <?php if ($accounts){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>ID</th>
			<th>First name</th>
			<th>Last name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Actions</th>
		</tr>

                
                <?php foreach ($accounts as $account){ ?>
		<tr>
			<td><?=$account['id']?></td>
			<td><?=$account['firstname']?></td>
			<td><?=$account['lastname']?></td>
			<td><?=$account['email']?></td>
			<td><?=$account['mobile']?></td>
			<td><a href="?con=items&page=items-form&user=<?=$account['id']?>">ADD ITEM</a> - <a href="?con=stores&page=store-form&user=<?=$account['id']?>">OPEN STORE</a></td>
		</tr>
                <?php } ?>
                
		
                
		




	</table>
<?php }else{  ?>
        
        There are no accounts !
        <?php } ?>
	<div class="clear"></div>


</div>