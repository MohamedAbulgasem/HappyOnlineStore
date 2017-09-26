<?php
	include('header.php');
?>
    <div class="content">

        <h1>Checkout</h1>
<?php
	if(isset($_SESSION['cart'])){
		$items = unserialize($_SESSION['cart']);
		//echo '<pre>'; 
		//print_r($items); 
		//echo '</pre>';
		$counter = 1;
		foreach($items as $key => $vals){
			include('dbc.php');
            $Query = "SELECT * FROM inventory WHERE item_id = '" . $key . "'";
            $queryResult = $dbc->query($Query);
			
			if($queryResult){
                $row = $queryResult->fetch_array();
				echo '<table style="width:80%; height: 60px; border: 2px solid #632F8D; margin: 10px auto; margin-bottom: 10px;">';
				echo '<tr>';
				echo '<td style="border-right: 2px solid #632F8D; height:100%; width: 5%; text-align:center;"><b>' . $counter . '</b></td>';
				echo '<td style="height:100%; width: 35%; text-align:center;"><b>' . htmlentities($row['item_name']) . '</b></td>';
				echo '<td style="border-right: 2px solid #632F8D; height:100%; width: 10%; text-align:center;"><img src=" ' . htmlentities($row['image_link']) . ' " alt=" ' . htmlentities($row['item_name']) . ' " width="50px" height="50px"/></td>';
				echo '<td style="border-right: 2px solid #632F8D; height:100%; width: 15%; text-align:center;"><b>Price</b><br />' . htmlentities($row['price']) . '</td>';
				echo '<td style="border-right: 2px solid #632F8D; height:100%; width: 10%; text-align:center;"><b>Quantity</b><br />' . $vals . '</td>';
				echo '<td style="height:100%; width: 25%; text-align:center;"><b>Subtotal</b><br />R ' . ($vals * $row['price']) . '</td>';
				echo '</tr>';
				echo '</table>';	
			}
			$counter++;
		}
	}
?>
		
	</div>
	
	
<?php
	include('footer.php');
?>