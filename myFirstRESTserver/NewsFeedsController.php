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
            $news = new DetailedNews($nid);
            
            
            //get what need to do here!!
            return   $news;
       }
        else {
            $tags['tag_1'] = 'I dont know what I am tagging';
            $tm = new TagsManager($tags);
            $nidList = $tm->searchNews();
            foreach ($nidList as $value)
            {
                $news = new News($value);
                $newsList[] = $news;

            }
            
              return $newsList;
    
       }
   }
    
   
   
   
   
   
     /**
     * post with a dictionary of tags, files in the temp folder
      * 
     *
     * @url POST /news
     */
    public function postNewsWithTags($data)
    {                
        //implement an array of all temp files!
//        $data = $data[0];
        $news = new DetailedNews();
        $tagM = new TagsManager($data['tags']);

        $news->initNewsWithData($data['news']);
        if(!$tagM->ifNewsExistWithTheSameTags($news->title))
        {
            $result = $news->saveNewsDetail();
            if($result)
            {
                if($tagM->tagNews($result))
                {
                    return  TRUE;
                }
                else 
                {
                    debug('tagging the news fail!', $tagM, $news);
                }
            }
            else 
            {
                debug('save news not successed... returned false', NULL, NULL);
            }
        }
        else 
        {
            debug('trying to save a news title that is alread tagged at the same place!!! what is going on?', $news, $tagM);
            
        }
        return  FALSE; 
    }



    
    
    
    
    
    /**
    * search news with tags
    * @url  POST /searchNewsWithTags
    */
   public function searchNewsWithTags($data)
   {
       $tm = new TagsManager($data);
       
       if(!$nidList = $tm->searchNews())
       {
            debug('no news returned when searching with tags: ', $tm, NULL);
            return  FALSE;
       }
       
       foreach ($nidList as $value)
       {
           $news = new News($value);
           $newsList[] = $news;
           
       }
       return   $newsList;
   }
   
   
   
   
   
   
   
   
   /**
    * make changes to a news~ like comments, tags
    * @url  PUT /news/$nid
    */
   public function makeChangestoNews($nid)
   {
       
   }
   
   
    /**
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
   
   
   
   
   /**
    * getting useful package of informations about the structure of our DB
    * @url  POST /nextLevelTags
    * 
    */
   public function getTags($data)
   {
       $tags = $data['tags'];
       echo   'trying to obtain all of our tags';
       $tm = new TagsManager($tags);
       
       return $tm->getTagStructure();
       
   }








































    public function  authorize()
    {
        $uc = new UserController();
        
        return $uc->authorize();
    }

}
?>