<?php

session_start();
date_default_timezone_set('Asia/Karachi');	
		if(isset($_SESSION["tme"]))
		{
			$str = $_SESSION["tme"];
			$arr = explode('|',$str);
			$finaltime = array();
			
			$dteStart = new DateTime(); 
			
			foreach($arr as $a)
			{
				if($a != "")
				{
					$strEnd   = $a;				
					$dteEnd   = new DateTime($strEnd);
					$dteDiff  = $dteStart->diff($dteEnd); 
					$result = $dteDiff->format("%H:%I:%S");
					
					if($dteStart > $dteEnd)
					{
						$result = "00:00:00";
					}
					
					array_push($finaltime,$result);
				}
			}
			
			echo json_encode($finaltime);	
			
									
		}
	
?>