<?php 
// Define variable for each movie
$pageName="Edge Of Tomorrow";
$type="AC";
$timeSlot= <<<EOD
<option value="0" data-Day="Wednesday" data-Time="9pm" id="ACwednesday"></option>
<option value="1" data-Day="Thursday" data-Time="9pm" id="ACthursday"></option>
<option value="2" data-Day="Friday" data-Time="9pm" id="ACfriday"></option>
<option value="3" data-Day="Saturday" data-Time="9pm" id="ACsaturday"></option>
<option value="4" data-Day="Sunday" data-Time="9pm" id="ACsunday"></option>
EOD;
require_once 'modularization/preContent.php'; ?>

	<script type="text/javascript">
    	$(document).ready(function() {
			//JSONfilm get the value from id "film"
				$.getJSON('movieService.json', function(jd) {
           		   $('#ACposter').attr("src",jd.AC.poster);
           		   $('.ACtitle').html(eval("jd.AC.title"));
          		   $('#ACdescription').html(eval("jd.AC.description"));
          		   $('#ACruntime').html('Runtime: ' + jd.AC.runtime);
          		   $('#ACgenre').html('Genre: ' + jd.AC.genre);
          		   $('#ACwednesday').html(eval("jd.AC.wednesday"));
          		   $('#ACthursday').html(eval("jd.AC.thursday"));
          		   $('#ACfriday').html(eval("jd.AC.friday"));
          		   $('#ACsaturday').html(eval("jd.AC.saturday"));
          		   $('#ACsunday').html(eval("jd.AC.sunday"));
                });
        });



	    function updatePriceForDD(){
	      resetZero();
	      $(".ticketQTY").each(function(){
	          switch($("#timeslot option:selected").val())
	          {
	            case "0":
	            case "1":
	            case "2":
	            case "3":
	            case "4":
	            $( this ).attr("data-price", priceArrayB[$(this).attr("data-index")] );
	            break;
	            case "-1":
	            $( this ).attr("data-price", 0);
	            break;
	          }

	      //replace the value of day and time from user selected
	      $("#day").attr("value", $("#timeslot option:selected").attr("data-Day") );
	      $("#time").attr("value", $("#timeslot option:selected").attr("data-Time") );

	      //real time display subtotal
          saCost = $("#standardAdult").attr("data-price");
          $("#SA").text(parseFloat(saCost).toFixed(2));

          spCost = $("#standardConcession").attr("data-price");
          $("#SP").text(parseFloat(spCost).toFixed(2));

          scCost = $("#standardChildren").attr("data-price");
          $("#SC").text(parseFloat(scCost).toFixed(2));

          faCost = $("#firstClassAdult").attr("data-price");
          $("#FA").text(parseFloat(faCost).toFixed(2));

          fcCost = $("#firstClassChildren").attr("data-price");
          $("#FC").text(parseFloat(fcCost).toFixed(2));

          b1Cost = $("#beanbagOne").attr("data-price");
          $("#B1").text(parseFloat(b1Cost).toFixed(2));

          b2Cost = $("#beanbagTwo").attr("data-price");
          $("#B2").text(parseFloat(b2Cost).toFixed(2));

          b3Cost = $("#beanbagThree").attr("data-price");
          $("#B3").text(parseFloat(b3Cost).toFixed(2));

	      updatePrice(this);

	      });
	      return true;
    	}
	</script>
<?php require_once'modularization/moviePostContent.php';?>

