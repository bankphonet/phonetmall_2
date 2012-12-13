<div class="cartholder">
    
    <h1>Manage Country </h1>
    <form action="?con=admin&ajax=countryform&code=<?=$code?>" method="post">
        <label>Code :</label> <input type="text" name="code" value="<?=$country['code']?>" id="" class="txtbox" />
        <br class="clear" />
        <label>Title english :</label> <input type="text" name="title_en" value="<?=$country['title_en']?>" id="" class="txtbox" />
        <br class="clear" />
        <label>Title arabic :</label> <input type="text" name="title_ar" value="<?=$country['title_ar']?>" id="" class="txtbox" />
        <br class="clear" />
         
        <input type="submit" value="SAVE" />
    </form>
</div>
