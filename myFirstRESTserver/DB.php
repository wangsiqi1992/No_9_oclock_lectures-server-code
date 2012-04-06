<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @param type $sql     could be both array and string
 * @param type $criteria    separate documentation explaining all wildcards
 * @return type         depends on how many results expecting... array if multiple results...!
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
        if (is_string($sql)) 
        {
            $a[] = $sql;
            $sql = $a;
            
        }
        foreach ($sql   as  $value)
        {
         
            $result = $db->SQLexecute($value, $criteria);
            $results[] = $result;       //becarefull the S!!!
        }
        if (!$results['1']) 
        {
            $result = $results[0];
            $results = $result;
            
        }
        
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
    return  $results;
}


?>
