<?php include "header.php" ?>


<div class="space"></div>
<div class="container-fluid">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1>Search Results</h1>
            </div>
            <div class="col-md-12">
            	<div class="line-full"></div>
            </div>
        </div>     
        <div class="space-sm"></div>
        
        <div class="row space-bot">
        	
            <?php
			
			  	$servername = "localhost";	$username = "root";	$password = "";	$databse = "jamesthew";
				
				$conn = mysqli_connect($servername,$username,$password,$databse);
				
				if(!$conn)
				{
					die("Connection Failed:".mysqli_connect_error());					
				}
				else
				{
					
					if(isset($_SESSION["role"]) && $_SESSION["role"] == "guest")
					{
						$query = "select 'tip' as tb,tip_id as id,tip_title as title,tip_detail as detail from tip where tip_title LIKE '%" . $_GET["searchquery"] . "%' && tip_type = 'free' union all select 'recipe' as tb,recp_id as id, recp_title as title,recp_intro as detail from recipe where recp_title LIKE '%" . $_GET["searchquery"] . "%' && recp_type = 'free'";
					}
					else
					{
						$query = "select 'tip' as tb,tip_id as id,tip_title as title,tip_detail as detail from tip where tip_title LIKE '%" . $_GET["searchquery"] . "%' union all select 'recipe' as tb,recp_id as id, recp_title as title,recp_intro as detail from recipe where recp_title LIKE '%" . $_GET["searchquery"] . "%'";
					}
					
					$result = mysqli_query($conn,$query);
					
					if(mysqli_num_rows($result) > 0)
					{
						while($row = mysqli_fetch_assoc($result))
						{
						
						if($row["tb"] == "recipe")
						{
							echo "<a class='searchanchor' href='recipedetail.php?search=" . $_GET["searchquery"] . "&recpid=".  $row["id"] ."'>";
						}
							 echo "<div class='col-md-12 tips'>";
					
						echo "<h5><b>". $row["title"] ."</b></h5>
						<p>". $row["detail"] ."</p>
						<div class='line-full-gray'></div>
									
									<img class='img-circle pad-sm' width='50' height='50' src='images/chef.png'>	<span class='font-12'> &nbsp;&nbsp;". $row["tb"] ." by <b>James Thew</b></span>
					  </div>
					  ";
					  
					  if($row["tb"] == "recipe")
					  {
						echo "</a>";	
					  }
					  
						}
					}
					else
					{
						header("Location: error.php");
					}
					
				}
              
			 
			?>
            
        </div>
        
    </div>
</div>



<?php include "footer.php" ?>