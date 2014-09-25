<?php

class CartController extends BaseController{

  function indexAction(int $userId) {
  	$cartItems = Cart::findById(array("userId" => $userId, "bought" => false));
  	return $this->render("index.html.haml", array("cartItems" => $cartItems, "userId" => $userId));

  }

  function buyAction(int $userId, int $itemId) {
  	$item = Item::findById(array("id" => $itemId));
  	if($item->getQuantity() != 0) {
    $cart = new cart();
    $cart->setUserId($userId);
    $cart->setItemId($itemId);
    $cart->setBought(false); 
    $cart->save();  
    return $this->redirect(SiteController, index); 
  	}
  }

  function checkoutAction(int $userId) {
  	$cartItems = Cart::findById(array("userId" => $userId));
  	foreach ($cartItems as $cartItem) {
      if(!$cartItem->getBought()) {
        $cartItem->setBought(true);
        $itemId = $cartItem->getItemId();
        $item  = Item::findById(array("id" => $itemId));
        $item->setQuantity($item->getQuantity() - 1);
        $item->save();
        $cartItem->save();
      }
    }
    return $this->redirect(CartController, index);
  }

  function historyAction(int $userId) {
    $boughtItems = Cart::findById(array("userId" => $userId, "bought" => true));
    return $this->render("history.html.haml", array("boughtItems" => $boughtItems, "userId" => $userId));
  }
}
