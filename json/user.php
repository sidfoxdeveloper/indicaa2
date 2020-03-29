<?php
include('../includes/script_top_json.php');

$table = TB_USERS;
$action = $_REQUEST['action'];
$response = array();
$error = FALSE;
$errorMessages = array();
$row = array();
$rows = array();
$created_at = date('Y-m-d H:i:s');

// Login User
if ($action == 'login'):
    
        //validate email and password is blank or not
        if (!isset($_REQUEST['email']) || $_REQUEST['email'] == ""):
                $error = true;
                $errorMessages[] = "Enter email";
        endif;
        if (!isset($_REQUEST['password']) || $_REQUEST['password'] == ""):
                $error = true;
                $errorMessages[] = "Enter password";
        endif;
        
         //Display error messages 
        if ($errorMessages):
                $errorMessages = implode(",", $errorMessages);
                $response = array('status' => 0, 'msg' => $errorMessages);
         else:
                //Check User cradentials
                $result = selectqry("*", TB_USERS, array( "email="=>$_REQUEST['email'], "password="=>encode($_REQUEST['password']), "users_groups_id="=>'6' ) );
   
                if(mysqli_num_rows($result) <= 0) :
                    $result = selectqry( "*", TB_USERS, array( "user_name="=>$_REQUEST['email'], "password="=>encode($_REQUEST['password']), "users_groups_id="=>'6' ) );
                endif;
                
                if( mysqli_num_rows($result) > 0 ):
                        
                        $row = mysqli_fetch_assoc($result);
                
                        $token = isEmpty($_REQUEST['token']) ? md5(date('Y-m-d H:i:s')) : $_REQUEST['token'];   
                        $arr = array('token'=>$token);
                        
                        updateqry($arr, array('id='=>$row['id']), $table);                        
                        $res = fetchqry( "id, user_name, email, image, token", $table, array("id="=>$row['id']) );
                        
                        if( !isEmpty($res['image']) ){
                            $image = URL_BASE.DIR_UPLOADS.$res['image'];
                        } else {
                            $image = URL_BASE.DIR_UPLOADS."not-available.png";
                        }
                        
                        $rows = array( 'user_id'=>$res['id'], 'user_name'=>$res['user_name'], 'email'=>$res['email'], 'image'=>$image, 'token'=>$res['token'] );

                        $response = array( 'status'=>1, 'msg'=>'Login sucessfull', 'data'=>$rows );

                else:
                        $response = array('status' => 0, 'msg' => 'Username or Password is wrong...Try Again');
                endif;
                
        endif;
        
// change Password
elseif($action == 'changePassword'):
        
        //check user_id for user authentication
        if( !isEmpty($_REQUEST['user_id']) && isUserIdValid($_REQUEST['user_id']) && isDeviceIdValid($_REQUEST['device_id']) ):

                $user_id = empty($_REQUEST['user_id']) ? "" : $_REQUEST['user_id'];
                
                //validate fieleds are blank or not
                if ( isEmpty($_REQUEST['current_password']) ):
                    $error = true;
                    $errorMessages[] = "Enter old password";
                endif;
                if ( isEmpty($_REQUEST['new_password']) ):
                    $error = true;
                    $errorMessages[] = "Enter new password";
                endif;

                //Display error messages 
                if ($errorMessages):
                    $errorMessages = implode(",", $errorMessages);
                    $response = array('status' => 0, 'msg' => $errorMessages);
                else:
                    
                    //Check Old Password
                    $qry = "SELECT id as user_id, password FROM $table WHERE id='".$_REQUEST['user_id']."' AND password='".encode($_REQUEST['current_password'])."' ";
                    $user = mysqli_fetch_array( mysqli_query($con, $qry) ); 
                    
                    if ( !isEmpty($user['user_id']) ):
                   
                        $user_id = $user['user_id'];
                    
                        //change user password
                        $arr = array("password"=>encode($_REQUEST['new_password']));
                        $result = updateqry($arr, array("id="=>$user_id), $table);

                        if ($result):
                            $response = array('status'=>1, 'msg'=>'Password changed sucessfully');
                        else:
                            $response = array('status'=>0, 'msg'=>'Password did not changed...Try Again');
                        endif;

                    else:
                        $response = array('status' => 0, 'msg' => 'Old password does not match');
                    endif;

                endif;

        else:
            $response = array('status' => 0, 'msg' => 'Please provide necessary details or Your blocked for sometime, Please contact admin for trouble in login');
        endif;
        
