<li style="height: 213px; " class="generated-height">
	<div class="product-grid-item " id="product-153233182">
		<a href="?con=items&page=item&id=<?= $item['id'] ?>" class="product-link" title="Minty">
			<span class="product-price"><?= $item['price'] ?> <?= l('LE')?></span>
			<img src="<?= ($item['image1']) ? 'uploads/items/' . $item['account_id'] . '/' . $item['image1'] : 'views/static/images/thumb.png' ?>" class="product-photo" alt="Minty">
		</a>
		<div class="product-information" style="height: 16px; ">
			<a href="?con=items&page=item&id=<?= $item['id'] ?>"><?= $item['title'] ?></a>
		</div>
	</div>
</li>