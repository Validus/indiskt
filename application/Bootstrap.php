<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

  public function _initDoctype()
  {
    $doctypeHelper = new Zend_View_Helper_Doctype();
    $doctypeHelper->doctype('HTML5');
  }

}

