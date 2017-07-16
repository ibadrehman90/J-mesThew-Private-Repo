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
				
				
?>


<div class="space"></div>
<div class="container-fluid">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>Results</h1>
            </div>
            <div class="col-md-12">
            	<div class="line-full"></div>
            </div>
        </div>     
        <div class="space"></div>
        
        <div class="row">
        	<div class="col-md-12">
            	
                <?php
				
				if($connn_flag == 1)
				{
						$query = "select * from contest inner join contestdet on contest.win_id = contestdet.cd_id";
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($rcpdtl = mysqli_fetch_assoc($result))
							{
								echo '<div class="result text-center">
									<h3>' . $rcpdtl["con_title"] . '</h3>
									<div class="line-full-gray"></div>
									<h5 class="space-sm">Contest - Winner</h5>';
									
									$qq = "select auth_image from auth where auth_email = '" . $rcpdtl["cd_email"] . "'";
					
									$rr = mysqli_query($conn,$qq);
									
									if(mysqli_num_rows($rr) > 0)
									{
										$rcpimg = mysqli_fetch_assoc($rr);														
									}
									
									echo '<img class="img-circle" width="100" height="100" src="';  
				
										if(isset($rcpimg))
										{
											echo $rcpimg['auth_image'];
										}
										else
										{
											echo "images/maleprofilecircle2.jpg";
										}
				
										echo '">
									
									<h4 class="space-sm">' . $rcpdtl["cd_name"] . '</h4>
									<h5 class="space-sm">' . $rcpdtl["cd_email"] . '</h5>
									<h5 class="space-sm">' . $rcpdtl["cd_type"] . '</h5>
								</div>';
				
							}
						}
						else
						{
							echo 'No Announcements yet!';
						}
						
				}
				
				
				?>
            </div>
            
            
        </div>
    </div>
</div>

<?php include "footer.php"?>