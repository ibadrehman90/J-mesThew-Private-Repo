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
					$cn = 0;
					$tdata = array();
					
					$query = "select * from contest";
					
					
					$result = mysqli_query($conn,$query);
					
					if(mysqli_num_rows($result) > 0)
					{
						echo "<div class='row space'>";
						while($condtl = mysqli_fetch_assoc($result))
						{	
							
							if($count == 3)
							{							
							echo "</div><div class='row space'>";
							$count = 1;
							}
						
							echo	"<div class='col-md-6'>";

			
				if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin")
				{
		 			echo "<div class='text-right'>
					<a onClick='editcondata(". $condtl["con_id"] .");'><p class='fleft'><i class='glyphicon glyphicon-pencil'></i></p></a>
					<a onClick='dltecon(". $condtl["con_id"] .");'><p><i class='glyphicon glyphicon-remove'></i></p></a>
					</div>";
				}
            		echo "<div class='contest' id='con". $condtl["con_id"] ."'>
                    <h2>Contest # "; echo $count; echo " <i class='glyphicon "; if($condtl["end_time"] != "00:00:00"){ $str = "Participate"; echo "glyphicon-ok-circle'";} else { $str = "View"; echo "glyphicon-remove-circle'";} echo "></i></h2>
                    <div class='line-full'></div>
                    <h4 class='space-sm'>" . $condtl["con_title"] . "</h4>
                    <p>" . $condtl["con_obj"] . "</p>
                    <h1 class='text-center' id='timer" . $cn . "'>00:00:00</h1>
					<a href='contestdetail.php?conid=". $condtl["con_id"] ."'><button class='form-control space-sm contest-button'>"; echo $str; echo "</button></a>
               		</div>
            		</div>";
						
						array_push($tdata,$condtl["end_time"]);
			
						$count++;
						$cn++;
						}
					}
				
				}
				
				$strs = "";
				foreach($tdata as $value)
				{
					$strs .= $value ."|";
				}
				
				$_SESSION["tme"] = $strs;
				
				
 ?>
 
 <script src="js/timingscript.js" type="text/javascript"></script>
 
 