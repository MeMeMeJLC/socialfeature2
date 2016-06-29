<?php
session_save_path("./");
session_start();
session_destroy();
?>
<html>
<h1>image annotator</h1>
<a href="build.php">Build The Database</a>
<br /><br />

<a href="displayTables.php">Display All Tables</a>
<br /><br />

<a href="login.php">Login/Register</a>


</html>
