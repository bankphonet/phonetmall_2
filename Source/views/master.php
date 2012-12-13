<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="<?= ($local == 'en')? 'ltr' : 'rtl' ;?>">
    <head>
        <title><?=($page_title) ? $page_title.'  ' : '' ?> <?= l('PhonetMall.com first online mall buy from stores & items open freely your store sell your stuff. We do marketing collecting shipping distributing') ?></title>
        <base href="<?=BASE_URL?>" />
        <meta name="description" content="<?= (isset($meta_tag[$con][$page]['description'])) ? $meta_tag[$con][$page]['description'] : $meta_tag ['description'] ?>" />
        <meta name="keywords" content="<?= (isset($meta_tag[$con][$page]['keywords'])) ? $meta_tag[$con][$page]['keywords'] : $meta_tag ['keywords'] ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<?php if ($local == 'en'){ ?>
			<link type="text/css" rel="stylesheet" href="views/static/css/style.css" />
		<?php }else{ ?>
			<link type="text/css" rel="stylesheet" href="views/static/css/style-ar.css" />
		<?php } ?>
        <link type="text/css" rel="stylesheet" href="views/static/css/bvalidator.css" />
        <link type="text/css" rel="stylesheet" href="views/static/css/tipsy.css" />
        <link type="text/css" rel="stylesheet" href="views/static/css/jquery-ui.css" />
        <link rel="stylesheet" href="views/static/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css">

        <script type="text/javascript" src="views/static/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="views/static/js/jquery.bvalidator.js"></script>
        <script type="text/javascript" src="views/static/js/jquery.tipsy.js"></script>
        <script type="text/javascript" src="views/static/js/jquery-ui.js"></script>
        <script type="text/javascript" src="views/static/js/jcarousellite_1.0.1.min.js"></script>
        <script language="JavaScript" src="views/static/js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
		<script type="text/javascript">var con='<?=$_GET['con']?>', page='<?=$_GET['page']?>', id='<?=$_GET['id']?>';</script>
        <script type="text/javascript" src="views/static/js/common.js"></script>

		<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5205741-11']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

    </head>
    <body style="margin: 0; padding: 0;">
        <!-- main div -->
        <div class="godfather">


            <div class="header">
                <div class="logo">
                    <a href="./"><img src="views/static/images/logo.png" width="278" height="58" alt="phonetmall.com"/></a>
                </div><!-- logo -->
				<?php if ($local == 'en'){ ?>
                    <a href="?lang=ar&ref=<?=getURL()?>" >عربي</a>
                    <?php }  else { ?>
                    <a href="?lang=en&ref=<?=getURL()?>" >English</a>
                    <?php } ?>
                <div class="loginbar">
                    
                    <?php if (!$oUser->id) { ?>
                        <form action="?page=login" method="post" class="bvalidator">
                            <input type="text" id="email" name="email"  value="<?= l('Email / Mobile no.') ?>" title="<?= l('Email / Mobile no.') ?>" class="txtbox clearonfocus" data-bvalidator="required"/>
                            <input type="password" id="password" name="password" value="<?= l('password') ?>" title="<?= l('password') ?>" class="txtbox clearonfocus" data-bvalidator="required"/>
                            <input type="submit" value="<?= l('LOGIN')?>" class="login"/>
                        </form>   

                        <div class="clear"></div>

                        <div class="loginoptions">
                            <label for="remember_me"><input type="checkbox" name="remember_me" class="checkbox" id="remember_me"/> <?= l('Remember me') ?></label>
                            <a href="?page=forget-password" class="links" style="margin-<?= l('left:')?> 145px;"><?= l('Forgot password')?></a>
							<span style="font-size: 11px; color: #FF8300"><?= l('bankphonet.com OR phonetmall.com accounts')?></span>

                        </div>
                    <?php } else { ?>

                        <div class="welcomeback">
                            welcome <?= $oUser->firstname . ' ' . $oUser->lastname ?>
							<a href="?action=logout"> - <?= l('Logout')?></a>
                        </div>

                        <div class="clear"></div>
                        <div class="loggedinmenu">
							<a href="./" class="<?= ($con == 'default' && $page == 'default') ? 'current' : ''; ?>"><span class="home"></span><?= l('HOME')?></a>
							<a href="?con=stores" class="<?= ($con == 'stores' && ($page == 'default' || $page == 'store-form' || $page == 'store')) ? 'current' : ''; ?>"><span class="stores"></span><?= l('STORES')?></a>
							<a href="?con=items" class="<?= ($con == 'items' && ($page == 'default' || $page == 'items-form' || $page == 'item')) ? 'current' : ''; ?>"><span class="items"></span><?= l('ITEMS')?></a>
							<a href="?page=search" class="<?= ($con == 'default' && $page == 'search') ? 'current' : ''; ?>"><span class="search"></span><?= l('SEARCH')?></a>
							<a href="?con=items&page=favoriteitems"><span class="fitems"></span><?= l('Favorite items')?></a>
							<a href="?con=stores&page=favoritestores"><span class="fitems"></span><?= l('Favorite stores')?></a>
							<a href="http://www.bankphonet.com/?con=cms&node=how-phonetmall-works"><span class="howitwork"></span><?= l('How it works?')?></a>
						</div>
                        <?php if ($oUser->admin == 1) { ?>
                            <a href="?con=admin">Admin Area</a>
                        <?php } ?>

                        
                    <?php } ?>
                </div><!-- loginbar -->
              <!-- Search------ -->
				<div class="search-position ">
				<form  name="search" method="post">
				<label for="search" class="searchlabel">Search:</label>
				<input type="text" id="search" name="keyword" class="search-home"  value="<?=($_GET['keyword']) ? $_GET['keyword'] : ("keyword")?>">
			
				<select name="con" id="con">
				<option value="items"  selected="selected">items</option>
				<option value="stores"  <?php if($_GET['con'] == "stores") echo 'selected="selected"' ?>> stores</option>	
				</select>			

				<input type="submit" value="Search" class="search-button">				
				</form>
				</div>
				<div class="ad-search">
				<a href="#" id="s" class="adv-search"><img src="views/static/images/showsearch.png" width="28" height="28" alt="show/hide"/></a>
		
				
				
				<div class="box hide" >
				
				
				<div class="searchholderbar">
    
	<div class="searchbar">
		<a href="#" class="showhide"><img src="views/static/images/showsearch.png" width="28" height="28" alt="show/hide"/></a>
	<h2><?= l('Search for stores')?></h2>
         <form action="" method="get">
         <input type="hidden" name="con" value="stores" />
         <input type="hidden" name="search_flag" value="1" />
	<input type="text" id="keyword" name="keyword" value="<?=($_GET['keyword']) ? $_GET['keyword'] : l('keyword')?>" title="keyword" class="txtbox clearonfocus"/>


	<select name="category_id" id="category_id" class="txtbox" data-bvalidator="required" onchange="url = '?ajax=subcategory-list&id=' + $(this).val(); $('#subcategory1').load(url,function(result){$('#subcategory1').val(<?=$_GET['sub_category_id']?>);});">
           
            <?= getCategoriesBox((($_GET['category_id']) ? $_GET['category_id'] : ''))  ?>
        </select>


	 <select name="sub_category_id" id="subcategory1" class="txtbox" data-bvalidator="required">
                    <option value="" ><?= l('Please Chose sub-category') ?></option>
          </select>



	<select id="country_code" class="txtbox" data-bvalidator="required" name="country_code" onchange="url = '?ajax=cities-list&id=' + $(this).val(); $('#city_id1').load(url,function(result){$('#city_id1').val(<?=$_GET['city_id']?>);$('#city_id1').trigger ('change'); });">
            
                <?= getCountriesBox ($_GET['country_code']) ?>
        </select>


	<select id="city_id1" class="txtbox" data-bvalidator="required" name="city_id" onchange="url = '?ajax=area-list&id=' + $(this).val(); $('#area_id1').load(url,function(result){$('#area_id1').val(<?=$_GET['area_id']?>);});">
            <option value=""><?= l('Please choose city') ?></option>
           
        </select>


	 
        <select id="area_id1" class="txtbox" data-bvalidator="required" name="area_id">
            <option value=""><?= l('Please choose area') ?></option>
           
        </select>

	


	<div class="clear"></div>

	<input type="submit" value="<?= l('SEARCH')?>" class="search"/>
        </form>

