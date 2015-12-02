<?php

class Validate
{

  private $passed = false,
          $errors = array(),
          $db = null;

  public function __construct()
  {
    $this->db = DB::getInstance();
  }

  public function check($source, $items = array())
  {
    foreach($items as $item => $rules)
    {
      $displayname = $rules["displayname"];
      foreach($rules as $rule => $ruleValue)
      {
        $value = $source[$item];
        $item = escape($item);

        if($rule === "required" && empty($value))
          $this->addError($item, "{$displayname} is required");
        else if(!empty($value))
        {
          switch($rule)
          {
            case "min":
              if(strlen($value) < $ruleValue)
                $this->addError($item, "{$displayname} must be a minimum of {$ruleValue} characters.");
            break;

            case "max":
              if(strlen($value) > $ruleValue)
                $this->addError($item, "{$displayname} must be a maximum of {$ruleValue} characters.");
            break;

            case "matches":
              if($value != $source[$ruleValue])
                $this->addError($item, "{$displayname} must match {$ruleValue}.");
            break;
            case "unique":
              $check = $this->db->get($ruleValue, array($item, "=", $value));
              if($check->count())
                $this->addError($item, "{$displayname} already exists.");
            break;
             
          }
        }

      }

    }
    if(empty($this->errors))
    {
      $this->passed = true;
    }

    return $this;

  }

  private function addError($item, $error)
  {
    $this->errors[$item] = $error;
  }

  private function getError($item)
  {
    if(exists($this->errors[$item]))
      return $this->errors[$item];
    else
      return "";
  }

  public function errors()
  {
    return $this->errors;
  }

  public function passed()
  {
    return $this->passed;
  }

}