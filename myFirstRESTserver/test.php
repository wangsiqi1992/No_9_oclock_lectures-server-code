<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$url = file_get_contents('http://graph.facebook.com/846339762/picture');
$file = fopen('users/profilePic/helloWorld.jpeg', 'w') or die("can't open it!");
fwrite($file, $url);
fclose($file);


?>
