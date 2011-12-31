<?php

/**
 * SellerEmail
 * Name: SellerEmail
 * Type: String
 * Maximum length: 50
 * Required: Yes
 * Comment: This is the email address that the seller uses as his Payson account. It is to this email address
 * that funds are transferred to. This is also the email address that is notified when a purchase is completed.
 *
 * BuyerEmail
 * Name: BuyerEmail
 * Type: String
 * Maximum length: 50
 * Required: Yes
 * Comments: This is the buyer’s email address and it is used to create a Payson account needed to process
 * a purchase.
 */
class Payson_Model_Email
{
  private static $validator;
  private $value; 

  private static function getValidator()
  {
    if (empty(self::$validator))
    {
      self::$validator = new Zend_Validate_EmailAddress();
    }
    return self::$validator;
  }

  public function __construct($value)
  {
    $value = (string)$value;

    $validator = self::getValidator();

    if (!$validator->isValid($value))
    {
      throw new Payson_Model_Exception(
        implode('; ', $validator->getMessages())
      );
    }

    $this->value = $value;
  }

  public function __toString()
  {
    return (string)$this->value;
  }


}

