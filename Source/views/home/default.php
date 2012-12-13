<!-- Items Carousel -->
<section class="diagonal-divider clearfix">
	<header class="section-details clearfix">
		<h2 class="section-title"><a href="?con=items" title="">Items</a></h2>
	</header>
	<div id="carousel" class="itemsholder-carousel one-edge-shadow carousel product-grid items-carousel">
		<a id="carousel-prev" class="prev browse left" title="Previous slide" style="display: none; "><span class="arrow ir">Next</span></a>
	    <a id="carousel-next" class="next browse right" title="Next slide" style="display: none; "><span class="arrow ir">Previous</span></a>
		<ul>
	    <?php
	    if ($items) {
	        //$x = 0;
	        foreach ($items as $item) {
	            include 'views/home/one-item-new.php';
	        }
		?>
	
	    <?php } else { ?>
	        There are no items
	    <?php } ?>
	    </ul>
	</div><!-- itemsholder -->
	<script>
	    $(document).ready(function(){
	        $('#category_id').trigger ('change');
	        $('#country_code').trigger ('change');
	    });
	</script>
</section>

<!-- Stores Carousel -->
<section class="diagonal-divider clearfix">
	<header class="section-details clearfix">
		<h2 class="section-title"><a href="?con=items" title="">Stores</a></h2>
	</header>
	<div id="carousel" class="itemsholder-carousel one-edge-shadow carousel product-grid stores-carousel">
		<a id="carousel-prev" class="prev browse left" title="Previous slide" style="display: none; "><span class="arrow ir">Next</span></a>
	    <a id="carousel-next" class="next browse right" title="Next slide" style="display: none; "><span class="arrow ir">Previous</span></a>
		<ul>
	    <?php
	    if ($stores) {
	        //$x = 0;
	        foreach ($stores as $store) {
	            include 'views/home/one-store-new.php';
	        }
		?>
	
	    <?php } else { ?>
	        There are no stores
	    <?php } ?>
	    </ul>
	    <!-- <button class="prev left"></button>
	 	<button class="next left"></button>
	 	<button class="prev right"></button>
	 	<button class="next right"></button> -->
	</div><!-- itemsholder -->
	<script>
	    $(document).ready(function(){
	        $('#category_id').trigger ('change');
	        $('#country_code').trigger ('change');
	    });
	</script>
</section>

<section class="diagonal-divider clearfix">
	<header class="section-details clearfix">
		<h2 class="section-title"><a href="?con=items" title="">Items</a></h2>
	</header>
	<div id="carousel" class="itemsholder-carousel one-edge-shadow carousel product-grid items-carousel">
		<a id="carousel-prev" class="prev browse left" title="Previous slide" style="display: none; "><span class="arrow ir">Next</span></a>
	    <a id="carousel-next" class="next browse right" title="Next slide" style="display: none; "><span class="arrow ir">Previous</span></a>
		<ul>
	    <?php
	    if ($items) {
	        //$x = 0;
	        foreach ($items as $item) {
	            include 'views/home/one-item-new.php';
	        }
		?>
	
	    <?php } else { ?>
	        There are no items
	    <?php } ?>
	    </ul>
	    <!-- <button class="prev left"></button>
	 	<button class="next left"></button>
	 	<button class="prev right"></button>
	 	<button class="next right"></button> -->
	</div><!-- itemsholder -->
	<script>
	    $(document).ready(function(){
	        $('#category_id').trigger ('change');
	        $('#country_code').trigger ('change');
	    });
	</script>
</section>


<section class="diagonal-divider clearfix">
	<header class="section-details clearfix">
		<h2 class="section-title"><a href="?con=items" title="">Stores</a></h2>
	</header>
	<div id="carousel" class="itemsholder-carousel one-edge-shadow carousel product-grid stores-carousel">
		<a id="carousel-prev" class="prev browse left" title="Previous slide" style="display: none; "><span class="arrow ir">Next</span></a>
	    <a id="carousel-next" class="next browse right" title="Next slide" style="display: none; "><span class="arrow ir">Previous</span></a>
		<ul>
	    <?php
	    if ($stores) {
	        //$x = 0;
	        foreach ($stores as $store) {
	            include 'views/home/one-store-new.php';
	        }
		?>
	
	    <?php } else { ?>
	        There are no stores
	    <?php } ?>
	    </ul>
	    <!-- <button class="prev left"></button>
	 	<button class="next left"></button>
	 	<button class="prev right"></button>
	 	<button class="next right"></button> -->
	</div><!-- itemsholder -->
	<script>
	    $(document).ready(function(){
	        $('#category_id').trigger ('change');
	        $('#country_code').trigger ('change');
	    });
	</script>
</section>

