<?php

/**
 * Description
 * Name: Description
 * Type: String
 * Maximum length: 200
 * Required: Yes
 * Comments: A short description of the product. This description is displayed in the account overview at
 * Payson.se. If a purchase is made up of several items, it is recommended that “Description” is specified as
 * “Items from...” or “In regards to an order placed at...” and the name of the store.
 */
class Payson_Model_Description
{
  private $value; 

  public function __construct($value)
  {
    $this->value = (string)$value;
  }

  public function __toString()
  {
    return (string)$this->value;
  }


}

