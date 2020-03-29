<?php
ob_start();
require_once '../classes/configure.php';
ini_set('display_errors', '1');

$table = TB_CHAT_SITES;
$action = $_POST['action'];
$response = array();
$error = FALSE;
$errorMessages = array();
$row = array();
$rows = array();
$created_at = date('Y-m-d H:i:s');

//Get Visitors List
if($action == 'getVisitorList'):
        
     //check user_id for user authentication
    if ( isset($_POST['user_id']) && $_POST['user_id'] != "" ):
        //Device id valid
        if( isDeviceIdValid($_POST['device_id']) ):
            
            $ul_qry = "SELECT u.id as user_id, u.fname, u.email, u.phone, u.profile_pic, u.profile_color, u.is_online, u.ip_address, u.city, s.site_name, "; 
            $ul_qry .= " u.created_at as u_created_at, max(m.id) as mid, m.site_id, m.sender_id ";
            $ul_qry .= " FROM `".TB_CHAT_MESSAGE."` as m ";
            $ul_qry .= " LEFT JOIN `".TB_USERS."` as u ON u.id=m.sender_id";
            $ul_qry .= " LEFT JOIN `".TB_CHAT_SITES."` as s ON s.id=u.site_id";
            /** For WHERE **/
            $ul_qry .= " WHERE u.users_groups_id=3 "; //3 is for only visitor
            //$ul_qry .= " AND m.is_new_req='no'";
            if( !isEmpty($_REQUEST['site_id']) ):
                $ul_qry .= " AND m.site_id='".$_REQUEST['site_id']."' ";
            endif;
            /** For Group By **/
            $ul_qry .= " group by u.id ";
            /** For Ordering **/
            $ul_qry .= " order by m.`id` DESC";
            
            /** For fire query **/
            $result = mysqli_query($con, $ul_qry);

            if(mysqli_num_rows($result) > 0):

                while($row = mysqli_fetch_assoc($result)):

                    $msg = fetchqry( '*', TB_CHAT_MESSAGE, array('id='=>$row['mid']) );
                    $message = 'image';                            
                    if( !isEmpty($msg['chat_message']) ):
                        $message = $msg['chat_message'];
                    endif;

                    $qry = " SELECT count(id) as tot_msg FROM `chat_message` WHERE `sender_id`='".$row['sender_id']."' AND `is_read_visitor`='unread' ";
                    $umQry = mysqli_query($con, $qry);
                    $unreadMsg = mysqli_fetch_assoc($umQry);
                    $profile_pic = URL_BASE.DIR_UPLOADS.$row['profile_pic'];

                    $arr = array( 'user_id'=>$row['user_id'], 'site_id'=>$row['site_id'], 'user_name'=>$row['fname'], 'profile_pic'=>$profile_pic, 'is_online'=>$row['is_online'], 'message'=>$message, 
                                    'unread_messages'=>$unreadMsg['tot_msg'], 'created_at'=>$msg['created_at'] );
                    $rows[] = $arr;

                endwhile;

                $response = array( 'status'=>1, 'msg'=>'Visitor List', 'data'=>$rows );

            else:
                $response = array('status'=>0, 'msg'=>'No Visitor Found');
            endif;
        else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
        endif; 
    else:
        $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif;
    
//Get New Visitors Request List
elseif($action == 'getNewVisitorRequestList'):
      
    //check user_id for user authentication
    if ( isset($_POST['user_id']) && $_POST['user_id'] != "" ):
        //Device id valid
        if( isDeviceIdValid($_POST['device_id']) ):
            
            $nuqry = " SELECT u.id as user_id, u.fname, u.profile_pic, u.is_online, m.id as mid, m.message_type, m.chat_message, m.is_new_req, m.sender_id, m.created_at ";
            $nuqry .= " FROM `".TB_CHAT_MESSAGE."` as m ";
            $nuqry .= " left join `".TB_USERS."` as u ON u.id=m.sender_id ";
            $nuqry .= " WHERE m.is_new_req='yes' AND u.users_groups_id=3 ";
            
            /** For fire query **/
            $result = mysqli_query($con, $nuqry);
            
            if(mysqli_num_rows($result)):

                while($row = mysqli_fetch_assoc($result)):

                    $msg = fetchqry( '*', TB_CHAT_MESSAGE, array('id='=>$row['mid']) );
                    $message = 'image';                            
                    if( !isEmpty($msg['chat_message']) ):
                        $message = $msg['chat_message'];
                    endif;

                    $profile_pic = "";
                    if( !isEmpty($row['profile_pic']) ):
                        $profile_pic = URL_BASE.DIR_UPLOADS.$row['profile_pic'];
                    endif;

                    $arr = array( 'user_id'=>$row['user_id'], 'message_id'=>$row['mid'], 'user_name'=>$row['fname'], 'profile_pic'=>$profile_pic, 'is_online'=>$row['is_online'], 'message'=>$message, 'created_at'=>$msg['created_at'] );
                    
                    $rows[] = $arr;

                endwhile;

                $response = array( 'status'=>1, 'msg'=>'New User Requests', 'data'=>$rows );

            else:
                $response = array('status'=>0, 'msg'=>'No New Request Found');
            endif;
        else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
        endif;  
    else:
        $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif;  
    
