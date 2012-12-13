<div class="cartholder">

	<h1>Manage cities:</h1>
        <a href="?con=admin&ajax=cityform" class="fancybox">Add City</a>
        <?php if($cities){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>ID</th>
			<th>ENGLISH TITLE</th>
			<th>ARABIC TITLE</th>
			<th>Country Code</th>
			<th>Action</th>
		</tr>
                <?php foreach ($cities as $city) { ?>
		<tr>
			<td><?=$city['id']?></td>
			<td><?=$city['title_en']?></td>
			<td><?=$city['title_ar']?></td>
			<td><?=$city['country']?></td>
			<td><a href="?con=admin&ajax=cityform&code=<?=$city['id']?>" class="fancybox">Edit</a> | <a href="?con=admin&action=deletecity&code=<?=$city['id']?>" onclick="var x= confirm ('Are you sure');if(!x)return false;">Delete</a></td>
			
			</tr>
                <?php } ?>
		
	</table>
    <?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

        <?php } ?>
	<div class="clear"></div>


</div>