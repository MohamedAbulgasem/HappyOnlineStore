<?php
	include('header.php');
?>
    <div class="content">
	
        <h1>Surf Boards</h1>
<?php
  require_once("shoppingCart.php");
  $ItemCategory = "Wet Suits";

  if (class_exists("shoppingCart")) {
    $cart = new shoppingCart();
  }

  $cart->setItemCategory($ItemCategory);

  $cart->getInventoryList();

  //$cart->addItem();
 ?>
    </div>
<?php
  include('footer.php');
?>
