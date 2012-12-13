<li style="height: 213px; " class="generated-height">
	<div class="product-grid-item " id="product-153233182">
		<a href="?con=stores&page=store&id=<?= $store['st_id'] ?>" class="product-link" title="Minty">
			<?= ($store['trusted'] == 1) ? '<img src="views/static/images/trusted.png" width="32" height="32" alt="trusted" class="tiptool" title="'. l('Trusted store').'" style="float:'.l(left).';"/>' : '' ?>
			<img src="<?= ($store['profile_photo']) ? 'uploads/stores/' . $store['account_id'] . '/' . $store['profile_photo'] : 'views/static/images/project-thumbnail.png' ?>" class="product-photo" alt="Minty">
		</a>
		<div class="product-information" style="height: 16px; ">
			<a href="?con=stores&page=store&id=<?= $store['st_id'] ?>"><?= $store['title'] ?></a>
		</div>
	</div>
</li>