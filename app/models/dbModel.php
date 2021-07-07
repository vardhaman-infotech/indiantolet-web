<?php

@ob_start;

class dbModel extends PDO {

    private $error;
    private $sql;
    private $bind;
    private $errorCallbackFunction;
    private $errorMsgFormat;
    private $dsn = "mysql:host=localhost;dbname=Bookmylab";
    private $user = "root";
    private $passwd = "";

    public function tableName() {
        
    }

    public function __construct() {
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            parent::__construct("mysql:host=" . VACDB_HOST . ";dbname=" . VACDB_NAME, VACDB_USER, VACDB_PASS, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    private function debug() {
        if (!empty($this->errorCallbackFunction)) {
            $error = array("Error" => $this->error);
            if (!empty($this->sql))
                $error["SQL Statement"] = $this->sql;
            if (!empty($this->bind))
                $error["Bind Parameters"] = trim(print_r($this->bind, true));

            $backtrace = debug_backtrace();
            if (!empty($backtrace)) {
                foreach ($backtrace as $info) {
                    if ($info["file"] != __FILE__)
                        $error["Backtrace"] = $info["file"] . " at line " . $info["line"];
                }
            }

            $msg = "";
            if ($this->errorMsgFormat == "html") {
                if (!empty($error["Bind Parameters"]))
                    $error["Bind Parameters"] = "<pre>" . $error["Bind Parameters"] . "</pre>";
                $css = trim(file_get_contents(dirname(__FILE__) . "/error.css"));
                $msg .= '<style type="text/css">' . "\n" . $css . "\n</style>";
                $msg .= "\n" . '<div class="db-error">' . "\n\t<h3>SQL Error</h3>";
                foreach ($error as $key => $val)
                    $msg .= "\n\t<label>" . $key . ":</label>" . $val;
                $msg .= "\n\t</div>\n</div>";
            }
            elseif ($this->errorMsgFormat == "text") {
                $msg .= "SQL Error\n" . str_repeat("-", 50);
                foreach ($error as $key => $val)
                    $msg .= "\n\n$key:\n$val";
            }

            $func = $this->errorCallbackFunction;
            $func($msg);
        }
    }

    public function delete($where, $bind = "") {
        $sql = "DELETE FROM " . $this->tableName() . " WHERE " . $where . ";";
        // echo $sql;die;
        $this->run($sql, $bind);
    }

    private function filter($table, $info) {
        $driver = $this->getAttribute(PDO::ATTR_DRIVER_NAME);
        if ($driver == 'sqlite') {
            $sql = "PRAGMA table_info('" . $table . "');";
            $key = "name";
        } elseif ($driver == 'mysql') {
            $sql = "DESCRIBE " . $table . ";";
            $key = "Field";
        } else {
            $sql = "SELECT column_name FROM information_schema.columns WHERE table_name = '" . $table . "';";
            $key = "column_name";
        }

        if (false !== ($list = $this->run($sql))) {
            $fields = array();
            foreach ($list as $record)
                $fields[] = $record->$key;

            return array_values(array_intersect($fields, array_keys($info)));
        }
        return array();
    }

    private function cleanup($bind) {
        if (!is_array($bind)) {
            if (!empty($bind))
                $bind = array($bind);
            else
                $bind = array();
        }
        $bind = $this->cleanArray($bind);
        return $bind;
    }

    public function insert($info) {
        $fields = $this->filter($this->tableName(), $info);

        $sql = "INSERT INTO " . $this->tableName() . " (" . implode($fields, ", ") . ") VALUES (:" . implode($fields, ", :") . ");";
        //echo $sql;die;
        $bind = array();
        foreach ($fields as $field)
            $bind[":$field"] = $info[$field];
//        echo $sql;die;
        return $this->run($sql, $bind);
    }

    public function run($sql, $bind = "") {

        $this->sql = trim($sql);
        $this->bind = $this->cleanup($bind);
        $this->error = "";
        try {

            $pdostmt = $this->prepare($this->sql);
            if ($pdostmt->execute($this->bind) !== false) {
                if (preg_match("/^(" . implode("|", array("select", "describe", "pragma")) . ") /i", $this->sql)) {
                    //return $pdostmt->fetchAll(PDO::FETCH_ASSOC); 
                    return $pdostmt->fetchAll(PDO::FETCH_OBJ);
                } elseif (preg_match("/^(" . implode("|", array("delete", "update")) . ") /i", $this->sql)) {
                    return $pdostmt->rowCount();
                } elseif (preg_match("/^(" . implode("|", array("insert")) . ") /i", $this->sql)) {
                    return $this->lastInsertId();
                } else {
                    return $pdostmt->fetchAll(PDO::FETCH_OBJ);
                }
            }
        } catch (PDOException $e) {
            echo $this->error = $e->getMessage();
            $this->debug();
            return false;
        }
    }

    public function select($where = "", $bind = "", $fields = "*", $orderBy = "") {
        $sql = "SELECT " . $fields . " FROM " . $this->tableName();
        if (!empty($where))
            $sql .= " WHERE " . $where;
        if (!empty($orderBy))
            $sql .= " ORDER BY " . $orderBy;
        $sql .= ";";

        return $this->run($sql, $bind);
    }

    public function selectLimit($limit = "", $bind = "", $fields = "*", $orderBy = "", $where = "") {

        $sql = "SELECT " . $fields . " FROM " . $this->tableName();

        if (!empty($where))
            $sql .= " WHERE " . $where;

        if (!empty($orderBy))
            $sql .= " ORDER BY " . $orderBy;


        if (!empty($limit))
            $sql .= " limit " . $limit;
        $sql .= ";";
      // echo $sql;die;
        $sql;
        return $this->run($sql, $bind);
    }

    public function checkAlreadyExist($tableName, $fieldName, $fieldValue) {
        $whereCondition = "$fieldName = '$fieldValue' ";
        $data = $this->select($whereCondition);
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function AdmincheckAlreadyExist($tableName, $fieldName, $fieldValue) {
        $whereCondition = "$fieldName = '$fieldValue' and is_delete='0' and admin_type='0' ";
        $data = $this->select($whereCondition);
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAlreadyExist1($tableName, $fieldName, $fieldValue) {
        $whereCondition = "$fieldName = '$fieldValue' and is_delete='0'";
        $data = $this->select($whereCondition);
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function setErrorCallbackFunction($errorCallbackFunction, $errorMsgFormat = "html") {
        //Variable functions for won't work with language constructs such as echo and print, so these are replaced with print_r.
        if (in_array(strtolower($errorCallbackFunction), array("echo", "print")))
            $errorCallbackFunction = "print_r";

        if (function_exists($errorCallbackFunction)) {
            $this->errorCallbackFunction = $errorCallbackFunction;
            if (!in_array(strtolower($errorMsgFormat), array("html", "text")))
                $errorMsgFormat = "html";
            $this->errorMsgFormat = $errorMsgFormat;
        }
    }

    public function update($info, $where, $bind = "") {
        $fields = $this->filter($this->tableName(), $info);
        $fieldSize = sizeof($fields);

        $sql = "UPDATE " . $this->tableName() . " SET ";
        for ($f = 0; $f < $fieldSize; ++$f) {
            if ($f > 0)
                $sql .= ", ";
            $sql .= $fields[$f] . " = :update_" . $fields[$f];
        }
        $sql .= " WHERE " . $where . ";";
        //echo $sql;die;
        // echo $fields ;die;
        $bind = $this->cleanup($bind);
        foreach ($fields as $field)
            $bind[":update_$field"] = $info[$field];
        return $this->run($sql, $bind);
    }

    //For Clean the string
    function clean($str) {
        if (get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        //$str = mysql_real_escape_string($str);
        return $str;
    }

    /* ======================================================== 
      Encode Decode Function
      ======================================================== */

    public function encode5t($cardstr) {
        $cardstr = strrev(base64_encode($cardstr));
        return $cardstr;
    }

    public function decode5t($str) {
        $str = base64_decode(strrev($str));
        return $str;
    }

    function disconnect() {
        //    unset($this);
    }

    function updateAllByPk($dataArr, $info, $primary_Key) {
        foreach ($dataArr as $Arr) {
            $this->update($info, $primary_Key . '=' . $Arr);
        }
    }

    function deleteAllByPk($dataArr, $primary_Key) {
        foreach ($dataArr as $Arr) {
            $this->delete($primary_Key . '=' . $Arr);
        }
    }

    /*
      $cropArray = array('is_delete' => 1);
      $obj_crop->update($cropArray, "id=" . $cropId);
     */

    function deleteAllByPk_status($dataArr, $primary_Key) {
        $change_status = array('is_delete' => 1);
        foreach ($dataArr as $Arr) {
            $this->update($change_status, $primary_Key . '=' . $Arr);
        }
    }

    public function selectByPk($pk = "0", $bind = "", $fields = "*") {
        $condition = $this->getPrimaryKey($this->tableName()) . "=" . $pk;
        $sql = "SELECT " . $fields . " FROM " . $this->tableName();
        if (!empty($condition))
            $sql .= " WHERE " . $condition;
        $sql .= ";";
        //echo $sql; 
        $this->sql = trim($sql);
        $this->bind = $this->cleanup($bind);
        $this->error = "";

        try {
            $pdostmt = $this->prepare($this->sql);
            if ($pdostmt->execute($this->bind) !== false) {
                if (preg_match("/^(" . implode("|", array("select", "describe", "pragma")) . ") /i", $this->sql)) {
                    $result = $pdostmt->fetchAll(PDO::FETCH_OBJ);
                    if ($pdostmt->rowCount() > 0) {
                        return $result[0];
                    } else
                        return $result;
                } elseif (preg_match("/^(" . implode("|", array("delete", "insert", "update")) . ") /i", $this->sql))
                    return $pdostmt->rowCount();
            }
        } catch (PDOException $e) {
            echo $this->error = $e->getMessage();
            $this->debug();
            return false;
        }
    }

    public function getPrimaryKey($tableName) {
        if ($tableName != '') {
            $sqlQuery = "SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'";

            $result = $this->run($sqlQuery);
//            echo'<pre>';
//            print_r($result);die;
            return $result[0]->Column_name;
        } else {
            return false;
        }
    }

    public function highlyencrpt($string, $pattern) {

        $currentTimestamp = getCurrentTimestamp();
        $tokan = $currentTimestamp . $pattern . $string;
        $encrypt = $this->encode5t($tokan);
        $encrypt = $this->encode5t($encrypt);
        $encrypt = str_replace("=", '', $encrypt);
        return $encrypt;
    }

    public function highlydecrpt($string) {
        $u = $this->decode5t($string);
        $maintoken = $this->decode5t($u);
        return $maintoken;
    }

    //For clean the post and get and request data
    public function cleanArray($dataArr) {
        foreach ($dataArr as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key1 => $value1) {
                    if (isset($value1[$key1])) {
                        $value1[$key1] = $this->clean($value1);
                    }
                }
            } else {
                $dataArr[$key] = $this->clean($value);
            }
        }
        return $dataArr;
    }

}
?>



