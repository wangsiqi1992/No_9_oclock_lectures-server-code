<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'DB.php';
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
        public $searchConditions;
        public $criteria;

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
        if (!$this->composeTagQueryStatementBeforeSearch()) 
        {
            debug('compossing search condition fail when tagsManager searchNews', $this, NULL);
            return  FALSE;
        }
        
        $sql = file_get_contents('sqlQueries/tagsManagerTagsSearchStatement.sql');
        $sql    .= $this->searchConditions;
        file_put_contents('sqlQueries/SelectNewsWithTags'.$_SESSION['fbid'].'.sql', $sql);
        $result = dbQuery('SelectNewsWithTags'.$_SESSION['fbid'], $this->criteria);
        while ($r = mysql_fetch_array($result))
        {
            $results[] = $r[0];
        }
        
        if($results)
        {
            return  $results;
        }
        
        return  FALSE;
        
        
    }
    
    
    
    
    
    
    
    
    /**
     *
     * @abstract        check tags exist, put different tags into DB, tags including: tags, author, date......etc.......
     * @param type $nid
     * @param type $tags 
     * @return          scuccess or not~!
     * @todo        add location info here!     myTags['location']...
     */
    public function tagNews($nid)
    {
        //prepare tags here...

        //make sure all sql wild cards are changed to avoid error....

        $tags = $this->myTags['tags'];
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
     * @todo            string manipulation!!!  bug here... on all the arrays
     */
    public function ifNewsExistWithTheSameTags($title)
    {
        $sql = file_get_contents('sqlQueries/tagsManagerCheckStatement.sql');
        
        if(!$this->composeTagQueryStatementBeforeSearch())
        {
            debug('some error when composing the search condition!', $this, NULL);
            return  TRUE;
        }
        
        $sql .= $this->searchConditions;
        
        file_put_contents('sqlQueries/SelectNewsWithTitleAndTags'.$_SESSION['fbid'].'.sql', $sql);

        $this->criteria['^title^'] = $title;//specific criteria for this statement!
        
        $result = dbQuery('SelectNewsWithTitleAndTags'.$_SESSION['fbid'], $this->criteria);
        $result = mysql_num_rows($result);
        if($result)
        {
            return  TRUE;
        }
        return  FALSE;
    }
    
    
    /**
     *
     * @todo        add school and department in a separated array! myTags['location']
     * @param type $tags 
     * 
     * @todo        check if the tag's too long!!!!
     */
    private function initWithTags($tags)
    {
        
        
        foreach (self::$standardTags  as $aKey => $aValue)
        {

            $this->myTags['tags'][$aKey] = $tags[$aKey];
                
            
        }
        
//        foreach (self::$locationInfo  as $bKey => $bValue)
//        {
//
//            $this->myTags[$bKey] = $tags[$bKey];
//                
//            
//        }
    }
    
    /**
     *
     * @abstract        compose this searchCondition and criteria ready to perform a search!
     *                  you still need to add on the statement!
     * @return boolean 
     * 
     */
    private function composeTagQueryStatementBeforeSearch()
    {
        $this->searchConditions = null;
        $tags = $this->myTags['tags'];

        foreach ($tags as $key => $value)
        {
            if ($value) 
            {
                $condition = file_get_contents('sqlQueries/tagsManagerCheckCondition.sql');
                $condition = str_replace('^tagTable^', $key,$condition);
                $condition = str_replace('tagName', $key, $condition);
                $this->searchConditions .= $condition;
                $this->criteria['^'.$key.'^'] = $value;

            }
        }
        
        return  TRUE;
        
    }

}
?>
