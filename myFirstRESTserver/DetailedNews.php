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

    public $fileDirectory;

    /**
     *
     * @abstract         get detailed news if $id is provided
     * 
     */
    function __construct($id) {
        parent::__construct($id);
    
        }
    
        
        
        /**
         *
         * @abstract        new news init, manage the files?
         * @param type $data 
         */
    public function initNewsWithData($data)
    {
        parent::initNewsWithData($data);
    }

    
    /**
     *
     * @abstract        get file directries and init it....
     * @param type $nid 
     */
    public function initExistingNews($nid)
    {
        parent::initExistingNews($nid);
    }
    
    
    
    /**
     *
     * @abstract        save to the right place!
     *  
     */
    public function saveNewsDetail() {
        parent::saveNewsDetail();
        
    }
}
?>
