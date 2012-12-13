<div class="cartholder">

	<h1>Manage Areas:</h1>
        <a href="?con=admin&ajax=areaform" class="fancybox">Add Area</a>
        <?php if($areas){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>ID</th>
			<th>ENGLISH TITLE</th>
			<th>ARABIC TITLE</th>
			<th>City id</th>
			<th>Action</th>
		</tr>
                <?php foreach ($areas as $area) { ?>
		<tr>
			<td><?=$area['id']?></td>
			<td><?=$area['title_en']?></td>
			<td><?=$area['title_ar']?></td>
			<td><?=$area['city_id']?></td>
			<td><a href="?con=admin&ajax=areaform&code=<?=$area['id']?>" class="fancybox">Edit</a> | <a href="?con=admin&action=deletearea&code=<?=$area['id']?>" onclick="var x= confirm ('Are you sure');if(!x)return false;">Delete</a></td>
			
			</tr>
                <?php } ?>
		
	</table>
    <?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

        <?php } ?>
	<div class="clear"></div>


</div>