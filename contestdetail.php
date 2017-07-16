<?php include "header.php"?>

<?php
	
			
			if(isset($_GET["r"]))
			{
				$ms = substr($_GET["r"],1,1);
				$cd = substr($_GET["r"],3);
				
				header("Location: contestdetail.php?msg=".$ms."&conid=".$cd);
			}
	
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
						$query = "select * from contest where con_id = ".$_GET["conid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							$cndtl = mysqli_fetch_assoc($result);														
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
            	<a href="contest.php"><p><span class="glyphicon glyphicon-hand-left"></span> &nbsp;Back to Contest</p></a>
            </div>
        
        	<div class="col-md-12  text-center">
            	<h1><?php echo $cndtl["con_title"] ?><h4>Contest - <?php if ($cndtl["end_time"] == "00:00:00") echo 'Inactive'; else echo 'Active'; ?></h4></h1>
            </div>
            <div class="col-md-12">
            	<div class="line-full"></div>
            </div>
        </div>     
        <div class="space-sm"></div>
        
        <?php if(isset($_GET["msg"]))
		{ echo "<div class='row' id='notif'>
        	<div class='col-md-12 space noti'>";
			echo "<a id='clse' onClick='msgnoti();'><i class='glyphicon glyphicon-remove'></i></a>";
			
            	if(isset($_GET["msg"]) && $_GET["msg"] == 1) echo "<p class='text-success text-customize'>Recipe/Tip submitted!</p>"; 
                else if(isset($_GET["msg"]) && $_GET["msg"] == 0) echo "<p class='text-danger text-customize'>An error occured. Try Again Later!</p>";
				else if(isset($_GET["msg"]) && $_GET["msg"] == 2) echo "<p class='text-danger text-customize'>The Email entered has already participated!</p>";
				else if(isset($_GET["msg"]) && $_GET["msg"] == 3) echo "<p class='text-success text-customize'>Recipe is Updated!</p>";
				else if(isset($_GET["msg"]) && $_GET["msg"] == 4) echo "<p class='text-danger text-customize'>Recipe is deleted!</p>";				 				else if(isset($_GET["msg"]) && $_GET["msg"] == 5) echo "<p class='text-success text-customize'>Tip is Updated!</p>";
            echo "</div>
        </div>";
		
		}?>
        
        <div class="row space">
        	<div class="col-md-1"></div>
        	<div class="col-md-10 contestdet">
            	<h2 class="text-center"><?php echo $cndtl["end_time"] ?></h2>
                <div class="line-full-gray"></div>
            
            	<h4><b>Objective : </b></h4>
                <p class="text-justify"><?php echo $cndtl["con_obj"] ?></p>
                
                <h4 class="space-sm"><b>Additional Information : </b></h4>
                <p class="text-justify"><?php echo $cndtl["con_intro"] ?></p>
                
                <h4 class="space-sm"><b>Things to keep in mind : </b></h4>
                <ol id="things" class="text-justify">
                    	<?php 
					
					if($connn_flag == 1)
					{
						$query = "select thing_detail from things where con_id = ".$_GET["conid"];
					
						$result = mysqli_query($conn,$query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($thdtl = mysqli_fetch_assoc($result))
							{
								echo'<li> '. $thdtl["thing_detail"] . '</li><br>';
							}
						}
					}
					?>
                    </ol>
              
              <div class="line-full-gray space"></div>
              
              <div class="row" id="dltemsg">
        	<div class="col-md-12 space noti">
             	<p class="text-info text-customize">Are you sure you want to delete this</p>
				
               <div class="col-md-4"></div>
               <div class="col-md-2">
                <form method="POST" name="delete-form" class="text-right" action="linkdb.php">
                	<input type="hidden" id="dltid" name="dltidn" value="0" />
                    <input type="hidden" id="sendconid" name="sendidn" value="0" />
                	<input type="submit" id="delte_sub" class="contest-button form-control space-bot" name="memdlte-submit" value="Yes" />
                </form>
                </div>
                <div class="col-md-2">
                	<button class="form-control contest-button space-bot" onClick="$('#dltemsg').hide();">No</button>
                </div>                
            </div>
        	</div>
    
                            
              <?php
			  	
				if(isset($_SESSION["role"]) && $_SESSION["role"] == "member" && $cndtl["end_time"] != "00:00:00")
				{
					if($connn_flag == 1)
					{
						$sel = mysqli_query($conn,"select * from contestdet where cd_email = '" . $_SESSION["userid"] . "' AND con_id = ".$_GET["conid"]);
						
						if(mysqli_num_rows($sel) > 0)
						{
							$limit = 1;
							
							$data = mysqli_fetch_assoc($sel);
							
							if($data["cd_type"] == "recipe")
							{
							
				?>		
                          
             				<h4 class="space-sm"><b>Your Participation!</b></h4>
                			<div class="col-md-12 feedbackview space">
                                <div id="ownpartrecipe" class="ownpart">
                    				<p class="font-20 space-sm"><?php echo $data["cd_title"]; ?></p>
                    				<div class="line-full-gray space-bot"></div>
                                    <img src="<?php echo $data["cd_image"]; ?>" class="img-responsive">
                                    
                                    <p class="space-sm"><i>"<?php echo $data["cd_intro"]; ?>"</i></p>
                                    
                                    <p>- recipe by <b><?php echo $data["cd_name"]; ?></b></p>
                                    
                                    <div class="space-sm"></div>
                                    
                                    <h3>Ingredients</h3>
                                    <div class="line-full-gray space-bot"></div>
                               			<div class="col-md-12">
                                    <?php
									
									$res = mysqli_query($conn,"select ci_detail from coningredient where cd_id = " . $data["cd_id"]);
									
									if(mysqli_num_rows($res) > 0 )
									{
										while($ings = mysqli_fetch_assoc($res))
										{
									   		echo "	<div class='col-md-6'>
                                                	<p>- " . $ings["ci_detail"] . "</p>
                                    			</div>";
										}
									}
									
									?>
                                    </div>
                                    <h3>Directions</h3>
                                    <div class="line-full-gray"></div>
                                    
                                    <ol id="directions" class="space text-justify">
                                    	
                                    <?php
									
									$res = mysqli_query($conn,"select cr_detail from condirection where cd_id = " . $data["cd_id"]);
									
									if(mysqli_num_rows($res) > 0 )
									{
										while($ings = mysqli_fetch_assoc($res))
										{
									   		echo "<li>" . $ings["cr_detail"] . "</li>";
										}
									}
									
									?>    
                                        
                                    </ol>
                             
                   <p class="text-right"><a href="#editmemrecp" onClick="editmemrecpdata(<?php echo $data["cd_id"]; ?>);">Edit</a> | <a href="#dltemsg" onClick='dltememid(1,<?php echo $data["cd_id"].",",$data["con_id"]; ?>);'>Delete</a></p>
                        	
                                
                               </div>
                            </div>
                            
                <?php
							}
							
							else if ($data["cd_type"] == "tip")
							{
			    ?><h4 class="space-sm"><b>Your Participation!</b></h4>
                			<div class="col-md-12 feedbackview space">
                                <div id="ownparttip" class="ownpart">
                                                                         
                                  <div class='col-md-12'>
                                    <p class="font-20"><?php echo $data["cd_title"]; ?></p>
                                    <div class='line-full-gray'></div>
                                    <p class="space-sm"><i>"<?php echo $data["cd_intro"]; ?>"</i></p>
                           			<p>- tip by <b><?php echo $data["cd_name"]; ?></b></p>    
                                    
                                    <br>
                                    
                                    <p class="text-right"><a onClick="editmemtipdata(<?php echo $data["cd_id"]; ?>);">Edit</a> | <a onClick='dltememid(2,<?php echo $data["cd_id"].",",$data["con_id"]; ?>);'>Delete</a></p>
                                                   
                    			  </div>
                       		    </div>
                      			</div>
                            
				<?php
							}
			    ?>

			 	
                <?php		}
						else
						{
							echo mysqli_error($conn);
							$limit = 0;
						}
					}
				}
				
				if(isset($limit) && $limit == 0 || $_SESSION["role"] == "guest" && $cndtl["end_time"] != "00:00:00")
				{
			  ?>
              
             <div id="participate" class="space col-md-12"> 
              <h4><b>Willing to Participate?</b></h4>
              <p class="text-justify">Submit your recipe or tip according to the above guidelines.</p>
              
             
              	<a href="#conrecipe-section" onClick="showrecp();"><div class="col-md-6 col-sm-6 col-xs-6 text-center act" id="recipemenu">
            	<h4>Recipe</h4>
                <div class="line-full-gray"></div>
            	</div></a>
                
            	<a href="#contip-section" onClick="showtip();"><div class="col-md-6 col-sm-6 col-xs-6 text-center" id="tipsmenu">
            	<h4>Tip</h4>
                <div class="line-full-gray"></div>
           		</div></a>
              
               <br><br>
               
               <div id="conrecipe-section" class="col-md-12 space-sm">
                	
                    <form class="form-group" id="contestrecipeform" name="contestrecipe-form" method="post" action="linkdb.php" autocomplete="off" enctype="multipart/form-data">
                    
                    <h4 class="space-sm">Contestant Information</h4>
                    <div class="line-full-gray"></div>
                    
                    <input class="form-control space-sm" name="cname" type="text" placeholder="Name" value="<?php if(isset($_SESSION["user_name"])) echo $_SESSION["user_name"]; ?>" required <?php if(isset($_SESSION["guestlimit"])) echo "readonly"; ?>>
                    <input class="form-control space-sm" name="email" type="text" placeholder="Email" value="<?php if(isset($_SESSION["userid"])) echo $_SESSION["userid"]; ?>" required <?php if(isset($_SESSION["guestlimit"])) echo "readonly"; ?>>
                    
                    <h4 class="space-sm">Recipe</h4>
                    <div class="line-full-gray"></div>
                    
                    <input class="form-control space-sm" name="title" type="text" placeholder="Title" required>
                    <input class="form-control space-sm" name="intro" type="text" placeholder="Something about the Recipe" required>
                    <input type="file" name="conimgrecipe" id="conimgrecipe" class="form-control space-sm"  required>
                                            
                    <h4>Ingredients</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="ingredients">
                    <input class="form-control space-sm" name="ing1" type="text" placeholder="Add Ingredient # 1">
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="adding" onClick="adding();">Add</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="reming" onClick="reming();">Remove</a></div>
                    
                    <div class="col-md-12 space">
                    </div>
                    
                    <h4>Directions</h4>
                    <div class="line-full-gray"></div>
                    
                    <div id="directions-form">
                    <textarea class="form-control space-sm" name="dir1" placeholder="Add Direction # 1"></textarea>
                    </div>
                    
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="adddir" onClick="adddir();">Add</a></div>
                    <div class="col-md-6">
                    <a class="form-control space-sm field-button text-center" id="remdir" onClick="remdir();">Remove</a></div>
                    <div class="col-md-12 space">
	               		<div class="line-full-gray"></div>
                        <input type="hidden" name="cid" value="<?php echo $_GET["conid"] ?>">
    	                <input class="form-control contest-button space-sm" name="conrecpform" type="submit" value="Submit">
                    </div>
                                  
                    
                    </form>
                    
                </div>
                
                <div id="contip-section">
                	
                    <form class="form-group" autocomplete="off" name="contesttip-form" method="post" action="linkdb.php">
                    <br>
                    <h4 class="space">Contestant Information</h4>
                    <div class="line-full-gray"></div>
                    
                    <input class="form-control space-sm" name="cname" type="text" placeholder="Name" value="<?php if(isset($_SESSION["user_name"])) echo $_SESSION["user_name"]; ?>" required <?php if(isset($_SESSION["guestlimit"])) echo "readonly"; ?>>
                    <input class="form-control space-sm" name="email" type="text" placeholder="Email" value="<?php if(isset($_SESSION["userid"])) echo $_SESSION["userid"]; ?>" required <?php if(isset($_SESSION["guestlimit"])) echo "readonly"; ?>>                        
                    <h4>Tip</h4>
                    <div class="line-full-gray"></div>
          
                    <input class="form-control space-sm" name="title" type="text" placeholder="Add Title" required>
                    
                    <textarea class="form-control space-sm" rows="5" name="tipdet" placeholder="Tip Details" required></textarea>
                    
                    <div class="col-md-12 space">
	               		<div class="line-full-gray"></div>
                        <input type="hidden" name="cid" value="<?php echo $_GET["conid"] ?>">
    	                <input class="form-control contest-button space-sm" name="contipform" type="submit" value="Submit">
                    </div>
                 </form>
                 
                </div>
              </div>
              
              <?php } ?>
              
              
              
              <div id="editmemrecp">
              </div>
              
              <div id="editmemtip">
              </div>
              
              
              <?php
			  
			  if($cndtl["end_time"] == "00:00:00" || $_SESSION["role"] == "admin")
			  {
				  ?>
              <div id="contestdata" class="col-md-12">
					
                    <h4><b>Contest Participation</b></h4>
                    <div class="line-full"></div>
                    
                    <div class="space"></div>
                   
                    
                    <table class="table">
                    	
                        <thead>
                        <tr>
                        	<td class="bor-updown">Title</td>
                        	<td class="bor-updown">Type</td>                                                      
                        </tr>
                        </thead>
                        
                       <?php
							
							if($connn_flag == 1)
							{
								
								$q = "select * from contestdet where con_id = ".$_GET["conid"];
								
								$res = mysqli_query($conn,$q);
								
								if(mysqli_num_rows($res) > 0)
								{
									while($data = mysqli_fetch_assoc($res))
									{
										echo '<tr>
											<td class="bor-updown"><a class="anchorblack" href="'; if($data['cd_type'] == "recipe") echo "showmemrecp.php"; else if($data['cd_type'] == "tip") echo "showmemtip.php";  echo'?cdid='. $data['cd_id'] . '"><b>' . $data['cd_title'] . '</b> - by ' . $data['cd_name'] . '</a></td>
											<td class="bor-updown">' . $data['cd_type'] . '</td>											
										</tr>';
									}
								}
								else
								{
									echo '<tr><td>No records Found!</td></tr>';
								}
							}
						?>
                    </table>
              </div>
              
              <?php } ?>
              
              
              
              
            </div>
            
        </div>
        
        <div class="space"></div>
        
    </div>
</div>

<?php include "footer.php"?>