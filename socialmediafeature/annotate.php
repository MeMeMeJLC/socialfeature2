<script>	
 
function getAnAnnotationLocation(){
		var x = event.clientX - 16.5;
		var y = event.clientY - 17;
		document.getElementById('annotationLocationX').value = x;
		document.getElementById('annotationLocationY').value = y;	
console.log(x);
console.log(y);		
	}	
	
</script>
<?php
require_once("MyFunctions.php");
require_once("MYSQLDB.php");
require_once("Token.php");
/*$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();*/

$con = new SudokuConnectionDetails();
$db = $con->Connect(); 
$db->selectDatabase();

session_start();

$theImageID = $_SESSION['theImageID'];
$theUserID = $_SESSION['theUserID'];
#echo "userid = " . $theUserID."<br>";
$i = new Image();
$image = $i->getAnImage($db, $theImageID);

$imageLocation = $i->getImageLocation($db, $theImageID);
#echo "$imageLocation";
$a = new Annotation();
$a->getImageAnnotations($db, $theImageID);
/*$d = AnnotationDisplay();
$d->displayGroup($result);*/
echo "<image onclick=getAnAnnotationLocation(event) src='resources/images/$imageLocation'></image>";	
//displayAnImage($image);
//$theAnnotationLocation = displayAnImageToAnnotate($image);


if(isset($_POST['comment'], $_POST['annotationLocationX'], $_POST['annotationLocationY'])){ #prevent xsrf 
		$comment = $_POST['comment'];
		$locationX = $_POST['annotationLocationX'];
		$locationY = $_POST['annotationLocationY'];
		
		if(!empty($comment) && !empty($locationX) && !empty($locationY)){
			if(Token::check($_POST['token'])){
			echo '<h1>Processed note!</h1>';
				$theAnnotationLocationX = " ".$_POST['annotationLocationX'];
	$theAnnotationLocationY = " ".$_POST['annotationLocationY']." ";

	$a->addAnAnnotation($db, $theImageID, $theUserID, $comment, $theAnnotationLocationX, $theAnnotationLocationY);
	header("Refresh:0");
			}
		}
	}

if(isset($_POST['comment']) and ($_POST['annotationLocationX']) and ($_POST['annotationLocationY'])){
	echo "running";
	$theComment = htmlentities($_POST['comment']);#xss attack proof
	#$theComment = mysqli_real_escape_string($db->query($theComment), $theComment); #sql injection prevention
	/*$theAnnotationLocationX = " ".$_POST['annotationLocationX'];
	$theAnnotationLocationY = " ".$_POST['annotationLocationY']." ";
	addAnAnnotation($db, $theImageID, $theUserID, $theComment, $theAnnotationLocationX, $theAnnotationLocationY);
	header("Refresh:0");*/
}


?>
<html>
<body>
<image id="image" src=''></image>
<br>
<div id="txtHint"><b>Comment will be here...</b></div>

<form method='post' action='annotate.php'>
	Add an annotation:<br> <input type='text' name='comment'></input><br>Click where you want to comment on the image.<br>Then click submit.
	<input type='hidden' id='annotationLocationX' name='annotationLocationX' value=''></input>
	<input type='hidden' id='annotationLocationY' name='annotationLocationY' value=''></input>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>"></input>
	<br><input type='submit'></input>
</form>
<h1 id="annotationLocation"></h1>
<a href="profile.php">Return to user profile</a>
<br><a href="main.php">Return to Main Page</a>
</body>
</html>


