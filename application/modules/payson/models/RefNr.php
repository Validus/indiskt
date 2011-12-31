<?php

/**
 * Name: RefNr
 * Type: String
 * Maximum length: 20
 * Required: No
 * Standard value: ””
 * Comments: This parameter is used to identify a unique purchase. It is 
 * returned to the seller when a
 * purchase is completed and it can be used to mark it as such.
 */
class Payson_Model_RefNr
{
  private $value; 

  public function __construct($value)
  {
    $value = (string)$value;

    if (strlen($value) > 20)
    {
      throw new Payson_Model_Exception('RefNr maximum length is 20');
    }

    $this->value = $value;
  }

  public function __toString()
  {
    return (string)$this->value;
  }
}

