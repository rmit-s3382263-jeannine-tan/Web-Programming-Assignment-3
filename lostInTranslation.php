<?php 
// Define variable for each movie
$pageName="Lost In Translation";
$type="AF";
$timeSlot= <<<EOD
<option value="0" data-Day="Monday" data-Time="6pm" id="AFmonday">Loading</option>					         
<option value="1" data-Day="Tuesday" data-Time="6pm" id="AFtuesday">Loading</option>
<option value="2" data-Day="Saturday" data-Time="3pm" id="AFsaturday">LoadingLoading</option>
<option value="3" data-Day="Sunday" data-Time="3pm" id="AFsunday">Loading</option>
EOD;
require_once 'modularization/preContent.php'; ?>

	<script type="text/javascript">
	   	$(document).ready(function() {
		//JSONfilm get the value from id "film"
			$.getJSON('movieService.json', function(jd) {
	   		   $('#AFposter').attr("src",jd.AF.poster);
	   		   $('.AFtitle').html(eval("jd.AF.title"));
	  		   $('#AFdescription').html(eval("jd.AF.description"));
	  		   $('#AFruntime').html('Runtime: ' + jd.AF.runtime);
	  		   $('#AFgenre').html('Genre: ' + jd.AF.genre);
	  		   $('#AFmonday').html(eval("jd.AF.monday"));
	  		   $('#AFtuesday').html(eval("jd.AF.tuesday"));
	  		   $('#AFsaturday').html(eval("jd.AF.saturday"));
	  		   $('#AFsunday').html(eval("jd.AF.sunday"));
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
<?php require_once 'modularization/moviePostContent.php';?>