</div> <!-- searhbar -->




<div class="searchbar" style="width: 580px; margin-<?= l('left')?>: 10px;">
	<a href="#" class="showhide" style="width: 560px;"><img src="views/static/images/showsearch.png" width="28" height="28" alt="show/hide"/></a>
	<h2><?= l('Search for items')?></h2>
        <form action="" method="get">
         <input type="hidden" name="con" value="items" />
	<input type="text" id="keyword" name="keyword" value="<?=($_GET['keyword']) ? $_GET['keyword'] : l('keyword')?>" title="<?=l('keyword')?>" class="txtbox clearonfocus"/>
	<input type="text" id="keyword" name="store" value="<?=($_GET['store']) ? $_GET['store'] : l('Store')?>" title="<?=l('Store')?>" class="txtbox clearonfocus" style="margin-left: 40px;"/>


	<select name="category_id" id="category_id" class="txtbox" data-bvalidator="required" onchange="url = '?ajax=subcategory-list&id=' + $(this).val(); $('#subcategory').load(url,function(result){$('#subcategory').val(<?=$_GET['sub_category_id']?>);});">
          
            <?= getCategoriesBox (($_GET['category_id']) ? $_GET['category_id'] : '')  ?>
        </select>


	 <select name="sub_category_id" id="subcategory" class="txtbox" data-bvalidator="required" style="margin-left: 40px;">
                    <option value="" ><?= l('Please Chose sub-category') ?></option>
          </select>

                 <select name="item_type" id="" class="txtbox">

            <option value=""><?= l('All types')?></option>
            <option value="for sale" <?=($_GET['item_type'] == 'for sale') ? 'SELECTED' : ''?> ><?= l('For Sale') ?></option>
            <option value="for rent" <?=($_GET['item_type'] == 'for rent') ? 'SELECTED' : ''?> ><?= l('For rent') ?></option>
            <option value="needed for sale" <?=($_GET['item_type'] == 'needed for sale') ? 'SELECTED' : ''?> ><?= l('Wanted for purchase') ?></option>
            <option value="needed for rent" <?=($_GET['item_type'] == 'needed for rent') ? 'SELECTED' : ''?> ><?= l('Wanted for rent') ?></option>
            <option value="needed job" <?=($_GET['item_type'] == 'needed job') ? 'SELECTED' : 'needed job'?> ><?= l('Needed job') ?></option>
            <option value="vacant job" <?=($_GET['item_type'] == 'vacant job') ? 'SELECTED' : ''?> ><?= l('Vacant job') ?></option>
        </select>


	<select id="country_code" class="txtbox" data-bvalidator="required" name="country_code" onchange="url = '?ajax=cities-list&id=' + $(this).val(); $('#city_id').load(url,function(result){$('#city_id').val(<?=$_GET['city_id']?>);$('#city_id').trigger ('change'); });" style="margin-left: 40px;">
            
                <?= getCountriesBox ($_GET['country_code']) ?>
        </select>


	<select id="city_id" class="txtbox" data-bvalidator="required" name="city_id" onchange="url = '?ajax=area-list&id=' + $(this).val(); $('#area_id').load(url,function(result){$('#area_id').val(<?=$_GET['area_id']?>);});">
            <option value=""><?= l('Please choose city') ?></option>

        </select>



        <select id="area_id" class="txtbox" data-bvalidator="required" name="area_id" style="margin-left: 40px;">
            <option value=""><?= l('Please choose area') ?></option>

        </select>


	<div class="price">
		<input type="text" id="pricefrom" name="pricefrom" value="<?=($_GET['pricefrom']) ? $_GET['pricefrom'] : l('price from')?>" class="txtbox clearonfocus" title="<?=('price from')?>"/>
		<input type="text" id="pricefrom" name="priceto" value="<?=($_GET['priceto']) ? $_GET['priceto'] : l('price to')?>" class="txtbox clearonfocus" title="<?=('price to')?>" style="margin-left: 40px;"/>
	</div>


	<select id="shipping_type" name="shipping_type" class="txtbox">
            <option value=""><?= l('Shipping type')?></option>
            <option value="paid" <?=($_GET['shipping_type'] == 'paid') ? 'SELECTED' : ''?>><?= l('Paid') ?></option>
            <option value="owner" <?=($_GET['shipping_type'] == 'owner') ? 'SELECTED' : ''?>><?= l('Owner') ?></option>
        </select>

	<div class="clear"></div>

	<input type="submit" value="<?= l('SEARCH')?>" class="search" style="margin-left: 200px;"/>
        </form>
