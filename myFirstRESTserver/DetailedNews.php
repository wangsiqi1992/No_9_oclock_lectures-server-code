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
        $nid = $this->nid;
        foreach ($_FILES as $Tkey => $value)
        {
            $uploads_dir = '/newsFiles/'.$nid.'/'.$Tkey;
            foreach ($_FILES[$Tkey]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES[$Tkey]["tmp_name"][$key];
                    $name = $_FILES[$Tkey]["name"][$key];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }
            }
            
        }
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
