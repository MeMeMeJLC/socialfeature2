<?php
session_start();
if(isset($_SESSION['theUserName'])){
	echo "welcome, " . $_SESSION['theUserName'];
}
else {
	echo "session data not set";
}
require_once("MyFunctions.php");
include_once "MYSQLDB.php";
$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();



echo "<h2>Images</h2>";
$images = getImages($db);
displayImages($images);

if(isset($_POST["image"])){
	$_SESSION['theImageID'] = $_POST["image"];
	header("Location:annotate.php");
	//echo $_SESSION['imageID'];
}

?>
<html>
<!--<br><br>
<h2>Add Image</h2>
<form action="profile.php" method="post">
	<input type="text" value="ImageLocation" name="theImageLocation"><br><br>
	<button type="submit">Add image</button>
</form>-->

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>



<br><br>
<a href="main.php">Return to Main Page</a>
</html>