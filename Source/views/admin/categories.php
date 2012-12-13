<div class="cartholder">

	<h1>Manage Categories:</h1>
        <a href="?con=admin&ajax=categoryform" class="fancybox">Add Category</a>
        <?php if($categories){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>ID</th>
			<th>ENGLISH TITLE</th>
			<th>ARABIC TITLE</th>
			
			<th>Action</th>
		</tr>
                <?php foreach ($categories as $cat) { ?>
		<tr>
			<td><?=$cat['id']?></td>
			<td><?=$cat['title_en']?></td>
			<td><?=$cat['title_ar']?></td>
			<td><a href="?con=admin&ajax=categoryform&code=<?=$cat['id']?>" class="fancybox">Edit</a> | <a href="?con=admin&action=deletecategory&code=<?=$cat['id']?>" onclick="var x= confirm ('Are you sure');if(!x)return false;">Delete</a></td>
			
			</tr>
                <?php } ?>
		
	</table>
    <?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

        <?php } ?>
	<div class="clear"></div>


</div>