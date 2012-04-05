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
     */
    public function test()
    {
        return "All the news!";
    }
    
     /**
     * post with a dictionary of tags, files in the temp folder
      * 
     *
     * @url POST /news
     */
    public function postNewsWithTags($tags)
    {
        $filePath = 'testFolder/helloWorld.jpg';
        $file = fopen($filePath, 'w') or die('can not create the file');
        $imagePath = $_FILES['image']['tmp_name'];
        $image = fopen($imagePath,'r');
        $image = fread($image);
        copy($imagePath , $filePath) or die('can not copy');
        
        return "post successful!";
    }

    /*
     * query for a indivadual news
     * @url GET /news/$nid
     * 
     */
   public function getNewsDetail($nid)
   {
       
   }
   
   /*
    * search news with tags
    * @url  GET /newsWithTags
    */
   public function searchNewsWithTags($tags)
   {
       
   }
   
   /*
    * make changes to a news~ like comments, tags
    * @url  PUT /news/$nid
    */
   public function makeChangestoNews($nid)
   {
       
   }
   
   /*
    * getting useful package of informations about the structure of our DB
    * @url  GET /allTheTags
    * 
    */
   public function getAllTags()
   {
       return   'trying to obtain all of our tags';
   }








































//    public function  authorize()
//    {
//        
//    }

}
?>