//Accept Visitor Request
elseif($action == 'acceptVisitorRequest'):
        
    //check user_id for user authentication
    if ( isset($_POST['user_id']) && $_POST['user_id'] != "" && !isEmpty($_POST['message_id']) ):
        //validate login from device
        if( isDeviceIdValid($_POST['device_id']) ):
            
            $req_accepter_id = trim($_POST['user_id']);
            $message_id = trim($_POST['message_id']);
            
            //accept message request
            $res = updateqry( array("receiver_id"=>$req_accepter_id, "is_read_admin"=>"read", "is_new_req"=>"no", "request_status"=>"accepted"), array("id="=>$message_id, "is_new_req="=>"yes"), TB_CHAT_MESSAGE );
        
            if($res):
                                    
                $nmqry = "SELECT u.fname, u.lname, u.profile_pic, m.id, m.chat_session_id, m.site_id, m.message_type, m.chat_message, m.chat_file, m.is_read_admin, m.sender_id, m.created_at ";
                $nmqry .= " FROM `".TB_CHAT_MESSAGE."` as m ";
                $nmqry .= " LEFT JOIN `".TB_USERS."` as u ON u.id=m.sender_id ";
                $nmqry .= " WHERE m.id='".$message_id."' AND m.request_status!='closed' ";
                $nmres = mysqli_query($con, $nmqry);
                
                    if( mysqli_num_rows($nmres) > 0 ) :
                        
                        $row = mysqli_fetch_assoc($nmres);
                        $mDate = getDateTimeDifference($row['created_at']);
                        $uimage = ( !isEmpty($row['profile_pic']) ) ? $row['profile_pic'] : "not-available.png";

                        //Add Thank you message
                        $arr = array( "chat_session_id"=>$row['chat_session_id'], "site_id"=>$row['site_id'], "sender_id"=>$req_accepter_id, "receiver_id"=>$row['sender_id'], "sort_order"=>time(), "chat_message"=>"Hi!, We are happy to see you.", 
                                      "chat_file"=>"", "message_type"=>"text", "is_read_admin"=>"read", "is_read_visitor"=>"unread", "is_new_req"=>"no", "request_status"=>"accepted", "created_at"=>date("Y-m-d h:i:s") ); 

                        insertqry($arr, TB_CHAT_MESSAGE);
                        $lastId = getfieldmaxvalue('id', TB_CHAT_MESSAGE);

                        $nmqry1 = "SELECT u.fname, u.lname, u.profile_pic, m.id as mid, m.chat_session_id, m.site_id, m.message_type, m.chat_message, m.chat_file, m.is_read_admin, m.sender_id, m.created_at ";
                        $nmqry1 .= " FROM `".TB_CHAT_MESSAGE."` as m ";
                        $nmqry1 .= " LEFT JOIN `".TB_USERS."` as u ON u.id=m.sender_id ";
                        $nmqry1 .= " WHERE m.id='".$lastId."' AND m.request_status!='closed' ";
                        $nmres1 = mysqli_query($con, $nmqry1);

                        if(mysqli_num_rows($nmres1) > 0):

                            $row1 = mysqli_fetch_assoc($nmres1);
                            $uimage1 = ( !isEmpty($row1['profile_pic']) ) ? $row1['profile_pic'] : "not-available.png";
                            $mu_name1 = $row1['fname'].' '.$row1['lname'];
                            $mDate1 = getDateTimeDifference($row1['created_at']);

                        endif;

                        $short_msg = getShortMessage($row1['chat_message'], 25);

                        $response = array('status'=>1, 'message_id'=>$row1['mid'], 'short_message'=>$short_msg, 'message'=>$row1['chat_message'], 'last_message_id'=>$lastId, 'sender_id'=>$row1['sender_id'], 'visitor_id'=>$row['sender_id'], "ago_time"=>$mDate1 );

                else:
                    $response = array('status'=>0, 'msg'=>'Record not found');
                endif;                 
            else:    
                $response = array('status'=>0, 'msg'=>'Record could not updated, please try again');        
            endif;   
        else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
        endif;         
    else:
        $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif; 
        
    
