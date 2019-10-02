<?php
  require_once __DIR__.'/whistleManager.php';
  public function getAllRelation()
  {
    $whistleManager = new WhistleManager();
    $allRelation = $whistleManager->getRelation();
    return $allRelation;
}
?>