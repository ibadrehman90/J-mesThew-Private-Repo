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

<body id="homepage">
<?php
session_start();

if(!isset($_SESSION["role"]) && !isset($_SESSION["guestlimit"]))
{
	$_SESSION["role"] = "guest";
}
?>
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

<div class="container" id="jamesthewintro">
	<div class="row">
    	<div class="col-md-12 text-center">
        	<div class="img-circle" id="jamesPic"><img src="images/chef.png" class="img-circle" width="200" height="200"></div>
        </div>
        <div class="col-md-12 text-center">
        	<h1 class="damionfont">James Thew</h1>
        	<h5>Executive Chef</h5>
        </div>
        
        <div class="col-md-12 space text-justify">
        	<p class="text-customize">James Thew is one of the famous cook working in one of the five star hotels in the city. He is so famous that the publishers approach him to write recipes book, and provide some of the tips pertaining to the recipes, etc. Also some of the producers want him to work for their recipe shows where he needs to cook two or three recipes of different categories like juices, non-vegetarian and vegetarian recipes, Italian recipes, etc.</p>

<p class="text-customize">He actually loves cooking, and during his free time he spends his time by cooking and trying out new recipes that he had come across. He also wanted to conduct the cookery classes and share his recipes where he can interact with different people and can get their feedback. So he has started the classes near by his home, as a part-time job during the weekends, where people used to attend for learning the different varieties of recipes from him. He generally charges with very less fares for these weekend classes, so as to attract the maximum number of people to the classes.
</p>
        </div>
	</div>
</div>

<div class="container" id="searchbar">
	<div class="row space space-bot">
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
</div>

<?php include "footer.php" ?>