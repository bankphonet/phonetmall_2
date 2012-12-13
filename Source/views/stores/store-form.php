<div class="pageheader rad5">
    <h1><?= ($id)? l('EDIT STORE') : l('CREATE NEW STORE') ?>:</h1>
</div>

<div class="transfer rad5">


    <form action="?con=stores&page=store-form&id=<?=$id?>&user=<?=$user_id?>" method="post" class="bvalidator" enctype="multipart/form-data">
        <label for="title"><?= l('Store name') ?>:</label>
        <input type="text" name="title" id="title" value="<?= $store['title'] ?>" class="txtbox" data-bvalidator="required"/>
        
        <label for="title"><?= l('Store user name') ?>:<span class="tiptool" style="color:red;" original-title="<?=l('uniqe user name to access your store fast')?>"> ?!</span></label>
        <input type="text" name="store_name" id="title" value="<?= $store['store_name'] ?>" class="txtbox" data-bvalidator="alphanum"/>

       <?php if($oUser->admin == 1){ ?>
        
         <label for="trusted"><?= l('Trusted') ?>:</label>
        <select id="country_code" class="txtbox"  name="trusted">
            <option value="1" <?=($store['trusted'] == 1) ? 'SELECTED' : '' ?> >Trusted</option>
            <option value="0" <?=($store['trusted'] == 0) ? 'SELECTED' : '' ?>>Not-Trusted</option>
        </select>
        <?php } ?>
        
        
        <label for="cover_photo"><?= l('Cover photo') ?>:</label>
        <input type="file" name="cover_photo">

        <label for="cover_photo"><?= l('profile photo') ?>:</label>
        <input type="file" name="profile_photo">

        <label for="category"><?= l('Category') ?>:</label>

        <select name="category_id" id="category_id" class="txtbox" data-bvalidator="required" onchange="url = '?ajax=subcategory-list&id=' + $(this).val(); $('#subcategory').load(url,function(result){});">
            <option value="" ><?= l('Please Chose Category') ?></option>
            <?= generate_select_options($categories, 'title', 'id', $store['category_id']) ?>
        </select>
        <div id="subcategory_container">
            <label for="lastname"><?= l('Subcategory') ?>:</label>
            <?php $x = 0; if ($id) foreach ($store['sub_categories'] as $sub_cat) { ?>
                    <div id="subcategory_clone" style="margin-top:5px;">
                        <select name="sub_category_id[]" id="subcategory" class="txtbox" data-bvalidator="required">
                            <option value="" ><?= l('Please Chose sub-category') ?></option>
                            <?= generate_select_options($subcategories, 'title', 'id',$sub_cat['category_id']); ?>
                        </select>
                        <a href="#" class="f" style="<?=($x==0) ? 'display: none;' : '' ?>" onclick="$(this).parent().remove(); return false;" style="margin: 5px 10px"><?= l('Remove') ?></a>
                    </div>

                <?php $x++;} else { ?>
                <div id="subcategory_clone" style="margin-top:5px;">
                    <select name="sub_category_id[]" id="subcategory" class="txtbox" data-bvalidator="required">
                        <option value="" ><?= l('Please Chose sub-category') ?></option>
                    </select>
                    <a href="#" class="f" style="display: none;" onclick="$(this).parent().remove(); return false;" style="margin: 5px 10px"><?= l('Remove') ?></a>
                </div>               
            <?php } ?>


        </div>
        <a href="#" id="add-subcat" onclick ="$('#subcategory_container').append($('#subcategory_clone').clone (true) ); $('.f').slice(1).show(); return false;"><?= l('+ Add another') ?></a>


        <label for="country"><?= l('Country') ?></label>
        <select id="country_code" class="txtbox" data-bvalidator="required" name="country_code" onchange="url = '?ajax=cities-list&id=' + $(this).val(); $('#city_id').load(url,function(result){});">
            <option value=""><?= l('please chose country') ?></option>
            <?= generate_select_options($countries, 'title', 'code',$store['country_code']) ?>
        </select>

        <label for="city"><?= l('City') ?></label>
        <select id="city_id" class="txtbox" data-bvalidator="required" name="city_id" onchange="url = '?ajax=area-list&id=' + $(this).val(); $('#area_id').load(url,function(result){});">
            <option value=""><?= l('please chose city') ?></option>
            <?php if($id)
               echo  generate_select_options($cities,'title','id',$store['city_id']); 
            ?>
        </select>


        <label for="area"><?= l('Area') ?></label>
        <select id="area_id" class="txtbox" data-bvalidator="required" name="area_id">
            <option value=""><?= l('please chose area') ?></option>
             <?php if($id)
               echo  generate_select_options($areas,'title','id',$store['area_id']); 
            ?>
        </select>


        <label for="tel1"><?= l('Telephone 1') ?>:</label>

        <div id="mailcontainer">
            <input type="text" id="tel1" name="tel1" value="<?= $store['tel1'] ?>" class="txtbox" data-bvalidator="required" />
        </div>

        <label for="tel2"><?= l('Telephone 2') ?>:</label>

        <div id="mailcontainer">
            <input type="text" id="tel2" name="tel2" value="<?= $store['tel2'] ?>" class="txtbox"  />
        </div>


        <label for="tel3"><?= l('Telephone 3') ?>:</label>

        <div id="mailcontainer">
            <input type="text" id="tel3" name="tel3" value="<?= $store['tel3'] ?>" class="txtbox"  />
        </div>


        <label for="mobile"><?= l('Description') ?>:</label>
        <textarea name="description" id="description" cols="30" rows="10" class="" data-bvalidator="required"><?= $store['description'] ?></textarea>



        <label for="location"><?= l('Location') ?>:</label>
        <div id="map" style="width:400px;height:300px;">


        </div>
        <input type="hidden" name="lat" value="<?= $store['lat'] ?>" id="lat">
        <input type="hidden" name="lng" value="<?= $store['lng'] ?>" id="lng">

        <div class="clear"></div>


        <input type="submit" id="send" value="<?=($id) ? l('EDIT STORE') : l('ADD STORE') ?>" class="registerbtn"/>
    </form>


</div>

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
				
            //assign click
            google.maps.event.addListener(map, 'click', function(event) {
                markerp = event.latLng;
                placeMarker(event.latLng);
            });
        }
			
        setMap(mLatLng,zoom);
        //LOAD ADD DEFAULT VALUES
		
	//if in edit mode !!
        var elat = $('#lat').val ();
        var elng = $('#lng').val ();
        if(elat && elng){
            var epoint = new google.maps.LatLng (elat,elng);
            placeMarker (epoint);
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


<script src='http://maps.google.com/maps/api/js?sensor=true&language=ar&region=EG' type='text/javascript'></script>

