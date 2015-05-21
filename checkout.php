<?php
session_start(); 

//get the data from cart.php, set them to a variable
foreach ($_POST as $key => $value) {
        $$key=$value; 
}

if (!(isset($_SESSION['myBooking']))) {
	echo "Please buy ticket!";
	goto end;
}

// Trim array, delete quantity = zero
foreach ($_SESSION['myBooking']['cart']['screening'] as $key => $value) {
	foreach ($_SESSION['myBooking']['cart']['screening'][$key]['seats'] as $key2 => $value2) {
		if ($_SESSION['myBooking']['cart']['screening'][$key]['seats'][$key2]['quantity'] == 0 ) {
			unset($_SESSION['myBooking']['cart']['screening'][$key]['seats'][$key2]);
		}
	}
}




//Assign a random number for user view their ticket after checkout
if (!(isset($_SESSION['uniqueID']))) {
	$_SESSION['uniqueID'] = rand(10000,99999);
}
$_SESSION['myBooking']['uid'] = $_SESSION['uniqueID'];
$_SESSION['myBooking']['name'] = $cartName;
$_SESSION['myBooking']['email'] = $cartEmail;
$_SESSION['myBooking']['phone'] = $cartMobile;

// $topArray = array ( 'allRecord' => array ());

// append array to existing json file
$record = file_get_contents('record.json');
$tempArray = json_decode($record,true);
unset($record);
array_push($tempArray, $_SESSION['myBooking']);
file_put_contents('record.json',json_encode($tempArray,true));
unset($tempArray);


// Define variable for each page
$pageName="Check Out";

require_once 'modularization/preContent.php';
?>


	<!-- ref: sweetalert -->
    <script type="text/javascript" src="js/beautiful-alert.js"></script>
	<script src="js/sweetalert.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>

<body class="bodyCheckout">
	<!-- require hearder.php -->
	<?php require_once 'modularization/header.php';?>
    <div id="checkoutContainer">
    	<br>
    	<img src="images/tick.png" width="50%" />
    	<hr>
    	<h1>Hello <?php echo $cartName ?></h1>
		<h2>Thank you for your purchase!</h2>
		<hr>
		<h3>Please save the information below </h3>
		<p>User ID: <?php echo $_SESSION['uniqueID'] ?></p>
		<p>Email: <?php echo $cartEmail ?></p>
		<P>Go to <a href="login.php">ticket</a> page to view your tickets</P>
    </div>


<?php 
//Shopping cart is emptied once bookings are completed
unset($_SESSION['myBooking']);
session_destroy();
 ?>


	<!-- require footer.php -->
	<?php require_once 'modularization/footer.php';?>	
    <?php end:?>

</body>


</html>