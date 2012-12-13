<div class="cartholder">
    
    <h1>Manage Country </h1>
    <form action="?con=admin&ajax=cityform&code=<?=$code?>" method="post">
        <label>Country Code :</label> <input type="text" name="country" value="<?=$city['country']?>" id="" class="txtbox" />
        <br class="clear" />
        <label>Title english :</label> <input type="text" name="title_en" value="<?=$city['title_en']?>" id="" class="txtbox" />
        <br class="clear" />
        <label>Title arabic :</label> <input type="text" name="title_ar" value="<?=$city['title_ar']?>" id="" class="txtbox" />
        <br class="clear" />
         
        <input type="submit" value="SAVE" />
    </form>
</div>
