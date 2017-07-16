<?php include "header.php"?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$databse = "jamesthew";
$con_flag = 0;

$conn = mysqli_connect($servername,$username,$password,$databse);

if(!$conn)
{
	die("Connection Failed:".mysqli_connect_error());
	$con_flag = 0;
}
else
{
	$con_flag = 1;
	
	$query = "select * from auth inner join membership on auth.ms_id = membership.ms_id where auth_email = '" .$_SESSION["userid"]."'";	
	
	$result = mysqli_query($conn,$query);
	
	if(mysqli_num_rows($result) > 0)
	{
		$auth  = mysqli_fetch_assoc($result);
	}
}

?>

<div class="space"></div>
<div class="container-fluid">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>Profile</h1>
            </div>
            <div class="col-md-12">
            	<div class="line-full"></div>
            </div>
            <div class="col-md-2 space-sm text-center">
            	<a onClick="editprofile();"><h5>Edit Profile</h5></a>
            </div>
        </div>     
        <div class="space-sm"></div>
        
        <?php if(isset($_GET["msg"]))
		{ echo "<div class='row' id='notif'>
        	<div class='col-md-12 noti'>";
			echo "<a id='clse' onClick='msgnoti();'><i class='glyphicon glyphicon-remove'></i></a>";
			
            	if(isset($_GET["msg"]) && $_GET["msg"] == 1) echo "<p class='text-success text-customize'>Profile updated!</p>"; 
                else if(isset($_GET["msg"]) && $_GET["msg"] == 0) echo "<p class='text-danger text-customize'>An error occured. Try Again Later!</p>";				 
				else if(isset($_GET["msg"]) && $_GET["msg"] == 2) echo "<p class='text-success text-customize'>You are now Logged In!";			
            echo "</div>
        </div>";
		
		}?>
        
        <div class="row space-sm" id="viewprofile">
        	<div class="col-md-2"></div>
        	<div class="col-md-8 profile">
            
            	<div class="row img-circle text-center">
                	<img src="<?php echo $auth["auth_image"]; ?>" class="img-circle" width="200" height="200">
                </div>
            	
                <div class="space"></div>
                
               <div class="row">
                <div class="col-md-4">
                	<h4><b>Name:</b></h4>
                </div>
                
		        <div class="col-md-8">
                	<h4><?php echo $auth["auth_name"]; ?></h4>
                </div>                
               </div>
               
               <div class="row">
                <div class="col-md-4">
                	<h4><b>Email:</b></h4>
                </div>
                
		        <div class="col-md-8">
                	<h4><?php echo $auth["auth_email"]; ?></h4>
                </div>                
               </div>
               
               <div class="row">
                <div class="col-md-4">
                	<h4><b>Password:</b></h4>
                </div>
                
		        <div class="col-md-8">
                	<h4>*********</h4>
                </div>                
               </div>
               
               <?php
			   	
				if(isset($_SESSION["role"]) && $_SESSION["role"] != "admin")
				{
			   
			   ?>
               
               <div class="row">
                <div class="col-md-4">
                	<h4><b>Membership:</b></h4>
                </div>
                
		        <div class="col-md-8">
                	<h4><?php echo $auth["ms_title"]; ?></h4>
                </div>                
               </div>
               
               <?php } ?>
               
				<div class="space"></div>
            </div>
        </div>
        
        <div class="row" id="editprofile">
        	<div class="col-md-2"></div>
        	<div class="col-md-8 profile">
            <form name="profiledit" method="post" action="linkdb.php" enctype="multipart/form-data"  autocomplete="off">
            	<div class="row img-circle text-center">
                
                	<div class="col-md-12">
                		<img id="pimg" src="<?php echo $auth["auth_image"]; ?>" class="img-circle" width="200" height="200">
                    </div>
                    
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                    	<input class="form-control space-sm" type="file" id="profilepic" name="profilepic" onChange="readURLprofile(this);">
                    </div>
                </div>
            	
                <div class="space"></div>
                
               <div class="row">
                <div class="col-md-4">
                	<h4><b>Name:</b></h4>
                </div>
                
		        <div class="col-md-8">
                	<h4 class="h4input"><input class="form-control" type="text" name="name" value="<?php echo $auth["auth_name"]; ?>"></h4>
                </div>                
               </div>
               
               <div class="row">
                <div class="col-md-4">
                	<h4><b>Email:</b></h4>
                </div>
                
		        <div class="col-md-8">
                	<h4 class="h4input"><input class="form-control" type="text" name="email" value="<?php echo $auth["auth_email"]; ?>"></h4>
                </div>                
               </div>
                              
               <div class="row">
                <div class="col-md-4">
                	<h4><b>Password:</b></h4>
                </div>
                
		        <div class="col-md-8">
                	<h4 class="h4input"><input class="form-control" type="password" name="password"></h4>
                </div>                
               </div>
               
                <?php
			   	
				if(isset($_SESSION["role"]) && $_SESSION["role"] != "admin")
				{
			   
			    ?>
               <div class="row">
                <div class="col-md-4">
                	<h4><b>Membership:</b></h4>
                </div>                
               
		        <div class="col-md-8">
                	<h4 class="h4input"><select name="membership" class="form-control">
                        	<option value="">Choose Membership</option>
                        <?php 
							if($con_flag == 1)
							{
								
								$result = mysqli_query($conn,"Select * from membership");
								
								if(mysqli_num_rows($result) > 0)
								{
									while($res = mysqli_fetch_assoc($result))
									{									
					
                            			echo '<option value="'. $res["ms_id"] .'" '; if($res["ms_id"] == $auth["ms_id"]) echo 'selected'; echo '>'. $res["ms_title"] .'</option>';  
                        	
									}
								}
							}
						?>
                        
                        </select></h4>
                </div> 
                
                               
               </div>
               <?php } ?>
               <div class="row">
               	<div class="col-md-6 space-sm">
                	<input type="submit" class="form-control contest-button" name="profileupdatesubmit" value="Update">
                </div>
                <div class="col-md-6 space-sm">
                	<input type="button" class="form-control contest-button" value="Cancel" onClick="viewprofile();">
                </div>
               </div>
               
               <div class="space"></div>
			 </form>
            </div>
        </div>
        
    </div>
</div>

<?php include "footer.php"?>