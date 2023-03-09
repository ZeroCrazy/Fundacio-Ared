<?php

	$page = "Habitaciones";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
	
	
?>
<style>
body {
  background: #fff;	
}

.room_green {
  background: green;
  color: #fff;
  width: 53px;
  height: 40px;
  text-align: center;
  line-height: 39px;
  font-weight: bold;
  font-size: 25px;
  float: left;
  border: 1px solid rgba(0, 0, 0, 0.17);
}

.room_yellow {
  background: #ffeb3b;
  color: #222;
  width: 53px;
  height: 40px;
  text-align: center;
  line-height: 39px;
  font-weight: bold;
  font-size: 25px;
  float: left;
  border: 1px solid rgba(0, 0, 0, 0.17);
}

.room_orange {
  background: #e65100;
  color: #222;
  width: 62px;
  height: 40px;
  text-align: center;
  line-height: 39px;
  font-weight: bold;
  font-size: 25px;
  float: left;
  border: 1px solid rgba(0, 0, 0, 0.17);
}

.room_blue {
  background: #2196f3;
  color: #fff;
  width: 62px;
  height: 40px;
  text-align: center;
  line-height: 39px;
  font-weight: bold;
  font-size: 25px;
  float: left;
  border: 1px solid rgba(0, 0, 0, 0.17);
}
</style>
	<main style="padding: 0px;">
	<div class="container">
	  <div class="row">
		<div class="col s12 m12">
		  <div style="background: url(assets/images/grafico.png);width: 1565px;height: 997px;position: absolute;margin-top: -77px;">
		    <?php $h_sql = mysql_query("SELECT * FROM rooms ORDER BY id"); while($h = mysql_fetch_assoc($h_sql)){ ?>
			<?php if($h['show'] == '1') { ?>
			<?php if($h['info'] == '') { ?><?php } else { ?>
			<div class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $h['info']; ?>" style="<?php echo $h['style']; ?>background: #860000;padding: 48px 23px 0px 23px;color: #fff;border-radius: 200px;font-weight: bold;line-height: 50px;font-size: 30px;">!</div>
			<?php } ?>
			 <div class="room_<?php echo $h['category']; ?>" style="<?php echo $h['style']; ?>"><?php echo $h['name']; ?></div>
			<?php } ?>
			<?php } ?>
		  </div>
		</div>
	  </div>
	</div>
	</main>
  
	<?php require 'templates/footer.php'; ?>