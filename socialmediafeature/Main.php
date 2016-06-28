<?php
session_save_path("./");
session_start();
session_destroy();
?>
<html>

<a href="build.php">Build The Database</a>
<br /><br />

<a href="displayTables.php">Display All Tables</a>
<br /><br />

<a href="login.php">Login/Register</a>

<br /><br />

<a href="addImage.php">Add Image</a>

</html>
