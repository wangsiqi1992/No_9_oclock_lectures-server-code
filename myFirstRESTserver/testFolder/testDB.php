<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'MySQLHandler.php';

//Setup the class 
//Be carefule wit the cases 
$db = new MySQLHandler; 

$db -> OpenConnection(); 

$sql = "SELECT * FROM users" ;

$result = $db -> Select($sql); 

/* execute the $result the way you want 
 *  close all 
 */
echo $result;
$db -> CloseConnection();


?>
