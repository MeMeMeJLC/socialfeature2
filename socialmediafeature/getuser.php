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
$q = intval($_GET['q']);

/*$con = mysqli_connect('localhost','peter','abc123','my_db');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");*/

require_once 'MySQLDB.php';
require_once 'myFunctions.php';
$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'image_annotator';
$db = new MySQL( $host, $dbUser , $dbPass , $dbName );
$db->selectDatabase();


$sql="SELECT * FROM annotation WHERE annotation_id = '".$q."'";
$result = $db->query($sql);

echo "<table>
<tr>
<th>Comment ID</th>
<th>User ID</th>
<th>Comment</th>
</tr>";
while($row = $result->fetch()) {
    echo "<tr>";
	echo "<td>" . $row['annotation_id'] . "</td>";
	echo "<td>" . $row['userID_fk'] . "</td>";
    echo "<td>" . $row['annotation_comment'] . "</td>";

    echo "</tr>";
}
echo "</table>";

?>
</body>
</html>