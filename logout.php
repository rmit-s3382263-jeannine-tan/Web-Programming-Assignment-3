<script type="text/javascript">setTimeout("window.close();", 1);</script>


<?php 
session_start();

//destroy all sessions canceling the login session
session_destroy();

//display success message
echo 'You have successfully logged out!<br><br>';


?>

