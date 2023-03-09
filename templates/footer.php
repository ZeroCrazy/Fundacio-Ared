<?php mysql_query("UPDATE admins SET last_online='". time() ."' WHERE id='$user[id]'"); ?>
	  <script type="text/javascript" src="<?php echo $site . "/" . $cdn; ?>/js/jquery.min.js"></script>
      <script type="text/javascript" src="<?php echo $site . "/" . $cdn; ?>/js/materialize.min.js"></script>
	<script>
	$(document).ready(function(){
	  <?php if($_GET['dia'] == '') { ?>
	  $('.modal').modal();
	  $('#AddIncidenciaHabitaciones').modal('open');
	  <?php } else { ?>
	  $('.modal').modal();
	  $('#ConsultRooms').modal('open');
	  <?php } ?>
	  $('.tooltipped').tooltip({delay: 50});
	  $('select').material_select();
	  $('.slider').slider({
	    height: 350,
	  });
	  $(".dropdown-button").dropdown();
	  $(".button-collapse").sideNav();
	  $('.scrollspy').scrollSpy({
	    scrollOffset: 700,
	  });
	});

	function myFunction() {
		// Declare variables
		var input, filter, ul, li, a, i;
		input = document.getElementById('myInput');
		filter = input.value.toUpperCase();
		ul = document.getElementById("myUL");
		li = ul.getElementsByTagName('li');

		// Loop through all list items, and hide those who don't match the search query
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
			}
		}
	}
	
  $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'Aceptar', // text for done-button
    cleartext: 'Limpiar', // text for clear-button
    canceltext: 'Cancelar', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
  
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Aceptar',
    closeOnSelect: false // Close upon selecting a date,
  });
	</script>
    </body>
  </html>