<?php
require_once 'MySQLDB.php';
require_once 'myFunctions.php';
/*$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'image_annotator';
$db = new MySQL( $host, $dbUser , $dbPass , $dbName );
$db->selectDatabase();*/
$con = new MaoriConnectionDetails();
$db = $con->Connect(); 
$db->selectDatabase();

//---- Display The users Table
echo "<h2>users</h2>";
$u = new User();
$users = $u->getusers($db);
$u = new UserDisplay();
$u->displayOne($users);

echo "<h2>Images</h2>";
$i = new Image();
$images = $i->getImages($db);
$d = new ImageDisplay();
$d->displayGroup($images);

echo "<h2>Annotation</h2>";
$a = new Annotation();
$annotations = $a->getAnnotations($db);
$d = new AnnotationDisplay();
$d->displayGroup($annotations);


?>
<html>
<body>
<br><br>
<a href="main.php">Return To Main Form</a>
</body>
</html>