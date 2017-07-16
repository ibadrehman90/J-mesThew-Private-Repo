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
						$query = "select * from contestdet where cd_id = ".$_GET["cdid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							$rcpdtl = mysqli_fetch_assoc($result);														
						}
						else
						{
							header("Location: error.php");
						}
						
				}
?>
        	
            
<div class="space"></div>
<div class="container-fluid">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<a href="contestdetail.php?conid=<?php echo $rcpdtl["con_id"]; ?>"><p><span class="glyphicon glyphicon-hand-left"></span> &nbsp;Back to Contest Details</p></a>
            </div>
        	<div class="col-md-12 text-center">
            	<h1><?php echo $rcpdtl["cd_title"]; ?></h1>
            </div>
            <div class="col-md-12">
            	<div class="line-full"></div>
            </div>
        </div>     
        <div class="space"></div>
                
        <div class="row space">
       	 	<div class="col-md-2"></div>
         	<div class="col-md-8">
            	
                <p class="text-customize"><?php echo $rcpdtl["cd_intro"]; ?></p>
                <div class="line-full-gray"></div>
                
                <?php
					
					if($connn_flag == 1)
					{
						$query = "select auth_image from auth where auth_email = '" . $rcpdtl["cd_email"] . "'";
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							$rcpimg = mysqli_fetch_assoc($result);														
						}
						
					}
				
				?>
                
                <img class='img-circle pad-sm' width='50' height='50' src='<?php 
				
					if(isset($rcpimg))
					{
						echo $rcpimg["auth_image"];
					}
					else
					{
						echo "images/maleprofilecircle2.jpg";
					}
				
				?>'><span> &nbsp;&nbsp;tip by <b><?php echo $rcpdtl["cd_name"]; ?></b></span>
                
                <?php
				
				if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin")
				{
					if($connn_flag == 1)
					{
						$query = "select win_id from contest where con_id = " . $rcpdtl["con_id"] . "";
					
						$res = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($res) > 0)
						{
							$rcpdt = mysqli_fetch_assoc($res);														
						}
						
					}
				
					?>
                
                		<form method="post" id="winnform" name="winn-form" action="linkdb.php">
                            <input type="hidden" id="winnid" name="winnidn" value="<?php echo $_GET["cdid"] ?>" />
                            <input type="hidden" id="winnconid" name="winnconidn" value="<?php echo $rcpdtl["con_id"]; ?>" />
                            
                            <div class="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php if($rcpdt["win_id"] == $_GET["cdid"]) echo "checked"; ?> onChange="winnerannounce();">
                                <label class="onoffswitch-label" for="myonoffswitch">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                            
                        </form>
                       
                        
                      <?php }  ?>
                
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>