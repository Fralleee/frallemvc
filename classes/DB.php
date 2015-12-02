<?php

class DB{
  private static $instance = null;
  private $pdo, 
          $query, 
          $error, 
          $results, 
          $count = 0;

  private function __construct()
  {
    try 
    {
      $this->pdo = new PDO("mysql:host=".Config::get("mysql/host").";dbname=".Config::get("mysql/db"), Config::get("mysql/username"), Config::get("mysql/password"));
    }
    catch(PDOException $e) 
    {
      die($e->getMessage());
    }
  }

  public static function getInstance()
  {
    if(!isset(self::$instance))
      self::$instance = new DB();

    return self::$instance;
  }

  public function query($sql, $params = array())
  {
    $this->error = false;
    $this->query = $this->pdo->prepare($sql);

    if(count($params)) 
    {
      $i = 1;
      foreach($params as $param) 
      {
        $this->query->bindValue($i, $param);
        $i++;
      }      
    }

    if($this->query->execute()) 
    {
      $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
      $this->count = $this->query->rowCount();
    }
    else
      $this->error = true;

    return $this;
  }

  public function action($action, $table, $where = array())
  {
    if(count($where) === 3)
    {
      $operators = array("=", "<", ">", "<=", ">=");
      $field = $where[0];
      $operator = $where[1];
      $value = $where[2];
      if(in_array($operator, $operators))
      {
        $sql = "{$action} from {$table} where {$field} {$operator} ?";
        if(! $this->query($sql, array($value))->error())
        {
          return $this;
        }
      }
    }
    return false;
  }

  public function get($table, $where)
  {
    return $this->action("select *", $table, $where);
  }

  public function delete($table, $where)
  {
    return $this->action("delete", $table, $where);
  }

  // $userInsert = DB::getInstance()->insert("users", array("Roland", "password", "etc...");
  public function insert($table, $fields = array())
  {
    $keys = array_keys($fields);
    var_dump($keys);
    $values = "";
    $i = 1;
    foreach($fields as $field)
    {
      $values .= "?";
      if($i < count($fields))
        $values .= ", ";

      $i++;
    }
    $sql = "insert into $table (`" . implode("`,`", $keys) . "`) values(".$values.")";
    if(!$this->query($sql, $fields)->error)
      return true;

    return false;
  }

  // $userUpdate = DB::getInstance()->update("users", 3, array("Roland", "password", "etc...");
  public function update($table, $id, $fields)
  {
    $set = "";
    $i = 1;
    foreach($fields as $name => $value)
    {
      $set .= "{$name} =  ?";
      if($i < count($fields))
        $set .= ", ";

      $i++;
    }

    // WHEY IS DIS KRESCHING SERVER
    $sql = "update {$table} set {$set} where id = {$id}";
    if(!$this->query($sql, $fields)->error)
      return true;

    return false;
  }

  public function all()
  {
    if($this->count > 0)
      return $this->results;
    return null;  
  }

  public function take($index, $length = 1)
  {
    if($length == 1)
      return $this->results[$index];
    else
    {
      $returnArr = array();
      for($i = 0; $i<$length; $i++)
      {
        $returnArr[$i] = $this->results[$i];
      }
      return $returnArr;
    }
  }

  public function first()
  {
    if($this->count > 0)
      return $this->results[0];
    else
      return null;
  }

  public function error()
  {
    return $this->error;
  }

  public function count()
  {
    return $this->count;
  }

}