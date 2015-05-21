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
$arrayKey = array_search($uid, array_column2($tempArray, 'uid'));


$discountTotal="0";
$discount = "0";
$Total = "0";
$displayDiscount = "N/A";

// Define variable for each movie
$pageName="View Ticket";

require_once 'modularization/preContent.php';
?>

</head>
<body class="bodyCart bodyViewTicket">
		
		<!-- require hearder.php -->
		<?php require_once 'modularization/header.php';

        	//Check email and user ID	
			if (!(is_numeric($arrayKey))) { ?>
			<div class="invalid">
				<p>Invalid Booking ID!</p>
				<p>Please try again</p>
				<p><a href="login.php">View Ticket Page</a></p>
			</div>
			<?php goto end;
			}
			else{
				if ($email != $tempArray[$arrayKey]['email']) { ?>
				<div class="invalid">
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


		<div id="cartTitle"><h1>View Ticket</h1></div>
		<div class="cartBlock">
			<div class="viewtickettop">
				<div class="ticketLeftContainer">
					<div class="ticketName"><span>Name :</span><?php echo $tempArray[$arrayKey]['name'] ?></div>
					<div class="ticketName"><span>Email :</span><?php echo $tempArray[$arrayKey]['email'] ?></div>
					<div class="ticketName"><span>Phone :</span><?php echo $tempArray[$arrayKey]['phone'] ?></div>
					<div class="ticketName"><span>User ID :</span><?php echo $tempArray[$arrayKey]['uid'] ?></div>
				</div>
				<div class="ticketRightContainer">
					<form action="mobileticket.php" method="get" name="ticketform">
						<input type="hidden" name="uid" value="<?php echo $uid; ?>">
						<input type="hidden" name="email" value="<?php echo $email; ?>">
						<!-- <input type="image" src="images/mobile1.png" alt="Click Me" disabled="disabled"> -->
						<button type="submit" value="someValue" border="0" id="mobileButton"><img src="images/mobile1.png" alt="SomeAlternateText"></button>
					</form>
					<!-- <div id="mobileEticket">Mobile E-Ticket</div> -->
				</div>
			</div>


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
								<th>Price</th>
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
								<td>$<?php echo sprintf('%0.2f',$row['price']); ?></td>
								</tr>						
								<?php 	
								}
								?>
							<?php endif ?>
						<?php endforeach ?>
						</tbody>


						<tfoot>
						    <tr>
						    	<td colspan="3"></td>
					    		<td id="subTotal">Total: $<?php echo sprintf('%0.2f',$value['subTotal']); ?></td>	
						    </tr>

						</tfoot>
					</table>
					<hr>
				<?php $Total += $value['subTotal']; ?>
				<?php endforeach ?>
				<?php 
				$voucherStatus="N/A";
				if ($tempArray[$arrayKey]['voucher'] != "N/A") {
					$discount = "0.2";
					$discountTotal = $Total * $discount;
					$displayDiscount = "- $ " .sprintf('%0.2f',$discountTotal). " (20%)";
					$voucherStatus=$tempArray[$arrayKey]['voucher'];
				}
				$grandTotal = $Total - $discountTotal; ?>

				<form id="form" class="cartForm" method="post" action="">
				    <div id="customerDetail">Total :</div>
				    <div class="content">
				        <div>
				            <div class="cartField"><span>Voucher :</span><span class="cartFloatRight"><?php echo $voucherStatus; ?></span></div>
				            <div class="cartField"><span>Subtotal :</span><span class="cartFloatRight">$<?php echo sprintf('%0.2f',$Total); ?></span></div>
							<div class="cartField"><span>Discount :</span><span class="cartFloatRight"><?php echo $displayDiscount; ?></span></div>	
							<div class="cartField" id="cartGrandTotal"><span>Grand Total</span><span class="cartFloatRight">$<?php echo sprintf('%0.2f',$grandTotal); ?></span></div>					

				        </div>
				    </div>
				</form>
		</div>
	<?php end:?>
	<!-- require footer.php -->
	<?php require_once 'modularization/footer.php';?>
	</body>
</html>