<?php include "header.php" ?>

<div class="space"></div>
<div class="container-fluid">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>Contests</h1>
            </div>
            <div class="col-md-12">
            	<div class="line-full"></div>
            </div>
        </div>     
        
        <?php
			
		if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin")
		{
			
		?>
        
        <div class="row">
        	<div class="col-md-2 space-sm text-center">
            	<a onClick="$('#addcontest').show();"><h5>Add New Contest</h5></a>
            </div>
        </div>
        
        <?php } ?>
        
         <?php if(isset($_GET["msg"]))
		{ echo "<div class='row' id='notif'>
        	<div class='col-md-12 space noti'>";
			echo "<a id='clse' onClick='msgnoti();'><i class='glyphicon glyphicon-remove'></i></a>";
			
            	if(isset($_GET["msg"]) && $_GET["msg"] == 1) echo "<p class='text-success text-customize'>Contest is Added!</p>"; 
                else if(isset($_GET["msg"]) && $_GET["msg"] == 0) echo "<p class='text-danger text-customize'>An error occured. Try Again Later!</p>";
				else if(isset($_GET["msg"]) && $_GET["msg"] == 2) echo "<p class='text-success text-customize'>Contest deleted successfully!</p>";
				else if(isset($_GET["msg"]) && $_GET["msg"] == 3) echo "<p class='text-success text-customize'>Contest is updated!</p>";				 
            echo "</div>
        </div>";
		
		}
		echo "<script> showcontestdata(); </script>"
		?>
        
        <div class="row" id="dltemsg">
        	<div class="col-md-12 space noti">
             	<p class="text-info text-customize">Are you sure you want to delete this Contest?</p>
				
               <div class="col-md-4"></div>
               <div class="col-md-2">
                <form method="POST" name="delete-form" class="text-right" action="linkdb.php">
                	<input type="hidden" id="dltid" name="dltidn" value="0" />
                	<input type="submit" id="delte_sub" class="contest-button form-control space-bot" name="dltecon-submit" value="Yes" />
                </form>
                </div>
                <div class="col-md-2">
                	<button class="form-control contest-button space-bot" onClick="$('#dltemsg').hide();">No</button>
                </div>                
            </div>
        </div>
        
    <div class="row space" id="addcontest">
        	
            <div class="col-md-2"></div>
            <div class="col-md-8 contest">
        	<form class="form-group" name="contest-form" method="post" action="linkdb.php">
                    
                    <a onClick="$('#addcontest').hide();"><p class="text-right">Close</p></a>
                    
                    <h4 class="space-sm">Contest</h4>
                    <div class="line-full-gray"></div>
                    
                    <input class="form-control space-sm" name="ctitle" type="text" placeholder="Title" required>
                    <textarea class="form-control space-sm" name="objective" placeholder="Objective" required></textarea>
                    <textarea class="form-control space-sm" name="addinfo" placeholder="Additional Information" required></textarea>             
                    <input class="form-control space-sm" name="timer" type="text" placeholder="Contest Ending Time (mm/dd/yyyy 00:00:00)" required >       
                                                                                    
                    <div class="col-md-12 space">
                    </div>
                    
                    <h4>Things to keep in mind</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="fields-form">
                    <textarea class="form-control space-sm" name="field1" placeholder="Add Field # 1"></textarea>
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="addfield" onClick="addfield();">Add Field</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="remfield" onClick="remfield();">Remove Field</a></div>
                    <div class="col-md-12 space">
	               		<div class="line-full-gray"></div>
    	                <input class="form-control contest-button space-sm" name="consubmit" type="submit" value="Submit">
                    </div>
                                  
                    
                    </form>
                    </div>
        </div>
        
        <div class="row space" id="editcontest">
        </div>
        
        <div class="space"></div>
        
        <div class="row">
        	<div class="col-md-12 text-center">
            	<h3>Participate & Win - Hurry Up!</h3>
                <h5>Read the Objective and send your Recipes and tips according to it and Win exciting prizes.</h5>
            </div>
        </div>
        
        <div id="showcondata">
 
        </div>
        
        <div class="space"></div>
    </div>
</div>


<?php include "footer.php" ?>