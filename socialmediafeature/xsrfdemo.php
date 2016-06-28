<?php
	session_start();
	require_once 'TokenDemo.php';
	
	if(isset($_POST['quantity'], $_POST['product'])){
		$product = $_POST['product'];
		$quantity = $_POST['quantity'];
		
		if(!empty($product) && !empty($quantity)){
			if(Token::check($_POST['token'])){
			echo 'Process Order';
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<body>
	<form action method="post">
		<div class="product">
			<strong>A Product</strong>
			<div class="field">
				Quantity: <Input type="text" name="quantity">
			</div>
			<input type="submit" value="Order">
			<input type="hidden" name="product" value="1">
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> <!-- no instantiation of token class needed because its a static class-->			
		</div>
	</form>
</body>
</html>

<?php
#echo $_SESSION['token'];
?>
