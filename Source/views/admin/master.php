<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr">
    <head>
        <title>PhonetMall.com</title>
		<meta name="description" content="<?=(isset($meta_tag[$con][$page]['description'])) ? $meta_tag[$con][$page]['description'] : $meta_tag ['description'] ?>" />
		<meta name="keywords" content="<?=(isset($meta_tag[$con][$page]['keywords'])) ? $meta_tag[$con][$page]['keywords'] : $meta_tag ['keywords'] ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<link type="text/css" rel="stylesheet" href="views/static/css/style.css" />
                <link type="text/css" rel="stylesheet" href="views/static/css/bvalidator.css" />

		<script type="text/javascript" src="views/static/js/jquery-1-6-4.js"></script>
                <script type="text/javascript" src="views/static/js/jquery.bvalidator.js"></script>
                
                <script language="JavaScript" src="views/static/js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
		<link rel="stylesheet" href="views/static/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css">

                
                <script type="text/javascript" src="views/static/js/common.js"></script>


	
	</head>
    <body>


		<!-- main div -->
		<div class="godfather">
			
			
			<div class="header">
				<div class="logo">
					<a href="./"><img src="views/static/images/logo.png" width="222" height="48" alt="phonetmall.com"/></a>
				</div><!-- logo -->

				<div class="loginbar">
                                    
                       			<div class="clear"></div>
                                    <?php if(!$oUser->id){ ?>
                                    <form action="?page=login" method="post" class="bvalidator">
					<input type="text" id="email" name="email"  value="<?=l('Email / Mobile no.')?>" title="<?=l('Email / Mobile no.')?>" class="txtbox rad5 clearonfocus" data-bvalidator="required,email"/>
					<input type="password" id="password" name="password" value="<?=l('password')?>" title="<?=l('password')?>" class="txtbox rad5 clearonfocus" data-bvalidator="required"/>
					<input type="submit" value="LOGIN" class="login"/>
                                    </form>   
                                   
					<div class="clear"></div>

					<div class="loginoptions">
						<label for="remember_me"><input type="checkbox" name="remember_me" class="checkbox" id="remember_me"/> <?= l('Remember me')?></label>
						<a href="?page=forget-password" class="links" style="margin-left: 165px;">Forgot password</a>
						
					</div>
                                         <?php }else{ ?>
                                        
										<div class="welcomeback">
											welcome <?=$oUser->firstname.' '.$oUser->lastname ?>
										</div>
                                        
										<div class="clear"></div>
										
										
                                                                                <a href="?action=logout">Logout</a>
                                        <?php } ?>
				</div><!-- loginbar -->
				<div class="clear"></div>
				
				<div class="menu">
					<a href="?con=admin" class="<?= ($con == 'admin' && $page == 'default')? 'current': ''; ?>">HOME</a>
					<a href="?con=admin&page=accounts" class="<?= ($con == 'admin' && ($page == 'accounts' || $page == 'store-form' || $page == 'store'))? 'current': ''; ?>">Accounts</a>
					<a href="?con=admin&page=stores" class="<?= ($con == 'admin' && $page == 'stores')? 'current': ''; ?>">STORES</a>
                                        <a href="?con=admin&page=items" class="<?= ($con == 'admin' && ($page == 'items' || $page == 'items-form' || $page == 'item'))? 'current': ''; ?>">ITEMS</a>
                                        <a href="?con=admin&page=countries" class="<?= ($con == 'admin' && ($page == 'countries' || $page == 'items-form' || $page == 'item'))? 'current': ''; ?>">COUNTRIES</a>
                                        <a href="?con=admin&page=cities" class="<?= ($con == 'admin' && ($page == 'cities' || $page == 'items-form' || $page == 'item'))? 'current': ''; ?>">CITIES</a>
                                        <a href="?con=admin&page=areas" class="<?= ($con == 'admin' && ($page == 'areas' || $page == 'items-form' || $page == 'item'))? 'current': ''; ?>">AREAS</a>
                                        <a href="?con=admin&page=categories" class="<?= ($con == 'admin' && ($page == 'categories' || $page == 'items-form' || $page == 'item'))? 'current': ''; ?>">CATEGORIES</a>
                                        <a href="?con=admin&page=subcategories" class="<?= ($con == 'admin' && ($page == 'subcategories' || $page == 'items-form' || $page == 'item'))? 'current': ''; ?>">SUB-CAT.</a>
                                        <a href="?con=admin&page=shipping-cost" class="<?= ($con == 'admin' && ($page == 'shipping-cost'))? 'current': ''; ?>">SHIPPING COST.</a>
                                        <a href="?con=admin&page=ads" class="<?= ($con == 'admin' && ($page == 'ads'))? 'current': ''; ?>">ADS</a>

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
					
						if(file_exists($inner_page))
						{
							include $inner_page;
						}
						
					?>

				

				
			</div><!-- contentholder -->

			<div class="clear"></div>

		</div><!-- godfather -->
			

			<div class="footer-content">
				<div class="footer-links">
					<a href="./">HOME</a>
					<a href="?con=stores">ABOUT US</a>
					<a href="?con=item">SERVICES</a>
					<a href="?page=search">SEARCH</a>
				</div>


				<div class="copyrights">
					copyright &copy; 2012 phonetmall.com | <a href="http://www.tqniat.com" target="_blank">Powered by: Tqniat</a>
				</div>
			</div><!-- footer-content -->

                        
			<div class="clear"></div>

		</div><!-- footer -->


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
                
                
		});

	</script>
</html>