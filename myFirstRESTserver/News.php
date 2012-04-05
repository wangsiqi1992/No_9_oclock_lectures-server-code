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
    

//    public $;
//    public $title;
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
    }
    public function detailedNews($nid)
    {
        echo 'getting detail of news:'.$nid;
    }
    public function saveNewsDetail()
    {
        //save this->!!!
        echo 'save news into our database';
    }
    
    
    
}
?>
