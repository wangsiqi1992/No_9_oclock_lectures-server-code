<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class DBcontroller
{

    
    public $connection;




    public function connect($database)
    {
        $host = 'blah';
        $username = 'blah';
        $password = 'blah';

        $conn = mysql_connect($host,$username,$password); 
         
        if ((!$conn) || (!mysql_select_db($database,$conn))) 
        { 
//            $this->ERROR_MSG = "\r\n" . "Unable to connect to database - " . date('H:i:s'); 
//            $this->debug(); 
            return false; 
        } 
        else 
        { 
            $this->connection = $conn; 
            return true; 
        } 
    }
    
    public  function CloseConnection() 
    { 
        if (mysql_close($this->connection)) 
        { 
        return true; 
        } 
        else { 
//        $this->ERROR_MSG = "\r\n" . "Unable to close database connection - " . date('H:i:s'); 
//        $this->debug(); 
        return false; 
        } 
    } 
    
    
    
    
    
    
}


?>