//Get chat conversion
elseif($action == 'getChatConversion'):
        
    //check user_id for user authentication
    if ( isset($_POST['user_id']) && $_POST['user_id'] != "" && !isEmpty($_POST['receiver_id']) ):

        if( isDeviceIdValid($_POST['device_id']) ):
            
                $mqry = "SELECT m.id as mid, m.chat_session_id, u.id as user_id, u.users_groups_id, u.fname, u.profile_pic, u.profile_color, u.is_online, s.site_name, m.chat_message,";
                $mqry .= " m.chat_file, m.message_type, m.is_new_req, m.is_read_admin, m.sender_id, m.receiver_id, m.is_read_visitor, m.created_at ";
                $mqry .= " FROM `".TB_CHAT_MESSAGE."` as m ";
                $mqry .= " LEFT JOIN `".TB_USERS."` as u ON u.id=m.sender_id";
                $mqry .= " LEFT JOIN `".TB_CHAT_SITES."` as s ON s.id=u.site_id";
                /** For Where **/
                $mqry .= " WHERE ( m.sender_id='".$_POST['receiver_id']."' OR m.receiver_id='".$_POST['receiver_id']."' ) AND m.is_new_req='no' AND m.request_status!='closed' ";
                /** For Group By **/
                $mqry .= " group by m.id ";
                /** For Ordering **/
                $mqry .= " order by m.sort_order ASC ";
                
                $result = mysqli_query($con, $mqry);

                if(mysqli_num_rows($result) > 0):
                    
                    while($row = mysqli_fetch_assoc($result)):
                    
                        $image = "";
                        if( $row['message_type'] == "file" && !isEmpty($row['chat_file']) ):
                            $image = URL_BASE.DIR_UPLOADS.$row['chat_file'];
                        endif;
                        
                        /* $array = array( 'mid'=>$row['mid'], 'sender_id'=>$row['sender_id'], 'receiver_id'=>$row['receiver_id'], 'user_name'=>$row['fname'], 'profile_pic'=>URL_BASE.DIR_UPLOADS.$row['profile_pic'],
                                        'is_online'=>$row['is_online'], 'message_type'=>$row['message_type'], 'chat_message'=>$row['chat_message'], 'is_read_visitor'=>$row['is_read_visitor'], 'chat_file'=>$image, 
                                        'chat_session_id'=>$row['chat_session_id'], 'created_at'=>$row['created_at'] ); */
                        
                        $array = array( 'mid'=>$row['mid'], 'sender_id'=>$row['sender_id'], 'receiver_id'=>$row['receiver_id'], 
                                        'message_type'=>$row['message_type'], 'chat_message'=>$row['chat_message'], 'is_read_visitor'=>$row['is_read_visitor'], 'chat_file'=>$image, 
                                        'chat_session_id'=>$row['chat_session_id'], 'created_at'=>$row['created_at'] );
                        
                        $rows[] = $array;
                        
                    endwhile;

                    $response = array( 'status'=>1, 'msg'=>'Chat Conversion', 'data'=>$rows );
                    
                else:
                    $response = array('status'=>0, 'msg'=>'No message Found');
                endif;
        else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
        endif;         
    else:
        $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif;

