<div class="cartholder">

	<h1>Manage Sub Categories:</h1>
        <a href="?con=admin&ajax=subcategoryform" class="fancybox">Add Sub Category</a>
        <?php if($subcategories){ ?>
	<table cellspacing="3" cellpadding="3" width="980px">
		<tr>
			<th>ID</th>
			<th>ENGLISH TITLE</th>
			<th>ARABIC TITLE</th>
			<th>MAin Category</th>
			
			<th>Action</th>
		</tr>
                <?php foreach ($subcategories as $cat) { ?>
		<tr>
			<td><?=$cat['id']?></td>
			<td><?=$cat['title_en']?></td>
			<td><?=$cat['title_ar']?></td>
			<td><?=$cat['main_category']?></td>
			<td><a href="?con=admin&ajax=subcategoryform&code=<?=$cat['id']?>" class="fancybox">Edit</a> | <a href="?con=admin&action=deletesubcategory&code=<?=$cat['id']?>" onclick="var x= confirm ('Are you sure');if(!x)return false;">Delete</a></td>
			
			</tr>
                <?php } ?>
		
	</table>
    <?= mypaging ($pages_count, $page_no, 'href="?'.extractUrl($_GET).'&page-no={page}" class="{active}"') ?>

        <?php } ?>
	<div class="clear"></div>


</div>