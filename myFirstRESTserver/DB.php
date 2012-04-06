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
        debug('DB got query to do:      , with criteria:', $sql, $criteria);
        $result = $db->SQLexecute($sql, $criteria);
        
    }
    else
    {
        if($db->OpenConnection())
        {
            
            debug('reopened DB connection, but nothing happend... implementation needed...!');
            
        }
        else 
        {
            debug('didnt connect to DB');
        }

    }
    $db -> CloseConnection();
    debug('DB got raw results:      or we can fetch the first one if it helps.....', $result, mysql_fetch_array($result[0]));
    return  $result;
}


?>
