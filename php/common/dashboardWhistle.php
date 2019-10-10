<?php

require_once __DIR__.'/dbOperations.php';
require_once __DIR__.'/appConfig.php';
        
class Dashboard{
    
    public function whistleRelation(){
          $sql='SELECT rt.name, count(r.relation) AS count,rt.id FROM whistle r, relation rt WHERE r.relation=rt.id GROUP BY r.relation';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getdatafortitle($id)
{
          $sql='SELECT count(r.relation) AS count,r.about_title AS title,rt.id AS id FROM whistle r, relation rt WHERE r.relation=rt.id GROUP BY r.relation';
  $dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 'i', $paramArray);
}
    public function whistleStatus(){
          $sql='SELECT rt.name, count(r.status) AS count FROM whistle r, whistle_status rt WHERE r.status=rt.id GROUP BY r.status';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function whistleMoneyRange(){
          $sql='SELECT rt.pricing, count(r.money) AS count FROM whistle r, money_range rt WHERE r.money=rt.id GROUP BY r.money';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function whistleCompany(){
          $sql='SELECT rt.name, count(r.company_id) AS count FROM whistle r, company rt WHERE r.company_id=rt.id GROUP BY r.company_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
}