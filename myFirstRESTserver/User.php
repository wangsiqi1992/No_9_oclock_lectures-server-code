<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'DB.php';

/**
 *@abstract this class return some basic info of a user that can be accessed by anybody!
 * @todo    implement database functions like search with tags... whatever I dont know.......!!!!!ahhhhh!!!!!!
 *  
 */
class User
{
    public $name;
    public $school;
    public $department;
    public $year;
    public $fbid;
    public $fbAccessToken;
    
    




    /**
     * @abstract    init a empty user if no $id provided... otherwise search for the userInfo
     * @author      Bill~!
     * @param       type $id 
     * @return      User object
     */
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
        //check if $id set, get userInfo()

    }
    
    
    /**
     * @abstract    check if user exist, put into db if not, otherwise update!
     * @param       type $param     passed in as the correct format!!!
     * @return      success or not!
     */
    public function saveUser($param) {
        if($param)
        {
//            $this->userInfo($param['fbid']);
            
            foreach ($param as $key => $value)
            {
                $this->$key = $value;
                
            }

        }
//        require_once 'DBlogin.php';
//        connectToDB();
//        $query = "SELECT * FROM users WHERE fbid = $this->fbid";
//        $result = mysql_query($query);        all integrated with the userExist function!
        
        if(User::userExist($this->fbid))
        {
            $this->updateUser();
        }
        else {
            $this->putIntoDB();
        }

        
        
    }
    
    
    /**
     * @abstract     check the existence of a id
     * @param type $fbid
     * @return boolean 
     */
    public function userExist($fbid)
    {
        if(!$fbid)
        {
            return  FALSE;
         }
        
        $criteria['^fbid^'] = $fbid;
        $sql[] = 'SelectUserWithFbid';
        $result = dbQuery($sql, $criteria);
        $result = mysql_fetch_row($result[0]);
        if($result)
        {
            return  TRUE;
    
        }
        return  FALSE;
    }


    /**
     *@abstract insert into DB!
     * @param   $this
     * @return string 
     */
    private function putIntoDB(){
        
        

//        $query = "INSERT INTO users VALUES ('$this->name','$this->fbid','$this->department','$this->year','$this->fbAccessToken')";
//        mysql_query($query);
//        mysql_close();
        //varifying access token... and set cookie!!!
        //setcookie('fbid', $this->fbid, FALSE, '/', FALSE, TRUE);
        $criteria['^fbid^'] = $this->fbid;
        $criteria['^name^'] = $this->name;
        $criteria['^school^'] = $this->school;
        $criteria['^department^'] = $this->department;
        $sql[0] = 'InsertSchoolIfNotExist';
        $sql[1] = 'InsertDepartmentIfNotExist';
        $sql[2] = 'InsertNewUser';
        
        $result = dbQuery($sql, $criteria);
        $result = mysql_fetch_row($result);
        if($result)
        {
            echo "put into db success! n/";
        }
        return  TRUE;
    }
    
    
    /**
     * @abstract    get the basic user info of a id
     * @param type $id
     * @return type User        
     */
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

        $criteria['^fbid^'] = $id;
        $result = dbQuery('SelectUserWithFbid', $criteria);
        if($result)
        {
            $user = mysql_fetch_object($result, User);
        }
//        
        echo  'trying to find out about user:'.$id;
        return $user;
    }
    
    /**
     *@abstract change basic info of a user...  
     * @todo    need to check if the variables already exist in the table... schools?
     * @param   $this
     * @return string
     *  
     */
    private function updateUser()
    {
//        $query = "UPDATE users SET name = '$this->name', department = '$this->department', year = $this->year, fbAccessToken = '$this->fbAccessToken' WHERE fbid = $this->fbid";
//        mysql_query($query);
//        mysql_close();  
        return  'trying to update user info for myself!';
    }
    
    
    
}





?>