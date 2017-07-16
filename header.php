<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>JamesThew.com</title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">


<script src="js/jquery-1.9.1.min.js"></script>
</head>

<body>
<?php
session_start();

if(!isset($_SESSION["role"]) && !isset($_SESSION["guestlimit"]))
{
	$_SESSION["role"] = "guest";
}
?>
<div class="wrapper container-fluid">

<div class="container-fluid navigation-bg-rest">
	<div class="container">
    <div class="row">
        	<div class="col-md-3">
            	<a href="index.php"><img src="images/jamesthewlogo.png" width="250" height="75"></a>
            </div>
            <div class="col-md-9">
            	<nav role="navigation" class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collection of nav links and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right" id="main_menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="recipe.php">Recipes/Tips</a></li>
                    <li><a href="contest.php">Contests</a></li>                    
                    <li><a href="announcement.php">Announcements</a></li>                                        
                    <li><a href="feedback.php">Feedback</a></li>
                    <li><a href="faq.php">FAQs</a></li>
                    
                    <?php
					 
					if(!isset($_SESSION["role"]) || $_SESSION["role"] == "guest")
					{ 
                    	echo '<li><a href="account.php">Login/Register</a></li>';
					}
					else
					{
                    	echo '<li><a href="userprofile.php">Profile</a></li>';
						echo '<li><a href="logout.php">Logout</a></li>';
					}
					
					?>
                </ul>
            </div>
    		</nav>
            </div>
    </div>
	</div>
</div>

<div class="space"></div>

<div class="container" id="searchbar">
	<div class="row space">
    	<div class="col-md-12 text-center">
        	<h1>Search Recipes/Tips Online</h1>
        </div>
        <div class="col-md-3 col-sm-2 col-xs-1"></div>
        <div class="col-md-6 col-sm-8 col-md-10 space">
        	<form name="search" method="get" id="searchform" class="form-group" action="search.php">
            	<input type="text" name="searchquery" id="querysearch" class="form-control searchbox" placeholder="e.g. Chicken Toast">
            </form>
        </div>
        <div class="col-md-3 col-sm-2 col-xs-1"></div>        
    </div>
    
    <div class="space-big"></div>
</div>

</div>

