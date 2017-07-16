<?php include "header.php"; ?>

<div class="space"></div>
<div class="container-fluid">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>Recipes/Tips</h1>
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
            	<a onClick="addrecp();"><h5>Add New Recipe</h5></a>
            </div>
            <div class="col-md-2 space-sm text-center">
            	<a onClick="addtip();"><h5>Add New Tip</h5></a>
            </div>
        </div>
        
        <?php } ?>
        
        <?php if(isset($_GET["msg"]))
		{ echo "<div class='row' id='notif'>
        	<div class='col-md-12 space-sm noti'>";
			echo "<a id='clse' onClick='msgnoti();'><i class='glyphicon glyphicon-remove'></i></a>";
			
            	if(isset($_GET["msg"]) && $_GET["msg"] == 1) echo "<p class='text-success text-customize'>Recipe has been Added!</p>"; 
                else if(isset($_GET["msg"]) && $_GET["msg"] == 0) echo "<p class='text-danger text-customize'>An error occured. Try Again Later!</p>";
				else if(isset($_GET["msg"]) && $_GET["msg"] == 2) echo "<p class='text-success text-customize'>Tip has been Added!</p>"; 
				else if(isset($_GET["msg"]) && $_GET["msg"] == 3) echo "<p class='text-success text-customize'>Recipe is been deleted!</p>"; 
				else if(isset($_GET["msg"]) && $_GET["msg"] == 4) echo "<p class='text-success text-customize'>Tip is been deleted!</p>"; 
				else if(isset($_GET["msg"]) && $_GET["msg"] == 5) echo "<p class='text-success text-customize'>Recipe is updated!</p>"; 
				else if(isset($_GET["msg"]) && $_GET["msg"] == 6) echo "<p class='text-success text-customize'>Tip is updated!</p>"; 
            echo "</div>
        </div>";
		
		}
		
		echo "<script> showrcipedata(); </script>"
		
		?>
        
        <div class="row" id="dltemsg">
        	<div class="col-md-12 space noti">
             	<p class="text-info text-customize">Are you sure you want to delete this</p>
				
               <div class="col-md-4"></div>
               <div class="col-md-2">
                <form method="POST" name="delete-form" class="text-right" action="linkdb.php">
                	<input type="hidden" id="dltid" name="dltidn" value="0" />
                	<input type="submit" id="delte_sub" class="contest-button form-control space-bot" name="dlte-submit" value="Yes" />
                </form>
                </div>
                <div class="col-md-2">
                	<button class="form-control contest-button space-bot" onClick="$('#dltemsg').hide();">No</button>
                </div>                
            </div>
        </div>
        
   
        
        <div class="row space" id="addrecp">
        	
            <div class="col-md-2"></div>
            <div class="col-md-8 contest">
        	<form class="form-group" autocomplete="off" name="recipe-form" method="post" action="linkdb.php" enctype="multipart/form-data">
                    
                    <a onClick="$('#addrecp').hide();"><p class="text-right">Close</p></a>
                    
                    <h4 class="space-sm">Recipe</h4>
                    <div class="line-full-gray"></div>
                    
                    <input class="form-control space-sm" name="title" type="text" placeholder="Title" required>
                    <input class="form-control space-sm" name="intro" type="text" placeholder="Something about the Recipe" required>
                    <input type="file" name="imgrecipe" id="imgrecipe" class="form-control space-sm"  required>
                    <select name="recptype" class="form-control space-sm">
                       <option value="">Choose Type</option>
                       <option value="free">Free</option>
                       <option value="paid">Paid</option>
                    </select>          
                                            
                    <h4 class="space">Ingredients</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="ingredients">
                    <input class="form-control space-sm" name="ing1" type="text" placeholder="Add Ingredient # 1">
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="adding" onClick="adding();">Add Field</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="reming" onClick="reming();">Remove Field</a></div>
                    
                    <div class="col-md-12 space">
                    </div>
                    
                    <h4>Directions</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="directions-form">
                    <textarea class="form-control space-sm" name="dir1" placeholder="Add Direction # 1"></textarea>
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="adddir" onClick="adddir();">Add Field</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="remdir" onClick="remdir();">Remove Field</a></div>
                    <div class="col-md-12 space">
	               		<div class="line-full-gray"></div>
    	                <input class="form-control contest-button space-sm" name="adminrecpform" type="submit" value="Submit">
                    </div>
                                  
                    
                    </form>
                    </div>
        </div>
        
         <div class="row space" id="addtip">
        	
            <div class="col-md-2"></div>
            <div class="col-md-8 contest">
            	<form class="form-group" name="tip-form" method="post" action="linkdb.php"  autocomplete="off">
                    <a onClick="$('#addtip').hide();"><p class="text-right">Close</p></a>                       
                    <h4>Tip</h4>
                    <div class="line-full-gray"></div>
          
                    <input class="form-control space-sm" name="title" type="text" placeholder="Add Title" required>
                    
                    <textarea class="form-control space-sm" rows="5" name="tipdet" placeholder="Tip Details" required></textarea>
                    <select name="tiptype" class="form-control space-sm">
                       <option value="">Choose Type</option>
                       <option value="free">Free</option>
                       <option value="paid">Paid</option>
                    </select>
                    <div class="col-md-12 space">
	               		<div class="line-full-gray"></div>
    	                <input class="form-control contest-button space-sm" name="admintipform" type="submit" value="Submit">
                    </div>
            </div>
         </div>
         
         <div class="row space-sm" id="editrecp">
         </div>
         
         <div class="row space-sm" id="edittip">
         </div>
        
        <div class="space-sm"></div>
        <div class="row text-center" id="menurecp">
        	<a href="#menurecp" onClick="showrecp();"><div class="col-md-6 col-sm-6 col-xs-6 act" id="recipemenu">
            	<h4>Recipes</h4>
                <div class="line-full-gray"></div>
            </div></a>
            <a href="#menurecp" onClick="showtip();"><div class="col-md-6 col-sm-6 col-xs-6" id="tipsmenu">
            	<h4>Tips</h4>
                <div class="line-full-gray"></div>
            </div></a>
        </div>
        
        <div id="recipe-section">
        </div>
        
        
        <div id="tip-section">
            <div class="row space">
            <?php
			
			  	$servername = "localhost";	$username = "root";	$password = "";	$databse = "jamesthew";
				
				$conn = mysqli_connect($servername,$username,$password,$databse);
				
				if(!$conn)
				{
					die("Connection Failed:".mysqli_connect_error());					
				}
				else
				{
					if(isset($_SESSION["role"]) && $_SESSION["role"] == "guest")
					{
						$query = "select * from tip where tip_type = 'free'";
					}
					else
					{
						$query = "select * from tip";
					}
					
					$result = mysqli_query($conn,$query);
					
					if(mysqli_num_rows($result) > 0)
					{
						while($row = mysqli_fetch_assoc($result))
						{
							 echo "<div class='col-md-12 tips'>";
							 
				 	if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin")
					{
					  echo "<div class='text-right'>;
							<a onClick='edittipdata(". $row["tip_id"] .");'><p class='fleft'><i class='glyphicon glyphicon-pencil'></i></p></a>
							<a onClick='dlteid(2,". $row["tip_id"] .");'><p><i class='glyphicon glyphicon-remove'></i></p></a>
					  </div>";
					}
						echo "<h5><b>". $row["tip_title"] ."</b></h5>
						<p>". $row["tip_detail"] ."</p>
						<div class='line-full-gray'></div>
									
									<img class='img-circle pad-sm' width='50' height='50' src='images/chef.png'>	<span class='font-12'> &nbsp;&nbsp;tip by <b>James Thew</b></span>
					  </div>
					  ";
						}
					}
					
				}
              
			 
			?>
            </div>
        </div>
        
        <div class="space"></div>
        
    </div>
</div>

<?php include "footer.php"; ?>