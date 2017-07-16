<?php include "header.php"?>

<?php
	
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
						$query = "select * from recipe where recp_id = ".$_GET["recpid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							$rcpdtl = mysqli_fetch_assoc($result);														
						}
						else
						{
							header("Location: error.php");
						}
						
						if(isset($_SESSION["role"]) && $_SESSION["role"] == "guest" && $rcpdtl["recp_type"] == "paid")
						{
							header("Location: error.php");
						}
						
					   }
	
?>

<div class="space"></div>
<div class="container-fluid">
	<div class="container">
    	<div class="row">
        	<?php
				if(isset($_GET["search"]))
				{
			?>
        	<div class="col-md-12">
            	<a href="search.php?searchquery=<?php echo $_GET["search"]; ?>"><p><span class="glyphicon glyphicon-hand-left"></span> &nbsp;Back to Search Results</p></a>
            </div>
            
            <?php
				}
				else
				{
			?>
			<div class="col-md-12">
            	<a href="recipe.php"><p><span class="glyphicon glyphicon-hand-left"></span> &nbsp;Back to Recipe Section</p></a>
            </div>
            
            <?php } ?>
			
        	<div class="col-md-12 text-center">
            	<h1><?php echo $rcpdtl["recp_title"]; ?></h1>
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
                
        <div class="row space">
       	 	<div class="col-md-2"></div>
         	<div class="col-md-8">
            	<div class="col-md-12 contest">
                	<img src="<?php echo $rcpdtl["recp_image"]; ?>" class="img-responsive">
                </div>
              
                <div class="col-md-12">
                         
                    <p class="space-sm"><i>"<?php echo $rcpdtl["recp_intro"]; ?>"</i></p>
                    
                    <p>- recipe by James Thew</p>
                    
                    <div class="space-sm"></div>
                    
                    <h3>Ingredients</h3>
                    <div class="line-full-gray"></div>
                </div>
                
                <div class="col-md-12 space">
                	
                    <?php 
					
					if($connn_flag == 1)
					{
						$query = "select ing_detail from ingredient where recp_id = ".$_GET["recpid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($ingdtl = mysqli_fetch_assoc($result))
							{
                
							echo'<div class="col-md-6">
								<p>- '. $ingdtl["ing_detail"] . '</p>
							</div>';
							}
						}
					}
					?>
                    
                </div>
                
                <div class="col-md-12">
                	<h3>Directions</h3>
                    <div class="line-full-gray"></div>
                    
                    <ol id="directions" class="space text-justify">
                    	<?php 
					
					if($connn_flag == 1)
					{
						$query = "select dir_detail from direction where recp_id = ".$_GET["recpid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($dirdtl = mysqli_fetch_assoc($result))
							{
								echo'<li> '. $dirdtl["dir_detail"] . '</li>';
							}
						}
					}
					?>
                    </ol>
                    
                    <div class="line-full-gray space"></div>
                    <p class="text-center space-sm text-style">Enjoy the Recipe!</p>
                </div>
                
                <div class="col-md-12">
                
                	<h3>Review</h3> 
                    <div class="line-full-gray"></div> 
                    
                    <div class="space"></div>
                    <?php
					if(isset($_SESSION["role"]) && $_SESSION["role"] != "admin")
					{
					?>
                    <form name="review-form" method="post" action="linkdb.php">
                    	<input type="text" name="rname" placeholder="Name" class="form-control" value="<?php if(isset($_SESSION["user_name"])) echo $_SESSION["user_name"]; ?>" required <?php if(isset($_SESSION["guestlimit"])) echo "readonly"; ?>>
                        <input type="email" name="remail" placeholder="Email" class="form-control space-sm" value="<?php if(isset($_SESSION["userid"])) echo $_SESSION["userid"]; ?>" required <?php if(isset($_SESSION["guestlimit"])) echo "readonly"; ?>>
                        
                        <textarea rows="5" cols="1" placeholder="Enter your Review..." name="rreview" class="form-control space-sm" required></textarea>
                        <input type="hidden" name="rrid" value="<?php echo $_GET["recpid"]; ?>">
                        <input type="submit" value="Submit" name="reviewsubmit" class="form-control space-sm contest-button">
                       
                    </form> 
                    
                    <?php } ?> 
                    
                    
                     <?php
			
			if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin")
			{
				if($connn_flag == 1)
				{
						$cn = 1;
						$query = "select * from review where recp_id = ".$_GET["recpid"];
					
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
							
							echo '<div class="col-md-12">
								<div class="feedbackview">
									<p><i>"' . $fdbk["rev_detail"] .'"</i></p>
									<p class="space-sm"><b>' . $fdbk["name"] .'</b></p>
									<p>' . $fdbk["email"] .'</p>
								</div>
								<div class="space"></div>            	
								</div>';
							
							$cn++;
                       		 }
        
        				}
						else
						{
							echo "No review Found!";
						}
        		}
			}
        
  ?>      
                                
                	
                    <div class="space"></div>
                </div>
                                              
            </div>                   
        </div>
                
    </div>
</div>

<?php include "footer.php"?>