//Get User Details
elseif($action == 'getUserDetails'):
        
        //check user_id for user authentication
        if ( isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "" ):

            if( isDeviceIdValid($_REQUEST['device_id']) ):

                $user_id = empty($_REQUEST['user_id']) ? "" : $_REQUEST['user_id'];
            
                //Get User Details
                $row = fetchqry( 'id, user_name, first_name, last_name, email, phone, image, location, lastlogin, token, created_at', $table, array("id="=>$user_id) );
                
                if( !isEmpty($res['image']) ){
                    $image = URL_BASE.DIR_UPLOADS.$row['image'];
                } else {
                    $image = URL_BASE.DIR_UPLOADS."not-available.png";
                }
                
                $rows = array( 'user_name'=>$row['user_name'],'first_name'=>$row['first_name'],'last_name'=>$row['last_name'], 'email'=>$row['email'], 'phone'=>$row['phone'], 'image'=>$image, 
                               'location'=>$row['location'], 'lastlogin'=>$row['lastlogin'], 'token'=>$row['token'], "created_at"=>$row['created_at'] );
                
                if($row):
                    $response = array( 'status'=>1, 'msg'=>'Profile details', 'data'=>$rows );
                else:           
                    $response = array('status'=>0, 'msg'=>'User not found');
                endif;

            else:
                $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
            endif;

        else: 
            $response = array('status' => 0, 'msg' => 'Please provide necessary details');
        endif;     

//For upload only image
elseif ($action == "uploadUpdateImage"):

        //check user_id for user authentication
        if ( !isEmpty($_REQUEST['user_id']) && isUserIdValid($_REQUEST['user_id']) && isDeviceIdValid($_REQUEST['device_id']) ):
                 
                if(!isEmpty($_FILES['image'])):
                    
                        //user id
                        $user_id = empty($_REQUEST['user_id']) ? "" : $_REQUEST['user_id'];
                        $image = $_FILES['image'];

                        //Upload Image   
                        $up_image = uploadfile("image", $image, array("jpeg", "jpg", "gif", "png"));

                        $result = updateqry( array("image" => $up_image), array("id="=>$user_id), $table );

                        if ($result):                    
                            $response = array('status' => 1, 'msg' => 'Profile updated sucessfully');
                        else:
                            $response = array('status' => 0, 'msg' => 'Profile did not updated...Try Again');
                        endif;
                        
                else:
                        $response = array('status' => 0, 'msg' => 'Please select image');
                endif;
        
        else:
                $response = array('status' => 0, 'msg' => 'Please provide necessary details');
        endif;        
        
// Forgot Password
elseif($action == 'forgotPassword'):
    
        //validate email and password is blank or not
        if (!isset($_REQUEST['email']) || $_REQUEST['email'] == ""):
            $error = true;
            $errorMessages[] = "Enter your email";
        endif;
        
        //Display error messages 
        if ($errorMessages):
            $errorMessages = implode(",", $errorMessages);
            $response = array('status' => 0, 'msg' => $errorMessages);
        else:
            
            if( isEmail($_REQUEST['email']) ):

                $user = selectqry('`email`', $table, array( 'email='=>$_REQUEST['email'] ) ); 
                
                if( mysqli_num_rows($user) > 0 ):

                    $row = mysqli_fetch_assoc($user);
                    $newPass = generatepassword();
                                        
                    if( !isEmpty($newPass) && !isEmpty($row['email']) ):

                        $result = updateqry( array('password'=>encode($newPass)), array("email="=>$row['email']), $table );
                                                
                        if($result):
                            
                                $content1 = file_get_contents("mail_templates/email_template.php");
                                $htmlmessage1 .= '<li style="list-style:none;">
                                                <span class="ul-li-span1" style="display:inline-block; float:left; font-family: "robotobold"; font-size:2em; color:#ef5438; line-height:1.5; padding: 5px 0px;">Your Password is : </span>
                                                <span class="ul-li-span2" style="display:inline-block; float:left;  font-size:2em; line-height:1.5; color:#161616;font-family: "robotomedium";padding: 5px 0px;"><strong>'.$newPass.'</strong></span>
                                            </li>';

                                $contenthtml = str_replace('{{message}}', $htmlmessage1, $content1);

                                $body = $contenthtml;
                                $customeEmail = $row['email'];
                                $subject = 'Your new password for login';

                                require(DIR_BASEADMIN . DIR_SMTP . "class.phpmailer.php");

                                $mailC = new PHPMailer();

                                if (MAIL_SMTPAUTH == 'false')
                                        $mailC->IsMail(); // set mailer to use Mail
                                else
                                        $mailC->IsSMTP(); // set mailer to use Mail 
                                $mailC->Host = MAIL_HOST; // specify main and backup server
                                $mailC->SMTPAuth = MAIL_SMTPAUTH; // turn on SMTP authentication
                                $mailC->Username = MAIL_USERNAME; // SMTP username
                                $mailC->Password = MAIL_PASSWORD; // SMTP password
                                $mailC->Port = MAIL_PORT;
                                if (MAIL_SSL)
                                        $mailC->SMTPSecure = MAIL_SSL;
                                if (MAIL_SMTPAUTH == 'false')
                                        $mailC->From = MAIL_FROMEMAIL;
                                else
                                        $mailC->From = MAIL_USERNAME;
                                $mailC->FromName = MAIL_FROMNAME;

                                $mailC->AddAddress($customeEmail);				
                                $mailC->Subject = $subject;
                                $mailC->Body = $body;	
                                $mailC->Send();     
                                
                                $response = array('status'=>1, 'msg'=>'Your password recover successfully!, Please check your email', 'data'=>'success' ); 

                        else:                                        
                            $response = array('status'=> 0,'msg'=>'Your email not found, Please try again' ); 
                        endif;
                    else:
                        $response = array('status' => 0, 'msg'=>'Please enter email and password' ); 
                    endif;
                else:
                    $response = array('status' => 0, 'msg'=>'Your email not found, Please try again' ); 
                endif;
            else:                
                $response = array('status' => 0, 'msg'=>'Please enter valid email' ); 
            endif;
            
        endif;
        
