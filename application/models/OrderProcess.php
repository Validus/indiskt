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

  public function getPayAgentSummary($day)
  {
    $dbTable = new Application_Model_DbTable_Order();

    $columns = array('paid_to');
    $select = $dbTable->select()
      ->from($dbTable, array_merge(array('COUNT(*) AS count', 'SUM(amount_paid) AS paid_sum'), $columns))
      ->where('day = ?', $day)
      ->where('paid_to IS NOT NULL')
      ->where('paid_to != ""')
      ->group($columns)
      ->order($columns);

    return $dbTable->fetchAll($select);
  }

  public function getUnpaidSummary($day)
  {
    $dbTable = new Application_Model_DbTable_Order();

    $select = $dbTable->select()
      ->where('day = ?', $day)
      ->where('(paid_to IS NULL OR paid_to = "" OR amount_paid != 60)')
      ->order('person');

    return $dbTable->fetchAll($select);
  }

  public function getAll($day)
  {
    $dbTable = new Application_Model_DbTable_Order();

    $select = $dbTable->select()
      ->where('day = ?', $day)
      ->order('person');

    return $dbTable->fetchAll($select);
  }

  public function getPeople()
  {
    $dbTable = new Application_Model_DbTable_Order();
    $select = $dbTable->select()
      ->from($dbTable, 'person')
      ->distinct()
      ->order('person');
    $rows = $dbTable->fetchAll($select);
    $people = array();
    foreach ($rows as $row)
    {
       $people[] = $row->person;
    }
    return $people;
  }

  public function getPowers()
  {
    $dbTable = new Application_Model_DbTable_Order();
    $select = $dbTable->select()
      ->from($dbTable, 'power')
      ->distinct()
      ->order('power');
    $rows = $dbTable->fetchAll($select);
    $powers = array();
    foreach ($rows as $row)
    {
       $powers[] = $row->power;
    }
    return $powers;
  }

  public function paid($id, $paidTo, $paysonRef)
  {
    $table = new Application_Model_DbTable_Order();
    $where = $table->getAdapter()->quoteInto('id = ?', $id);
    
    $data = array(
      'paid_to' => $paidTo,
      'amount_paid' => 60,
      'paysonRef' => $paysonRef,
    );

    $table->update($data, $where);
  }

}

