<?php include "global.php"; 

if(!$logged){
	if($_POST){
	  if($_POST["username"] && $_POST["password"] && $_POST["email"] && $_POST["invitekey"]){
		$username = $mysqli->real_escape_string(strip_tags($_POST["username"]));
 	 	$password = $mysqli->real_escape_string(md5(strip_tags($_POST["password"])));
 	 	$email = $mysqli->real_escape_string(strip_tags($_POST["email"]));
 	 	$key = $mysqli->real_escape_string(strip_tags($_POST["invitekey"]));
 	 	$ip = $_SERVER['REMOTE_ADDR'];
	
		if($username && $password && $email && $key){
				$checkquery = $mysqli->query("SELECT * FROM `accounts` WHERE `username`='$username'");
				$check = $checkquery->fetch_array();
				
				$checkquery2 = $mysqli->query("SELECT * FROM `accounts` WHERE `email`='$email'");
				$check2 = $checkquery2->fetch_array();

                     
                    $checkIpQ = $mysqli->query("SELECT * FROM `accounts` WHERE `ip`='$ip'");
                    $checkIp = $checkIpQ->fetch_array();
                    
                    $checkExists = $mysqli->query("SELECT * FROM `invitekey` WHERE `invitekey`='$key' AND used='0'");
                    $exists = $checkExists->fetch_array();

					if($check != 0){
						die("<div style='margin:10px;padding:4px;color:red;'>That username has been taken.</div>");
					}elseif($checkIp > 2){
                        die("<div style='margin:10px;padding:4px;color:red;'>You can't create more than one account!</div>");
                    }elseif($exists == 0) {
                        die("<div style='margin:10px;padding:4px;color:red;'>Invalid Invite Key.</div>");
                    }elseif($check2 != 0){
						die("<div style='margin:10px;padding:4px;color:red;'>That email is already in use. Please login.");
					}else{
							$mysqli->query("INSERT INTO `accounts` (`username`, `password`, `email`, `ip`) VALUES ('$username', '$password', '$email', '$ip')");
							$mysqli->query("UPDATE `invitekey` SET `used` = `used` + 1 WHERE invitekey = '$key'");
							$mysqli->query("UPDATE `invitekey` SET `usedby` = '$username' WHERE invitekey = '$key'");
							$mysqli->query("UPDATE `invitekey` SET `userip` = '$ip' WHERE invitekey = '$key'");
	
						 	setcookie("username", hash("sha512", $username), time() + 24 * 60 * 60, "/");
      							setcookie("password", $password, time() + 24 * 60 * 60, "/");	
	
						 	die("<div style='margin:10px;padding:4px;'>Your account has been created.</div><META http-equiv=refresh content=1;URL=/signin.php>");
       						}
       					}	
				}	 
			}	
		}
	
?>
	<body>
		<?php if(!$logged) { 
			echo '<div class="container">
  <div class="jumbotron">
    <h1 class="text-light"><b>Welcome to Rainway</h1></b>
    <p class="text-light">Hey look! Its raining nostalgia!</p></div>
    <div class="row">
<div class="col-sm-4">
      <h3>Invite Only!</h3>
      <p>Rainway is a private revival. Ask your friend for a key if they are in Rainway!</p>
      <p>However, if your friend breaks the rules, you will be banned too!</p></div>
<div class="col-sm-4">
      <h3>Join!</h3>
      <p><a href="login.php">Login</a></p>
      <p><a href="register.php">Register</a></p>
</div></div>
<style>
.jumbotron {
    background-image: url("https://qunjz.please-fuck.me/57Nf2Pgxy.png");
    background-color: #17234E;
    margin-bottom: 0;
    min-height: 5%;
    background-repeat: no-repeat;
    background-position: center;
    -webkit-background-size: cover;
    background-size: cover;
}
</style>
			';
			}
			?>
			<?php if($logged) { ?>
            <div class="container">
					<div class="jumbotron">
                    <iframe allowtransparency scrolling="no" frameborder="no" src="/core/character.php?id=<?=$usr['id']?>" width="200" height="225"></iframe>
    <h1 class="text-light">Hello, <?php echo $usr['Username']; ?>.</h1><a href="/Games/" class="btn btn-success btn-lg active" role="button" aria-pressed="true">Play ></a></div>
    <p>Don't like your current avatar? Shop at the <a href="/Catalog/">Catalog</a>!</p>
    <p>Chat with other fellow users at the <a href="Forum">forum</a>. (currently down)</p>
    <style>
.jumbotron {
    background-image: url("https://qunjz.please-fuck.me/57Nf2Pgxy.png");
    background-color: #17234E;
    margin-bottom: 0;
    min-height: 1%;
    background-repeat: no-repeat;
    background-position: center;
    -webkit-background-size: cover;
    background-size: cover;
}
</style></div></div>

			<? } ?>
		
			<?php include "footer.php"; ?>
	</body>
</html>