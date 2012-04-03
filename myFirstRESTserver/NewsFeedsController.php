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
     * Returns a JSON string object to the browser when hitting the root of the domain
     *
     * @url POST /news
     */
    public function post($data)
    {
        $filePath = 'testFolder/helloWorld.jpg';
        $file = fopen($filePath, 'w') or die('can not create the file');
        $imagePath = $_FILES['image']['tmp_name'];
        $image = fopen($imagePath,'r');
        $image = fread($image);
        copy($imagePath , $filePath) or die('can not copy');
        
        return "post successful!";
    }

//    public function  authorize()
//    {
//        
//    }

}
?>