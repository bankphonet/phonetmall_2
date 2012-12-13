<div class="innercontent-holder">

	<div class="box-holder">
            <div class="content">
                
               <form action="?con=admin&page=portfolio-form&id=<?=$id?>" method="POST" class="bvalidator" enctype="multipart/form-data">

                <div class="sendmessage">
                                  <?php
						if ($notify_msg)
							echo '<div class="notify-msg clear">' . $notify_msg . '</div>';
						if ($error_msg)
							echo '<div class="error-msg clear">' . $error_msg . '</div>';
                                ?>
				<h1>Add Project:</h1><br/>
                                
                                
                                <h5>Project Name:</h5>   
				<input type="text" id="name" name="title" value="<?=$portfolio['title']?>" class="txtbox " title="" data-bvalidator="required"/>
				<h5>Description:</h5>   
                                <textarea  id="description" name="description"  class="txtbox clearonfocus" title="" data-bvalidator="required"><?=$portfolio['description']?></textarea>
                                
				<div class="clear"></div>
                                <input type="submit" value="ADD PROJECT" class="submitbtn"/>

				
		</div>
                   
                    <div class="sendmessage">
                    <input type="file" name="image[]" class="txtbox"/>   
                    <input type="file" name="image[]" class="txtbox" />   
                    <input type="file" name="image[]" class="txtbox" />   
                    <input type="file" name="image[]" class="txtbox" />   
                    <input type="file" name="image[]" class="txtbox" />   
                    <input type="file" name="image[]" class="txtbox" /> 
                    <br class="clear"/>
                   
                    </div>
               
               </form>
                
            </div>
        </div>
</div>