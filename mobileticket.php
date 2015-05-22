<?php

//get value from modify.php, set them to variable
foreach ($_GET as $key => $value) {
        $$key=$value; 
}



// load json file to php array
$record = file_get_contents('record.json');
$tempArray = json_decode($record,true);
unset($record);


//titan server php ver had not function array_column(), but I found a similar once in stackoverflow
//refer to : http://stackoverflow.com/questions/163336/slicing-a-multi-dimensional-php-array-across-one-of-its-elements
function array_column2($array, $column)
{
    $arr = array();
    foreach ($array as $row) $arr[] = $row[$column];
    return $arr;
}

//the key of specific user in json file
// $arrayKey = array_search($uid, array_column2($tempArray, 'uid'));



// Hash the uniqueID for compare with json file
// We can't use password_hash function because titan server php ver is not 5.5 :-(
$hashedUniqueID = hash("sha256",$uid);
//the key of specific user in json file
$arrayKey = array_search($hashedUniqueID, array_column2($tempArray, 'uid'));


//decrypt email
// decode the text to bytes
$encrypted = base64_decode($tempArray[$arrayKey]['email']);
// read the private key
$private_key = openssl_pkey_get_private(file_get_contents('private_key.pem'));
$private_key_details = openssl_pkey_get_details($private_key);
// there is no need to minus the overhead
$decrypt_chunk_size = ceil($private_key_details['bits'] / 8);
$output = '';
// decrypt it back chunk-by-chunk
while ($encrypted) {
    $chunk = substr($encrypted, 0, $decrypt_chunk_size);
    $encrypted = substr($encrypted, $decrypt_chunk_size);
    $decrypted = '';
    if (!openssl_private_decrypt($chunk, $decrypted, $private_key))
        die('Failed to decrypt data');
    $output .= $decrypted;
}
openssl_free_key($private_key);
$decryptedEmail = $output;



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



// Decrypt client Name by caesar cipher
$caesarKey = "777";
$encryptedName = $tempArray[$arrayKey]['name'];
$decryptedCartName = decrypt_string("caesar", $encryptedName, $caesarKey);



$Total="";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mobile E-Ticket</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" /><!-- control layout on mobile browsers -->
		<link rel="stylesheet" type="text/css" href="css/style.css" />

		<!-- jquery file -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.qrcode.js"></script>
		<script type="text/javascript" src="js/qrcode.js"></script>

<!-- 		tutorial code from: 
		http://stackoverflow.com/questions/10033215/how-do-i-add-an-add-to-favorites-button-or-link-on-my-website
		used as a starting point to create add to bookmark function -->
		<script type="text/javascript">
		    $(function() {
		        $('#bookmarkme').click(function() {
		            if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
		                window.sidebar.addPanel(document.title,window.location.href,'');
		            } else if(window.external && ('AddFavorite' in window.external)) { // IE Favorite
		                window.external.AddFavorite(location.href,document.title); 
		            } else if(window.opera && window.print) { // Opera Hotlist
		                this.title=document.title;
		                return true;
		            } else { // webkit - safari/chrome
		                alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != - 1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
		            }
		        });
		    });
		</script>	
</head>
<body class="bodyCart">
        <?php
        	//Check email and user ID	
			if (!(is_numeric($arrayKey))) { ?>
			<div class="invalid">
				<img src="images/Logo.png" id="ticketLogo">
				<p>Invalid Booking ID!</p>
				<p>Please try again</p>
				<p><a href="login.php">View Ticket Page</a></p>
			</div>
			<?php goto end;
			}
			else{
				if ($email != $decryptedEmail) { ?>
				<div class="invalid">
					<img src="images/Logo.png" id="ticketLogo">
					<p>Invalid EMAIL!</p>
					<p>Please try again</p>
					<p><a href="login.php">View Ticket Page</a></p>
				</div>
				<?php goto end;
				}
				else{
					echo "<pre>";
					// print_r($tempArray[$arrayKey]);
					echo "</pre>";
				}
			}
        ?>

		<div class="cartBlock">
			<div id="ticketLogoDiv"><img src="images/Logo.png" id="ticketLogo"></div>
			<div id="qrcodeTable"></div>
			<div class="ticketName"><span>Name :</span><?php echo $decryptedCartName; ?></div>
			<div class="ticketName"><span>Email :</span><?php echo $decryptedEmail; ?></div>
			<div class="ticketName"><span>Phone :</span><?php echo $tempArray[$arrayKey]['phone']; ?></div>
			<div class="ticketName"><span>User ID :</span><?php echo $uid; ?></div>
			<div class="ticketName"><a id="bookmarkme" href="#" rel="sidebar" title="bookmark this page">Bookmark This Page</a></div>
			<hr>
				<?php foreach ($tempArray[$arrayKey]['cart']['screening'] as $key => $value): ?>
				<?php
					switch ($value['type']) {
						case 'CH':
							$link = "bigHero6.php";
							break;
						case 'AF':
							"lostInTranslation.php";
							break;
						case 'RC':
							$link="amelie.php";
							break;
						case 'AC':
							$link = "edgeOfTomorrow.php";
							break;
						default:
							$link = "index.php";
							break;
					}
				?>


			<div class="cartMovieTitle"><a href="<?php echo $link ?>"><?php echo $value['movie'];?></a></div>
			<div class="carth1">Session: <?php echo $value['day']?>, <?php echo $value['time']?></div>
					<table id="cartTable">
						<thead>
							<tr>
								<th class="ticketType">Ticket Type</th>
								<th>Seat</th>
								<th>Quantity</th>
							</tr>
						</thead>

						<tbody>
						<?php foreach ($value['seats'] as $row): ?>
							<?php $positionNumber="0";?>
							<?php $seatNumber = rand(1,40-$row['quantity']); ?>
							<?php if ($row['quantity'] > 0 ): ?>
								<?php 
								for ($i=0; $i < $row['quantity'] ; $i++) { 
									?>
								<tr>	
								<td class="ticketType"><?php echo $row['ticketType']; ?></td>
								<td>
									<?php
									echo $row['position'][$positionNumber];
									$positionNumber++;
									 ?>
								</td>
								<td>1</td>
								</tr>						
								<?php 	
								}
								?>
							<?php endif ?>
						<?php endforeach ?>
						</tbody>


						<tfoot>
						    <tr>
						    	<td colspan="4"></td>

						    </tr>

						</tfoot>
					</table>
					<hr>
				<?php $Total += $value['subTotal']; ?>
				<?php endforeach ?>
		</div>

	<!-- generate QR code -->
	<script>
		jQuery('#qrcodeTable').qrcode({
			render	: "table",
			text	: "UID: <?php echo $uid ?> EMAIL:<?php echo $decryptedEmail ?> NAME: <?php echo $decryptedCartName; ?>"
		});	
	</script>
	<?php end:?>
</body>
</html>