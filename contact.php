<?php 
// Define variable for each page
$pageName="Contact US";

require_once 'modularization/preContent.php'; ?>
</head>

<body class="bodyContactUS">
	<div id="mainContainer">
		<!-- require hearder.php -->
		<?php require_once 'modularization/header.php';?>
		<div class="contactBanner">
			<div class="textContent">
				<p>SILVERADO RE-OPENING<br />LIMITED TICKETS AVALIABLE<br />CLICK 
				<a href="bighero.php">HERE</a> TO BUY</p>
			</div>
		</div>
		<div class="infoContainer">
			<!-- tutorial code from https://coveloping.com/tools/html5-responsive-form-generator used as a starting point to create adaptive page layout -->
			<!-- This page inspire me to edit the layout of form. -->
			<form class="contactUS" name="form" accept-charset="UTF-8" action='http://titan.csit.rmit.edu.au/~e54061/wp/form-tester.php' method="post">
			    <h1>CONTACT&nbsp;US</h1>
			    <div class="content">
			        <div class="intro">We welcome your feedback, fill out the form or call us on 1314 888 969</div>
			        <div id="section0" >
			            <label class="field1">SUBJECT</label>
			            	<select id="subject" name="subject" required>
			            		<option value="">Please&nbsp;select&nbsp;an&nbsp;option</option>
				            	<option value="General&nbsp;Enquiry">General&nbsp;Enquiry</option>
				            	<option value="Group&nbsp;and&nbsp;Corporate&nbsp;Bookings">Group&nbsp;and&nbsp;Corporate&nbsp;Bookings</option>
				            	<option value="Suggestions&nbsp;&&nbsp;Complaints">Suggestions&nbsp;&&nbsp;Complaints</option>
			            	</select>
			            <label class="field1">NAME</label><input type="text" id="NAME" name="name" required />
			            <label class="field1">EMAIL</label><input type="email" id="email" name="email" required />
			            <label class="field1">MESSAGE</label><textarea id="message" name="message" wrap="hard" cols="20" required ></textarea>
			            <div class="field1" id="requireField" ><label>Indicates required field</label></div>
			            <div class="field2" id="checkboxMessage">
			<!--             test-email default value is false because the checkbox is not checked,
			            but it will override the default value when it is checked -->
			            <input type="hidden" name="test-email" value="false" />
			            <input type="checkbox" name="test-email" value="true" />
			            Send me a copy of my enquiry via email</div>
			            <div class="field2">
			            <input type="reset" value="RESET" />
			            <input type="submit" value="SEND" />
			            </div>
			        </div>
			    </div>
			</form>

			<div class="findUS">
		    	<h1>FIND&nbsp;US&nbsp;ON:</h1>
			    <a href="http://www.facebook.com" target="_blank" title="FACEBOOK"><img src="images/facebook.png" alt="FACEBOOK" /></a>
			    <a href="http://www.instagram.com" target="_blank" title="Instagram"><img src="images/ynstag.png" alt="Instagram" /></a>
			    <a href="http://www.youtube.com" target="_blank" title="Youtube"><img src="images/youtube.png" alt="Youtube" /></a>
			    <a href="http://www.sina.com.cn" target="_blank" title="Sina"><img src="images/xinlang.png" alt="Sina" /></a>
			    <div class="title1">Address</div>
				<p>Shop 77, 7 Victoria St, Carlton VIC 3053</p>
				<div class="title1">Contact details</div>
				<p>To book please call 1314 888 969</p>
				<p>Situated within the Carlton Central complex, on the Yarra Promenade. In the heart of Carlton, Silverado now offers a powerful and dramatic new cinema sound experience that is at the top of its class, with DOLBY ATMOS. Experience the sound as it moves around the theatre. Now fully licensed! Get your tasty beverages from the candy bar.</p>
			</div>
		</div>
	</div>

		<!-- require footer.php -->
		<?php require_once 'modularization/footer.php';?>	
</body>
</html>
