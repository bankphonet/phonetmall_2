<div class="innercontent-holder">

	<div class="box-holder">
            <div class="content">
                
                
                <div class="sendmessage">
                                  <?php
						if ($notify_msg)
							echo '<div class="notify-msg clear">' . $notify_msg . '</div>';
						if ($error_msg)
							echo '<div class="error-msg clear">' . $error_msg . '</div>';
                                ?>
				<h1>Login:</h1><br/>
                                
                                
                                <form action="?con=admin&page=login" method="POST" class="bvalidator">
                                <h5>Email:</h5>   
				<input type="text" id="name" name="email" value="" class="txtbox " title="" data-bvalidator="required,email"/>
				<h5>Password:</h5>   
                                <input type="text" id="password" name="password" value="" class="txtbox clearonfocus" title="" data-bvalidator="required"/>
                                
				<div class="clear"></div>


				<input type="submit" value="SEND NOW" class="submitbtn"/>
                                </form>
		</div>
                
            </div>
        </div>
</div>