</div> <!-- searhbar -->
</div>
				
	<script type="text/javascript">



$(function(){

	$('.showhide').toggle(function() {
		$(this).parent().find('input, .txtbox').hide();
		$(this).parent().css("height","55");
	}, function() {
		$(this).parent().find('input, .txtbox').show();
		$(this).parent().css("height","345");
});


});
</script>			
				
				
				</div>
				</div>
			
                

                <a href="<?= (!$oUser->id) ? '?page=register' : '?page=my-cart' ?>" class="links registerlink" ><?= (!$oUser->id) ? l('Create new account') : l('Shopping Cart (') .$cart_count ?>)</a>



                <div class="clear"></div>

                <div class="menu">

				<?php if ($oUser->id) { ?>

					<a href="?con=items&page=myitems" class="<?= ($con == 'items' && $page == 'myitems') ? 'current' : ''; ?>"><?= l('MY ITEMS')?></a>
					<a href="?con=stores&page=mystore" class="<?= ($con == 'stores' && $page == 'mystore') ? 'current' : ''; ?>" ><?= l('MY STORES')?></a>
					<a href="?page=droprequests" class="<?= ($_GET['type'] == '' && $page == 'droprequests') ? 'current' : ''; ?>"><?= l('DROPPED')?> (<?= $my_drops_count ?>)</a>
					<a href="?page=droprequests&type=in" class="<?= ($_GET['type'] == 'in' && $page == 'droprequests') ? 'current' : ''; ?>"><?= l('INCOMING DROPS')?> (<?= $my_indrops_count ?>)</a>
					<a href="?page=orders"><?= l('MY ORDERS')?></a>
					<a href="?page=orders&type=in"><?= l('INCOMING ORDERS')?></a>
					<a href="?page=inbox" class="<?= ($page == 'inbox' || $page == 'outbox') ? 'current' : ''; ?>"><?=l('INBOX')?> (<?= $my_inbox_count ?>)</a>
					
					
				<?php } else { ?>
					
                    <a href="./" class="<?= ($con == 'default' && $page == 'default') ? 'current' : ''; ?>"><?= l('HOME')?></a>
                    <a href="?con=stores" class="<?= ($con == 'stores' && ($page == 'default' || $page == 'store-form' || $page == 'store')) ? 'current' : ''; ?>"><?= l('STORES')?></a>
                    <a href="?con=items" class="<?= ($con == 'items' && ($page == 'default' || $page == 'items-form' || $page == 'item')) ? 'current' : ''; ?>"><?= l('ITEMS')?></a>
                    <a href="?page=search" class="<?= ($con == 'default' && $page == 'search') ? 'current' : ''; ?>"><?= l('SEARCH')?></a>
                    <a href="http://www.bankphonet.com/?con=cms&node=how-phonetmall-works"><?= l('How it works?')?></a>
				<?php } ?>
                </div>
            </div> <!-- header -->



            <div class="contentholder">

                <?php
                if ($notify_msg)
                    echo '<div class="notifmessage successmessage rad5">' . $notify_msg . '</div>';
                if ($error_msg)
                    echo '<div class="notifmessage errormessage rad5">' . $error_msg . '</div>';
                ?>
                <!-- show notification messages to the user -->

                <?php
                if (file_exists($inner_page)) {
                    include $inner_page;
                }
                ?>



                <div class="clear"></div>
            </div><!-- contentholder -->



        </div><!-- godfather -->
        <div class="clear"></div>
