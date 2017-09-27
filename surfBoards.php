<?php
	include('header.php');
?>
    <div class="content">

        <h1>Surf Boards</h1>

	    <?php
			include('dbc.php');
			$surfBoardsQuery = "SELECT * FROM inventory WHERE category = 'Surf Boards'";
			$queryResult = $dbc->query($surfBoardsQuery);

			if($_SERVER['REQUEST_METHOD'] == 'POST') {		//if "Add To Cart" is clicked
				if($queryResult){		//Query the database for all item

					$qty = $_POST['quantity'];//assign quantity of the submitted item to $qty

					while($row = $queryResult->fetch_array()){	//Loop through each item

						$Item = $row['item_id'];
						if(isset($_POST[$Item])){		//compare each item id in the db to the itemId submitted by the user
							if($qty <= $row['quantity']){		//check if entered quantity is <= available quantity
								//check if the cart session already exists
								if(isset($_SESSION['cart'])){
									//assign it to $Cart
									$Cart = unserialize($_SESSION['cart']);
									//check if the specific item added before already
									if(isset($Cart[$Item])){
										$orderedQty = $Cart[$Item];
										if(($orderedQty + $qty) <= $row['quantity']){
										$Cart[$Item] += $qty; //increment
										echo '<script>alert("item ' . $Item . ' is added, Qty : ' . $Cart[$Item] .  '")</script>';//SUCCESS
										}
										else echo '<script>alert("The Quantity You Ordered For This Item is Unavailable, Please Choose a Lower Quantity!")</script>';
									}
									else{
										$Cart[$Item] = $qty; //assign the qty
										echo '<script>alert("item ' . $Item . ' is added, Qty : ' . $Cart[$Item] .  '")</script>';//SUCCESS
									}
								}
								//if the cart session isn't created then create a new array to be the cart session
								else{
									$Cart = array();
									$Cart[$Item] = $qty;
									echo '<script>alert("item ' . $Item . ' is added, Qty : ' . $Cart[$Item] .  '")</script>';//SUCCESS
								}
							}
							else echo '<script>alert("The Quantity You Ordered For This Item is Unavailable, Please Choose a Lower Quantity!")</script>';
						}
					}
				}
			}

            if($queryResult){
                while($row = $queryResult->fetch_array()){
                    echo '<div class="item">';
                    echo '<div class="itemTitle">';
                    echo '<h3>' . htmlentities($row['item_name']) . '</h3>';
                    echo '</div>';
                    echo '<img src=" ' . htmlentities($row['image_link']) . ' " alt=" ' . htmlentities($row['item_name']) . ' " />';
	                echo '<div class="itemPurchase">';
	                echo '<p class="availability">Availability: ';
	                if((htmlentities($row['quantity'])) < 10){
	                    echo '<span style="color: red;">' . htmlentities($row['quantity']) . ' Left</span></p>';
                    }
                    else{
	                    echo '<span style="color: green;">In stock</span></p>';
                    }
	                echo '<p class="price">PRICE: R ' . htmlentities($row['price']) . '</p>';
	                echo '<form action="surfBoards.php" method="POST" target="votar">';
	                echo '<div class="qty"><label>Qty : </label><input type="text" size="1" class="quantity" name="quantity" value="1" /></div>';
	                echo '<input type="submit" class="addToCart" name="' . $row['item_id'] . '" value="Add To Cart" />';
	                echo '</form>';
	                echo '</div>';
                    echo '<div class="itemDesc">';
                    echo '<p>' . htmlentities($row['item_description']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            }
	    ?>


    </div>
<?php
	if(isset($Cart)){
		$_SESSION['cart'] = serialize($Cart);
	}
	include('footer.php');
?>
