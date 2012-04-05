<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class News
{
    public $title;
    public $type;
    public $date;
    public $author_id;
    public $detailOrSummary;
    public $nid;
    public $fileArray;
    public $searchCriteria;//aka tags and positions...!












    public function __construct($data) 
    {
        if($data)
        {
            //implement a new news object
        }
        //else reture a empty object!
        echo 'new news object!';
    }
    public function summaryOfNewsWithTags($tags)
    {
        echo 'getting summary of news';
        //looking news summary in db...
        $this->getNewsFromDB();
        
        
        
    }
    public function detailedNews($nid)
    {
        echo 'getting detail of news:'.$nid;
        //can share the same function as the summary... looking a few variables inside of db...
        $this->getNewsFromDB();
        
        
    }
    public function saveNewsDetail()
    {
        //save this->!!!
        echo 'save news into our database';
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
        
        
        
        
        
        
        
        
        
        
        
        
        /*
         * save files from temp to the right directory
         */
        
        
        
        
        
        
    }
    
    
}
?>
