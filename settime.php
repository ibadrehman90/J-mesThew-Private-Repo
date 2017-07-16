<?php

				$servername = "localhost";	$username = "root";	$password = "";	$databse = "jamesthew";
				date_default_timezone_set('Asia/Karachi');
				$conn = mysqli_connect($servername,$username,$password,$databse);
				
				if(!$conn)
				{
					die("Connection Failed:".mysqli_connect_error());					
					$connn_flag = 0;
				}
				else
				{
					$q = "select con_id,end_time from contest";								
					
					$result = mysqli_query($conn,$q);
					
					
						if(mysqli_num_rows($result) > 0)
						{
							while($con1 = mysqli_fetch_assoc($result))
							{								
								if($con1["end_time"] != "00:00:00")
								{														
									$strEnd   = $con1["end_time"];
									$dteStart = new DateTime();							 
									$dteEnd   = new DateTime($strEnd);
									 
																
									if($dteStart > $dteEnd)
									{
										$q = "update contest set end_time = '00:00:00' where con_id = " .$con1["con_id"];
										
										if(mysqli_query($conn,$q))
										{
											echo 'done';
										}
										else
										{
											echo mysqli_error($conn);
										}
									}
								}
								
							}
						}
						else
						{
							echo 'No Records Found';
						}
				}

?>