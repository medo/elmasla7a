<?php

class TransactionController extends BaseController{

  function buyAction($params) {
    $itemId = $params["itemId"];
    $item = Item::model()->findById(array("id" => $itemId));
  	
    if($item->quantity != 0) {  
    return $this->render("buy.html.haml", array("item" => $item));
  	}
  }

  function checkoutAction($params) {
    $userId = $this->signedInUser()->id;
    $item = $params["item"];
    $item->quantity--;
    $transaction = new Transaction();
    $transaction->userId = $userId;
    $transaction->itemId = $item->id;
    $transaction->save();
    $item->save();
    
    return $this->redirect("Site", "index");
  }

  function historyAction(int $userId) {
    $boughtItems = Transaction::model()->findById(array("userId" => $userId, "bought" => true));
    
    return $this->render("history.html.haml", array("boughtItems" => $boughtItems));
  }
}