//Add New Message
elseif($action == 'sendMessage'):
    
    //check user_id for user authentication
    if ( !isEmpty($_POST['user_id']) && !isEmpty($_POST['receiver_id']) ):
        
        //validate login from device
        if( isDeviceIdValid($_POST['device_id']) ):
            
            $senderid = $_POST['user_id'];
            $receiver_id = $_POST['receiver_id'];
            
            $lsQry = "SELECT MAX(m.chat_session_id) as chat_session_id, site_id FROM `".TB_CHAT_MESSAGE."` as m WHERE (m.sender_id='".$senderid."' AND m.receiver_id='".$receiver_id."')";
            $lsQry .= " OR (m.sender_id='".$receiver_id."' AND m.receiver_id='".$senderid."') ";
            $lsRes = mysqli_query($con, $lsQry);
            $lsRow = mysqli_fetch_assoc($lsRes);
            
            $chat_session_id = $lsRow['chat_session_id'];    
            $site_id = trim($lsRow['site_id']);
            $sort_order = time();
            
            if( !isEmpty($_POST['message']) ):
                
                $created_at = date('Y-m-d h:i:s');                
                $arr = array( "chat_session_id"=>$chat_session_id, "site_id"=>$site_id, "sender_id"=>$senderid, "receiver_id"=>$receiver_id, "sort_order"=>$sort_order, "chat_message"=>trim($_POST['message']),
                              "message_type"=>"text", "is_read_admin"=>"read", "is_read_visitor"=>"unread", "is_new_req"=>"no", "request_status"=>"accepted", "created_at"=>$created_at );
                
                $res = insertqry($arr, TB_CHAT_MESSAGE);
                $lastId = getfieldmaxvalue('id', TB_CHAT_MESSAGE);
                $ago_time = getDateTimeDifference($created_at);
                
                if( !isEmpty($lastId) ):
                    $response = array('status'=>1, 'message_id'=>$lastId, 'message'=>$_POST['message'], 'last_message_id'=>$lastId, 'sender_id'=>$senderid, 'receiver_id'=>$receiver_id, "ago_time"=>$ago_time );
                else:
                    $response = array('status'=>0, 'msg'=>'Please try again');
                endif;
                
            else:
                $response = array('status'=>0, 'msg'=>'Please enter message');
            endif;                        
        else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');    
        endif;
    else:    
        $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif;   
    
//send new image
elseif($action == 'sendChatImage'):
    
    //check user_id for user authentication
    if ( !isEmpty($_POST['user_id']) && !isEmpty($_POST['receiver_id']) ):
        
        //validate login from device
        if( isDeviceIdValid($_POST['device_id']) ):
            
            $senderid = $_POST['user_id'];
            $receiver_id = $_POST['receiver_id'];
            
            $lsQry = "SELECT MAX(m.chat_session_id) as chat_session_id, site_id FROM `".TB_CHAT_MESSAGE."` as m WHERE (m.sender_id='".$senderid."' AND m.receiver_id='".$receiver_id."') OR (m.sender_id='".$receiver_id."' AND m.receiver_id='".$senderid."') ";
            $lsRes = mysqli_query($con, $lsQry);
            $lsRow = mysqli_fetch_assoc($lsRes);
            
            $chat_session_id = $lsRow['chat_session_id'];    
            $site_id = trim($lsRow['site_id']);
            $sort_order = time();
            
            if( isset($_FILES['image']) ):
                
                $created_at = date('Y-m-d h:i:s');
                $mediaUrl = "";
                if( isset($_FILES['image']) ):
                     $mediaUrl = uploadfile( "image", $_FILES['image'], array("jpeg", "jpg", "gif", "png","bmp","pdf") );  
                endif;
            
                $arr = array( "chat_session_id"=>$chat_session_id, "site_id"=>$site_id, "sender_id"=>$senderid, "receiver_id"=>$receiver_id, "sort_order"=>$sort_order, "chat_file"=>$mediaUrl,
                                "message_type"=>"file", "chat_message"=>"", "is_read_admin"=>"read", "is_read_visitor"=>"unread", "is_new_req"=>"no", "request_status"=>"accepted", 
                                "created_at"=>$created_at );
                
                $res = insertqry($arr, TB_CHAT_MESSAGE);
                $lastId = getfieldmaxvalue('id', TB_CHAT_MESSAGE);
                $ago_time = getDateTimeDifference($created_at);
                
                if( !isEmpty($lastId) ):
                    $response = array('status'=>1, 'message_id'=>$lastId, 'message'=>"",  "image"=>URL_BASE.DIR_UPLOADS.$mediaUrl, 'last_message_id'=>$lastId, 'sender_id'=>$senderid, 'receiver_id'=>$receiver_id, "ago_time"=>$ago_time );
                else:
                    $response = array('status'=>0, 'msg'=>'Please try again');
                endif;
                
            else:
                $response = array('status'=>0, 'msg'=>'Please select file');
            endif;
            
        else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');    
        endif;
    else:    
        $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif;
    
