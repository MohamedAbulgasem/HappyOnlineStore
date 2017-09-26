<?php

	$dbc = @new mysqli('localhost', 'root', '','shopping_cart');
		if($dbc->connect_error) {
				echo"<p style='color: #FF0000'>Couldn't select the database because: <br />". $dbc->connect_error . ".</p>";
				$dbc->close();
				$dbc = FALSE;
		}
?>



