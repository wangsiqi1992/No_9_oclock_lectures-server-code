<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

/**
 *this class is accessed only by user themself!
 * can perform method related to facebook
 * can verify user identity...?check fbAccessToken
 * maybe can return user default settings?
 *  
 */
class UserSecret extends User
{
    private $fbAccessToken;
    
    
    /**
     *@author   Bill~!
     * @param   no param needed, only init current user!
     * @return  User::  with fbAccessToken
     * 
     */
    function __construct() {
        $user = new User($_SESSION['fbid']);
        if($user['fbid'])
        {
            $criteria['^fbid^'] = $user['fbid'];
            $sql = 'SelectUserSecret';
            $result = dbQuery($sql, $criteria);
            $user->fbAccessToken = mysql_fetch_row($result);    //potential bug:private var...
            
            
            return  $user;
        }
        return  FALSE;
    }
    
    
    /**
     * @abstract    check for token passed, if match with our db, 
     * @todo        check all existing tokens if expired, delet!    if not the same as DB check to FB and save the token~!   
     * @author  Bill~!
     * @param   $fbAccessToken  no test proformed here, need to be absolutely sure!
     * @return  true: if success    false: if not done for any reason...?(list here)
     */
    protected function verifyAccessToken($fbAccessToken)
    {
        $tokenList = $this->fbAccessToken;
        foreach ($tokenList as  $value)
        {
            if($fbAccessToken == $value)
            {
                return  TRUE;
            }
            else 
            {
                //check the token and save it~!
            }
        }
    }
    
    

}
?>