//remove Text message
elseif($action == 'removeChatTextMessage'):
    
    //check user_id for user authentication
    if ( !isEmpty($_POST['user_id']) && !isEmpty($_POST['message_id']) ):
        
        //validate login from device
        if( isDeviceIdValid($_POST['device_id']) ):
            
            $mType = fetchqry( 'message_type', TB_CHAT_MESSAGE, array('id='=>$_POST['message_id']) );
            //check message type
            if ( $mType['message_type'] == "text" ):    
                
                $dqry = " DELETE FROM `".TB_CHAT_MESSAGE."` WHERE `id`='".$_POST['message_id']."' AND `message_type`='text' AND `sender_id`='".$_POST['user_id']."' ";
                $res = mysqli_query($con, $dqry);

                if($res):
                    $response = array('status'=>1, 'msg'=>'Message deleted successfully' );
                else:
                    $response = array('status'=>0, 'msg'=>'Please try again OR You can not delete sended by others message');
                endif;
                    
            else:
                    $response = array('status'=>0, 'msg'=>'Please try again, Message type should be text');    
            endif;        
            
        else:
                $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
        endif;
        
    else:
        $response = array('status'=>0, 'msg'=>'Please provide necessary details');
    endif;
    
//remove chat image
elseif($action == 'removeChatFileMessage'):
    
    //check user_id for user authentication
    if ( !isEmpty($_POST['user_id']) && !isEmpty($_POST['message_id']) ):
        
        //validate login from device
        if( isDeviceIdValid($_POST['device_id']) ):            
            //Get record
            $mType = fetchqry( 'message_type, chat_file', TB_CHAT_MESSAGE, array('id='=>$_POST['message_id']) );            
            //check message type
            if ( $mType['message_type'] == "file" ):
                
                    $filePath = URL_BASE.DIR_UPLOADS.$mType['chat_file'];
                    deletefile($filePath);
                    $res = deleteqry(TB_CHAT_MESSAGE, array("id="=>$_POST['message_id']) );            

                    if($res):
                        $response = array( 'status'=>1, 'msg'=>'Message deleted successfully' );         
                    else:
                        $response = array( 'status'=>0, 'msg'=>'Please try again' );
                    endif;
            else:
                $response = array('status'=>0, 'msg'=>'Please try again, message type should be file');
            endif;                
        else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');     
        endif;
        
    else:
        $response = array('status'=>0, 'msg'=>'Please provide necessary details');
    endif;
    
//remove Text message
elseif($action == 'editChatMessage'):
    
    //check user_id for user authentication
    if ( !isEmpty($_POST['user_id']) && !isEmpty($_POST['message_id']) && !isEmpty($_POST['message']) ) :
        
        //validate login from device
        if( isDeviceIdValid($_POST['device_id']) ):
            
            $mType = fetchqry( 'id', TB_CHAT_MESSAGE, array('id='=>$_POST['message_id'],'sender_id='=>$_POST['user_id']) );
        
            if( !isEmpty($mType['id']) ):
                
                $message_id = $_POST['message_id'];
                $message = trim($_POST['message']);

                $arr = array("chat_message"=>$message);
                $res = updateqry($arr, array("id="=>$message_id), TB_CHAT_MESSAGE);

                if($res):
                    $response = array('status'=>1, 'msg'=>'Message updated successfully' );                
                else:
                    $response = array('status'=>0, 'msg'=>'Please try again');
                endif;               
                
            else:
                $response = array('status'=>0, 'msg'=>'You do not have rights to edit this message');
            endif;         
            
        else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');     
        endif;
        
    else :
        $response = array('status'=>0, 'msg'=>'Please provide necessary details');
    endif;    
            
else:
    $response = array('status' => 0, 'msg' => 'Please provide necessary details');
endif;

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);