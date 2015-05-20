<!DOCTYPE html> 
<html>
	<head>
		<title>SILVERADO CINEMA - Amelie</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" /><!-- control layout on mobile browsers -->
		<meta name="description" content="3D Cinema" />
		<meta name="keywords" content="Silverado,Cinema,3D" />
		<link href='//fonts.googleapis.com/css?family=Amatic+SC' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css' />
		<link rel="shortcut icon" href="images/icon.ico" type="image/x-icon"/>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<!--slicknav: ref link: http://slicknav.com -->
		<link rel="stylesheet" href="css/slicknav.css" />
		<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
		<!-- jquery for the nav menu bar  ref link:https://jquery.com/-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" language="javascript">
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
        </script>
    	<script type="text/javascript">
		    priceArrayA=[12,10,8,25,20,20,20,20];
		    priceArrayB=[18,15,12,30,25,30,30,30,30];

		    function onLoadPage(){
		    	resetZero();
				updatePriceForDD();
		    	//reset ticket QTY to zero
		       	// $(".ticketQTY").attr("value", 0 );

		    }



			function validateForm() {
			    // var x = document.forms["myForm"]["fname"].value;
			    if ($("#timeslot option:selected").val() == -1 ) {
			        alert("Please select the session");
			        // document.getElementById("timeslot").focus();
			        $("#timeslot").focus();
			        return false;
			    }
			    if ($("#price").val() == 0) {
			        alert("Please select the quantity of ticket(s)");
			    	return false;
			    }
			    return (true);
			}



		    //reset sub-total and total to zero
		    function resetZero(){
		      $("#cost").text("0.00");
		      $("#SAtotal").text("0.00");
		      $("#SPtotal").text("0.00");
		      $("#SCtotal").text("0.00");
		      $("#FAtotal").text("0.00");
		      $("#FCtotal").text("0.00");
		      $("#B1total").text("0.00");
		      $("#B2total").text("0.00");
		      $("#B3total").text("0.00");
		      $("#Total").text("0.00");
		      return true;
		    }


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
		            $( this ).attr("data-price", priceArrayA[$(this).attr("data-index")] );
		            break;
		            case "5":
		            case "6":
		            case "7":
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




	    function updatePrice(item){
	      // sample
	      // myPrice = $(item).attr("data-price")*$(item).val();;
	      // $("#cost").text(parseFloat(myPrice).toFixed(2));

	      saPrice = $("#standardAdult").attr("data-price")*$("#standardAdult").val();;
	      $("#SAtotal").text(parseFloat(saPrice).toFixed(2));


	      spPrice = $("#standardConcession").attr("data-price")*$("#standardConcession").val();;
	      $("#SPtotal").text(parseFloat(spPrice).toFixed(2));


	      scPrice = $("#standardChildren").attr("data-price")*$("#standardChildren").val();;
	      $("#SCtotal").text(parseFloat(scPrice).toFixed(2));


	      faPrice = $("#firstClassAdult").attr("data-price")*$("#firstClassAdult").val();;
	      $("#FAtotal").text(parseFloat(faPrice).toFixed(2));


	      fcPrice = $("#firstClassChildren").attr("data-price")*$("#firstClassChildren").val();;
	      $("#FCtotal").text(parseFloat(fcPrice).toFixed(2));

	      b1Price = $("#beanbagOne").attr("data-price")*$("#beanbagOne").val();;
	      $("#B1total").text(parseFloat(b1Price).toFixed(2));

	      b2Price = $("#beanbagTwo").attr("data-price")*$("#beanbagTwo").val();;
	      $("#B2total").text(parseFloat(b2Price).toFixed(2));

	      b3Price = $("#beanbagThree").attr("data-price")*$("#beanbagThree").val();;
	      $("#B3total").text(parseFloat(b3Price).toFixed(2));


		  //calculate the total price
	      totalPrice = parseInt(saPrice) +parseInt(spPrice) + parseInt(scPrice) + parseInt(faPrice) + parseInt(fcPrice) + parseInt(b1Price) + parseInt(b2Price) + parseInt(b3Price);
	      $("#Total").text(parseFloat(totalPrice).toFixed(2));
	      
	      //sumbit the total price to tester.php
	      document.movieForm.price.value = parseFloat(totalPrice).toFixed(2);

	      return true;
	    }

    </script>
	</head>


	<body onload="onLoadPage()" class="bodyMovies">  
		<!-- include hearder.php -->
		<?php include 'header.php';?>
		<div class="allMovieHeader RCtitle"></div>
		<div class="movieBlock">
			<div class="topBlock">
 		       <img class="imageBlock" id="RCposter">
			</div>	
			<div class="leftBlock">
				<h2 class="RCtitle"></h2>
				<p id="RCdescription"></p>
				<p id="RCruntime"></p>
				<p id="RCgenre"></p>
			</div>

			<div class="rightBlock">
				<form class="movieForm" name="movieForm" accept-charset="UTF-8" action='receive.php' method="post" onsubmit="return validateForm()">
		    		<h1>Buy Tickets</h1>
		   			<div class="content2">
		       			<div class="intro2">Use the form below to order the ticket(s), or call us on 1314 888 969</div>
		     			<div id="booking">
					      <select id="timeslot" onchange="updatePriceForDD()">
					          <option value="-1">Select Session</option>
					          <option value="0" data-Day="Monday" data-Time="9pm" id="RCmonday"></option>
					          <option value="1" data-Day="Tuesday" data-Time="9pm" id="RCtuesday"></option>
					          <option value="2" data-Day="Wednesday" data-Time="1pm" id="RCwednesday"></option>
					          <option value="3" data-Day="Thursday" data-Time="1pm" id="RCthursday"></option>
					          <option value="4" data-Day="Friday" data-Time="1pm" id="RCfriday"></option>
					          <option value="5" data-Day="Saturday" data-Time="6pm" id="RCsaturday"></option>
					          <option value="6" data-Day="Sunday" data-Time="6pm" id="RCsunday"></option>
					      </select>

					      <div class="ticketTitle">
					      	<span class="ticketTitleLeft">Standard Tickets</span>
					      	<span class="ticketTitleRight">Cost</span>
					      </div>

					      <div class="ticketBlock">
					        <select id="standardAdult" class="ticketQTY" data-index="0" data-price="" onchange="updatePrice(this)" name="SA">
					          <option value="0" selected="selected">0</option>
					          <option value="1">1</option>
					          <option value="2">2</option>
					          <option value="3">3</option>
					          <option value="4">4</option>          
					        </select>
					        <span>Standard Adult ($</span><span id="SA">0.00</span>)
					        <span class="ticketRight">$<span id="SAtotal">0.00</span></span>
					      </div>

					      <div class="ticketBlock">
					        <select id="standardConcession" class="ticketQTY" data-index="1" data-price="" onchange="updatePrice(this)" name="SP">
					          <option value="0" selected="selected">0</option>
					          <option value="1">1</option>
					          <option value="2">2</option>
					          <option value="3">3</option>
					          <option value="4">4</option>    
					        </select>
					    	<span>Standard Concession ($</span><span id="SP">0.00</span>)
						    <span class="ticketRight">$<span id="SPtotal">0.00</span></span>
						   </div>

					      <div class="ticketBlock">
					        <select id="standardChildren" class="ticketQTY" data-index="2" data-price="" onchange="updatePrice(this)" name="SC">
					          <option value="0" selected="selected">0</option>
					          <option value="1">1</option>
					          <option value="2">2</option>
					          <option value="3">3</option>
					          <option value="4">4</option>    
					        </select>
					      	<span>Standard Children ($</span><span id="SC">0.00</span>)
						    <span class="ticketRight">$<span id="SCtotal">0.00</span></span>
					       </div>

					      <div class="ticketTitle">
					      	<span class="ticketTitleLeft">First Class Tickets</span>
					      	<span class="ticketTitleRight">Cost</span>
					      </div>

					      <div class="ticketBlock">
					        <select id="firstClassAdult" class="ticketQTY" data-index="3" data-price="" onchange="updatePrice(this)" name="FA">
					          <option value="0" selected="selected">0</option>
					          <option value="1">1</option>
					          <option value="2">2</option>
					          <option value="3">3</option>
					          <option value="4">4</option>          
					        </select>
					        <span>First Class Adult ($</span><span id="FA">0.00</span>)
					        <span class="ticketRight">$<span id="FAtotal">0.00</span></span>
					      </div>

					      <div class="ticketBlock">
					        <select id="firstClassChildren" class="ticketQTY" data-index="4" data-price="" onchange="updatePrice(this)" name="FC">
					          <option value="0" selected="selected">0</option>
					          <option value="1">1</option>
					          <option value="2">2</option>
					          <option value="3">3</option>
					          <option value="4">4</option>          
					        </select>
					        <span>First Class Children ($</span><span id="FC">0.00</span>)
					        <span class="ticketRight">$<span id="FCtotal">0.00</span></span>
					      </div>

					      <div class="ticketTitle">
					      	<span class="ticketTitleLeft">Beanbag Tickets</span>
					      	<span class="ticketTitleRight">Cost</span>
					      </div>

					      <div class="ticketBlock">
					        <select id="beanbagOne" class="ticketQTY" data-index="5" data-price="" onchange="updatePrice(this)" name="B1">
					          <option value="0" selected="selected">0</option>
					          <option value="1">1</option>
					          <option value="2">2</option>
					          <option value="3">3</option>
					          <option value="4">4</option>          
					        </select>
					        <span>Two Adults ($</span><span id="B1">0.00</span>)
					        <span class="ticketRight">$<span id="B1total">0.00</span></span>
					      </div>

					      <div class="ticketBlock">
					        <select id="beanbagTwo" class="ticketQTY" data-index="6" data-price="" onchange="updatePrice(this)" name="B2">
					          <option value="0" selected="selected">0</option>
					          <option value="1">1</option>
					          <option value="2">2</option>
					          <option value="3">3</option>
					          <option value="4">4</option>          
					        </select>
					        <span>One Adult, One Child ($</span><span id="B2">0.00</span>)
					        <span class="ticketRight">$<span id="B2total">0.00</span></span>
					      </div>

					      <div class="ticketBlock">
					        <select id="beanbagThree" class="ticketQTY" data-index="7" data-price="" onchange="updatePrice(this)" name="B3">
					          <option value="0" selected="selected">0</option>
					          <option value="1">1</option>
					          <option value="2">2</option>
					          <option value="3">3</option>
					          <option value="4">4</option>          
					        </select>
					        <span>Three Children ($</span><span id="B3">0.00</span>)
					        <span class="ticketRight">$<span id="B3total">0.00</span></span>
					      </div>

					      <div class="ticketTitle">
					      	<span class="ticketTitleRight">Total Cost</span>
					      </div>

					      <div class="ticketTitle2">
						  	<div class="ticketRight">$<span id="Total">0.00</span></div>
					      </div>
					      <div class="ticketTitle2">
					      	<div class="ticketRight">
					      		<input type="button" value="Back" onclick="location.href='movies.php'" />
					      		<input type="submit" value="Confirm" />
					      	</div>
					      </div>
					   </div>


					      <input id="price" name="price" type="hidden" value="0.00"/>
					      <input id="film" name="film" type="hidden" value="RC"/>
					      <input id="day" name="day" type="hidden" value="Not seleced"/>
					      <input id="time" name="time" type="hidden" value="Not seleced"/>

		    		</div>
				</form>
			</div>
	</div>

	<!-- include footer.php -->
	<?php include 'footer.php';?>

	</body>
</html>
