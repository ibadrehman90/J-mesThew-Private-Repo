<?php
 session_start();      
		   		$servername = "localhost";	$username = "root";	$password = "";	$databse = "jamesthew";
				
				$conn = mysqli_connect($servername,$username,$password,$databse);
				
				if(!$conn)
				{
					die("Connection Failed:".mysqli_connect_error());					
				}
				else
				{
					$count = 1;
					
					if(isset($_SESSION["role"]) && $_SESSION["role"] == "guest")
					{
						$query = "select * from recipe where recp_type = 'free'";
					}
					else
					{
						$query = "select * from recipe";
					}
					
					$result = mysqli_query($conn,$query);
					
					if(mysqli_num_rows($result) > 0)
					{
						echo "<div class='row space'>";
						while($row = mysqli_fetch_assoc($result))
						{	
							
							if($count == 4)
							{							
							echo "</div><div class='row space'>";
							$count = 1;
							}
                
                echo "<div class='col-md-4 col-sm-6 col-xs-12'>";
				
				if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin")
				{
                  echo "<div class='text-right'>
					<a onClick='editdata(".  $row["recp_id"] .");'><p class='fleft'><i class='glyphicon glyphicon-pencil'></i></p></a>
					<a href='#dltemsg' onClick='dlteid(1,". $row["recp_id"] .");'><p><i class='glyphicon glyphicon-remove'></i></p></a>
					</div>";
				}
					echo "<div class='recp'><a href='recipedetail.php?recpid=".  $row["recp_id"] ."'>
                        <div class='subrecp'>
                            <img src='". $row["recp_image"] ."' class="; if($count%2 == 0) echo 'centre-recipe'; else echo 'corner-recipe'; echo ">
                            <h4 class='text-center space-sm'>". $row["recp_title"] ."</h4>
                            <p class='font-12 text-justify space-sm'>". $row["recp_intro"] ."</p>
                            <div class='line-full-gray'></div>
                            
                            <img class='img-circle pad-sm' width='50' height='50' src='images/chef.png'>	<span class='font-12'>recipe by <b>James Thew</b></span>
                        </div></a>
                    </div>
                    <div class='space'></div>
                </div>
                
                "; 
				$count++;
						}
					}
				
				}

             ?>