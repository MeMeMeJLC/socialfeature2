<?php
require_once("MyFunctions.php");
include_once "MYSQLDB.php";
$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();

echo "Login";

if(isset($_POST["theUserName"], $_POST["thePassword"])){
		$theUserName = $_POST["theUserName"];
		$thePassword = $_POST["thePassword"];
		$user = new User();
	    $stored_password = $user->getAUserNameAndPassword($db, $theUserName);
		#echo $thePassword." ".$stored_password;
		
		if(password_verify( $thePassword, $stored_password)){
			echo "<br>you are in!";
			$user = new User();
			$theUserID = $user->getAUserID($db, $theUserName);
			#echo " The userID = $theUserID";
			       // specify where to save the session variables
        //session_save_path("./");
		echo "<script>window.alert($theUserID)</script>";
        session_start();
      // register the session variables and load the next page
        $_SESSION['theUserName'] = $theUserName;
		$_SESSION['thePassword'] = $thePassword;
		$_SESSION['theUserID'] = $theUserID;
		sleep(1);
        header ("Location:profile.php") ;
		exit;
		//echo "<br> session id ".$_SESSION['theUserID'];
		/*$user = getAUser($db,$theUserID);
		displayAUser($user);*/
   
		} else{
			echo "<br>not valid login info";
		}	
} else {
	echo "<br>Please enter username and password";
}
 
?>

<form action="login.php" method="post">
	Enter User Name:<input type="text" name="theUserName"><br>
	Enter Password:<input type="text" name="thePassword"><br>
	<button type="submit" name="Login">Login User In</button>
</form>
<a href="registerNewUser.php">Register new user<a>

<html>
<body>
<br><br>
<a href="main.php">Return To Main Form</a>
</body>
</html>