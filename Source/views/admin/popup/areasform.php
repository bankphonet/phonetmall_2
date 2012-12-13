<div class="cartholder">
    
    <h1>Manage area </h1>
    <form action="?con=admin&ajax=areaform&code=<?=$code?>" method="post">
        <label>City id :</label> <input type="text" name="city_id" value="<?=$area['city_id']?>" id="" class="txtbox" />
        <br class="clear" />
        <label>Title english :</label> <input type="text" name="title_en" value="<?=$area['title_en']?>" id="" class="txtbox" />
        <br class="clear" />
        <label>Title arabic :</label> <input type="text" name="title_ar" value="<?=$area['title_ar']?>" id="" class="txtbox" />
        <br class="clear" />
         
        <input type="submit" value="SAVE" />
    </form>
</div>
