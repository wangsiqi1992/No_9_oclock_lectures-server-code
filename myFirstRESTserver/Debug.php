<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    function    debug($bug)
    {
        $showError = TRUE;

        if ($showError) 
        {
            echo '**************';;
            print_r($bug);
            echo date('H:i:s');
            
        }
    }
?>
