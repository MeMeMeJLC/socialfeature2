
<form method="post" action="test.php">
	Add an annotation: <input type="text" name="comment"></input><br>
	<input type="text" id="annotationLocation" name="annotationLocation" value=""></input>
	<input type="submit"></input>
</form>

<?php

displayAnImageToAnnotate();

	function displayAnImageToAnnotate(
	){

		
		echo"<script>	function getAnAnnotationLocation(){
		var x = event.clientX;
		var y = event.clientY;
		var coords = x + '' + y;
		window.alert(coords);
		document.getElementByID('annotationLocation').value = coords; 
	}	</script>";
		
		echo "<image src='resources/images/105.png' onclick='getAnAnnotationLocation(event)'></image>";

		
	}
	
echo "<script type='text/javascript'>
  // #chk1 exists in DOM, this works
  //document.getElementById('annotationLocation').value = 'dogs';
</script>";

?>