<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class NewsFeedsController
{
    /**
     * Returns a JSON string object to the browser when hitting the root of the domain
     *
     * @url GET /news     
     * @url GET /news/$nid
     */
   public function getNewsDetail($nid)
   {
       if($nid)
       {
            $news = new News;
            $news->detailedNews($nid);
            return   $news;
       }
        else {
              return 'all the news!';
    
       }
   }
    
     /**
     * post with a dictionary of tags, files in the temp folder
      * 
     *
     * @url POST /news
     */
    public function postNewsWithTags($tags)
    {
//        $filePath = 'testFolder/helloWorld.jpg';
//        $file = fopen($filePath, 'w') or die('can not create the file');
        $files = array();

        foreach ($_FILES as $key => $value)
        {
            $filePath = $value['tmp_name'];
            $file = fopen($filePath,'r');
//            $file = fread($file);
            $files[$key] = $file;
            
        }
        
        
        //implement an array of all temp files!
        
        $news = new News($files);
        $news->saveNewsDetail();
        
        
        echo "post successful!";
    }

    /*
     * query for a indivadual news
     * @url GET /news/$nid
     * 
     */
    public function newsDetail($nid)
    {
        $news = new News;
        $news->detailOfNews($nid);
    }



    /*
    * search news with tags
    * @url  GET /newsWithTags
    */
   public function searchNewsWithTags($tags)
   {
       $news = new News;
       $news->summaryOfNewsWithTags($tags);
   }
   
   /*
    * make changes to a news~ like comments, tags
    * @url  PUT /news/$nid
    */
   public function makeChangestoNews($nid)
   {
       
   }
   
   
    /*
    * make changes to only the likes...
    * 
    * 
    * @url  POST /like/$nid
    * 
    */
   public function like($nid)
   {
       echo   'trying to add one like!';
      
       News::DBlike($nid,$_SESSION['fbid']);//error might be catched here!
       
       
   }
   
   
   
   
   /*
    * getting useful package of informations about the structure of our DB
    * @url  GET /allTheTags
    * 
    */
   public function getAllTags()
   {
       echo   'trying to obtain all of our tags';
       return News::allTags();
       
   }








































    public function  authorize()
    {
        $uc = new UserController();
        
        return $uc->authorize();
    }

}
?>