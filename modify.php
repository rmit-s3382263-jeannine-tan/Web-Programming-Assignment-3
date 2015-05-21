<?php 
session_start(); 

//for remove session
if (isset($_GET['remove'])){
unset($_SESSION['myBooking']['cart']['screening'][$_GET['remove']]);
}

$modifyArray=$_SESSION['myBooking']['cart']['screening'][$_GET["modifySession"]];
$link = "index.php";


function totalID($item){
	switch ($item) {
		case 'Standard Adult':
			echo "SAtotal";
			break;
		case 'Standard Concession':
			echo "SPtotal";
			break;
		case 'Standard Children':
			echo "SCtotal";
			break;
		case 'First Class Adult':
			echo "FAtotal";
			break;
		case 'First Class Children':
			echo "FCtotal";
			break;
		case 'Beanbag Two Adults':
			echo "B1total";
			break;
		case 'Beanbag One Adult, One Children':
			echo "B2total";
			break;
		case 'Beanbag Three Children':
			echo "B3total";
			break;
		}
	}




// Define variable for each page
$pageName="Modify screening";

require_once 'modularization/preContent.php';

?>


		<!-- ref: sweetalert -->
	    <script type="text/javascript" src="js/beautiful-alert.js"></script>
		<script src="js/sweetalert.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">



		<!-- drowdown menu -->
		<script>
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


	      if (isNaN(saPrice)) {
	      	saPrice="0";
	      };

	      if (isNaN(spPrice)) {
	      	spPrice="0";
	      };

	      if (isNaN(scPrice)) {
	      	scPrice="0";
	      };

	      if (isNaN(faPrice)) {
	      	faPrice="0";
	      };

	      if (isNaN(saPrice)) {
	      	saPrice="0";
	      };

	      if (isNaN(fcPrice)) {
	      	fcPrice="0";
	      };

	      if (isNaN(b1Price)) {
	      	b1Price="0";
	      };

	      if (isNaN(b2Price)) {
	      	b2Price="0";
	      };

	      if (isNaN(b3Price)) {
	      	b3Price="0";
	      };


		  //calculate the total price
	      totalPrice = parseInt(saPrice) +parseInt(spPrice) + parseInt(scPrice) + parseInt(faPrice) + parseInt(fcPrice) + parseInt(b1Price) + parseInt(b2Price) + parseInt(b3Price);
	      $("#Total").text(parseFloat(totalPrice).toFixed(2));
	      
	      //sumbit the total price to tester.php
	      document.movieForm.price.value = parseFloat(totalPrice).toFixed(2);

	      return true;
	    }


	    // remove session
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
						// window.location.href = "cart.php";
					} else {     
						swal("Cancelled", "Your session is safe :)", "error");   
					} });

			}


		</script>




</head>
	<body class="bodyCart" onload="updatePrice()">
		<!-- require hearder.php -->
		<?php require_once 'modularization/header.php';?>

		<div id="cartTitle"><h1>Modify screening</h1></div>

<div class="cartBlock">
	<form class="modifyForm" name="modifyForm" accept-charset="UTF-8" action='cart.php' method="post">
		
			<?php
				switch ($modifyArray['type']) {
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


					<div class="cartMovieTitle"><a href="<?php echo $link ?>"><?php echo $modifyArray['movie'];?></a></div>
					<div class="carth1">Session: <?php echo $modifyArray['day']?>, <?php echo $modifyArray['time']?></div>




		<table id="cartTable">
			<thead>
				<tr>
					<th class="ticketType">Ticket Type</th>
					<th>Cost</th>
					<th>Quantity</th>
					<th>Subtotal</th>
				</tr>
			</thead>

			<tbody>
			<?php foreach ($modifyArray['seats'] as $row): ?>
				<tr>
					<td class="ticketType"><?php echo $row['ticketType']; ?></td>
					<td>$<?php echo sprintf('%0.2f',$row['price']); ?></td>
					<td>
						<?php $selected=$row['quantity']; ?>


						<?php $find = array(" ",","); ?>
			        	<select id="<?php 
						switch ($row['ticketType']) {
							case 'Beanbag Two Adults':
								echo "beanbagOne";
								break;
							case 'Beanbag One Adult, One Children':
								echo "beanbagTwo";
								break;
							case 'Beanbag Three Children':
								echo "beanbagThree";
								break;
							default:
								echo str_replace($find, '', lcfirst($row['ticketType'])); 
								break;
							}
			        	?>" data-price="<?php echo sprintf('%0.2f',$row['price']); ?>" onchange="updatePrice(this)" name="<?php echo $row['ticketCode'] ?>">
						  <option value="0" <?php if($selected == '0'){echo("selected");}?>>0</option>
						  <option value="1" <?php if($selected == '1'){echo("selected");}?>>1</option>
						  <option value="2" <?php if($selected == '2'){echo("selected");}?>>2</option>
						  <option value="3" <?php if($selected == '3'){echo("selected");}?>>3</option>
						  <option value="4" <?php if($selected == '4'){echo("selected");}?>>4</option>
						</select>
						<input type="hidden" name="sessionNumber" value="<?php echo $_GET["modifySession"];?>">
						<script type="text/javascript">

						// document.getElementById("test").innerHTML = $(".sel option:selected").text();;

						</script>
					</td>
					<td>$<span id="<?php totalID($row['ticketType']); ?>">0.00</span></td>						
				</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
			    <tr>
			    	<td colspan="3"></td>
			    	<td>$<span id="Total">0.00</span></td>	
			    </tr>
			    <tr>
			    	<td colspan="3"></td>
			    	<td id="remove"><a href="javascript:confirmRemoveSession(<?php echo $_GET["modifySession"];?>)" class="whiteLink">Remove session from cart</a></td>
			    </tr>
			</tfoot>
		</table>
		<hr>
		<input type="submit" value="Confirm" id="Confirm" name="submit"/>
	</form>
</div>

</div>
		<!-- require footer.php -->
		<?php require_once 'modularization/footer.php';?>

</body>
</html>