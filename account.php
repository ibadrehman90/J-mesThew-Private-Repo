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
}



?>

<div class="space"></div>
<div class="container-fluid">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>Login/Register</h1>
            </div>
            <div class="col-md-12">
            	<div class="line-full"></div>
            </div>
        </div>     
        <div class="space-sm"></div>
        
         <?php if(isset($_GET["msg"]))
		{ echo "<div class='row' id='notif'>
        	<div class='col-md-12 space-sm noti'>";
			echo "<a id='clse' onClick='msgnoti();'><i class='glyphicon glyphicon-remove'></i></a>";
			
            	if(isset($_GET["msg"]) && $_GET["msg"] == 1) echo "<p class='text-success text-customize'>Registered Succesfully! Log In to Continue!</p>"; 
                else if(isset($_GET["msg"]) && $_GET["msg"] == 0) echo "<p class='text-danger text-customize'>An error occured. Try Again Later!</p>";
				else if(isset($_GET["msg"]) && $_GET["msg"] == 2) echo "<p class='text-danger text-customize'>The Email entered is already registered!</p>";
				else if(isset($_GET["msg"]) && $_GET["msg"] == 3) echo "<p class='text-danger text-customize'>Invalid Email or Password!</p>";
				else if(isset($_GET["msg"]) && $_GET["msg"] == 4) echo "<p class='text-success text-customize'>Logged In</p>";				 
            echo "</div>
        </div>";
		
		}?>
        
        <div class="row space">
        	<div class="col-md-6">
				<div class="account">
                	<h3>Login</h3>
                    <div class="line-full-gray"></div>
                    <p class="space-sm">Sign In if you are already Registered!</p>
                    <div class="space-sm"></div>
                	<form id="login-form" method="post" action="linkdb.php">
                    	<input type="text" class="form-control" placeholder="Email" name="email" required>
                       	<input type="password" class="form-control space-sm" placeholder="Password" name="password" required>
                        <input type="submit" class="form-control contest-button space-sm" name="loginsubmit" value="Login">
                    </form>                   
                </div> 
            </div>
        	<div class="col-md-6">
				<div class="account">
	                <h3>Register</h3>
                    <div class="line-full-gray"></div>
                    <p class="space-sm">Get Registered!</p>
                    <div class="space-sm"></div>
                	<form id="register-form" method="post" action="linkdb.php">
                    	<input type="text" class="form-control" placeholder="First Name" name="fname" required>
                        <input type="text" class="form-control space-sm" placeholder="Last Name" name="lname" required>
                       	<input type="text" class="form-control space-sm" placeholder="Email" name="email" required>
                        <input type="password" class="form-control space-sm" placeholder="Password" name="password" required>
                        <!--<input type="password" class="form-control space-sm" placeholder="Confirm Password" name="password" required>-->
                        <div class="space-sm"></div>
                        
                        <select name="membership" class="form-control" required>
                        	<option value="">Choose Membership</option>
                        <?php 
							if($con_flag == 1)
							{
								
								$result = mysqli_query($conn,"Select * from membership");
								
								if(mysqli_num_rows($result) > 0)
								{
									while($res = mysqli_fetch_assoc($result))
									{									
					
                            		echo '<option value="'. $res["ms_id"] .'">'. $res["ms_title"] .'</option>';  
                        	
									}
								}
							}
						?>
                        
                        </select>
                        
                        <input type="submit" class="form-control contest-button space-sm" name="registersubmit" value="Register">
                    </form>
              
                </div> 
            </div>
        </div>
        <div class="space"></div>
    </div>
</div>

<?php include "footer.php"?>