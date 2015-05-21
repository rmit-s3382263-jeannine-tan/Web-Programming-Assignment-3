<?php 
// Define variable for each movie
$pageName="Amelie";
$type="RC";
$timeSlot= <<<EOD
<option value="-1">Select Session</option>
<option value="0" data-Day="Monday" data-Time="9pm" id="RCmonday"></option>
<option value="1" data-Day="Tuesday" data-Time="9pm" id="RCtuesday"></option>
<option value="2" data-Day="Wednesday" data-Time="1pm" id="RCwednesday"></option>
<option value="3" data-Day="Thursday" data-Time="1pm" id="RCthursday"></option>
<option value="4" data-Day="Friday" data-Time="1pm" id="RCfriday"></option>
<option value="5" data-Day="Saturday" data-Time="6pm" id="RCsaturday"></option>
<option value="6" data-Day="Sunday" data-Time="6pm" id="RCsunday"></option>
EOD;
require_once 'modularization/preContent.php'; ?>

	<script type="text/javascript">
    	$(document).ready(function() {
			//JSONfilm get the value from id "film"
				$.getJSON('movieService.json', function(jd) {
           		   $('#RCposter').attr("src",jd.RC.poster);
           		   $('.RCtitle').html(eval("jd.RC.title"));
          		   $('#RCdescription').html(eval("jd.RC.description"));
          		   $('#RCruntime').html('Runtime: ' + jd.RC.runtime);
          		   $('#RCgenre').html('Genre: ' + jd.RC.genre);
          		   $('#RCmonday').html(eval("jd.RC.monday"));
          		   $('#RCtuesday').html(eval("jd.RC.tuesday"));
          		   $('#RCwednesday').html(eval("jd.RC.wednesday"));
          		   $('#RCthursday').html(eval("jd.RC.thursday"));
          		   $('#RCfriday').html(eval("jd.RC.friday"));
          		   $('#RCsaturday').html(eval("jd.RC.saturday"));
          		   $('#RCsunday').html(eval("jd.RC.sunday"));
                });
        });



	    function updatePriceForDD(){
	      resetZero();
	      $(".ticketQTY").each(function(){
	          switch($("#timeslot option:selected").val())
	          {
	            case "0":
	            case "1":
	            $( this ).attr("data-price", priceArrayA[$(this).attr("data-index")] );
	            break;
	            case "2":
	            case "3":
	            case "4":
	            case "5":
	            case "6":
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