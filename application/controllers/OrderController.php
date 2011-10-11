<?php

class OrderController extends Zend_Controller_Action
{

  protected $_postRedirectGet = null;

  public function init()
  {
    $this->_postRedirectGet = $this->_helper->getHelper('Redirector');
    $this->_postRedirectGet->setCode(303);

    $this->today = self::getTodayFormatted();
  }

  protected static function getTodayFormatted()
  {
    $now = new DateTime();
    $today = $now->format('Y-m-d');
    return $today;
  }

  public function indexAction()
  {
    // action body
  }

  public function addAction()
  {
    $order = new stdClass();

    $keys = array('person','base_dish','rice','power','drink','amount_paid'); 
    foreach($keys as $key)
    {
      $order->$key = trim($this->_getParam($key));
    }

    $order->day = $this->today;

    $orderProcess = new Application_Model_OrderProcess();
    $orderProcess->add($order);

    $this->_postRedirectGet->gotoUrl('/order/show/?person='.urlencode($order->person));
  }

  public function showAction()
  {
    $person = $this->_getParam('person');

    $orderProcess = new Application_Model_OrderProcess();
    $order = $orderProcess->getByDayAndPerson($this->today, $person);

    $this->view->order = $order;
  }

  public function summaryAction()
  {
    $orderProcess = new Application_Model_OrderProcess();

    $this->view->today = $this->today;
    $this->view->foodSummary = $orderProcess->getFoodSummary($this->today);
    $this->view->drinkSummary = $orderProcess->getDrinkSummary($this->today);
    $this->view->all = $orderProcess->getAll($this->today);
    $this->view->paidSum = $orderProcess->getPaidSum($this->today);
    $this->view->unpaidSum = 60 * count($this->view->all) - $orderProcess->getPaidSum($this->today);
  }


}



