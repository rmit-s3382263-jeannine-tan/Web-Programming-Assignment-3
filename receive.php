<?php 
session_start(); 

$film="";
$movieName="";
$day="";
$time="";
$SA="";
$SC="";
$SP="";
$FA="";
$FC="";
$B1="";
$B2="";
$B3="";




//get the data from index.html, set them to a variable
foreach ($_POST as $key => $value) {
        $$key=$value; 
}

if ($film=="") {
    goto skipPHP;
}



//different price
$priceArrayA= array(
	'SA' => 12,
	'SP' => 10,
	'SC' => 8,
	'FA' => 25,
	'FC' => 20,
	'B1' => 20,
	'B2' => 20,
	'B3' => 20
	);

$priceArrayB= array(
	'SA' => 18,
	'SP' => 15,
	'SC' => 12,
	'FA' => 30,
	'FC' => 25,
	'B1' => 30,
	'B2' => 30,
	'B3' => 30
	);

if (isset($priceArray)) {
    $priceArray= array ();
}


//Find the particular price
if ($film == "CH") {
    switch ($day) {
        case 'Monday':
        case 'Tuesday':
        $priceArray = $priceArrayA;
        break;
        case 'Wednesday':
        case 'Thursday':
        case 'Friday':
        case 'Saturday':
        case 'Sunday':
        $priceArray = $priceArrayB;
        break;
        default:
        # code...
        break;
    }
}

if ($film == "AF") {
    switch ($day) {
        case 'Monday':
        case 'Tuesday':
        $priceArray = $priceArrayA;
        break;
        case 'Saturday':
        case 'Sunday':
        $priceArray = $priceArrayB;
        break;
        default:
        # code...
        break;
    }
}

if ($film == "RC") {
    switch ($day) {
        case 'Monday':
        case 'Tuesday':
        case 'Wednesday':
        case 'Thursday':
        case 'Friday':
        $priceArray = $priceArrayA;
        break;
        case 'Saturday':
        case 'Sunday':
        $priceArray = $priceArrayB;
        break;
        default:
        # code...
        break;
    }
}


if ($film == "AC") {
    $priceArray = $priceArrayB;
}








//Assign movie name
switch ($film) {
    case 'AC':
    $movieName = "Edge of Tomorrow";
        break;
    case 'CH':
    $movieName = "Big Hero 6";
        break;
    case 'AF':
    $movieName = "Lost in Translation";
        break;
    case 'RC':
    $movieName = "Amelie";
        break;
    default:
        break;
}



$tempBooking = array (
	'movie' => $movieName,
	'type' => $film,
	'day' => $day,
	'time' => $time,
	'seats' => array (),
	'subTotal' => 0
);




function ticketType($item){
    switch ($item) {
        case 'SA':
        $type = 'Standard Adult';
            return $type;
            break;
        case 'SP':
        $type = 'Standard Concession';
            return $type;
            break;
        case 'SC':
        $type = 'Standard Children';
            return $type;
            break;
        case 'FA':
        $type = 'First Class Adult';
            return $type;
            break;
        case 'FC':
        $type = 'First Class Children';
            return $type;
            break;
        case 'B1':
        $type = 'Beanbag Two Adults';
            return $type;
            break;
        case 'B2':
        $type = 'Beanbag One Adult, One Children';
            return $type;
            break;
        case 'B3':
        $type = 'Beanbag Three Children';
            return $type;
            break;

        default:
            return $item;
            break;
    }

}



$seatType = array("SA","SP","SC","FA","FC","B1","B2","B3");
foreach ($seatType as $key => $value) {
	// if ($$value > 0) {
	$tempSeats = array (
        'ticketType' => ticketType($value),
        'ticketCode' => $value,
		'quantity' => $$value,
		'price' => $priceArray [$value],
		'position' => array()
	);

    // Generate random seat number
    if (isset($seatNumber)) {
        $seatNumber="";
    }
    if (isset($seatPos)) {
    $seatPos="";
    }
    $seatNumber = rand(1,40-$tempSeats['quantity']);
    for ($i=0; $i < $$value ; $i++) {
            $seatPos=$value."-".$seatNumber; 
            array_push($tempSeats['position'], $seatPos);
            $seatNumber++;
    }




	$tempBooking ['seats'][$value] = $tempSeats;
	$tempBooking ['subTotal'] += $$value * $priceArray [$value];
	// }
}






if (!isset($_SESSION['myBooking'])) {
    $_SESSION['myBooking'] = array (
    	'name' => '',
    	'email' => '',
    	'phone' => '',
        'voucher' => 'N/A',
        'uid' => '',
    	'cart' => array (
    		'screening' => array ()
    	)
    );
}

array_push($_SESSION ['myBooking']['cart']['screening'], $tempBooking);




?>

<?php skipPHP:?>


<?php // Define variable for each page
$pageName="Receive";
require_once 'modularization/preContent.php';?>

        <!-- refer:http://www.jqueryrain.com/?ekkjPgqM -->
        <script src="js/jqmeter.min.js"></script>
        

    </head>
    
    <body class="bodyReceive">
        <!-- require hearder.php -->
        <?php require_once 'modularization/header.php';?>

        <?php if ($film=="") { 

            // echo "Please buy some ticket!";


            goto end; } ?>
        <div id="receive">
            
            <div id="jqmeter-horizontal"></div>
            <h1>Adding a session to shopping cart...</h1>


            <!-- ref:http://www.jqueryrain.com/?ekkjPgqM -->
            <script>
            $(document).ready(function(e) {
              $('#jqmeter-horizontal').jQMeter({goal:'$10,000',raised:'$10,000',width:'300px',animationSpeed:3000,barColor:'#a684a6',counterSpeed:3000});
            });
            </script>

            <?php header('refresh: 4; url=cart.php'); // redirect the user after 2 seconds ?>
        </div>


        <!-- for emptycart.png -->
        <?php end:?>
        <!-- require footer.php -->
        <?php require_once 'modularization/footer.php';?>
    </body>
</html>