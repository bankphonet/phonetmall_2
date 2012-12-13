<div class="innercontent-holder">

	<div class="box-holder">
            <div class="content">
                
               <form action="?con=admin&page=clients-form&id=<?=$id?>" method="POST" class="bvalidator" enctype="multipart/form-data">

                <div class="sendmessage">
                                  <?php
						if ($notify_msg)
							echo '<div class="notify-msg clear">' . $notify_msg . '</div>';
						if ($error_msg)
							echo '<div class="error-msg clear">' . $error_msg . '</div>';
                                ?>
				<h1>Add Client:</h1><br/>
                                
                                
                                <h5>Client Name:</h5>   
				<input type="text" id="name" name="title" value="<?=$client['title']?>" class="txtbox " title="" data-bvalidator="required"/>
                                <br class="clear"/>
                                <h5>Image:</h5>   
                                <input type="file" name="file" class="txtbox"/>   

				<div class="clear"></div>
                                <input type="submit" value="ADD CLIENT" class="submitbtn"/>

				
		</div>
                   
                   
               
               </form>
                
            </div>
        </div>
</div>