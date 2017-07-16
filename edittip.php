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
            	<form class="form-group" name="edittip-form" method="post" action="linkdb.php"  autocomplete="off">
                    <a onClick="$('#edittip').hide();"><p class="text-right">Close</p></a>                       
                    <h4>Edit Tip</h4>
                    <div class="line-full-gray"></div>

                    <?php 
					
						if($connn_flag == 1)
					   {
						$query = "select * from tip where tip_id = ".$_REQUEST["tipid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							$tiprow = mysqli_fetch_assoc($result);														
						}	
					   }
					?>
                    
                    <input class="form-control space-sm" name="tiptitle" type="text" value="<?php echo $tiprow["tip_title"]; ?>" placeholder="Add Title" required>
                    
                    <textarea class="form-control space-sm" rows="5" name="tipdet" placeholder="Tip Details" required><?php echo $tiprow["tip_detail"]; ?></textarea>
                    
                    
                    <select name="tiptype" class="form-control space-sm">
                       <option value="">Choose Type</option>
                       <option value="free" <?php if($tiprow["tip_type"] == "free") echo "selected"; ?>>Free</option>
                       <option value="paid" <?php if($tiprow["tip_type"] == "paid") echo "selected"; ?>>Paid</option>
                    </select>
                    
                    <div class="col-md-12 space">
	               		<div class="line-full-gray"></div>
                        <input type="hidden" name="dataid" value="<?php echo $_REQUEST["tipid"]; ?>" />
    	                <input class="form-control contest-button space-sm" name="adminedittipform" type="submit" value="Save">
                    </div>
                    </form>
            </div>