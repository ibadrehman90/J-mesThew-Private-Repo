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


	<div class="col-md-2"></div>
            <div class="col-md-8 contest">
        	<form class="form-group" autocomplete="off" name="editcontest-form" method="post" action="linkdb.php">
                    
                    <a onClick="$('#editcontest').hide();"><p class="text-right">Close</p></a>
                    
                    <h4 class="space-sm">Edit Contest</h4>
                    <div class="line-full-gray"></div>
                    
                    <?php
					  
					   if($connn_flag == 1)
					   {
						$query = "select * from contest where con_id = ".$_REQUEST["cipid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							$con1 = mysqli_fetch_assoc($result);														
						}
						else
						{
							echo 'No Records Found';
						}
					   }
					?>
                    
                    <input class="form-control space-sm" name="ctitle" type="text" placeholder="Title" value="<?php echo $con1["con_title"];  ?>" required>
                    <textarea class="form-control space-sm" name="objective" placeholder="Objective" required><?php echo $con1["con_obj"]; ?></textarea>
                    <textarea class="form-control space-sm" name="addinfo" placeholder="Additional Information" required><?php echo $con1["con_intro"]; ?></textarea>             
                    <input class="form-control space-sm" name="timer" type="text" value="<?php echo $con1["end_time"];  ?>" placeholder="Contest Ending Time (mm/dd/yyyy 00:00:00)" required>       
                                                                                    
                    <div class="col-md-12 space">
                    </div>
                    
                    <h4>Things to keep in mind</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="editfields-form">
                    
                    <?php
					  
					   if($connn_flag == 1)
					   {
						$cntc  = 0;
						$query = "select * from things where con_id = ".$_REQUEST["cipid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($con2 = mysqli_fetch_assoc($result))
							{
								echo '<textarea class="form-control space-sm" name="ufl'. $con2["thing_id"] .'" placeholder="Add Field">'. $con2["thing_detail"] .'</textarea>';
								$cntc++;
								
								echo '<input type="hidden" name="ufres[]" value="'. $con2["thing_id"]. '">';
							}
						}
						else
						{
							echo 'No Records Found';
						}
						
						echo '<script>$edit_thing_var = '. $cntc .'</script>';
					   }
					?>   
                    
                    
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="addefield();">Add Field</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="remefield();">Remove Field</a></div>
                    <div class="col-md-12 space">
	               		<div class="line-full-gray"></div>
                        <input type="hidden" name="countuf" value="<?php echo $cntc; ?>" />
                        <input type="hidden" name="dataid" value="<?php echo $_REQUEST["cipid"]; ?>" />
    	                <input class="form-control contest-button space-sm" name="editconsubmit" type="submit" value="Save">
                    </div>
                                  
                    
                    </form>
                    </div>