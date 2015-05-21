<?php 

$pageName="Lost In Translation";


require_once 'prescript.php'; ?>
		<!-- For moviePage calculate price javascript function -->
		<script src="js/movieScript.js"></script>

		<script type="text/javascript" language="javascript">
        	$(document).ready(function() {
				//JSONfilm get the value from id "film"
					$.getJSON('movieService.json', function(jd) {
               		   $('#FOposter').attr("src",jd.FO.poster);
               		   $('.FOtitle').html(eval("jd.FO.title"));
              		   $('#FOdescription').html(eval("jd.FO.description"));
              		   $('#FOruntime').html('Runtime: ' + jd.FO.runtime);
              		   $('#FOgenre').html('Genre: ' + jd.FO.genre);
              		   $('#FOmonday').html(eval("jd.FO.monday"));
              		   $('#FOtuesday').html(eval("jd.FO.tuesday"));
              		   $('#FOsaturday').html(eval("jd.FO.saturday"));
              		   $('#FOsunday').html(eval("jd.FO.sunday"));
                    });
            });
        </script>




        <script type="text/javascript">
        	 //update price
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
        </script>
        </head>



	<body onload="onLoadPage()" class="bodyMovies">  
		<!-- require hearder.php -->
		<?php require_once 'header.php';?>
		<div class="allMovieHeader FOtitle"></div>
		<div class="movieBlock">
			<div class="topBlock">
 		       <img class="imageBlock" id="FOposter">
			</div>				
			<div class="leftBlock">
				<h2 class="FOtitle"></h2>
				<p id="FOdescription"></p>
				<p id="FOruntime"></p>
				<p id="FOgenre"></p>
			</div>

			<div class="rightBlock">
				<form class="movieForm" name="movieForm" accept-charset="UTF-8" action='receive.php' method="post" onsubmit="return validateForm()">
		    		<h1>Buy Tickets</h1>
		   			<div class="content2">
		       			<div class="intro2">Use the form below to order the ticket(s), or call us on 1314 888 969</div>
		     			<div id="booking">
					      <select id="timeslot" onchange="updatePriceForDD()">
					          <option value="-1">Select Session</option>
					          <option value="0" data-Day="Monday" data-Time="6pm" id="FOmonday"></option>
					          <option value="1" data-Day="Tuesday" data-Time="6pm" id="FOtuesday"></option>
					          <option value="2" data-Day="Saturday" data-Time="3pm" id="FOsaturday"></option>
					          <option value="3" data-Day="Sunday" data-Time="3pm" id="FOsunday"></option>
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
					      <input id="film" name="film" type="hidden" value="AF"/>
					      <input id="day" name="day" type="hidden" value="Not seleced"/>
					      <input id="time" name="time" type="hidden" value="Not seleced"/>

		    		</div>
				</form>
			</div>
	</div>

	<!-- require footer.php -->
	<?php require_once 'footer.php';?>

	</body>
</html>
