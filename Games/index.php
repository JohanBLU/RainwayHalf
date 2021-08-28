<?
	include "../global.php";
?>

		
		
	
<?php if($logged) { ?>
<style>
.games2 {
    background-color: #f2f2f2;
    border: 1px solid #e3e3e3;
    color: #adadad;
}</style>
	<!--<div class="lander">-->
		<h1><b>Games</b></h1>
			Create games <a href="/Games/Compose.php">here</a>! Remember that games are self-hosted by people!
				<!--<table>
					<tr>
					    <div>
						<td style="vertical-align:text-top;padding:14px;">
							<div class="verticaloptionpanel">
							    <h3>Filters</h3>
							<ul class="list-group list-group-flush">
 <a href="?tab=featured"" class="btn btn-primary btn-lg btn-block">Featured</a>
 <a href="?tab=mostplayed" class="btn btn-primary">Most Played</a>
 <a href="?tab=mostfavorited" class="btn btn-primary">Most Favorited</a>
  </ul>
							</div>
						</td>
							<td style="vertical-align: text-top;">
								<?php if($_GET['tab'] == 'featured') { ?>
									<h3>Featured Games</h3>
								<? } ?>
								
								<?php if($_GET['tab'] == 'mostplayed') { ?>
									<h3>Most Played Games</h3>
								<? } ?>
								
								
								<?php if($_GET['tab'] == 'mostfavorited') { ?>
									<h3>Most Favorited Games</h3>
								<? } ?>
                                --><div class="row">
                             <!-- <div style="text-allign:center"> is way better, but if i added it, it screws the games up... -->
										<?php
			$result = $mysqli->query("SELECT * FROM `games` ORDER BY id");
			while($row = $result->fetch_array()){
		    ?>
        <div class="card" style="width: 13rem;">
  <img class="card-img-top" src="/img/games/<?=$row['icon']?>s.png" alt="RAINWAY Game">
  <div class="card-body">
    <h5 class="card-title"><?=$row['name']?></h5>
    <p class="card-text">Creator: <a href="/User/?id=<?=$row['creatorid']?>"><?=$row['creatorname']?></a></p>
    <a href="/Game/?id=<?=$row['id']?>" class="btn btn-success">View</a>
  </div>
</div>
<!--
</div> - There would be another div tag but if this comment is removed, it just screws the page up.
-->
		<?
		}
		?>

							</td>
					</tr>
				</table>
			
	</div>
<? } ?>
</html>
	
	</div>

<?php include "../footer.php"; ?>