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
    public $date;
    public $author_name;
    public $nid;










    /**
    *@abstract      if nid is provided search in the db     otherwise empty object
    * @param type $nid (optional)
     *@return   News
    */

    public function __construct($nid) 
    {
        $this->nid = $nid;
        
        if($this->newsExist())
        {
            //implement summary of the news object...
            $this->initExistingNews();
        }
        
        //else reture a empty object!
        
        
        
        
        debug('we have created a new news object: ', $this);
    }
    


    
    
    /**
     *@abstract     put this into db 
     * 
     */
    public function saveNewsDetail()
    {
        //save this->!!!
        //echo 'save news into our database';
        if($this->newsExist())
        {
            //update all of the news... controller might changed that entire news content... like allowing user to implement it...
        }
        else {
            //insert!
            foreach ($this as $key => $value)
            {
                $criteria['^'.$key.'^'] = $value;
            }
            
            $criteria['^author_id^'] = $_SESSION['fbid'];
            $sql = 'InsertNewsBasics';
            
            $result = dbQuery($sql, $criteria);
            
            if($result)
            {
                return  $result;
            }
            return  FALSE;
        }
    }
    
    /**
     *@abstract     initiate news from db
     * @param type $nid 
     * @return  News
     */
    private function initExistingNews()
    {
        //get data from db first!
        
        $criteria['^nid^'] = $this->nid;
        $sql = 'SelectNewsBasicsWithNid';
        $data = dbQuery($sql, $criteria);
        $data = mysql_fetch_assoc($data);
        
        foreach ($data as $key => $value)
        {
            $this->$key = $value;
            
        }        
    }
    
    
    
    
    /**
     *@abstract     initiate a new News object with the data provided
     * @param type $data 
     * @return      News
     */
    public function initNewsWithData($data)
    {
        foreach ($data as $key => $value)
        {
            $this->$key = $value;
            
        }
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
        if(!$this->nid)
        {
            return  FALSE;
        }
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
