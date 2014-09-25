<?php

class CartController extends BaseController{

  function indexAction(int $userId) {
  	$cartItems = cart::findById(array("userId" => $userId, "bought" => false));
  	return $this->render("index.html.haml", array("cartItems" => $cartItems, "userId" => $userId));

  }

  function buyAction(int $userId, int $itemId) {
  	$item = items::findById(array("id" => $itemId));
  	if($item->getQuantity() != 0) {
    $cart = new Cart();
    $cart->setUserId($userId);
    $cart->setItemId($itemId);
    $cart->setBought(false); 
    $cart->save();   
  	}
  }

  function checkoutAction(int $userId) {
  	$cartItems = cart::findById(array("userId" => $userId));
  	foreach ($cartItems as $item) {
      if(!$item->getBought()) {
        $item->setBought(true);
        $item->setQuantity($item->getQuantity() - 1);
        $item->save();
      }
    }
  }

  function historyAction(int $userId) {
    $boughtItems = cart::findById(array("userId" => $userId, "bought" => true));
    return $this->render("history.html.haml", array("boughtItems" => $boughtItems, "userId" => $userId));
  }
}
