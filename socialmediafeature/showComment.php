<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
<?php
require_once 'MySQLDB.php';
require_once 'myFunctions.php';

/*$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'image_annotator';
$db = new MySQL( $host, $dbUser , $dbPass , $dbName );
$db->selectDatabase();*/
$con = new SudokuConnectionDetails();
$db = $con->Connect(); 
$db->selectDatabase();

echo "showcomment running";
$thing = intval($_GET['thing']);
echo "$thing";
$sql="select annotation_comment from annotation where annotation_id='".$thing."'";
$result = $db->query($sql);

$aRow = $thing->fetch();
$comment = $aRow['annotation_comment'];
echo "<table id='annotationDataTable'><tr>Annotation</tr><tr><td>$comment</td></tr></table>";
echo "hi";
mysqli_close($con);
?>
</body>
</html>