<div class="splash" style="height: 330px;">
	<div class="slider">
		<img src="views/static/images/slide1.png" width="967" height="330" alt="point of sale activities"/>
		<img src="views/static/images/slide2.png" width="967" height="330" alt="point of sale activities"/>
	</div>
</div>

<div class="clear"></div>


<div class="innercontent-holder">

	<div class="box-holder">
		<div class="content">
                    <?php
						if ($notify_msg)
							echo '<div class="notify-msg clear">' . $notify_msg . '</div>';
						if ($error_msg)
							echo '<div class="error-msg clear">' . $error_msg . '</div>';
			?>
			<h1>Where are we?</h1>
			<br />
                        <div id="map" style="width:902px;height:510px"></div>
<!--			<img src="views/static/images/map.png" width="902" height="510" alt="map"/>-->
		</div>


		<div class="bottom-bg"></div>
	</div><!-- box-holder -->




	<div class="box-holder">
		<div class="content">

			
			<div class="sendmessage">

				<h1>Send message:</h1>
                                <form action="?page=contact" method="POST" class="bvalidator">
				<input type="text" id="name" name="name" value="Full name" class="txtbox clearonfocus" title="Full name" data-bvalidator="required"/>
				<input type="text" id="email" name="email" value="Email" class="txtbox clearonfocus" title="Email" data-bvalidator="required,email"/>
				<input type="text" id="mobile" name="mobile" value="Telephone" class="txtbox clearonfocus" title="Telephone" data-bvalidator="required,number"/>
				<textarea id="message" name="message" cols="40" rows="50" class="txtbox clearonfocus" title="Message" data-bvalidator="required">Message</textarea>
                                
				<div class="clear"></div>


				<input type="submit" value="SEND NOW" class="submitbtn"/>
                                </form>
			</div>


			<div class="sendmessage">

				<h1>Contact info:</h1>


				<div class="infoholder address">
					<span>49 Mahkama street Off Ahmad El zomor, Zahraa Nasr City, Cairo, Egypt.</span>
				</div>

				<div class="infoholder phone">
					<span>+202 33256373</span>
				</div>

				<div class="infoholder phone">
					<span>+202 33256373</span>
				</div>

				<div class="infoholder email">
					<span>info@adboxegypt.com</span>
				</div>


			</div>


		</div>


		<div class="bottom-bg"></div>
	</div><!-- box-holder -->





</div>


<script src='http://maps.google.com/maps/api/js?sensor=true&language=ar&region=EG' type='text/javascript'></script>
<script type="text/javascript">
	$(document).ready(function(){
	
	initialize ();
	
	function initialize() {
        var myOptions = {
          center: new google.maps.LatLng(30.051054, 31.348203),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        var map = new google.maps.Map(document.getElementById("map"),
            myOptions);
     

	  
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(30.051054,31.348203),
      map: map,
	
      title:"AdboxEgypt"
		});
  
		
	}
	  
	  
	  });
</script>

