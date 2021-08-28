<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<?php
if($usr['Admin'] == "false"){
	header('location:/maintenance.html');
}

ob_start();
	$mysqli = new mysqli("server306.web-hosting.com","rainmfma_rainway","BlwS,kblHl~V","rainmfma_database");
		global $mysqli;	
		

	
	$shoutquery = $mysqli->query("SELECT * FROM `shout`");
		$shout = $shoutquery->fetch_array();
			$shoutmsg = $shout['shout'];
				$shouterid = $shout['shouter'];
					$shouterquery = $mysqli->query("SELECT * FROM `accounts` WHERE `id`='$shouterid'");
       						 $shouter = $shouterquery->fetch_array();
 
		function thetime()
			{
				$thetime = getdate();
				print_r($thetime);
			}

  				$logged = false;
  					 if($_COOKIE['username'] && $_COOKIE['password']){
     			 			 $username = strip_tags($_COOKIE['username']);
        		 				 $password = strip_tags($_COOKIE['password']);
        							$usrquery = $mysqli->query("SELECT * FROM `accounts` WHERE `password`='$password'");
        							$usr = $usrquery->fetch_array();
        								if($usr != 0){
             								 $logged = true;
             									}
    									}
    										$uID = $usr['id'];
    										$timey = time();
    										$timer = $timey -  $usr['status'];
    										$mysqli->query("UPDATE `accounts` SET `status`='$timey' WHERE `id`='$uID'");
    										if($timer < 20) {
    											$mysqli->query("UPDATE `accounts` SET `isstatus`='true' WHERE `id`='$uID'");
    										}
    										else{	
    											$mysqli->query("UPDATE `accounts` SET `isstatus`='false' WHERE `id`='$uID'");
    										}
    											
    											
    											
    	$numpmcheck = $mysqli->query("SELECT * FROM `messages` WHERE `toid`='$uID'");
	    $numpm = $numpmcheck->num_rows;
	    
	    $invnumpmcheck = $mysqli->query("SELECT * FROM `invitekey` WHERE `creatorid`='$uID'");
	    $invkeycount = $invnumpmcheck->num_rows;
    										
// Daily Currency
$now = time();
$gettc = $usr['gettc'];
$Bucks = $usr['Bucks'];
if ($now > $gettc) {
$newgettc = $now + 86400;
$BucksToAdd = 25; // Bucks to add every day - Codex
$mysqli->query("UPDATE `accounts` SET `Bucks` = '$Bucks' + '$BucksToAdd' WHERE `id`='$uID'");
$mysqli->query("UPDATE `accounts` SET `gettc` = '$newgettc' WHERE `id`='$uID'");
}
?>
<html>
	<head>
	<title>Rainway</title>
		<link href="/img/favicon.ico" rel="icon" type="image/x-icon" />
		<!-- <script src="/snowstorm.js"></script> -->
        <script src="https://kit.fontawesome.com/245de4e6af.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="/major.css">
		<link rel="stylesheet" type="text/css" href="/major2.css">
		<link rel="stylesheet" type="text/css" href="/major3.js">
		<script>$('button').click(function() {
    $(this).prop('disabled',true);
});</script>
<head>
	<?php
    						if($usr['banned'] == "1"){
    							header('Location: /banned.php');
    						}

    	?>
<!-- BEGIN NAVBAR REWRITE -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
      <img src="https://rainway.xyz/img/logonew.png" width="100"  class="d-inline-block align-top" alt="">
     
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/Games/">Games</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="/Forum/">Forum</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/Browse/">Browse</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/Catalog/">Catalog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/Avatar/?tab=avatar">Avatar</a>
      </li>
      
      <a class="nav-link" href="#"><i class="far fa-money-bill-alt"></i> <?=$usr['Bucks']?></a>
     <a class="nav-link " href="#"><i class="far fa-user mr-1"></i>  <?php echo $usr['Username']; ?></a>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          more
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/Blog/">Blog</a>
          <a class="dropdown-item" href="https://discord.gg/5fRh3gCjMA">Discord</a>
          <a class="dropdown-item" href="/Rules/">Rules</a>
          <a class="dropdown-item" href="/ClientDownload/">Download</a>
        </div>
      </li>
    </ul>
  </div>
  </div>
  </div>
  </nav>
<?php if($logged) { ?>
	<?php if($logged) { ?>
    <div class="container">
<ul class="nav nav-tabs">
    <li><a href="/User/">My RAINWAY</a></li>
    <li><a href="/Settings/">Settings</a></li>
    <li><a href="/Account/FR/">Friend Requests</a></li>
    <li><a href="/InviteKey/">Invites (<?=$invkeycount?>)</a></li>
    <li><a href="/Inbox/">Inbox (<?=$numpm?>)</a></li>
    <li><a href="/logout.php">Logout</a></li>
</ul>
</div>
																					<?php if($usr['Flarf'] == "true" || $usr['powerForumMod'] == "1" || $usr['powerImageMod'] == "1" || $usr['powerGlobalMod'] == "1" ) { ?>
								<li><a href="/Admin">Admin</a></li>
							<? } ?>
			</span>
			<? } ?>
			</span>
		</div></div>


																								<?php if($usr['Flarf'] == "true" || $usr['powerForumMod'] == "1" || $usr['powerImageMod'] == "1" || $usr['powerGlobalMod'] == "1" ) { ?>
								
							<? } ?>
					<? } ?>
			</div>	
	
							<!--<center><div class="alert alert-primary" role="alert">
  Join the Discord! It's in the navbar and the footer.</center>-->
</div>
		
</html>
		
</html>
<meta property="og:title" content="Rainway" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://rainway.xyz" />
    <meta property="og:description" content="Rainway is a ROBLOX 2010 revival." />
    <meta name="theme-color" content="#00FFFF" />