<?php
require_once("MyFunctions.php");
include_once "MYSQLDB.php";
$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();

function isValidForm ( $theAnnotationComment, $theAnnotationLocation, $theUserIDFK, $theImageIDFK  ) 
{
    $result = true;
    if ( $theAnnotationComment == "" and $theAnnotationLocation =="" and $theUserIDFK=="" and $theImageIDFK="" )
    {
       $result = false;
       print "Please enter the annotation comment, location, userID, and imageID";
    }
return $result;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // grab the variables from the form
    $theAnnotationComment = $_POST["theAnnotationComment"];
    $theAnnotationLocation = $_POST["theAnnotationLocation"];
    $theUserIDFK = $_POST["theUserIDFK"];
    $theImageIDFK = $_POST["theImageIDFK"];
    
    if ( isValidForm ( $theAnnotationComment, $theAnnotationLocation, $theUserIDFK, $theImageIDFK  )  )
    {
       // specify where to save the session variables
        session_save_path("./");
        session_start();
      // register the session variables and load the next page
        #$_SESSION["theImageLocation"] = $theImageLocation ;
		$_SESSION["theAnnotationComment"] = $theAnnotationComment ;
		$_SESSION["theAnnotationLocation"] = $theAnnotationLocation ;
		$_SESSION["theUserIDFK"] = $theUserIDFK ;
		$_SESSION["theImageIDFK"] = $theImageIDFK ;
        /*header ("Location:searchProductsA.php")*/ ;
		$annotation = addAnAnnotation($db,$theAnnotationComment, $theAnnotationLocation, $theUserIDFK, $theImageIDFK );
    }
} 
?>
<html>
<h2>Add Annotation</h2>
<form action="addAnnotation.php" method="post">
	<input type="text" value="Add Comment Here" name="theAnnotationComment"><br><br>
	<input type="text" value="Add Location Here" name="theAnnotationLocation"><br><br>
	<input type="text" value="Add User ID" name="theUserIDFK"><br><br>
	<input type="text" value="Add Image ID" name="theImageIDFK"><br><br>
	<button type="submit" value="Search for user">Add Comment</button>
</form>



<br><br>
<a href="main.php">Return to Main Page</a>
</html>