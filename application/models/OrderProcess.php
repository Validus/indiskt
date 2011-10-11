<?php

class Application_Model_OrderProcess
{

  public function add($order)
  {
    $dbTable = new Application_Model_DbTable_Order();
    $dbTable->insert((array)$order);
  }

  public function getByDayAndPerson($day, $person)
  {
    $dbTable = new Application_Model_DbTable_Order();

    $select = $dbTable->select()
      ->where('day = ?', $day)
      ->where('person = ?', $person)
      ->limit(1);

    $row = $dbTable->fetchRow($select);
    return $row ? (object)$row->toArray() : null;
  }

  public function getDrinkSummary($day)
  {
    $dbTable = new Application_Model_DbTable_Order();

    $columns = array('drink');

    $select = $dbTable->select()
      ->from($dbTable, array_merge(array('COUNT(*) AS count'), $columns))
      ->where('day = ?', $day)
      ->group($columns)
      ->order($columns);

    return $dbTable->fetchAll($select);
  }

  public function getFoodSummary($day)
  {
    $dbTable = new Application_Model_DbTable_Order();

    $columns = array('base_dish', 'power', 'rice');

    $select = $dbTable->select()
      ->from($dbTable, array_merge(array('COUNT(*) AS count'), $columns))
      ->where('day = ?', $day)
      ->group($columns)
      ->order($columns);

    return $dbTable->fetchAll($select);
  }

  /*
  public function getUnpaid($expectedPayment)
  {
    $dbTable = new Application_Model_DbTable_Order();

    $select = $dbTable->select()
      ->where('day = ?', $day)
      ->where('amount_paid != ?', $expectedPayment)
      ->order('person');

    return $this->fetchAll($select);
  }
   */

  public function getAll($day)
  {
    $dbTable = new Application_Model_DbTable_Order();

    $select = $dbTable->select()
      ->where('day = ?', $day)
      ->order('person');

    return $dbTable->fetchAll($select);
  }

}

