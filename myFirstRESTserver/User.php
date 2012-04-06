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
    
    




    /**
     * @abstract    init a empty user if no $id provided... otherwise search for the userInfo
     * @author      Bill~!
     * @param       type $id 
     * @todo        whats going on here?!?
     * @return      User object
     */
    public function __construct($id = NULL) {
        if ($id) 
        {
        $this = $this->userInfo($id);
   
        }
        //check if $id set, get userInfo()
        debug('creating a new user~', $this);       //potential bug here!!!!!***********************

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
        debug('user checking if id:'.$fbid.'exist');
        if(!$fbid)
        {
            return  FALSE;
         }
        
        $criteria['^fbid^'] = $fbid;
        $sql[] = 'SelectUserWithFbid';
        $result = dbQuery($sql, $criteria);
        $result = mysql_fetch_object($result, User);
        if($result)
        {
            return  TRUE;
    
        }
        return  FALSE;
    }
    
    
    /**
     * @abstract    get the basic user info of a id
     * @param type $id
     * @return type User        
     */
    public function userInfo($id)
    {
        debug('user class starting to look for user with id:'.$id);
        $criteria['^fbid^'] = $id;
        $sql = 'SelectUserWithFbid';
        $result = dbQuery($sql, $criteria);
        if($result)
        {
            $user = mysql_fetch_object($result, User);
        }
//        
        debug('finished finding user with id:'.$id.', and the result is:', $user);
        return $user;
    }
    
    
    

    /**
     *@abstract insert into DB!
     * @param   $this
     * @return string 
     */
    private function putIntoDB(){
        
        


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
            debug('putting user into db successed, and the result we get is:'.$result);
        }
        return  TRUE;
    }

    
    /**
     *@abstract change basic info of a user...  
     * @todo    need to check if the variables already exist in the table... schools?
     * @param   $this
     * @return string
     * @todo    test............
     *  
     */
    private function updateUser()
    {
        $criteria['^fbid^'] = $this->fbid;
        $criteria['^name^'] = $this->name;
        $criteria['^school^'] = $this->school;
        $criteria['^department^'] = $this->department;
        $criteria['^year^'] = $this->year;
        
        $sql[] = 'InsertSchoolIfNotExist';
        $sql[] = 'InsertdepartmentIfNotExist';
        $sql[] = 'UpdateUserBasics';
        
        $result = dbQuery($sql, $criteria);
        
        
        
        debug('user class trying to update user, result is: ', $result);
        if ($result) 
        {
            return  TRUE;
        }
        
        return  FALSE;
        
        }
    
    
    
}





?>