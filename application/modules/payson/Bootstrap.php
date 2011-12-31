<?php

class Payson_Bootstrap extends Zend_Application_Module_Bootstrap
{
  protected function _initPaysonOptions()
  {
    $options = $this->getOptions();
    Zend_Registry::set('paysonOptions', $options);
  }


}
