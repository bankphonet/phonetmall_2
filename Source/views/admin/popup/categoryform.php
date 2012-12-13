<div class="cartholder">
    
    <h1>Manage Country </h1>
    <form action="?con=admin&ajax=categoryform&code=<?=$code?>" method="post">
        
        <label>Title english :</label> <input type="text" name="title_en" value="<?=$category['title_en']?>" id="" class="txtbox" />
        <br class="clear" />
        <label>Title arabic :</label> <input type="text" name="title_ar" value="<?=$category['title_ar']?>" id="" class="txtbox" />
        <br class="clear" />
         
        <input type="submit" value="SAVE" />
    </form>
</div>
