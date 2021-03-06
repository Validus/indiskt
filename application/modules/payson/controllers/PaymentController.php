<?php

class Payson_PaymentController extends Zend_Controller_Action
{
  private $_postRedirectGet = null;
  private $helper;

  public function init()
  {
    $this->_postRedirectGet = $this->_helper->getHelper('Redirector');
    $this->_postRedirectGet->setCode(303);

    $this->options = Zend_Registry::get('paysonOptions');
    $this->helper = new Payson_Model_Helper($this->options);
  }

  public function indexAction()
  {
    $cost = new Payson_Model_Cost(60);
    $extraCost = new Payson_Model_Cost(7);  // (60+2+3)/.97-60 = 7.01

    $refNr = new Payson_Model_RefNr($this->_getParam('refNr'));

    try
    {
      $email = new Payson_Model_Email($this->_getParam('email'));
      $this->view->form = $this->helper->createForm(
        $email,
        new Payson_Model_Description("Indisk mat"),
        $cost,
        $extraCost,
        $refNr
      );
    }
    catch (Exception $e)
    {
      $this->view->exception = $e;
      $this->view->email = $this->_getParam('email');
      $this->view->refNr = (string)$refNr;
    }
  }

  public function doneAction()
  {
    $keys = array('OkURL', 'RefNr', 'Paysonref', 'MD5', 'Fee'); 
    foreach($keys as $key)
    {
      $$key = trim($this->_getParam($key));
    }

    $this->helper->validatePaysonRedirect($OkURL, $Paysonref, $MD5);

    $orderProcess = new Application_Model_OrderProcess();
    $orderProcess->paid($RefNr, $this->options['sellerEmail'], $Paysonref);

    $this->_postRedirectGet->gotoUrl('/order/summary');
  }


}



