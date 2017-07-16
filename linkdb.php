<?php

$servername = "localhost";
$username = "root";
$password = "";
$databse = "jamesthew";
$con_flag = 0;

$conn = mysqli_connect($servername,$username,$password,$databse);

if(!$conn)
{
	die("Connection Failed:".mysqli_connect_error());
	$con_flag = 0;
}
else
{
	$con_flag = 1;	
}

//**************************************************************//

if(isset($_POST["adminrecpform"]) && $con_flag == 1)
{
	
	if(!empty($_FILES['imgrecipe']['name']))
	{
		$temp = explode(".", $_FILES["imgrecipe"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		
		$target = "uploads//".$newfilename;
	
		move_uploaded_file($_FILES["imgrecipe"]["tmp_name"],$target);
	}
	
	$values = '"'.$_POST['title'].'","'.$_POST['intro'].'","'.$target.'","'.$_POST['recptype'].'"';

	$query = "BEGIN;";
	$query .=  "insert into recipe(recp_title,recp_intro,recp_image,recp_type) values(". $values .");";
	$query .= "select LAST_INSERT_ID() INTO @lid;";
	
	foreach(array_keys($_POST) as $pst)
	{
		if(strpos($pst,'ing') !== FALSE)
		{
			$query .= "insert into ingredient(ing_detail,recp_id) values('". $_POST[$pst] . "',@lid);";
		}
		else if(strpos($pst,'dir') !== FALSE)
		{
			$query .= "insert into direction(dir_detail,recp_id) values('". $_POST[$pst] . "',@lid);";
		}
	}
    
	$query .= "COMMIT;";
	
 	if(mysqli_multi_query($conn,$query))
 	{
			echo 'data inserted';
			sleep(1);
			header("Location: recipe.php?msg=1");
	}
    else
	{
	  	    echo mysqli_error($conn);
			header("Location: recipe.php?msg=0");
	}	
	
}

//***************************************************************//

if(isset($_POST["admintipform"]) && $con_flag == 1)
{
	$values = '"'.$_POST['title'].'","'.$_POST['tipdet'].'","'.$_POST['tiptype'].'"';
	
	$query = "insert into tip(tip_title,tip_detail,tip_type) values(". $values .")";
	
	if(mysqli_query($conn,$query))
 	{
			echo 'data inserted';
			sleep(1);
			header("Location: recipe.php?msg=2");
	}
    else
	{
	  	    echo mysqli_error($conn);
			header("Location: recipe.php?msg=0");
	}
}

//***************************************************************//

if(isset($_POST["dlte-submit"]) && $con_flag == 1)
{
	if(strpos($_POST["dltidn"],"recp_id") !== FALSE)
	{
		$query = "delete from direction where ".$_POST["dltidn"].";";
		$query .= "delete from ingredient where ".$_POST["dltidn"].";";
		$query .= "delete from review where ".$_POST["dltidn"].";";
		$query .= "delete from recipe where ".$_POST["dltidn"].";";
		
		
		if(mysqli_multi_query($conn,$query))
		{
				echo 'data inserted';
				sleep(1);
				header("Location: recipe.php?msg=3");
		}
		else
		{
				echo mysqli_error($conn);
				header("Location: recipe.php?msg=0");
		}
	}
	else if(strpos($_POST["dltidn"],"tip_id") !== FALSE)
	{
		$query = "delete from tip where ".$_POST["dltidn"].";";
		
		if(mysqli_query($conn,$query))
		{
				echo 'query executed';
    			sleep(1);
				header("Location: recipe.php?msg=4");
		}
		else
		{
				echo mysqli_error($conn);
				header("Location: recipe.php?msg=0");
		}
	} 
	
}

//***************************************************************//

if(isset($_POST["admineditrecpform"]) && $con_flag == 1)
{

	$query = "BEGIN;";
	$query .= 'update recipe set recp_title = "' . $_POST["title"] . '", recp_intro = "'. $_POST["intro"] . '" , recp_type = "' . $_POST["recptype"] . '"' ;
	
	if(!empty($_FILES['imgrecipe']['name']))
	{
		$temp = explode(".", $_FILES["imgrecipe"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		
		$target = "uploads//".$newfilename;
	
		move_uploaded_file($_FILES["imgrecipe"]["tmp_name"],$target);
		
		$query .= ', recp_image = "'. $target . '"';
	}
	
	$query .= ' where recp_id = '. $_POST["dataid"] . ";";
	
	$ingarr = array();
	$inginsert = array();
	$ingdir = array();
	$dirinsert = array();
	
	foreach(array_keys($_POST) as $pst)
	{
		if(strpos($pst,'uig') !== FALSE)
		{
			array_push($ingarr,substr($pst,3));
		}
		else if(strpos($pst,'udr') !== FALSE)
		{
			array_push($ingdir,substr($pst,3));
		}
		else if(strpos($pst,'ing') !== FALSE)
		{
			array_push($inginsert,$pst);
		}
		else if(strpos($pst,'dir') !== FALSE)
		{
			array_push($dirinsert,$pst);
		}
	}
	
	$diffing = array_diff($_POST['ugres'],$ingarr);
    $sameing = array_intersect($_POST['ugres'],$ingarr);
	
	$diffdir = array_diff($_POST['drres'],$ingdir);
    $samedir = array_intersect($_POST['drres'],$ingdir);
	
	
	foreach($diffing as $i)
	{
		$query .= 'delete from ingredient where ing_id = '. $i . ';';
	}
		
	foreach($sameing as $i)
	{
		$query .= 'update ingredient set ing_detail = "'. $_POST["uig".$i] .'" where ing_id = '. $i . ';'; 
	}	
	
	foreach($inginsert as $i)
	{
		$query .= 'insert into ingredient (ing_detail,recp_id) values("' . $_POST[$i] . '",' . $_POST['dataid'] . ');';
	}
	
	
	
	foreach($diffdir as $i)
	{
		$query .= 'delete from direction where dir_id = '. $i . ';';
	}
		
	foreach($samedir as $i)
	{
		$query .= 'update direction set dir_detail = "'. $_POST["udr".$i] .'" where dir_id = '. $i . ';'; 
	}	
	
	foreach($dirinsert as $i)
	{
		$query .= 'insert into direction (dir_detail,recp_id) values("' . $_POST[$i] . '",' . $_POST['dataid'] . ');';
	}
	
	
	$query .= "COMMIT;";
	
	
	if(mysqli_multi_query($conn,$query))
	{
		echo $query;
		sleep(1);
		header("Location: recipe.php?msg=5");
	}
	else
	{
		echo mysqli_error($conn);
		header("Location: recipe.php?msg=0");
	}
}


//***************************************************************//

if(isset($_POST["adminedittipform"]) && $con_flag == 1)
{
	$query = 'Update tip set tip_title = "' . $_POST["tiptitle"] . '", tip_detail = "' . $_POST["tipdet"] . '" , tip_type = "' . $_POST["tiptype"] . '" where tip_id = '.$_POST["dataid"]; 
	
	if(mysqli_query($conn,$query))
	{
		echo $query;
		sleep(1);
		header("Location: recipe.php?msg=6");
	}
	else
	{
		echo mysqli_error($conn);
		header("Location: recipe.php?msg=0");
	}
}

//***************************************************************//

if(isset($_POST["reviewsubmit"]) && $con_flag == 1)
{
	$values = '"'.$_POST['rname'].'","'.$_POST['remail'].'","'.$_POST['rreview'].'","'.$_POST['rrid'].'"';
	
	$query = "insert into review(name,email,rev_detail,recp_id) values(". $values .")";
	
	if(mysqli_query($conn,$query))
 	{
			echo 'data inserted';
			header("Location: recipedetail.php?msg=1&recpid=".$_POST['rrid']);
	}
    else
	{
	  	    echo mysqli_error($conn);
			header("Location: recipedetail.php?msg=0&recpid=".$_POST['rrid']);
	}
}


//**************************************************************//

if(isset($_POST["consubmit"]) && $con_flag == 1)
{

	$values = '"'.$_POST['ctitle'].'","'.$_POST['objective'].'","'.$_POST['addinfo'].'","'.$_POST['timer'].'"';

	$query = "BEGIN;";
	$query .=  "insert into contest(con_title,con_obj,con_intro,end_time) values(". $values .");";
	$query .= "select LAST_INSERT_ID() INTO @lid;";
	
	foreach(array_keys($_POST) as $pst)
	{
		if(strpos($pst,'field') !== FALSE)
		{
			$query .= "insert into things(thing_detail,con_id) values('". $_POST[$pst] . "',@lid);";
		}
	}
    
	$query .= "COMMIT;";
	
 	if(mysqli_multi_query($conn,$query))
 	{
			echo 'data inserted';
			sleep(2);
			header("Location: contest.php?msg=1");
	}
    else
	{
	  	    echo mysqli_error($conn);
			header("Location: contest.php?msg=0");
	}	
	
}

//***************************************************************//

if(isset($_POST["dltecon-submit"]) && $con_flag == 1)
{
	
	
	    $query = "delete condirection from condirection inner join contestdet on condirection.cd_id = contestdet.cd_id where ".$_POST["dltidn"].";";
		$query .= "delete coningredient from coningredient inner join contestdet on coningredient.cd_id = contestdet.cd_id where ".$_POST["dltidn"].";";
		$query .= "delete from contestdet where ".$_POST["dltidn"].";";
  		$query .= "delete from things where ".$_POST["dltidn"].";";
		$query .= "delete from contest where ".$_POST["dltidn"].";";
		
		if(mysqli_multi_query($conn,$query))
		{
				echo 'query executed';
				sleep(2);
				header("Location: contest.php?msg=2");
		}
		else
		{
				echo mysqli_error($conn);
				header("Location: contest.php?msg=0");
		}	
}

//***************************************************************//

if(isset($_POST["editconsubmit"]) && $con_flag == 1)
{

	$query = "BEGIN;";
	$query .= 'update contest set con_title = "' . $_POST["ctitle"] . '", con_obj = "'. $_POST["objective"] . '", con_intro = "'. $_POST["addinfo"] . '", end_time = "'. $_POST["timer"] . '"';
	
	$query .= ' where con_id = '. $_POST["dataid"] . ";";
	
	$flarr = array();
	$flinsert = array();
	
	foreach(array_keys($_POST) as $pst)
	{
		if(strpos($pst,'ufl') !== FALSE)
		{
			array_push($flarr,substr($pst,3));
		}
		else if(strpos($pst,'field') !== FALSE)
		{
			array_push($flinsert,$pst);
		}
	}
	
	$difffl = array_diff($_POST['ufres'],$flarr);
    $samefl = array_intersect($_POST['ufres'],$flarr);	
	
	foreach($difffl as $i)
	{
		$query .= 'delete from things where thing_id = '. $i . ';';
	}
		
	foreach($samefl as $i)
	{
		$query .= 'update things set thing_detail = "'. $_POST["ufl".$i] .'" where thing_id = '. $i . ';'; 
	}	
	
	foreach($flinsert as $i)
	{
		$query .= 'insert into things (thing_detail,con_id) values("' . $_POST[$i] . '",' . $_POST['dataid'] . ');';
	}

	
	$query .= "COMMIT;";
	
	
	if(mysqli_multi_query($conn,$query))
	{
		echo $query;
		sleep(1);
		header("Location: contest.php?msg=3");
	}
	else
	{
		echo mysqli_error($conn);
		header("Location: contest.php?msg=0");
	}
}

//***************************************************************//

if(isset($_POST["fdbacksubmit"]) && $con_flag == 1)
{
	$values = '"'.$_POST['fname'].'","'.$_POST['femail'].'","'.$_POST['feedbk'].'"';
	
	$query = "insert into feedback(fb_name,fb_email,fb_detail) values(". $values .")";
	
	if(mysqli_query($conn,$query))
 	{
			echo 'data inserted';
			header("Location: feedback.php?msg=1");
	}
    else
	{
	  	    echo mysqli_error($conn);
			header("Location: feedback.php?msg=0");
	}
}

//**************************************************************//

if(isset($_POST["conrecpform"]) && $con_flag == 1)
{
  	$q = "select cd_id from contestdet where cd_email = '".$_POST["email"] . "' AND con_id = ".$_POST['cid'];
	
	$result = mysqli_query($conn,$q);
						
	if(mysqli_num_rows($result) > 0)
	{	
		header("Location: contestdetail.php?msg=2&conid=".$_POST['cid']);
	}
	else
	{
		if(!empty($_FILES['conimgrecipe']['name']))
		{
			$temp = explode(".", $_FILES["conimgrecipe"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			
			$target = "uploads//contest//".$newfilename;
		
			move_uploaded_file($_FILES["conimgrecipe"]["tmp_name"],$target);
		}
		else
		{
			$target = "";
		}
		
		$values = '"'.$_POST['cname'].'","'.$_POST['email'].'","recipe","'.$_POST['title'].'","'.$_POST['intro'].'","'.$target.'",'.$_POST['cid'].'';
	
		$query = "BEGIN;";
		$query .=  "insert into contestdet(cd_name,cd_email,cd_type,cd_title,cd_intro,cd_image,con_id) values(". $values .");";
		$query .= "select LAST_INSERT_ID() INTO @lid;";
		
		foreach(array_keys($_POST) as $pst)
		{
			if(strpos($pst,'ing') !== FALSE)
			{
				$query .= "insert into coningredient(ci_detail,cd_id) values('". $_POST[$pst] . "',@lid);";
			}
			else if(strpos($pst,'dir') !== FALSE)
			{
				$query .= "insert into condirection(cr_detail,cd_id) values('". $_POST[$pst] . "',@lid);";
			}
		}
		
		$query .= "COMMIT;";
		
		if(mysqli_multi_query($conn,$query))
		{
				echo 'data inserted';
				sleep(2);
				header("Location: contestdetail.php?msg=1&conid=".$_POST['cid'] . "&r=m1c".$_POST['cid']);
				
		}
		else
		{
				echo mysqli_error($conn);
				header("Location: contestdetail.php?msg=0&conid=".$_POST['cid']);
		}
	}
	
}

//***************************************************************//

if(isset($_POST["contipform"]) && $con_flag == 1)
{
	$q = "select cd_id from contestdet where cd_email = '".$_POST["email"] . "' AND con_id = ".$_POST['cid'];
	echo $q;
	$result = mysqli_query($conn,$q);
						
	if(mysqli_num_rows($result) > 0)
	{				
		header("Location: contestdetail.php?msg=2&conid=".$_POST['cid']);		
	}
	else
	{
		$values = '"'.$_POST['cname'].'","'.$_POST['email'].'","tip","'.$_POST['title'].'","'.$_POST['tipdet'].'",'.$_POST['cid'].'';
		
		$query =  "insert into contestdet(cd_name,cd_email,cd_type,cd_title,cd_intro,con_id) values(". $values .");";
		
		if(mysqli_query($conn,$query))
		{
				echo $query.'data inserted';
				sleep(1);
				header("Location: contestdetail.php?msg=1&conid=".$_POST['cid']);
		}
		else
		{
				echo mysqli_error($conn);
				header("Location: contestdetail.php?msg=0&conid=".$_POST['cid']);
		}
	}
}


//***************************************************************//

if(isset($_POST["registersubmit"]) && $con_flag == 1)
{
	$q = "select * from auth where auth_email = '".$_POST["email"]."'";
	
	$result = mysqli_query($conn,$q);
						
	if(mysqli_num_rows($result) > 0)
	{	
		header("Location: account.php?msg=2");
	}
	else
	{
		
		$values = '"'.$_POST['email'].'","'.$_POST['password'].'","'.$_POST['fname']. " ".$_POST['lname'].'","member","images/profile.png","'.$_POST['membership'].'"';
		
		$query =  "insert into auth(auth_email,auth_password,auth_name,auth_role,auth_image,ms_id) values(". $values .");";
		
		if(mysqli_query($conn,$query))
		{
				echo 'data inserted';
				header("Location: account.php?msg=1");
		}
		else
		{
				echo mysqli_error($conn);
				header("Location: account.php?msg=0");
		}
	}
}

//***************************************************************//

if(isset($_POST["loginsubmit"]) && $con_flag == 1)
{
	$q = "Select auth_name,auth_password,auth_role from auth where auth_email = '".$_POST["email"]."'";	
	
	$result = mysqli_query($conn,$q);
	
	if(mysqli_num_rows($result) > 0)
	{
		while($r = mysqli_fetch_assoc($result))
		{
			$pass = $r["auth_password"];
			$role = $r["auth_role"];
			$name = $r["auth_name"];
		}
		
		if($pass == $_POST["password"])
		{
			session_start();
			$_SESSION["role"] = $role;
			$_SESSION["userid"] = $_POST["email"];
			$_SESSION["user_name"] = $name;
			$_SESSION["guestlimit"] = 1;
			
			header("Location: userprofile.php?msg=2");
			
		}
		else
		{
			header("Location: account.php?msg=3");
		}
	}
	else
	{
		header("Location: account.php?msg=3");
	}
}

//***************************************************************//

if(isset($_POST["profileupdatesubmit"]) && $con_flag == 1)
{

	$query = 'update auth set auth_name = "' . $_POST["name"] . '", auth_password = "'. $_POST["password"] .'"';
	
	if(isset($_SESSION["role"]) && $_SESSION["role"] != "admin")
	{
		$query .= ', ms_id = '.$_POST["membership"];
	}
	
	if(!empty($_FILES['profilepic']['name']))
	{
		$temp = explode(".", $_FILES["profilepic"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		
		$target = "uploads//userprofile//".$newfilename;
	
		move_uploaded_file($_FILES["profilepic"]["tmp_name"],$target);
		
		$query .= ', auth_image = "'. $target . '"';
	}
	
	$query .= ' where auth_email = "' . $_POST["email"] . '"';
	
		if(mysqli_query($conn,$query))
		{
				echo 'data inserted';
				sleep(1);
				header("Location: userprofile.php?msg=1");
		}
		else
		{
				echo mysqli_error($conn);
				header("Location: userprofile.php?msg=0");
		}
	
}


//***************************************************************//

if(isset($_POST["memeditrecpform"]) && $con_flag == 1)
{

	$query = "BEGIN;";
	$query .= 'update contestdet set cd_title = "' . $_POST["title"] . '", cd_intro = "'. $_POST["intro"] . '"';
	
	if(!empty($_FILES['conimgrecipe']['name']))
	{
		$temp = explode(".", $_FILES["conimgrecipe"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		
		$target = "uploads//contest//".$newfilename;
	
		move_uploaded_file($_FILES["conimgrecipe"]["tmp_name"],$target);
		
		$query .= ', cd_image = "'. $target . '"';
	}
	
	$query .= ' where cd_id = '. $_POST["dataid"] . ";";
	
	$ingarr = array();
	$inginsert = array();
	$ingdir = array();
	$dirinsert = array();
	
	foreach(array_keys($_POST) as $pst)
	{
		if(strpos($pst,'cuig') !== FALSE)
		{
			array_push($ingarr,substr($pst,4));
		}
		else if(strpos($pst,'cudr') !== FALSE)
		{
			array_push($ingdir,substr($pst,4));
		}
		else if(strpos($pst,'cing') !== FALSE)
		{
			array_push($inginsert,$pst);
		}
		else if(strpos($pst,'cdir') !== FALSE)
		{
			array_push($dirinsert,$pst);
		}
	}
	
	$diffing = array_diff($_POST['cugres'],$ingarr);
    $sameing = array_intersect($_POST['cugres'],$ingarr);
	
	$diffdir = array_diff($_POST['cdrres'],$ingdir);
    $samedir = array_intersect($_POST['cdrres'],$ingdir);
	
	
	foreach($diffing as $i)
	{
		$query .= 'delete from coningredient where ci_id = '. $i . ';';
	}
		
	foreach($sameing as $i)
	{
		$query .= 'update coningredient set ci_detail = "'. $_POST["cuig".$i] .'" where ci_id = '. $i . ';'; 
	}	
	
	foreach($inginsert as $i)
	{
		$query .= 'insert into coningredient (ci_detail,cd_id) values("' . $_POST[$i] . '",' . $_POST['dataid'] . ');';
	}
	
	
	
	foreach($diffdir as $i)
	{
		$query .= 'delete from condirection where cr_id = '. $i . ';';
	}
		
	foreach($samedir as $i)
	{
		$query .= 'update condirection set cr_detail = "'. $_POST["cudr".$i] .'" where cr_id = '. $i . ';'; 
	}	
	
	foreach($dirinsert as $i)
	{
		$query .= 'insert into condirection (cr_detail,cd_id) values("' . $_POST[$i] . '",' . $_POST['dataid'] . ');';
	}
	
	
	$query .= "COMMIT;";
	
	
	if(mysqli_multi_query($conn,$query))
	{
		echo $query;
		sleep(2);
		header("Location: contestdetail.php?msg=3&conid=".$_POST['dataconid'] . "&r=m3c".$_POST['dataconid']);
	}
	else
	{
		echo mysqli_error($conn);
		header("Location: contestdetail.php?msg=0&conid=".$_POST['dataconid']);
	}
}


//***************************************************************//

if(isset($_POST["memdlte-submit"]) && $con_flag == 1)
{
	if(strpos($_POST["dltidn"],"cd_id") !== FALSE)
	{
		$query = "delete from condirection where ".$_POST["dltidn"].";";
		$query .= "delete from coningredient where ".$_POST["dltidn"].";";
		$query .= "delete from contestdet where ".$_POST["dltidn"].";";
		
		if(mysqli_multi_query($conn,$query))
		{
				echo 'data inserted';
				sleep(2);
				header("Location: contestdetail.php?msg=4&conid=".$_POST["sendidn"] . "&r=m4c".$_POST["sendidn"]);
		}
		else
		{
				echo mysqli_error($conn);
				header("Location: contestdetail.php?msg=0&conid=".$_POST["sendidn"]);
		}
	}	
}

//***************************************************************//

if(isset($_POST["memedittipform"]) && $con_flag == 1)
{
	$query = 'Update contestdet set cd_title = "' . $_POST["tiptitle"] . '", cd_intro = "' . $_POST["tipdet"] . '" where cd_id = '.$_POST["dataid"]; 	 
	
	if(mysqli_query($conn,$query))
	{
		echo $query;
		sleep(1);
		header("Location: contestdetail.php?msg=5&conid=".$_POST["datasendid"]);
		
	}
	else
	{
		echo mysqli_error($conn);
		header("Location: contestdetail.php?msg=0conid=".$_POST["datasendid"]);
	}
}

//***************************************************************//

if(isset($_POST["winarr"]) && $con_flag == 1)
{
	if($_POST["winarr"] == "true")
	{
		$query = 'update contest set win_id = ' . $_POST["winid"] . ' where con_id = ' . $_POST["winconid"];
	}
	else
	{
		$query = 'update contest set win_id = 0 where con_id = ' . $_POST["winconid"];
	}
	
	if(mysqli_query($conn,$query))
	{
		$str = "success";	
	}
	else
	{
		$str = mysqli_error($conn);
	}
	
	echo json_encode($str);
}

?>