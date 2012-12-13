<script type="text/javascript" src="views/static/js/jquery-1-6-4.js"></script>


<div id="map" style="width:600px;height:400px;">
    
    
</div>
<input type="hidden" id="lat" value="<?=$store['lat']?>" />
<input type="hidden" id="lng" value="<?=$store['lng']?>" />


<script type="text/javascript">
    $(document).ready(function(){
        var Allmarkers=[]; //Variable to hold all markers
        var map=null; //Reference to map
        var zoom=6;//Defsault zoom
        var mLatLng = new google.maps.LatLng(30.087206152940972, 31.18627312343756);
        var markerp;//User Clicked Marker
        function setMap(pos,zoomr){
            var myOptions = {
                zoom: zoomr,
                center: pos,
                mapTypeControlOptions: 
                    {
                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU     
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP
			  
            };
            map = new google.maps.Map(document.getElementById("map"),
            myOptions);
				
            
        }
			
        setMap(mLatLng,zoom);
        //LOAD ADD DEFAULT VALUES
	var store_lat = $('#lat').val ();	
	var store_lng = $('#lng').val ();	
	if(store_lng){
            var store_point = new google.maps.LatLng(store_lat,store_lng);
            placeMarker(store_point);
            map.setCenter(store_point);
            map.setZoom(14);
        }
        
        //Functions
        function placeMarker(location) {
            clearOverlays();
            $('#lat').val(location.lat ());
            $('#lng').val(location.lng ());
                 
            var marker = new google.maps.Marker({
                position: location, 
                map: map
            });
            Allmarkers.push(marker);
        }
                 
        function clearOverlays() {
            if (Allmarkers) {
                for (i in Allmarkers) {
                    Allmarkers[i].setMap(null);
                }
            }
        }
                
                
              
    });

</script>

