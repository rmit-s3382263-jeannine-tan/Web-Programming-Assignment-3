<?php
session_start(); 

//get the data from cart.php, set them to a variable
foreach ($_POST as $key => $value) {
        $$key=$value; 
}

if (!(isset($_SESSION['myBooking']))) { ?>
<!DOCTYPE html>
<html>
<head>
	<title>Buy ticket please!</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" /><!-- control layout on mobile browsers -->
</head>
<body>
	<h1>Buy ticket please!</h1>
</body>
</html>

<?php
	exit();
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

//Caesar cipher encrypt function
function encrypt_string($type, $str, $inc)
{
	if ($type != "caesar")
		return "";

	$t = "";
	for ($i=0; $i < strlen($str); $i++) {
		$ch = ord($str[$i]) - ord(' ');
		$ch = ($ch + $inc) % 95;
		$t .= chr($ch + ord(' '));
	}
	return $t;
}

//Caesar cipher decrypt function
function decrypt_string($type, $str, $inc)
{
	if ($type != "caesar")
		return "";
	 
	$t = "";
	for ($i=0; $i < strlen($str); $i++) {
		$ch = ord($str[$i]) - ord(' ');
		$ch = ($ch - $inc) % 95;
		if ($ch<0){
			$t .= chr($ch + ord(' ') + 95);
		} else
			$t.=chr($ch + 32);
	}
	return $t;
}








// for echo client email
$helloEmail = $cartEmail;

//Assign a random number for user view their ticket after checkout
if (!(isset($_SESSION['uniqueID']))) {
	$_SESSION['uniqueID'] = rand(10000,99999);
}

// Hash the uniqueID
// We can't use password_hash function because titan server php ver is not 5.5 :-(
$hashedUniqueID = hash("sha256",$_SESSION['uniqueID']);
$_SESSION['myBooking']['uid'] = $hashedUniqueID;


// Encrypt client Name by caesar cipher
$caesarKey = "777";
$encryptedCartName = encrypt_string("caesar", $cartName, $caesarKey);
$decryptedCartName = decrypt_string("caesar", $encryptedCartName, $caesarKey);
$_SESSION['myBooking']['name'] = $encryptedCartName;


// Encrypt Email by RSA
// read the public key
$public_key = openssl_pkey_get_public(file_get_contents('public_key.pem'));
$public_key_details = openssl_pkey_get_details($public_key);
// there are 11 bytes overhead for PKCS1 padding
$encrypt_chunk_size = ceil($public_key_details['bits'] / 8) - 11;
$output = '';
// loop through the long plain text, and divide by chunks
while ($cartEmail) {
    $chunk = substr($cartEmail, 0, $encrypt_chunk_size);
    $cartEmail = substr($cartEmail, $encrypt_chunk_size);
    $encrypted = '';
    if (!openssl_public_encrypt($chunk, $encrypted, $public_key))
        die('Failed to encrypt data');
    $output .= $encrypted;
}
openssl_free_key($public_key);
$encryptedCartEmail = base64_encode($output);
$_SESSION['myBooking']['email'] = $encryptedCartEmail;


//No security, plaintext for compare security
$_SESSION['myBooking']['phone'] = $cartMobile;


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
    	<h1>Hello <?php echo $decryptedCartName; ?></h1>
		<h2>Thank you for your purchase!</h2>
		<hr>
		<h3>Please save the information below </h3>
		<p>User ID: <?php echo $_SESSION['uniqueID']; ?></p>
		<p>Email: <?php echo $helloEmail; ?></p>
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


