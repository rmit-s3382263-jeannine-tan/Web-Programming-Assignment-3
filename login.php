<?php 
// Define variable for each page
$pageName="Login";

require_once 'modularization/preContent.php'; ?>

	    <link rel="stylesheet" href="css/loginstyle.css">
		<script type="text/javascript">
			$("#login-button").click(function(event){
			event.preventDefault();
			$('form').fadeOut(500);
			$('.wrapper').addClass('form-success');
			});
		</script>


</head>
	<body class="bodyViewTicket">
		
		<!-- require hearder.php -->
		<?php require_once 'modularization/header.php';?>

		<div id="loginpage">
			<!-- Start from this tutorial code to develop ref: http://designscrazed.org/css-html-login-form-templates/ -->
			<div class="wrapper">
				<div class="container">
					<h1>Welcome</h1>

					<form class="form" method="get" action="viewticket.php">
						<input type="text" placeholder="User ID" name="uid">
						<input type="text" placeholder="EMAIL" name="email">
						<button type="submit" id="login-button">View ticket</button>
					</form>
				</div>

				<ul class="bg-bubbles">
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			</div>
		</div>

		<!-- require footer.php -->
		<?php require_once 'modularization/footer.php';?>
	</body>
</html>