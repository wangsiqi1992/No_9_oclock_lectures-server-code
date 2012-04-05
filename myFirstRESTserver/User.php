<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'DB.php';


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
//        require_once 'DBlogin.php';
//        connectToDB();
//        $query = "SELECT * FROM users WHERE fbid = $this->fbid";
//        $result = mysql_query($query);        all integrated with the userExist function!
        
        if($this->userExist($this->fbid))
        {
            $this->updateUser();
        }
        else {
            $this->putIntoDB();
        }
        
        
    }
    
    protected function userExist($fbid)
    {
        if(!$fbid)
        {
            return  FALSE;
         }
        
        $criteria['_fbid'] = $fbid;
        $result = dbQuery('SelectUserWithFbid', $criteria);
        if($result)
        {
            return  TRUE;
    
        }
        return  FALSE;
    }


    private function putIntoDB(){
        
        

//        $query = "INSERT INTO users VALUES ('$this->name','$this->fbid','$this->department','$this->year','$this->fbAccessToken')";
//        mysql_query($query);
//        mysql_close();
        //varifying access token... and set cookie!!!
        //setcookie('fbid', $this->fbid, FALSE, '/', FALSE, TRUE);
        return  'trying to put user into DB!';
    }
    
    public function userInfo($id)
    {
//        require_once 'DBlogin.php';
//        connectToDB();
//        
//        $query = "SELECT * FROM  `users` WHERE fbid =$id";
//        $result = mysql_query($query);
//        mysql_close();
//        $this->name = mysql_result($result, 0, "name");
//        $this->fbAccessToken = mysql_result($result, 0, "fbAccessToken");
//        $this->fbid = mysql_result($result, 0, "fbid");
//        $this->department = mysql_result($result, 0, "department");
//        $this->year = mysql_result($result, 0, "year");

        $criteria['_fbid'] = $id;
        $result = dbQuery('SelectUserWithFbid', $criteria);
        if($result)
        {
            $user = mysql_fetch_object($result, User);
            
        }
//        
        echo  'trying to find out about user:'.$id;
        return $user;
    }
    
    
    private function updateUser()
    {
//        $query = "UPDATE users SET name = '$this->name', department = '$this->department', year = $this->year, fbAccessToken = '$this->fbAccessToken' WHERE fbid = $this->fbid";
//        mysql_query($query);
//        mysql_close();  
        return  'trying to update user info for myself!';
    }
    
    
    
}





?>