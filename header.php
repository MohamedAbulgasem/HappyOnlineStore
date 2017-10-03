<?php
	session_start();
?>
<!doctype html>
<html>
	<head>
		<title>Happy Online Store</title>
		<meta charset="UTF-8">
    <link rel="icon" href="style/logo.png">
		<link rel="stylesheet" type="text/css" href="style/css.css" />
	<body>
		<?php
			//Establishing database connection for all the shopping cart operations
			include('dbc.php');

			//if user is logged in
			if(isset($_SESSION['user_name'])){
				$member = $_SESSION['user_name'];
				echo"<p style='text-align: right; position: absolute; top:10px; right: 50px;'>Welcome to our store <b>" . $member . "</b>. (<a href='logout.php'>Logout</a>)</p>";
			}
			else echo "<p id='welcome'>Welcome to our store. Please <a href='login.php'>Login</a> or <a href='registration.php'>Register</a></p>";

			//If Cart icon is clicked
			if(isset($_POST['action'])){
				if(isset($_SESSION['cart'])){
					if(isset($_SESSION['user_name'])){
						header("Location: checkout.php");
					}
					else echo '<script language="javascript">alert("Please Login Before You Can Checkout!"); </script>';
				}
				else echo '<script language="javascript">alert("Cart is Empty!"); </script>';
			}
		?>
		<div id="homelogo">
			<a href="index.php"><img src="style/logo.png" alt="Logo" width="100px" height="97px" style="margin-top: 5px"></a>
		</div>
		<img src="style/head.jpg" alt="header" id="header">
		<div class="topnav" id="myTopnav">
			<a href="index.php">Home</a>
			<a href="surfBoards.php">Surf Boards</a>
			<a href="wetSuits.php">Wet Suits</a>
			<a href="about.php">About Our Store</a>
			<a href="javascript:void(0);" class="icon" onclick="responsive()">&#9776;</a>
		</div>
		<form action="header.php" method="POST" <?php if(!(isset($_SESSION['cart'])) && !(isset($_SESSION['user_name']))) echo 'target="votar"' ?>>
        <input type="image" src="style/cart.png" alt="Submit" width="30px" height="30px" style="text-align: right; position: absolute; top: 5px; right: 370px;">
			  <input type="hidden" name="action">
    </form>
	<script type="text/javascript">
         function responsive() {
             var x = document.getElementById("myTopnav");
             if (x.className === "topnav") {
                 x.className += " responsive";
             } else {
	             x.className = "topnav";
             }
         }
	</script>
