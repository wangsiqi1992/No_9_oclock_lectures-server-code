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
 * access token can only access at here...? no... other function should be able to get basic info somewhere else...
 * act as a token manager~!
 *  
 */
class UserSecret //extends User
{
    protected $fbAccessToken;
    
    /**
     * @abstract    accept both current user or a passed $id because of the registration process...
     *@author   Bill~!
     * @param   no param needed, only init current user!
     * @return  User::  with fbAccessToken
     * 
     */
    public function __construct($id = NULL) {
        if(!$_SESSION['fbid'])
        {
            $user = new User($id);
        }
        else
        {
            $user = new User($_SESSION['fbid']);
        }
        
        if($user->fbid)
        {
            $criteria['^fbid^'] = $user->fbid;
            $sql = 'SelectUserToken';
            $result = dbQuery($sql, $criteria);
            while ($token = mysql_fetch_row($result))
            {
                $this->fbAccessToken[] = $token[0];
            }            
 //           $_SESSION['userS'] = $this;
        }
        return  $user;
//        return  FALSE;
    }
    
    
    /**
     * @abstract    check for token passed, if match with our db, 
     * @todo        check all existing tokens if expired, delete!    if not the same as DB check to FB and save the token~!   
     * @author  Bill~!
     * @param   $fbAccessToken  no test proformed here, need to be absolutely sure!
     * @return  true: if success    false: if not done for any reason...?(list here)
     */
    public function verifyAccessToken($fbAccessToken)
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
                //what do we do here?!?!
            }
        }
        
        //check if this token is valiad
            //save it
        //check all existing token expired?
        
        
        return  FALSE;
    }
    
    
    /**
     *@abstract     find friends on facebook output a file at the right directory!
     * @param       nop
     * @return      successed or not
     * @todo        separated friends into different files with different property~!
     */
    protected function getUserFriends()
    {
        
    }
    
    
    
    
    /**
     *@abstract     save things &verifying token    &return things~ like all db things friend lists...   
     */
    public function registration($fbid, $fbAccessToken)
    {
        //verify token first... by downloading things from FB
        //save token    
        //check what to return~!
        
    }
    

}
?>
