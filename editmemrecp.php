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
        	
            
            <div class="col-md-12 contest">
        	<form class="form-group" autocomplete="off" name="editmemrecipe-form" action="linkdb.php" method="post" enctype="multipart/form-data">
                    
                    <a onClick="$('#editmemrecp').hide();$('#ownpartrecipe').show();"><p class="text-right">Close</p></a>
                    
                    <h4 class="space-sm">Edit Recipe</h4>
                    <div class="line-full-gray"></div>
                    
                    <?php
					  
					   if($connn_flag == 1)
					   {
						$query = "select * from contestdet where cd_id = ".$_REQUEST["ripid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							$row1 = mysqli_fetch_assoc($result);														
						}
					   }
					?>
                    
                    <input class="form-control space-sm" name="title" type="text" placeholder="Title" value="<?php echo $row1["cd_title"];  ?>" required>
                    <textarea class="form-control space-sm" name="intro" type="text" placeholder="Something about the Recipe" required><?php echo $row1["cd_intro"];  ?></textarea>
                    
                     <img id="coneimg" class="space img-responsive" src="<?php echo $row1["cd_image"];  ?>" height="200">
                    <input type="file" name="conimgrecipe" id="conimgerecipe" onChange="readconURL(this);" class="form-control space-sm">
                                                                
                    <h4 class="space">Ingredients</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="editmemingredients">
                    
 					<?php
					  
					   if($connn_flag == 1)
					   {
						$cnti  = 0;
						$query = "select * from coningredient where cd_id = ".$_REQUEST["ripid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($row2 = mysqli_fetch_assoc($result))
							{
								echo '<input class="form-control space-sm" name="cuig'. $row2["ci_id"] .'" type="text" placeholder="Edit Ingredient" value="'. $row2["ci_detail"] .'">';
								$cnti++;
								
								echo '<input type="hidden" name="cugres[]" value="'. $row2["ci_id"]. '">';
							}
						}
						
						echo '<script>$edit_cing_var = '. $cnti .'</script>';
					   }
					?>                   
                    
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="addcing();">Add</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="remcing();">Remove</a></div>
                    
                    <div class="col-md-12 space">
                    </div>
                    
                    <h4>Directions</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="editmemdirections-form">
                    
                    <?php
					  
					   if($connn_flag == 1)
					   {
						$cntd  = 0;
						$query = "select * from condirection where cd_id = ".$_REQUEST["ripid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($row3 = mysqli_fetch_assoc($result))
							{
								echo '<textarea rows="4" class="form-control space-sm" name="cudr'. $row3["cr_id"].'" placeholder="Edit Direction">'. $row3["cr_detail"].'</textarea>';
								$cntd++;
								
								echo '<input type="hidden" name="cdrres[]" value="'. $row3["cr_id"]. '">';
							}
						}
						
						echo '<script>$edit_cdir_var = '. $cntd .'</script>';
					   }
					?>   
                    
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="addcdir();">Add</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="remcdir();">Remove</a></div>
                    <div class="col-md-12 space">
	               		<div class="line-full-gray"></div>
                        <input type="hidden" name="countcug" value="<?php echo $cnti; ?>" />
                        <input type="hidden" name="countcdr" value="<?php echo $cntd; ?>" />
                        <input type="hidden" name="dataid" value="<?php echo $_REQUEST["ripid"]; ?>" />
                        <input type="hidden" name="dataconid" value="<?php echo $row1["con_id"]; ?>" />
    	                <input class="form-control contest-button space-sm" name="memeditrecpform" type="submit" value="Save">
                    </div>
                                  
                    
                    </form>
                    </div>
