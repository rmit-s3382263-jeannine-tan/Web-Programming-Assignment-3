<?php $password="123";
$hashAndSalt = password_hash($password, PASSWORD_BCRYPT);
echo $hashAndSalt;

?>