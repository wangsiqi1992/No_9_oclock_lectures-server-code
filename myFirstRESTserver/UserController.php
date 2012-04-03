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
        return "Hello World";
    }

    /**
     * Logs in a user with the given username and password POSTed. Though true
     * REST doesn't believe in sessions, it is often desirable for an AJAX server.
     *
     * @url POST /login
     * 
     */
    public function login($data)
    {
        $fbid = $data['fbid'];
        $fbAccessToken = $data['fbAccessToken'];
        $user = new User();
        
        $user->userInfo($fbid);
            if($fbAccessToken == $user->fbAccessToken)
            {
                setcookie('fbid', $fbid);
            }
            else {
                //check token here!
                //if valid update database
                $this->getUserInfoFromFB($fbid, $fbAccessToken, $user);
                
                setcookie('fbid', $fbid);

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
        $user = new User();

        if ($id == "current") {
            //implement whatever you want here~!
            $user->userInfo($_COOKIE['fbid']);

        } 
        elseif ($id == "friendList") {
            
            
            
    }
        else {
            $user->userInfo($id);            
            
            }
        return $user; // serializes object into JSON

    }

    /**
     * Saves a user to the database
     *
     * @url POST /user
     * @url PUT /users/$id
     */
    public function saveUser($id = null, $data)
    {
        // ... validate $data properties such as $data->username, $data->firstName, etc.
        //$data->id = $id;
        $user = new User;
        
        $user->saveUser($data); // saving the user to the database
  //      $data[$id] = 11111;
//        if ($data['name']) {
 //       echo $data['name'];       
 //       $user->name = "Hello world!";
//
//        }
       
        return $user; // returning the updated or newly created user object
    }
    
    public function authorize()
    {
        $server = $this->server;
        
        if ($server->url == "/login" || $server->url == "") {
            return TRUE;
        }
        $fbid = $_COOKIE['fbid'];
        if(!$fbid)
        {
            if($_SERVER[PHP_AUTH_USER])
            {
                $fbid = $_SERVER[PHP_AUTH_USER];
                setcookie('fbid', $fbid);
                $_COOKIE['fbid'] = $fbid;
                
            }
            
        }
        $user = new User;
        $user->userInfo($fbid);
        if($user->name)
        {
            return TRUE;
        }
        return FALSE;
        
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