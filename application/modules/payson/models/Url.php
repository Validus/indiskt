<?php

/**
 * OkUrl
 * Name: OkUrl
 * Type: String
 * Maximum length: 255
 * Required: Yes
 * Comments: This URL is requested when a purchase is completed. It is requested both asynchronically in
 * the background by Payson and through the buyer’s browser when he clicks on “Back to the store”. This
 * parameter can thus be requested more than once. Please note that this parameter must be HTML-
 * encoded so that spaces and other special characters are correctly formatted.
 */
class Payson_Model_Url
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

