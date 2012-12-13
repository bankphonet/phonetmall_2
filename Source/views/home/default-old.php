<div class="itemsholder one-edge-shadow carousel product-grid">
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
    <button class="prev left"></button>
 	<button class="next left"></button>
 	<button class="prev right"></button>
 	<button class="next right"></button>
</div><!-- itemsholder -->
<script>
    $(document).ready(function(){
        $('#category_id').trigger ('change');
        $('#country_code').trigger ('change');
    });
</script>
