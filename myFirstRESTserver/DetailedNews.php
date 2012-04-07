<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

/**
 *this class handle anything that required a news detail, like files and comments etc~! 
 */
class DetailedNews extends News
{

    function __construct() {
        parent::__construct();
    
        }
    
    public function initDetailedNewsWithData($data)
    {
        
    }

    
    
    public function initExistingNewsDetails($nid)
    {
        
    }
    
    
    public function saveNewsDetail() {
        parent::saveNewsDetail();
        
    }
}
?>
