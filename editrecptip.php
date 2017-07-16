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
        	<form class="form-group" autocomplete="off" name="editrecipe-form" action="linkdb.php" method="post" enctype="multipart/form-data">
                    
                    <a onClick="$('#editrecp').hide();"><p class="text-right">Close</p></a>
                    
                    <h4 class="space-sm">Edit Recipe</h4>
                    <div class="line-full-gray"></div>
                    
                    <?php
					  
					   if($connn_flag == 1)
					   {
						$query = "select * from recipe where recp_id = ".$_REQUEST["ripid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							$row1 = mysqli_fetch_assoc($result);														
						}
					   }
					?>
                    
                    <input class="form-control space-sm" name="title" type="text" placeholder="Title" value="<?php echo $row1["recp_title"];  ?>" required>
                    <textarea class="form-control space-sm" name="intro" type="text" placeholder="Something about the Recipe" required><?php echo $row1["recp_intro"];  ?></textarea>
                    <img id="eimg" class="space img-responsive" src="<?php echo $row1["recp_image"];  ?>" height="200">
                    <input type="file" name="imgrecipe" id="imgerecipe" onChange="readURL(this);" class="form-control space-sm">
                    
                    <select name="recptype" class="form-control space-sm">
                       <option value="">Choose Type</option>
                       <option value="free" <?php if($row1["recp_type"] == "free") echo "selected"; ?>>Free</option>
                       <option value="paid" <?php if($row1["recp_type"] == "paid") echo "selected"; ?>>Paid</option>
                    </select>                       
                    <h4 class="space">Ingredients</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="editingredients">
                    
 					<?php
					  
					   if($connn_flag == 1)
					   {
						$cnti  = 0;
						$query = "select * from ingredient where recp_id = ".$_REQUEST["ripid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($row2 = mysqli_fetch_assoc($result))
							{
								echo '<input class="form-control space-sm" name="uig'. $row2["ing_id"] .'" type="text" placeholder="Edit Ingredient" value="'. $row2["ing_detail"] .'">';
								$cnti++;
								
								echo '<input type="hidden" name="ugres[]" value="'. $row2["ing_id"]. '">';
							}
						}
						
						echo '<script>$edit_ing_var = '. $cnti .'</script>';
					   }
					?>                   
                    
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="addeing();">Add</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="remeing();">Remove</a></div>
                    
                    <div class="col-md-12 space">
                    </div>
                    
                    <h4>Directions</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="editdirections-form">
                    
                    <?php
					  
					   if($connn_flag == 1)
					   {
						$cntd  = 0;
						$query = "select * from direction where recp_id = ".$_REQUEST["ripid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($row3 = mysqli_fetch_assoc($result))
							{
								echo '<textarea rows="4" class="form-control space-sm" name="udr'. $row3["dir_id"].'" placeholder="Edit Direction">'. $row3["dir_detail"].'</textarea>';
								$cntd++;
								
								echo '<input type="hidden" name="drres[]" value="'. $row3["dir_id"]. '">';
							}
						}
						
						echo '<script>$edit_dir_var = '. $cntd .'</script>';
					   }
					?>   
                    
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="addedir();">Add</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" onClick="remedir();">Remove</a></div>
                    <div class="col-md-12 space">
	               		<div class="line-full-gray"></div>
                        <input type="hidden" name="countug" value="<?php echo $cnti; ?>" />
                        <input type="hidden" name="countdr" value="<?php echo $cntd; ?>" />
                        <input type="hidden" name="dataid" value="<?php echo $_REQUEST["ripid"]; ?>" />
    	                <input class="form-control contest-button space-sm" name="admineditrecpform" type="submit" value="Save">
                    </div>
                                  
                    
                    </form>
                    </div>
