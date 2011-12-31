<?php

class Payson_Model_Post
{
  public $url;
  public $fields;

  public function __construct(Payson_Model_Url $url, $fields)
  {
    $this->url = $url;
    $this->fields = $fields;
  }

}

