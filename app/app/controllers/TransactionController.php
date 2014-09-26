<?php

class TransactionController extends BaseController{

  function buyAction($params) {
    $itemId = $params["itemId"];
    $userId = $this->signedInUser()->getId();
  	$item = Item::findById(array("id" => $itemId));
  	
    if($item->getQuantity() != 0) {  
    return $this->render("buy.html.haml", array("item" => $item));
  	}
  }

  function checkoutAction($params) {
    $userId = $this->signedInUser()->getId();
  	$item = $params["item"];
    $item->setQuantity($item->getQuantity()--);
    $transaction = new Transaction();
    $transaction->setUserId($userId);
    $transaction->setItemId($item->getId());
    $transaction->save();
    $item->save();
    
    return $this->redirect("Site", "index");
  }

  function historyAction(int $userId) {
    $boughtItems = Transaction::findById(array("userId" => $userId, "bought" => true));
    
    return $this->render("history.html.haml", array("boughtItems" => $boughtItems));
  }
}
