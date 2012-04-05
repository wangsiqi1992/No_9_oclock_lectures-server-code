<?php 
class MySQLHandler { 

  // Change these variables to your own database settings 
  public $DATABASE = 'mydb'; 
  public $USERNAME = 'root'; 
  public $PASSWORD = 'root'; 
  public $SERVER = 'localhost'; 

  public $LOGFILE = ""; // full path to debug LOGFILE. Use only in debug mode! 
  public $LOGGING = false; // debug on or off 
  public $SHOW_ERRORS = true; // output errors. true/false 
  public $USE_PERMANENT_CONNECTION = false; 

  // Do not change the variables below 
  public $CONNECTION; 
  public $FILE_HANDLER; 
  public $ERROR_MSG = ''; 

########################################### 
# Function:    init 
# Parameters:  N/A 
# Return Type: boolean 
# Description: initiates the MySQL Handler 
########################################### 
    public function __construct() { 
    $this->logfile_init(); 
    if ($this->OpenConnection()) { 
      return true; 
    } else { 
      return false; 
        } 
    } 

########################################### 
# Function:    OpenConnection 
# Parameters:  N/A 
# Return Type: boolean 
# Description: connects to the database 
########################################### 
    public function OpenConnection()    { 
    if ($this->USE_PERMANENT_CONNECTION) { 
      $conn = mysql_pconnect($this->SERVER,$this->USERNAME,$this->PASSWORD); 
    } else { 
      $conn = mysql_connect($this->SERVER,$this->USERNAME,$this->PASSWORD); 
    } 
        if ((!$conn) || (!mysql_select_db($this->DATABASE,$conn))) { 
      $this->ERROR_MSG = "\r\n" . "Unable to connect to database - " . date('H:i:s'); 
      $this->debug(); 
      return false; 
    } else { 
          $this->CONNECTION = $conn; 
          return true; 
    } 
    } 

########################################### 
# Function:    CloseConnection 
# Parameters:  N/A 
# Return Type: boolean 
# Description: closes connection to the database 
########################################### 
    public function CloseConnection() { 
      if (mysql_close($this->CONNECTION)) { 
      return true; 
    } else { 
      $this->ERROR_MSG = "\r\n" . "Unable to close database connection - " . date('H:i:s'); 
      $this->debug(); 
      return false; 
    } 
    } 

########################################### 
# Function:    logfile_init 
# Parameters:  N/A 
# Return Type: N/A 
# Description: initiates the logfile 
########################################### 
    public function logfile_init() { 
    if ($this->LOGGING) { 
      $this->FILE_HANDLER = fopen($this->LOGFILE,'a') ; 
        $this->debug(); 
    } 
    } 
    
########################################### 
# Function:    logfile_close 
# Parameters:  N/A 
# Return Type: N/A 
# Description: closes the logfile 
########################################### 
    public function logfile_close() { 
    if ($this->LOGGING) { 
          if ($this->FILE_HANDLER) { 
            fclose($this->FILE_HANDLER) ; 
        } 
    } 
    } 

########################################### 
# Function:    debug 
# Parameters:  N/A 
# Return Type: N/A 
# Description: logs and displays errors 
########################################### 
  function debug() { 
    if ($this->SHOW_ERRORS) { 
      echo $this->ERROR_MSG; 
    } 
    if ($this->LOGGING) { 
          if ($this->FILE_HANDLER) { 
              fwrite($this->FILE_HANDLER,$this->ERROR_MSG); 
          } else { 
              return false; 
          } 
    } 
    } 

########################################### 
# Function:    Insert 
# Parameters:  sql : string 
# Return Type: integer 
# Description: executes a INSERT statement and returns the INSERT ID 
########################################### 
    public function Insert($sql) { 
        if ((empty($sql)) || (!eregi("^insert",$sql)) || (empty($this->CONNECTION))) { 
      $this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not an INSERT - " . date('H:i:s'); 
      $this->debug(); 
      return false; 
    } else { 
          $conn = $this->CONNECTION; 
          $results = mysql_query($sql,$conn); 
          if (!$results) { 
        $this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s'); 
        $this->debug(); 
        return false; 
      } else { 
            $result = mysql_insert_id(); 
            return $result; 
      } 
    } 
    } 

########################################### 
# Function:    Select 
# Parameters:  sql : string 
# Return Type: array 
# Description: executes a SELECT statement and returns a 
#              multidimensional array containing the results 
#              array[row][fieldname/fieldindex] 
########################################### 
    public function Select($sql)    { 
        if ((empty($sql)) || (!eregi("^select",$sql)) || (empty($this->CONNECTION))) { 
      $this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not a SELECT - " . date('H:i:s'); 
      $this->debug(); 
      return false; 
    } else { 
          $conn = $this->CONNECTION; 
          $results = mysql_query($sql,$conn); 
          if ((!$results) || (empty($results))) { 
        $this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s'); 
        $this->debug(); 
        return false; 
      } else { 
        $i = 0; 
        $data = array(); 
        while ($row = mysql_fetch_array($results)) { 
            $data[$i] = $row; 
            $i++; 
        } 
        mysql_free_result($results); 
        return $data; 
      } 
    } 
    } 

########################################### 
# Function:    Update 
# Parameters:  sql : string 
# Return Type: integer 
# Description: executes a UPDATE statement 
#              and returns number of affected rows 
########################################### 
    public function Update($sql)    { 
        if ((empty($sql)) || (!eregi("^update",$sql)) || (empty($this->CONNECTION))) { 
      $this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not an UPDATE - " . date('H:i:s'); 
      $this->debug(); 
      return false; 
    } else { 
          $conn = $this->CONNECTION; 
          $results = mysql_query($sql,$conn); 
          if (!$results) { 
        $this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s'); 
        $this->debug(); 
        return false; 
      } else { 
            return mysql_affected_rows(); 
      } 
    } 
    } 
  
########################################### 
# Function:    Replace 
# Parameters:  sql : string 
# Return Type: boolean 
# Description: executes a REPLACE statement 
########################################### 
    public function Replace($sql) { 
        if ((empty($sql)) || (!eregi("^replace",$sql)) || (empty($this->CONNECTION))) { 
      $this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not a REPLACE - " . date('H:i:s'); 
      $this->debug(); 
      return false; 
    } else { 
          $conn = $this->CONNECTION; 
          $results = mysql_query($sql,$conn); 
          if (!$results) { 
        $this->ERROR_MSG = "\r\n" . "Error in SQL Statement : ($sql) - " . date('H:i:s'); 
        $this->debug(); 
        return false; 
      } else { 
            return true; 
      } 
    } 
    }  

########################################### 
# Function:    Delete 
# Parameters:  sql : string 
# Return Type: boolean 
# Description: executes a DELETE statement 
########################################### 
    public function Delete($sql)    { 
        if ((empty($sql)) || (!eregi("^delete",$sql)) || (empty($this->CONNECTION))) { 
      $this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> or not a DELETE - " . date('H:i:s'); 
      $this->debug(); 
      return false; 
    } else { 
          $conn = $this->CONNECTION; 
          $results = mysql_query($sql,$conn); 
          if (!$results) { 
        $this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s'); 
        $this->debug(); 
        return false; 
      } else { 
            return true; 
      } 
    } 
    } 
  
########################################### 
# Function:    Query 
# Parameters:  sql : string 
# Return Type: boolean 
# Description: executes any SQL Query statement 
########################################### 
    public function Query($sql)    { 
        if ((empty($sql)) || (empty($this->CONNECTION))) { 
      $this->ERROR_MSG = "\r\n" . "SQL Statement is <code>null</code> - " . date('H:i:s'); 
      $this->debug(); 
      return false; 
    } else { 
          $conn = $this->CONNECTION; 
          $results = mysql_query($sql,$conn); 
          if (!$results) { 
        $this->ERROR_MSG = "\r\n" . mysql_error()." - " . date('H:i:s'); 
        $this->debug(); 
        return false; 
      } else { 
            return true; 
      } 
    } 
    } 
} 
?>