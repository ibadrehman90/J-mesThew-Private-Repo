<?php include "header.php"?>


<div class="space"></div>
<div class="container-fluid">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>Feedback</h1>
            </div>
            <div class="col-md-12">
            	<div class="line-full"></div>
            </div>
        </div>     
        <div class="space"></div>
        
        <?php if(isset($_GET["msg"]))
		{ echo "<div class='row' id='notif'>
        	<div class='col-md-12 space noti'>";
			echo "<a id='clse' onClick='msgnoti();'><i class='glyphicon glyphicon-remove'></i></a>";
			
            	if(isset($_GET["msg"]) && $_GET["msg"] == 1) echo "<p class='text-success text-customize'>Feedback submitted!</p>"; 
                else if(isset($_GET["msg"]) && $_GET["msg"] == 0) echo "<p class='text-danger text-customize'>An error occured. Try Again Later!</p>";				 
            echo "</div>
        </div>";
		
		}?>
        
        <?php
			   	
				if(isset($_SESSION["role"]) && $_SESSION["role"] != "admin")
				{
			   
		?>
		
			
        <div class="row space">
        	<div class="col-md-12 text-center">
            	<p>Kindly provide with your valuable Feedback so that we can bring everything upto your need!</p>
            </div>
        </div>
        
        <div class="row space">
        	<div class="col-md-3"></div>
        	<div class="col-md-6">
				<div class="feedback">
                	<form id="feedback-form" method="post" action="linkdb.php">
                    	<input type="text" class="form-control" placeholder="Name" name="fname" value="<?php if(isset($_SESSION["user_name"])) echo $_SESSION["user_name"]; ?>" required <?php if(isset($_SESSION["guestlimit"])) echo "readonly"; ?>>
                       	<input type="text" class="form-control space-sm" placeholder="Email" name="femail" value="<?php if(isset($_SESSION["userid"])) echo $_SESSION["userid"]; ?>" required <?php if(isset($_SESSION["guestlimit"])) echo "readonly"; ?>>
                        <textarea rows="5" cols="1" class="form-control space-sm" placeholder="Feedback" name="feedbk"></textarea>
                        <input type="submit" class="form-control contest-button space-sm" name="fdbacksubmit" value="Submit">
                    </form>
                <div class="space"></div>
                </div>    
        	
            </div>
        </div>
        
        <?php } ?>
        
        <?php
			
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin")
			{
				$servername = "localhost";	$username = "root";	$password = "";	$databse = "jamesthew";
				
				$conn = mysqli_connect($servername,$username,$password,$databse);
				
				if(!$conn)
				{
					die("Connection Failed:".mysqli_connect_error());					
					$connn_flag = 0;
				}
				else
				{
					$connn_flag = 1;								
				}
	

        	 	if($connn_flag == 1)
				{
						$cn = 1;
						$query = "select * from feedback";
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
						echo '<div class="row space">';
													
							while($fdbk = mysqli_fetch_assoc($result))
							{																			
							
							if($cn == 3)
							{
								echo '</div><div class="row space">';
								$cn = 1;
							}
							
							echo '<div class="col-md-6">
								<div class="feedbackview">
									<p><i>"' . $fdbk["fb_detail"] .'"</i></p>
									<p class="space-sm"><b>' . $fdbk["fb_name"] .'</b></p>
									<p>' . $fdbk["fb_email"] .'</p>
								</div>
								<div class="space"></div>            	
								</div>';
							
							$cn++;
                       		 }
        
        				}
						else
						{
							echo 'No Feedback found!';
						}
        		}
			}
        
  ?>      
    </div>
</div>

<?php include "footer.php"?>