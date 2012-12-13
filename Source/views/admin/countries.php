<div class="cartholder">

	<h1>Manage Items:</h1>
        <a href="?con=admin&ajax=countryform" class="fancybox">Add Country</a>
        <?php if($countries){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>ID</th>
			<th>ENGLISH TITLE</th>
			<th>ARABIC TITLE</th>
			<th>Action</th>
		</tr>
                <?php foreach ($countries as $country) { ?>
		<tr>
			<td><?=$country['code']?></td>
			<td><?=$country['title_en']?></td>
			<td><?=$country['title_ar']?></td>
			<td><a href="?con=admin&ajax=countryform&code=<?=$country['code']?>" class="fancybox">Edit</a> | <a href="?con=admin&action=deletecountry&code=<?=$country['code']?>" onclick="var x= confirm ('Are you sure');if(!x)return false;">Delete</a></td>
			
			</tr>
                <?php } ?>
		
	</table>
    <?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

        <?php } ?>
	<div class="clear"></div>


</div>