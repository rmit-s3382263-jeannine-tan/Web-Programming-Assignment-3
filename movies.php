<!DOCTYPE html> 
<html>
	<head>
		<title>SILVERADO CINEMA</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" /><!-- control layout on mobile browsers -->
		<meta name="description" content="3D Cinema" />
		<meta name="keywords" content="Silverado,Cinema,3D" />
		<link href='//fonts.googleapis.com/css?family=Amatic+SC' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="images/icon.ico" type="image/x-icon"/>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!--slicknav: ref link: http://slicknav.com -->
		<link rel="stylesheet" href="css/slicknav.css">
		<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
		<!-- jquery for the nav menu bar  ref link:https://jquery.com/-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" language="javascript">
        	$(document).ready(function() {
				//JSONfilm get the value from id "film"
					$.getJSON('movieService.json', function(jd) {
					   // get children movie information (Big Hero 6)
               		   $('#CHposter').attr("src",jd.CH.poster);
               		   $('#CHtitle').html(eval("jd.CH.title"));
              		   $('#CHdescription').html(eval("jd.CH.description"));
              		   $('#CHsession1').html(eval("jd.CH.session1"));
              		   $('#CHsession2').html(eval("jd.CH.session2"));
              		   $('#CHsession3').html(eval("jd.CH.session3"));

					   // get romantic comedy movie information (Amelie)
               		   $('#RCposter').attr("src",jd.RC.poster);
               		   $('#RCtitle').html(eval("jd.RC.title"));
              		   $('#RCdescription').html(eval("jd.RC.description"));
              		   $('#RCsession1').html(eval("jd.RC.session1"));
              		   $('#RCsession2').html(eval("jd.RC.session2"));
              		   $('#RCsession3').html(eval("jd.RC.session3"));

              		   // get foreign movie information (Lost in Translation)
               		   $('#FOposter').attr("src",jd.FO.poster);
               		   $('#FOtitle').html(eval("jd.FO.title"));
              		   $('#FOdescription').html(eval("jd.FO.description"));
              		   $('#FOsession1').html(eval("jd.FO.session1"));
              		   $('#FOsession2').html(eval("jd.FO.session2"));

              		   // get action movie information (Edge of Tomorrow)
               		   $('#ACposter').attr("src",jd.AC.poster);
               		   $('#ACtitle').html(eval("jd.AC.title"));
              		   $('#ACdescription').html(eval("jd.AC.description"));
              		   $('#ACsession1').html(eval("jd.AC.session1"));
              		   $('#ACsession2').html(eval("jd.AC.session2"));
              		   $('#ACsession3').html(eval("jd.AC.session3"));
                    });
            });
      </script>
	</head>
	
	<body class="bodyMovies">
<!-- 		//checking for JSON movies
 -->		
		<div id="mainContainer">
			<?php include 'header.php';?>
			<div class="allMovieContent">
	 			<div class="allMovieHeader">All Movies</div>
	 			<div class="allMovie" onClick="window.location.href='bigHero6.php'">
	  				<img class="smallImage" id="CHposter">
	  				<h1 id="CHtitle"></h1>
					<p id="CHdescription"></p>
					<p class="sessionTimes">Sessions: </p>
					<p id="CHsession1"></p>
					<p id="CHsession2"></p>
					<p id="CHsession3"></p>
					<div>Buy tickets >></div>
				</div>

	 			<div class="allMovie" id="all2" onClick="window.location.href='amelie.php'">
	  				<img class="smallImage" id="RCposter">
	  				<h1 id="RCtitle"></h1>
					<p id="RCdescription"></p>
					<p class="sessionTimes">Sessions: </p>
					<p id="RCsession1"></p>
					<p id="RCsession2"></p>
					<p id="RCsession3"></p>
					<div>Buy tickets >></div>
				</div>

				 <div class="allMovie" onClick="window.location.href='lostInTranslation.php'">
	  				<img class="smallImage" id="FOposter">
	  				<h1 id="FOtitle"></h1>
					<p id="FOdescription"></p>
					<p class="sessionTimes">Sessions: </p>
					<p id="FOsession1"></p>
					<p id="FOsession2"></p>
					<div>Buy tickets >></div>
				</div>

	 			<div class="allMovie" id="all4" onClick="window.location.href='edgeOfTomorrow.php'">
					<img class="smallImage" id="ACposter">
	  				<h1 id="ACtitle"></h1>
					<p id="ACdescription"></p>
					<p class="sessionTimes">Sessions: </p>
					<p id="ACsession1"></p>
					<p id="ACsession2"></p>
					<div>Buy tickets >></div>
				</div>
			</div>
		</div>
		<?php include 'footer.php';?>
	</body>
</html>