<!-- -------Fooooooooooooooter------------------- -->
    <div class="footer-content">
        <div class="design-footer">
       		 <div class="item-footer">
        	<a href="?con=items&page=myitems" class="<?= ($con == 'items' && $page == 'myitems') ? 'current' : ''; ?>"><?= l(' items')?></a>
        	<div class="item-foter-link">
        	<span class="span-link" > <a href="?con=items&amp;country_code=EG">EGYPT</a></span>
        	<span class="span-link"> <a href="?con=items&amp;city_id=6">Cairo</a></span>
        	<span class="span-link"> <a href="?con=items&amp;area_id=1">Nasr City</a></span>
        	<div class="clear-fix">
        	<span class="span-link"> <a href="?con=items&amp;item_type=for sale">for sale</a></span>
        	<span class="span-link"> <a href="?con=items&item_type=for+rent">for rent</a></span>
        	<span class="span-link"> <a href="?con=items&amp;category_id=544">electronics</a></span>
        	</div>
        	<span class="span-link"> <a href="?con=items&amp;category_id=30">Clothes</a></span>
        	<span class="span-link"> <a href="?con=items&item_type=vacant+job">vacant job</a></span>
        	<span class="span-link"> <a href="?con=items&category_id=784">tickets</a></span>
        	<span class="span-link"> <a href="?con=items&trusted=1">trusted item</a></span>
        	
        	
        	<span></span>
        	
        	</div>
 			</div>
      	<div class="stores-footer">
          	<a href="?con=stores&page=mystore" class="<?= ($con == 'stores' && $page == 'mystore') ? 'current' : ''; ?>"style="left:500px;" ><?= l( 'stores')?></a>
         	<div class="stores-footer-link">
        	<span class="span-link" > <a href="?con=stores&country_code=EG">EGYPT</a></span>
        	<span class="span-link"> <a href="?con=stores&amp;area_id=1">Nasr City</a></span>
        	<span class="span-link"> <a href="?con=stores&category_id=172">food</a></span>
        	<span class="span-link"> <a href="?con=stores&category_id=40">furniture</a></span>
        	<div class="clear-fix">
        	<span class="span-link"> <a href="?con=stores&category_id=356">watches</a></span>
        	<span class="span-link"> <a href="?con=stores&category_id=378">drugs</a></span>
        	<span class="span-link"> <a href="?con=stores&category_id=495">job</a></span>
        	<span class="span-link"> <a href="?con=stores&category_id=381">home tools</a></span>
       		 </div>
       		 <span class="span-link"> <a href="?con=stores&trusted=1 ">trusted sites</a></span>
         	</div>
         	</div>  
 
 
 <!--        	</div>
  
 
 
  
 
 
 --> 
        </div> 
    </div>

            <div class="clear"></div>
            <div class="copyrights">
                copyright &copy; 2012 phonetmall.com
            </div>
        </div><!-- footer-content -->


        <div class="clear"></div>
        
        

</body>

<script type="text/javascript">

    $(function(){
		
        //clear textbox or textarea on focus
        $('.clearonfocus').focus(function() {
            if (this.value == this.title) {
                $(this).val("");
            }
        }).blur(function() {
            if (this.value == "") {
                $(this).val(this.title);
            }
        });
                
        
      $('.tweet').click(function(){
        u = $(this).attr('href');
        t=document.title;
	window.open('http://twitter.com/share?url='+encodeURIComponent(u)+'&text='+encodeURIComponent(t)+'&via=phonetmall','toolbar=0,status=0,width=626,height=436');
        return false;
      });
      
      
      $('.fb').click(function(){
        u = $(this).attr('href');
        t=document.title;
	window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
        return false;
      });

        $('.tiptool').tipsy({gravity: 's',html: true});
    });

</script>
</html>