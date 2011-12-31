<?php

/**
 * Cost
 * Name: Cost
 * Type: Integers or floating point
 * Maximum length:
 * Required: Yes
 * Comments: This is the cost of the item or service. “Cost” must be an integer (e.g. 145) or a floating point
 * number (e.g. 145,50). Please note that the comma (,) must be used if the amount is not an integer.
 *
 * ExtraCost
 * Name: ExtraCost
 * Type: Integers or floating point
 * Maximum length:
 * Required: Yes
 * Comments: This parameter can be used if the seller wishes to add extra costs to cover shipping costs.
 * The parameter is required and set to zero if not used. “ExtraCost” must be an integer (e.g. 145) or a
 * floating point number (e.g. 145,50). Please note that the comma (,) must be used if the amount is not an
 * integer.
 *
 * If “ExtraCost” has been specified, “Amount”, “Shipping” and “Total Amount” are shown to the buyer. If
 * “ExtraCost” is set to zero only “Amount” is shown to the buyer. ”Total Amount” is the sum of “Cost” and
 * “ExtraCost”. “Total Amount” must be at least SEK 10.
 */
class Payson_Model_Cost
{
  private $value; 

  public function __construct($value)
  {
    $this->value = (double)$value;
  }

  public function __toString()
  {
    return (string)$this->value;
  }


}

