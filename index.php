<?php 
// Define variable for each page
$pageName="INDEX";

require_once 'modularization/preContent.php'; ?>


		<!-- Banner slideshow- ref link:http://www.woothemes.com/flexslider/ -->
		<link rel="stylesheet" href="css/flexslider.css" type="text/css" />
		<script src="js/jquery.flexslider.js"></script>
		<script type="text/javascript">
		  $(window).load(function() {
		    $('.flexslider').flexslider();
		  });
		</script>
	</head>


	<body class="bodyHome">
		<div id="indexContainer">

		<!-- require hearder.php -->
		<?php require_once 'modularization/header.php';?>


			<!-- tutorial code from http://www.woothemes.com/flexslider/ used as a starting point to create slide show -->	
			<div class="flexslider">
			  <ul class="slides">
			    <li>
			      <img src="images/Banners/Banner1.png" alt="Banner1" />
			    </li>
			    <li>
			      <img src="images/Banners/Banner2.png" alt="Banner2" />
			    </li>
			    <li>
			      <img src="images/Banners/Banner3.png" alt="Banner3" />
			    </li>
			    <li>
			      <img src="images/Banners/Banner4.png" alt="Banner4" />
			    </li>
			  </ul>
			</div>

			<div class="buttonContainer">
				<div class="button">
					<a href="amelie.php"><img src="images/Icon/IconRomance.png" alt="ROMANCE" title="ROMANCE" /></a>
					<a href="amelie.php">ROMANTIC</a>
				</div>
				<div class="button">
					<a href="bigHero6.php"><img src="images/Icon/IconDocumentary.png" alt="DOCUMENTARY" title="DOCUMENTARY" /></a>
					<a href="bighero6.php">CHILDRENS</a>
				</div>
				<div class="button">
					<a href="lostInTranslation.php"><img src="images/Icon/IconHorror.png" alt="HORROR" title="HORROR" /></a>
					<a href="lostInTranslation.php">ART</a>
				</div>
				<div class="button">
					<a href="edgeOfTomorrow.php"><img src="images/Icon/IconAction.png" alt="ACTION" title="ACTION" /></a>
					<a href="edgeOfTomorrow.php">ACTION</a>
				</div>
			</div>
		</div>

		<!-- require footer.php -->
		<?php require_once 'modularization/footer.php';?>	

	</body>
</html>
