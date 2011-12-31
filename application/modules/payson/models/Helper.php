<?php

class Payson_Model_Helper
{
  private $url;
  private $agentId;
  private $key;
  private $sellerEmail;
  private $okUrl;

  public function __construct($options)
  {
    $this->url          = new Payson_Model_Url($options['url']);
    $this->agentId      = $options['agentId'];
    $this->key          = $options['key'];
    $this->sellerEmail  = new Payson_Model_Email($options['sellerEmail']);
    $this->okUrl        = new Payson_Model_Url($options['okUrl']);
  }

  private function calculateChecksum(
    Payson_Model_Cost $cost, 
    Payson_Model_Cost $extraCost, 
    $guaranteeOffered)
  {
    $parameters =
      implode(
        ':',
        array_map(
          'strval',
          array($this->sellerEmail, $cost, $extraCost,  $this->okUrl, $guaranteeOffered)
        )
      ) . $this->key;
    //echo $parameters;
    return md5($parameters);
  }

  public function createForm(
    Payson_Model_Email $buyerEmail, 
    Payson_Model_Description $description,
    Payson_Model_Cost $cost, 
    Payson_Model_Cost $extraCost, 
    Payson_Model_RefNr $refNr)
  {
    $guaranteeOffered = "1";

    $md5 = $this->calculateChecksum($cost, $extraCost, $guaranteeOffered);

    return new Payson_Model_Post($this->url,
      array(
        'AgentId'           => $this->agentId,
        'BuyerEmail'        => $buyerEmail,
        'Cost'              => $cost,
        'Description'       => $description,
        'ExtraCost'         => $extraCost,
        'GuaranteeOffered'  => $guaranteeOffered,
        'MD5'               => $md5,
        'OkUrl'             => $this->okUrl,
        'RefNr'             => $refNr,
        'SellerEmail'       => $this->sellerEmail,
      ));
  }

}

