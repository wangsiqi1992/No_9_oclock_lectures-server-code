<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    function    debug($bug,$var1,$var2)
    {
        $showError = TRUE;

        if ($showError) 
        {
            echo '****';;
            print_r($bug);
            print_r($var1);
            print_r($var2);
        }
    }
?>
