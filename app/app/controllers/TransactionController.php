<?php

class TransactionController extends BaseController{

  function buyAction($params) {
    $itemId = $params["itemId"];
    $item = Item::model()->find($itemId);
    if($item->quantity != 0) {
      return $this->render("buy.html.haml", array("item" => $item));
    }else{
      $this->redirect("Site","index");
    }
  }

  function checkoutAction($params) {
    if($this->isGuest()){
      $this->redirect("Site","login");
    }
    $userId = $this->signedInUser()->id;
    $itemId = $params["itemId"];
    $item = Item::model()->find($itemId);
    $item->quantity--;
    $transaction = new Transaction();
    $transaction->userId = $userId;
    $transaction->itemId = $item->id;
    $transaction->date = date("Y-m-d H:i:s");
    $item->save();
    $transaction->save();
    
    return $this->redirect("Site", "index");
  }

  function historyAction(int $userId) {
    if($this->isGuest()){
      $this->redirect("Site","login");
    }
    $boughtItems = Transaction::model()->findById(array("userId" => $userId, "bought" => true));
    return $this->render("history.html.haml", array("boughtItems" => $boughtItems));
  }
}
