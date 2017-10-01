<?php
	include('header.php');
?>
    <div class="content">
        <h1 style="color:#632F8D;">Checkout</h1>
<?php

	if(isset($_SESSION['cart'])){

		$items = $_SESSION['cart'];

		//if 'remove' is clicked
		foreach($items as $key => $vals){
			if(isset($_POST[$key])){
				unset($items[$key]);
				$_SESSION['cart'] = $items;
			}
	  }

		$subtotal = 0.0;
		$total = 0.0;
		$itemsCounter = 0;
		$counter = 1;
		foreach($items as $key => $vals){

      $Query = "SELECT * FROM inventory WHERE item_id = '" . $key . "'";
      $queryResult = $dbc->query($Query);

			if($queryResult){
                $row = $queryResult->fetch_array();
								//if '+' is clicked
								if(isset($_POST['add'.$key])){
									$tester = $vals+1;
									if($tester <= $row['quantity']){
										$vals=$tester;
										$items[$key]=$vals;
										$_SESSION['cart'] = $items;
									}
									else echo '<script>alert("More Quantity For This Item is Unavailable!")</script>';
								}
								//if '-' is clicked
								if(isset($_POST['minus'.$key])){
									$tester = $vals-1;
									if($tester > 0){
										$vals=$tester;
										$items[$key]=$vals;
										$_SESSION['cart'] = $items;
									}
									else echo '<script>alert("You Can\'t Set The Quantity Lower Than 1!")</script>';
								}
								//display cart items
								echo '<table style="width:80%; height: 70px; border: 2px solid #632F8D; margin: 10px auto; margin-bottom: 10px;">';
								echo '<tr>';
								echo '<td style="border-right: 2px solid #632F8D; height:100%; width: 5%; text-align:center;"><b>' . $counter . '</b></td>';
							  echo '<td style="height:100%; width: 35%; text-align:center;"><b>' . htmlentities($row['item_name']) . '</b></td>';
								echo '<td style="border-right: 2px solid #632F8D; height:100%; width: 10%; text-align:center;"><img src=" ' . htmlentities($row['image_link']) . ' " alt=" ' . htmlentities($row['item_name']) . ' " width="50px" height="50px"/></td>';
								echo '<td style="border-right: 2px solid #632F8D; height:100%; width: 10%; text-align:center;"><b>Price</b><br />' . htmlentities($row['price']) . '</td>';
								echo '<td style="height:100%; width: 11%; text-align:center;"><b>Quantity</b><br />' . $vals . '</td>';
								echo '<td style="border-right: 2px solid #632F8D; height:100%; width: 4%; text-align:center;">';
										echo '<form action="checkout.php" method="POST">';
										echo '<input type="image" src="style/plus.png" alt="+" title="Add" width="25px" height="25px">';
										echo '<input type="hidden" name="add' . $key . '">';
										echo '</form>';
										echo '<form action="checkout.php" method="POST">';
										echo '<input type="image" src="style/minus.png" alt="-" title="Deduct" width="25px" height="25px">';
										echo '<input type="hidden" name="minus' . $key . '">';
										echo '</form>';
							  echo '</td>';
								$subtotal = $vals * $row['price'];
								echo '<td style="height:100%; width: 15%; text-align:center;"><b>Subtotal</b><br />R ' . $subtotal . '</td>';
								echo '<td style="height:100%; width: 10%; text-align:center;">';
								 	  echo '<form action="checkout.php" method="POST">';
							  	  echo '<input type="submit" name="' . $key . '" value="Remove" style="background-color:#f44242; color:#fff; width:70%; border:1px solid #ff8787; padding:9px; font-size:14px; cursor:pointer; border-radius:5px;">';
								 	  echo '</form>';
							  echo '</td>';
								echo '</tr>';
								echo '</table>';
			}
			$itemsCounter += $vals;
			$total += $subtotal;
			$counter++;
		}

		//if 'checkout' is clicked
		if(isset($_POST['checkout'])){

				//1_ Insert into orders table
				$cusId = $_SESSION['customer_id'];
				$insertOrder = "INSERT INTO orders (order_num, total_amount, order_date, customer_id)
													VALUES (NULL, '$total', CURRENT_TIMESTAMP, '$cusId'); ";
				$dbc->query($insertOrder);

					//initialising variables
				$item_name = '';
				$category = '';
				$price = '';
				$existingQuantity = '';
				$orderedQuantity = '';
				$updatedQuantity = '';
				$total_amount = '';

				foreach($items as $key => $vals){

						//Retriving required data from the DB
					$Q = "SELECT * FROM inventory WHERE item_id = '" . $key . "'";
					$queryRslt = $dbc->query($Q);

					if($queryRslt){
						$row = $queryRslt->fetch_array();
							$item_name = $row['item_name'];
							$category = $row['category'];
							$price = $row['price'];
							$existingQuantity = $row['quantity'];
							$orderedQuantity = $vals;
							$updatedQuantity = $existingQuantity - $orderedQuantity;
							$total_amount = $orderedQuantity * $price;
					}

					//2_ Insert into orderlines table
							//Retriving order_num from orders table
							$ordernumQuery = "SELECT order_num FROM orders WHERE total_amount = '" . $total . "'";
							$ordernumResult = $dbc->query($ordernumQuery);
							$ordernumRow = $ordernumResult->fetch_array();
							$order_num = $ordernumRow['order_num'];


					$insertOrder = "INSERT INTO orderlines (orderline, item_name, category, price, quantity, total_amount, order_num)
														VALUES (NULL, '$item_name', '$category', '$price', '$orderedQuantity', '$total_amount', '$order_num'); ";

					//3_ Update inventory table
					$updateItemQuantity = "UPDATE inventory SET quantity = " . $updatedQuantity . "
											WHERE item_id = '" . $key . "'";
					$dbc->query($updateItemQuantity);

				}
				echo '<script language="javascript">alert("Order Successful!"); </script>';
				//redirect to the postcheckout page
				header("Location: postcheckout.php");
		}

		echo '<table style="width:32%; height: 100px; border: 2px solid #632F8D; margin-top: 10px; margin-bottom: 10px; margin-right: 145px; float: right;">';
		echo '<tr>';
		echo '<td style="border-right: 2px solid #632F8D; height:100%; width: 37.5%; text-align:center; font-size:20px;"><b>Quantity</b><br />' . $itemsCounter . ' Items</td>';
		echo '<td style="height:100%; width: 62.5%; text-align:center; font-size:20px;"><b>Total</b><br />R ' . $total . '</td>';
		echo '</tr>';
		echo '</table>';
		echo '<div style="height:200px; width: 400px; float:right; margin-right:120px;">';
		  echo '<form action="checkout.php" method="POST">';
	    echo '<input type="submit" name="checkout" value="Checkout" style="background-color:#632F8D; margin-top: 50px; color:#fff; width:80%; border:1px solid mediumpurple; padding:10px; font-size:32px; cursor:pointer; border-radius:5px; font-family:"Microsoft YaHei Light";">';
		  echo '</form>';
		echo '</div>';

	}
?>

	</div>


<?php
	include('footer.php');
?>
