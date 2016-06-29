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

$con = new MaoriConnectionDetails();
$db = $con->Connect(); 
$db->selectDatabase();


echo "<h2>Images</h2>";
$i = new Image();
$images = $i->getImages($db);
$d = new ImageDisplay();
$d->displayGroup($images);

if(isset($_POST["image"])){
	$_SESSION['theImageID'] = $_POST["image"];
	header("Location:annotate.php");
	//echo $_SESSION['imageID'];
}

echo "<h2>All Annotations</h2>";
$all = new AllTables();
$allInfo = $all->getAllTables($db);

$allD = new AllDisplay();
$allD->displayGroup($allInfo);
echo "<br>";
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