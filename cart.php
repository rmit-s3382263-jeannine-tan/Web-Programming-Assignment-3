<?php 
session_start(); 

//for remove session
if (isset($_GET['remove'])){
unset($_SESSION['myBooking']['cart']['screening'][$_GET['remove']]);
}


//for empty cart button
if ((isset($_GET['emptyCart'])) && ($_GET['emptyCart'] == "yes") ){
	foreach ($_SESSION['myBooking']['cart']['screening'] as $key => $value) {
		unset($_SESSION['myBooking']['cart']['screening'][$key]);
		session_destroy();
	}
}


//get value from modify.php, set them to variable
foreach ($_POST as $key => $value) {
        $$key=$value; 
}


//update session array
if (isset($sessionNumber)) {
	$seatType = array("SA","SP","SC","FA","FC","B1","B2","B3");
	$_SESSION['myBooking']['cart']['screening'][$sessionNumber]['subTotal'] = 0;
	foreach ($seatType as $key => $value) {
			$_SESSION['myBooking']['cart']['screening'][$sessionNumber]['seats'][$value]['quantity'] = $$value;
			$_SESSION['myBooking']['cart']['screening'][$sessionNumber]['subTotal']+= $$value * $_SESSION['myBooking']['cart']['screening'][$sessionNumber]['seats'][$value]['price'];
	}
	//unset array if all ticket qty is zero
	if ($SA+$SP+$SC+$FA+$FC+$B1+$B2+$B3 == 0) {
		unset($_SESSION['myBooking']['cart']['screening'][$sessionNumber]);
	}

}

$link = "index.php";
$discountTotal="0";
$discount = "0";
$Total = "0";
$displayDiscount = "N / A";


function validateVoucher($voucher) {
	if (empty($voucher)) {
		$voucher="00000-00000-AA";
	}
	//check if voucher is valid
	$checkSum = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

	$voucherPartOne = (($voucher[0] * $voucher[1] + $voucher[2]) * $voucher[3] + $voucher[4]) % 26;
	    
	$voucherPartTwo = (($voucher[6] * $voucher[7] + $voucher[8]) * $voucher[9] + $voucher[10]) % 26;

	$voucherValid="invalid";

	if (( $voucherPartOne == array_search($voucher[12], $checkSum))
	      &&
	    ( $voucherPartTwo == array_search($voucher[13], $checkSum))
	      &&
	    ( !(empty($_POST['Voucher'])) )

	    )
	    {
	   		$_SESSION['voucher']= $_POST['Voucher'];
	   		$_SESSION['myBooking']['voucher'] = $_SESSION['voucher'];
	        $voucherValid="valid";
	        $_SESSION['voucherValid']="valid";
	        return true;

	    } else {
	        $voucherValid="invalid";
	        $_SESSION['voucherValid']="invalid";	        
			return false;
	    }
} //end of funcction





if (empty($_POST['cartName'])) {
$_POST['cartName']="";
}

if (empty($_POST['cartEmail'])) {
$_POST['cartEmail']="";
}

if (empty($_POST['cartMobile'])) {
$_POST['cartMobile']="";
}


if (empty($voucherValid)) {
$voucherValid="invalid";
}

if (empty($_SESSION['voucherValid'])) {
$_SESSION['voucherValid']="invalid";
}


if (isset($_SESSION['name'])) {
	$_SESSION['name']= "";
}

if (isset($_SESSION['email'])) {
	$_SESSION['email']="";
}

if (isset($_SESSION['phone'])) {
	$_SESSION['phone']="";
}

if (empty($_SESSION['countError'])) {
$_SESSION['countError']="0";
}



$_SESSION['name']= $_POST['cartName'];
$_SESSION['email']= $_POST['cartEmail'];
$_SESSION['phone']= $_POST['cartMobile'];


// Define variable for each page
$pageName="Shopping Cart";

