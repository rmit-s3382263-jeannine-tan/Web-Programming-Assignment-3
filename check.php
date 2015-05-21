<?php 
session_start(); ?>


<!DOCTYPE html>
<html>
<head>
	<title>Debug page</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>

</head>
<body>


<div id="tabs">
  <ul>
    <li><a href="#tabs-1">record.json</a></li>
    <li><a href="#tabs-2">Session Array</a></li>
  </ul>

  <div id="tabs-1">
	<pre><?php 
		$record = file_get_contents('record.json');
		$tempArray = json_decode($record,true);
		unset($record);
		print_r($tempArray);
		unset($tempArray);
		 ?></pre>
  </div>


  <div id="tabs-2">
	<pre><?php print_r($_SESSION['myBooking']); ?></pre>
  </div>




</div>



</body>
</html>