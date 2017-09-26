<?php
	class shoppingCart{
		private $DBConnect = NULL;
		private $ItemCategory = "";

		function __construct(){
		  include("dbc.php");
		  $this->DBConnect = $dbc;
		}

		function __destruct(){
		  if (!$this->DBConnect->connect_error)
			$this->DBConnect->close();
		}

		public function setItemCategory($ItemCategory){
			if ($this->ItemCategory != $ItemCategory) {
				$this->ItemCategory = $ItemCategory;
				$SQLString = "SELECT * FROM inventory " .
							 "WHERE category = '" . $this->ItemCategory . "'";
				$QueryResult = @$this->DBConnect->query($SQLString);

				if ($QueryResult ===  FALSE) {
				  $this->ItemCategory = "";
				} else {
					$this->inventory = array();
					$this->shoppingCart = array();
					while (($Row = $QueryResult->fetch_assoc()) !== NULL) {
						$this->inventory[$Row['item_id']] = array();
						$this->inventory[$Row['item_id']]['item_name'] = $Row['item_name'];
						$this->inventory[$Row['item_id']]['category'] = $Row['category'];
						$this->inventory[$Row['item_id']]['price'] = $Row['price'];
						$this->inventory[$Row['item_id']]['quantity'] = $Row['quantity'];
						$this->inventory[$Row['item_id']]['item_description'] = $Row['item_description'];
						$this->inventory[$Row['item_id']]['image_link'] = $Row['image_link'];
						$this->shoppingCart[$Row['item_id']] = 0;
					}
				}
		  }
		  // echo "item category set.";
		}

		public function getInventoryList(){
			if (count($this->inventory) > 0) {
				foreach ($this->inventory as $ID => $row) {
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
					echo '<p class="price">PRICE: R ' . htmlentities($row['price']) . '</p><iframe name="votar" style="display:none;"></iframe>';
					echo '<form action="" method="get" target="votar">';//
					echo '<div class="qty"><label>Qty : </label><input type="text" size="1" class="quantity" name="quantity" value="1" /></div>';
					echo '<input type="submit" class="addToCart" name="addToCart" value="Add To Cart" />';
					echo '</form>';
					echo '</div>';
					echo '<div class="itemDesc">';
					echo '<p>' . htmlentities($row['item_description']) . '</p>';
					echo '</div>';
					echo '</div>';
				}
			}
		}
	}
	  
      // Check if method works
      // if (isset($_GET['addToCart'])) {
      //   printf("Item ID is %u and quantity is %u", $_GET['ItemToAdd'], $_GET['quantity']);
      // }
    
	/*
    public function addItem(id, qty){
		$_SESSION[$ItemCategory].add($jjjjj);
	}
	
	 public function addItem(id, qty){
		$_SESSION[$ItemCategory].add($jjjjj);
	}
		
		echo '<script>alert("Works")</script>';*/
      //$ProdID = $_GET['ItemToAdd'];
      //if (array_key_exists($ProdID, $this->shoppingCart)){
        //$this->shoppingCart[$ProdID] += $_GET['quantity'];
        // echo $this->shoppingCart[$ProdID];
      //}
      // if (isset($_GET['addToCart'])) {
      //   printf("Item ID is %u and quantity is %u", $_GET['ItemToAdd'], $this->shoppingCart[$ProdID]);
      // }
    //}
  
 ?>
