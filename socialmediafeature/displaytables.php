<?php
require_once 'MySQLDB.php';
require_once 'myFunctions.php';
$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'image_annotator';
$db = new MySQL( $host, $dbUser , $dbPass , $dbName );
$db->selectDatabase();
//---- Display The users Table
echo "<h2>users</h2>";
$users = getusers($db);
displayusers($users);

echo "<h2>Images</h2>";
$images = getImages($db);
displayImages($images);

echo "<h2>Annotation</h2>";
$annotations = getAnnotations($db);
displayAnnotations($annotations);


?>
<html>
<body>
<br><br>
<a href="main.php">Return To Main Form</a>
</body>
</html>