require_once 'modularization/preContent.php'; 
?>


		<!-- ref: sweetalert plugin to make the alert box more beautiful-->
		<!-- ref: http://t4t5.github.io/sweetalert/ -->
	    <script type="text/javascript" src="js/beautiful-alert.js"></script>
		<script src="js/sweetalert.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">



		<!-- function for button action -->
		<script>
    		function submitForm(action)
			    {
			        document.getElementById('form').action = action;
			        document.getElementById('form').submit();
			    }

		</script>




	<!-- for confirm empty cart  -->
	<script type="text/javascript">
	function confirmEmpty(){
	swal({   
		title: "Are you sure?",   
		text: "You will not be able to recover your booking!",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, delete it!",   
		cancelButtonText: "No, cancel please!",   
		closeOnConfirm: false,   
		closeOnCancel: false }, 

		function(isConfirm){   
			if (isConfirm) {     
				swal("Clear!", "Your shopping cart has been cleared.", "success"); 
				self.location='?emptyCart=yes';

			} else {     
				swal("Cancelled", "Your shopping cart is safe :)", "error");   
			} });

	}
	</script>


	<script type="text/javascript">
	function confirmRemoveSession(item){
	swal({   
		title: "Are you sure?",   
		text: "You will not be able to recover your booking!",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, delete it!",   
		cancelButtonText: "No, cancel please!",   
		closeOnConfirm: false,   
		closeOnCancel: false }, 

		function(isConfirm){   
			if (isConfirm) {     
				swal("Clear!", "Your session has been cleared.", "success"); 
				self.location='?remove='+item;

			} else {     
				swal("Cancelled", "Your session is safe :)", "error");   
			} });

	}
	</script>

	
	</head>


	<body class="bodyCart">
		<!-- require hearder.php -->
		<?php require_once 'modularization/header.php';?>

		<div id="cartTitle"><h1>Shopping Cart</h1></div>
		<div class="cartBlock">
		
			<?php if ((empty($_SESSION['myBooking']['cart']['screening']))) :?>
			<div id="empty">
				<img src="images/emptycart.png" />
				<p>Oops!! Your shopping cart is empty!</p>
			</div>
			</div>
			<?php goto end;?>
			<?php endif ?>
			<?php foreach ($_SESSION['myBooking']['cart']['screening'] as $key => $value): ?>

			<?php
				switch ($value['type']) {
					case 'CH':
						$link = "bigHero6.php";
						break;
					case 'AF':
						$link = "lostInTranslation.php";
						break;
					case 'RC':
						$link = "amelie.php";
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
					<div class="carth1">Session: <?php echo $value['day']?>, <?php echo $value['time']?><span class="cartFloatRight"><a href="modify.php?modifySession=<?php echo $key;?>">Modify session</a></span></div>

				<table id="cartTable">
					<thead>
						<tr>
							<th class="ticketType">Ticket Type</th>
							<th>Cost</th>
							<th>Quantity</th>
							<th>Seats</th>
							<th>Subtotal</th>
						</tr>
					</thead>

					<tbody>
					<?php foreach ($value['seats'] as $row): ?>
						<?php if ($row['quantity'] > 0 ): ?>
						<tr>
							<td class="ticketType"><?php echo $row['ticketType']; ?></td>
							<td>$<?php echo sprintf('%0.2f',$row['price']); ?></td>
							<td><?php echo $row['quantity']; ?></td>
							<td><?php
									for($i = 0; $i < count($row['position']); $i++) {
									     echo $row['position'][$i];
									     if (!(count($row['position']) - $i == 1)) { //prevent last value comma
									     echo ", ";
									     }
									}
								?>
							</td>
							<td>$<?php echo sprintf('%0.2f',($row['quantity'] * $row['price'])); ?></td>						
						</tr>
						<?php endif ?>
					<?php endforeach ?>
					</tbody>


					<tfoot>
					    <tr>
					    	<td colspan="4"></td>
					    	<td id="subTotal">Total: $<?php echo sprintf('%0.2f',$value['subTotal']); ?></td>	
					    </tr>
					    <tr>
					    	<td colspan="4"></td>
					    	<td id="remove"><a href="javascript:confirmRemoveSession(<?php echo $key;?>)" class="whiteLink">Remove session from cart</a></td>
					    </tr>
					</tfoot>
				</table>
				<hr>
			<?php $Total += $value['subTotal']; ?>
			<?php endforeach ?>

			<?php 
				if ((isset($_POST['Voucher'])) && (validateVoucher($_POST['Voucher'])) && ($_SESSION['voucherValid']=="valid")) {
					$discount = "0.2";
					$discountTotal = $Total * $discount;
					$displayDiscount = "-$" .sprintf('%0.2f',$discountTotal). " (20%)";
				?>
				<script type="text/javascript">
					swal("Sweet!", "Valid Voucher Code!", "success");
				</script>

				<?php
				}
					elseif ((isset($_POST['Voucher'])) && (!(validateVoucher($_POST['Voucher']))) && ($_SESSION['countError'] < 5))
					{
						$_SESSION['countError']++;
						?>
						<script type="text/javascript">
							sweetAlert("Oops...", "Invalid Voucher Code... You have <?php echo 5-$_SESSION['countError'] ?> times left to try."  , "error");
						</script>

				<?php
					}

					if ($_SESSION['voucherValid']=="valid") {
						$discount = "0.2";
						$discountTotal = $Total * $discount;
						$displayDiscount = "-$" .sprintf('%0.2f',$discountTotal). " (20%)";
					}

					$grandTotal = $Total - $discountTotal; ?>
			





				<form id="form" class="cartForm" method="post" action="">
				    <div id="customerDetail">Customer Details</div>
				    <div class="content">
				        <div>
				            <div class="cartField">
				            	<label for="Name">Name :</label>
				            	<input type="text" id="cartName" name="cartName" minlength="2" pattern="^[a-zA-Z ']*$" title="Name can only contain letters, spaces and apostrophes" required autofocus value="<?php echo $_SESSION['name'] ?>" />
				            </div>
				            <div class="cartField">
				            	<label for="Email">Email :</label>
				            	<input type="text" id="cartEmail" name="cartEmail" required autofocus value="<?php echo $_SESSION['email'] ?>" />
				            </div>
				            <div class="cartField">
				            	<label for="Mobile">Mobile :</label>
				            	<input type="text" id="cartMobile" name="cartMobile" required autofocus pattern="^(\(04\)|04|\+614)[ ]?\d{4}[ ]?\d{4}$" title="Please enter a valid mobile number" value="<?php echo $_SESSION['phone'] ?>" />
				            </div>
				            <div class="cartField" id="voucherDIV"><label for="Voucher">Voucher :</label>
				            	<div id="voucherContainer">
				            		<input type="text" id="Voucher" name="Voucher" pattern="^\d{5}-\d{5}-[A-Z]{2}$" title="Voucher code must in the format 00000-00000-AB" value="" />
				            		<input type="submit" value="Apply" id="apply" name="submit" onclick="submitForm('#')" />
				            	</div>	
				            </div>
				            <div class="cartField" id="voucherAccept"><span>Voucher accepted :</span><span class="cartFloatRight"><?php echo $_SESSION['voucher']; ?></span></div>
				            <div class="cartField" id="voucherDeny"><span>Voucher denied :</span><span class="cartFloatRight">Please try again later!</span></div>
							<div class="cartField"><span>Subtotal :</span><span class="cartFloatRight">$<?php echo sprintf('%0.2f',$Total); ?></span></div>
							<div class="cartField"><span>Discount :</span><span class="cartFloatRight"><?php echo $displayDiscount; ?></span></div>	
							<div class="cartField" id="cartGrandTotal"><span>Grand Total</span><span class="cartFloatRight">$<?php echo sprintf('%0.2f',$grandTotal); ?></span></div>
							<div class="cartField">
				            	<div id="checkOutContainer">
				            		<input type="button" value="Empty Cart" id="emptyCart" onClick="confirmEmpty()" />
				            		<input type="submit" value="Check Out" id="checkOut" name="submit" onclick="submitForm('checkout.php')"/>
				            	</div>	
							</div>
							<script type="text/javascript">$('#voucherAccept').hide();</script>
							<script type="text/javascript">$('#voucherDeny').hide();</script>
						<?php if ($_SESSION['voucherValid']=="valid" || ((isset($_POST['Voucher'])) && (validateVoucher($_POST['Voucher'])))): ?>
						        <script type="text/javascript">
						        	$('#voucherDIV').hide();
						        	$('#voucherDeny').hide();
						        	$('#voucherAccept').show();
						        </script>							
						<?php endif ?>

				        </div>
				    </div>
				</form>

		</div>

	<?php if ($_SESSION['countError'] >=5): ?>
	
				<script type="text/javascript">
					sweetAlert("SORRY!", "You have exceeded the number of allowed, please try again later!", "error");
					$('#voucherDIV').hide();
					$('#voucherDeny').show();

				</script>

	<?php endif ?>



		<!-- for emptycart.png -->
		<?php end:?>

		<!-- require footer.php -->
		<?php require_once 'modularization/footer.php';?>
	</body>
</html>
