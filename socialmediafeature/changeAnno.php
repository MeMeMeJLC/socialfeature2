<?php

require_once 'MySQLDB.php';
require_once 'myFunctions.php';
$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'image_annotator';
$db = new MySQL( $host, $dbUser , $dbPass , $dbName );
$db->selectDatabase();

			if (isset($_POST['newComment'])){
				$newComment = $_POST['newComment'];
				$theAnnotationID = $_POST['annotationID'];
				updateAnnotation($db, $theAnnotationID, $newComment);
				header("location:annotate.php");
			}