<div class="cartholder">
    
    <h1>Manage Sub Category </h1>
    <form action="?con=admin&ajax=subcategoryform&code=<?=$code?>" method="post">
        <label>Main Category id</label><input type="text" name="main_category" value="<?=$subcategory['main_category']?>" id="" class="txtbox" />
        <label>Title english :</label> <input type="text" name="title_en" value="<?=$subcategory['title_en']?>" id="" class="txtbox" />
        <br class="clear" />
        <label>Title arabic :</label> <input type="text" name="title_ar" value="<?=$subcategory['title_ar']?>" id="" class="txtbox" />
        <br class="clear" />
         
        <input type="submit" value="SAVE" />
    </form>
</div>
