<?php

/*DO NOT TOUCH ON THE COMMENTS!!!!!
 * IT NEEDS TO BE WHERE IT IS!
 * 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * FACEBOOK access token needs: user/friends about me+user/friend education history!
 */
class UserController
{
    /**
     * Returns a JSON string object to the browser when hitting the root of the domain
     *
     * @url GET /
     */
    public function test()
    {
        debug('Hello!');
    }

    /**
     * Logs in a user with the given username and password POSTed. Though true
     * REST doesn't believe in sessions, it is often desirable for an AJAX server.
     * return user preference!
     * all tags
     * anything that is needed to make a search(directory....)
     * 
     * @url POST /register
     * 
     */
    public function register($data)
    {
        $fbid = $data['fbid'];
        $fbAccessToken = $data['fbAccessToken'];
        $user = new User();
        //seasion set here!!!!
        
        $user->userInfo($fbid);
            if($fbAccessToken == $user->fbAccessToken)
            {
                $_SESSION['fbid'] = $fbid;
                
            }
            else {
                //check token here! with facebook
                //if valid update database
                $this->getUserInfoFromFB($fbid, $fbAccessToken, $user);
                
                $_SESSION['fbid'] = $fbid;
                
            }

        return $user;///return user friends and database structure here!!!!
        
    }

    /**
     * Gets the user by id or current user
     *
     * @url GET /users
     * @url GET /users/$id
     * @url GET /users/current
     * @url GET /users/friendList
     */
    public function getUser($id = null)
    {
//        $user = new User();
        debug('controller tring to get user! id is:'.$id);
        if ($id == "current") {
            //implement whatever you want here~!
            $user = User::userInfo($_COOKIE['fbid']);

        } 
        elseif ($id == "friendList") {
            
            
            
    }
        else {
            $user = User::userInfo($id);            
            
            }
        return $user; // serializes object into JSON

    }

    /**
     * Saves a user to the database
     *
     * @url POST /user      need to specify Format in http header to be json!
     * @url PUT /user
     */
    public function saveUser($data)
    {
        // ... validate $data properties such as $data->username, $data->firstName, etc.
        //$data->id = $id;
        debug('controller trying to save user~! id is:'.$data['fbid']);
        if($data['fbid'] == $_SESSION['fbid'])
        {
            $user = new User();
            $user->saveUser($data);
        }
        else
        {
            return FALSE;
        }
  //      $data[$id] = 11111;
//        if ($data['name']) {
 //       echo $data['name'];       
 //       $user->name = "Hello world!";
//
//        }
        debug('controller save user successed! user is:'.$user);
        return TRUE; // success or not~!
    }
    
    public function authorize()
    {
        $server = $this->server;
        
        
        $fbid = $_SESSION['fbid'];
        if(!$fbid)
        {
            if($_SERVER[PHP_AUTH_USER])
            {
                $fbid = $_SERVER[PHP_AUTH_USER];
                
                //check for access token here!
                //set seasion here
                $_SESSION['fbid'] = $fbid;
//                ini_set('session.gc_maxlifetime', 10);
                
                return  TRUE;

            }
            if ($server->url == "/register" || $server->url == "") {
            return TRUE;
            }
            return FALSE;
            debug('did not log in... controller authorize failed');
        }

//        $user = new User;
//        $user->userInfo($fbid);
//        if($user->name)
//        {
//            return TRUE;
//        }
        return true;
        
    }
//    
    private function getUserInfoFromFB($fbid, $fbAccessToken, &$user)
    {
        require_once('facebook.php');
  
                $config = array(
                    'appId' => '379239032088044',
                    'secret' => '39939c419278f33a82c09df2d3806e88',
                );

                $facebook = new Facebook($config);
 //               $user_id = $facebook->getUser();
                $facebook->setAccessToken($fbAccessToken);
                
                
                      try {
                                $user_profile = $facebook->api('/'.$fbid,'GET');
                                $user_friends = $facebook->api('/'.$fbid.'/friends','GET');
                                
                                

                            } catch(FacebookApiException $e) {
                                // If the user is logged out, you can have a 
                                // user ID even though the access token is invalid.
                                // In this case, we'll get an exception, so we'll
                                // just ask the user to login again here.
                                $login_url = $facebook->getLoginUrl(); 
                                echo 'Please <a href="' . $login_url . '">login.</a>';
                                error_log($e->getType());
                                error_log($e->getMessage());
                                return FALSE;
                            }
                                            $user->name = $user_profile['name'];
                                            $user->fbAccessToken = $fbAccessToken;
                                            $user->fbid = $fbid;
                                            $edu = $user_profile['education'];
                                            $friendList = $user_friends['data'];
                                            
                                            foreach ($edu as $key => $value)
                                            {
                                                if($value['type'] == "College")
                                                {
                                                    $sch = $edu[$key];
                                                    break;
                                                }
                                            }
                                            $department = $sch['concentration'];
                                            $year = $sch['year'];
                                            $a1 = $department[0];
                                            $user->school = $sch['school']['name'];
                                            $user->department = $a1['name'];
                                            $user->year = $year['name'];
                                            
                                            $user->saveUser(NIL);
                                            $fileP = 'usersData/profilePic/'.$fbid.'.jpeg';
                                            
                                         if(file_exists($fileP))
                                         {
                                             
                                         }
                                         else
                                         {
                                             $url = 'http://graph.facebook.com/'.$fbid.'/picture';
                                             $pic = file_get_contents($url);
                                             $file = fopen($fileP, 'w') or die("can not create profile picture file");
                                             fwrite($file, $pic);
                                             fclose($file);
                                             
                                             
                                         }
                                         
                                         try {
                                             foreach ($friendList as $key => $value) {
                                                 $id = $friendList[$key]['id'];
                                                $friendInfo = $facebook->api('/'.$id,'GET');
                                                if ($friendInfo['education']) {
                                                    $friendEducation = $friendInfo['education'];
                                                    foreach ($friendEducation as $key2 => $value)
                                                    {
                                                        if($value['type'] == "College")
                                                        {
                                                            $s = $friendEducation[$key2];
                                                            $friendSch = $s['school'];
                                                            if ($friendSch['name'] == $user->school) {
                                                                $friendWeWant[] = $friendList[$key];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    
                                                    
                                                }
                                                 
                                             }

                                            } catch(FacebookApiException $e) {
                                                // If the user is logged out, you can have a 
                                                // user ID even though the access token is invalid.
                                                // In this case, we'll get an exception, so we'll
                                                // just ask the user to login again here.
                                                $login_url = $facebook->getLoginUrl(); 
                                                echo 'Please <a href="' . $login_url . '">login.</a>';
                                                error_log($e->getType());
                                                error_log($e->getMessage());
                                                return FALSE;
                                            }
                                            $friendWeWant[] = "end";
                                            
                                            
//                 return $user;
                           
    }
    

}
?>