<html>
<form action="registerNewUser.php" method="post">
	First name:<input type="text" name="theFirstName"><br>
	Last Name:<input type="text" name="theLastName"><br>
	User name:<input type="text" name="theUserName"><br>
	Password:<input type="text"  name="thePassword"><br>
	<button type="submit">Register new user</button>
</form>

<br /><br />
<a href="main.php">Return To Main Form</a>

</html>

<?php
require_once("MyFunctions.php");
include_once "MYSQLDB.php";

/*$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();*/

$con = new SudokuConnectionDetails();
$db = $con->Connect(); 
$db->selectDatabase();

echo "<h2>register new user</h2>";

	if(isset(/*$_POST["thefirstName"],$_POST["theLastName"],*/$_POST["theUserName"], $_POST["thePassword"])){
		$theUserName = $_POST["theUserName"];
		$thePassword = $_POST["thePassword"];
		$theFirstName = $_POST["theFirstName"];
		$theLastName = $_POST["theLastName"];
		$hashed = password_hash($thePassword, PASSWORD_BCRYPT, array('cost' => 12));
		echo "$theUserName, $thePassword, $theFirstName, $theLastName";
		$user = new User();
		$user->addAUser($db,$theUserName, $hashed ,$theFirstName, $theLastName);
		$result = $user->getAUser($db, $theUserName);
		$displayU = new UserDisplay();
		$displayU->displayOne($result);
		
		sleep(3);
        header ("Location:login.php") ;
		exit;

   
		} else {
	echo "<br>Please enter firstname, lastname, username and password";
}	



?>