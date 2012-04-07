<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TagsManager {
    

    function __construct() {
        
    }
    
    /**
     *
     * @abstract        used by news controller to return data~!
     * @param type $tags 
     * @return          array of News
     */
    public function searchNewsWithTags($tags)
    {
        
    }
    
    
    /**
     *
     * @abstract        check tags exist, put different tags into DB, tags including: tags, author, date......etc.......
     * @param type $nid
     * @param type $tags 
     * @return          scuccess or not~!
     */
    public function tagNews($nid, $tags)
    {
        
    }
    
    
    /**
     *
     * @abstract        summarise the structure of our tag system
     * @todo            all the function needed for mobile UI structure....!!! Important, but not now..... 
     */
    public function getTagStructure()
    {
        
    }

}
?>
