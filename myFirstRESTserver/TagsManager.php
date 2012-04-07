<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TagsManager {
    
    
        static $standardTags = array(
        "tag_1" => "",
        "tag_2" => "",
	"tag_3" => "",
	"tag_4" => "",
	"tag_5" => ""
        );
        static $locationInfo = array(
            "school" => "",
            "department" => ""
        );


        public $myTags;
        

        /**
     *
     * @abstract        can init with a set of tags...! 
     */
    function __construct($tags) {
        
        if($tags)
        {
            $this->initWithTags($tags);
            
        }
        
    }
    
    /**
     *
     * @abstract        used by news controller to return data~!
     * @param 
     * @return          array of News
     */
    public function searchNews()
    {
        
    }
    
    
    /**
     *
     * @abstract        check tags exist, put different tags into DB, tags including: tags, author, date......etc.......
     * @param type $nid
     * @param type $tags 
     * @return          scuccess or not~!
     */
    public function tagNews($nid)
    {
        //prepare tags here...

        //make sure all sql wild cards are changed to avoid error....

        $tags = $this->myTags;
        foreach ($tags as $key => $value)
        {
            $criteria['^tagTable^'] = $key;
            $criteria['^tagName^'] = $value;
            $sql = 'InsertTagNameIfNotExist';
            dbQuery($sql, $criteria);
            
            $anotherCriteria['^'.$key.'^'] = $value;
        }
       
        $sql = 'InsertNewsTags';
        $anotherCriteria['^nid^'] = $nid;
        $result = dbQuery($sql, $anotherCriteria);
        if ($result) 
        {
            return  TRUE;
            
        }
        return  FALSE;
    }
    
    
    /**
     *
     * @abstract        summarise the structure of our tag system
     * @todo            all the function needed for mobile UI structure....!!! Important, but not now..... 
     */
    public function getTagStructure()
    {
        
    }
    
    
    
    /**
     *
     * @abstract        before saving the news... check if the same news exist at the same place...
     * @param type $title 
     */
    public function ifNewsExistWithTheSameTags($title)
    {
        
    }
    
    
    
    private function initWithTags($tags)
    {
        
        
        foreach (self::$standardTags  as $aKey => $aValue)
        {

            $this->myTags[$aKey] = $tags[$aKey];
                
            
        }
        
        foreach (self::$locationInfo  as $bKey => $bValue)
        {

            $this->myTags[$bKey] = $tags[$bKey];
                
            
        }
    }

}
?>
