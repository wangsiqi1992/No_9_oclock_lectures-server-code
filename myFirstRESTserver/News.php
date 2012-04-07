<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'DB.php';



/**
 *@abstract     news object  can contain both summary or (summary and files) 
 */
class News
{
    public $title;
    public $type;
    public $date;
    public $author_id;
    public $likes;
    public $onlySummary;
    public $nid;
    public $fileArray;
    public $searchCriteria;//aka tags and positions...!












    public function __construct($nid) 
    {
        $this->nid = $nid;
        
        if($this->newsExist())
        {
            //implement summary of the news object...
        }
        
        $this->onlySummary = TRUE;
        //else reture a empty object!
        echo 'new news object!';
    }
    

    public function detailOfNews($nid)
    {
        echo 'getting detail of news:'.$nid;
        //can share the same function as the summary... looking a few variables inside of db...
        $this->getNewsFromDB();
        
        
    }
    public function saveNewsDetail()
    {
        //save this->!!!
        echo 'save news into our database';
        if($this->newsExist())
        {
            //update all of the news... controller might changed that entire news content... like allowing user to implement it...
        }
    }
    
    
    public function getOnlySummary()
    {
        
    }























    /*
     * below use DB!!!!
     */
    
    protected function getNewsFromDB()
    {
        
        //set up the query... like separate file of properties... and written down...
        
        if($this->detailOrSummary == 'detail')
        {            
            //getting the file path ready and put into fileArray to return...

        }
        
        //return self...

    }
    
    protected function saveNewsToDB()
    {
        /*
         * get a place inside our db...
         * nid needed!
         */
        //need to find out id of all the tag first? or we can insert stright away in one query?
        
        
        
        
        
        
        
        
        
        
        
        
        /*
         * save files from temp to the right directory
         */
        
        
        
        
        
        
    }
    
    
    public function newsExist($nid)
    {
        return  TRUE;
    }






    /*
     * return the structure of our database...
     * tags, relationship between tags?
     * structure of user belong to? like department and schools~!
     * 
     */
    public function allTags()
    {
        //call functions to get all the mysql tables...
        
        //return an array~!
        
        
    }
    
    public function DBlike($nid,$fbid)
    {
        //get a connection in the like table and update the total like in the news db...!
    }


    
}
?>
