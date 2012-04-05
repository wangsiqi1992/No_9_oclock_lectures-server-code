<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function dbQuery($sql, $criteria)
{
    require_once 'MySQLHandler.php';

    //Setup the class 
    //Be carefule wit the cases 
    $db = new MySQLHandler; 

    if($db)
    {
        $result = $db->SQLexecute($sql, $criteria);
    }
    else
    {
        if($db->OpenConnection())
        {
            
        }
        else 
        {
            echo 'didnt connect to DB';
        }

    }
    $db -> CloseConnection();
    return  $result;
}


?>