//For edit inspector profile
elseif ($action == "editInspectorProfile"):

        //check user_id for user authentication
        if ( !isEmpty($_REQUEST['user_id']) && isUserIdValid($_REQUEST['user_id']) && isDeviceIdValid($_REQUEST['device_id']) ):
                                    
                //user id
                $user_id = empty($_REQUEST['user_id']) ? "" : $_REQUEST['user_id'];

                if( !isEmpty($_REQUEST['first_name']) ):
                    $result = updateqry( array( "first_name"=>$_REQUEST['first_name'] ), array( "id="=>$_REQUEST['user_id'] ), $table );
                endif;
                
                if( !isEmpty($_REQUEST['last_name']) ):
                    $result = updateqry( array( "last_name"=>$_REQUEST['last_name'] ), array( "id="=>$_REQUEST['user_id'] ), $table );
                endif;
                
                if( !isEmpty($_REQUEST['phone']) ):
                    $result = updateqry( array( "phone"=>$_REQUEST['phone'] ), array( "id="=>$_REQUEST['user_id'] ), $table );
                endif;
                
                if( !isEmpty($_REQUEST['location']) ):
                    $result = updateqry( array( "location"=>$_REQUEST['location'] ), array( "id="=>$_REQUEST['user_id'] ), $table );
                endif;
                
                if( !isEmpty($_REQUEST['email']) ):
                                   
                    $res = selectqry( "email", $table, array("email="=>$_REQUEST['email']) );
                    
                    if(mysqli_num_rows($res) > 0):                        
                            $response = array('status' => 0, 'msg' => 'Profile could not updated, please try with another email');
                            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                            die();        
                    else:
                            $result = updateqry( array( "email"=>$_REQUEST['email'] ), array( "id="=>$_REQUEST['user_id'] ), $table );                    
                    endif;
                    
                endif;
                
                if( !isEmpty($_REQUEST['user_name']) ):
                                   
                    $res = selectqry( "user_name", $table, array("user_name="=>$_REQUEST['user_name']) );
                    
                    if(mysqli_num_rows($res) > 0):
                            $response = array('status' => 0, 'msg' => 'Profile could not updated, please try with another User Name');
                            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                            die();        
                    else:
                            $result = updateqry( array( "user_name"=>$_REQUEST['user_name'] ), array( "id="=>$_REQUEST['user_id'] ), $table );      
                    endif;
                    
                endif;

                if ($result):
                        $response = array('status' => 1, 'msg' => 'Profile updated sucessfully');
                else:
                        $response = array('status' => 0, 'msg' => 'Profile did not updated, please fill neccesary details');
                endif;                
        
        else:
                $response = array('status' => 0, 'msg' => 'Please provide necessary details');
        endif;        
        
//Get device id
elseif($action == 'logout'):

        //check user_id for user authentication
        if ( !isEmpty($_REQUEST['user_id']) && !isEmpty($_REQUEST['device_id']) ):      

            //Update user details
            $result = fetchqry( 'id, email, token', $table, array("token="=>$_REQUEST['device_id'], "id="=>$_REQUEST['user_id']) );

            if( !isEmpty($result['id']) ):
                    updateqry( array("token"=>""), array("id="=>$result['id']), $table );
                    $response = array( 'status'=>1, 'msg'=>'logout Successfully', 'data'=>array() );       
            else:
                    $response = array('status'=>0, 'msg'=>'Device not found');
            endif;

        else: 
            $response = array('status'=>0, 'msg'=>'Please provide necessary details');
        endif;
    
else:
    $response = array('status' => 0, 'msg' => 'Please provide necessary details');
endif;

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);