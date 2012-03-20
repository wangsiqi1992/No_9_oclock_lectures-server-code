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

    public function  authorize()
    {
        
    }

}
?>