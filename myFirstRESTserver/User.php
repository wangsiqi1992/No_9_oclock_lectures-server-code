<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User
{
    public $name;
    public $school;
    public $department;
    public $year;
    public $fbid;
    public $fbAccessToken;
    






    public function __construct($id = NULL) {
//                    $this->name = "Siqi Wang";
//                    $this-> department = "Mechanical Engineering";
//                    $this->year = "2014";
//                    if ($id) {
//                        $this->fbid = $id;
//                    }
// 
//                    else {                    
//                        $this->fbid = "110730292284790";
//
//                    }    //this is what I made for testing on my ios programe! you can implement the new user from database!

    }
    
    public function saveUser($param) {
        if($param)
        {
            $this->userInfo($param['fbid']);
            
            foreach ($param as $key => $value)
            {
                $this->$key = $value;
                
            }

        }
        require_once 'DBlogin.php';
        connectToDB();
        $query = "SELECT * FROM users WHERE fbid = $this->fbid";
        $result = mysql_query($query);
        if(mysql_result($result, 0, "name"))
        {
            $this->updateUser();
        }
        else {
            $this->putIntoDB();
        }
        
        
    }
    
    
    
    private function putIntoDB(){

        $query = "INSERT INTO users VALUES ('$this->name','$this->fbid','$this->department','$this->year','$this->fbAccessToken')";
        mysql_query($query);
        mysql_close();
        //varifying access token... and set cookie!!!
        //setcookie('fbid', $this->fbid, FALSE, '/', FALSE, TRUE);
        
    }
    
    public function userInfo($id)
    {
        require_once 'DBlogin.php';
        connectToDB();
        
        $query = "SELECT * FROM  `users` WHERE fbid =$id";
        $result = mysql_query($query);
        mysql_close();
        $this->name = mysql_result($result, 0, "name");
        $this->fbAccessToken = mysql_result($result, 0, "fbAccessToken");
        $this->fbid = mysql_result($result, 0, "fbid");
        $this->department = mysql_result($result, 0, "department");
        $this->year = mysql_result($result, 0, "year");
        
        
        return $this;
    }
    
    
    private function updateUser()
    {
        $query = "UPDATE users SET name = '$this->name', department = '$this->department', year = $this->year, fbAccessToken = '$this->fbAccessToken' WHERE fbid = $this->fbid";
        mysql_query($query);
        mysql_close();        
    }
    
    
    
}





?>