<?php
include('../includes/script_top_json.php');

$table = TB_CONTAINERS;
$action = $_REQUEST['action'];
$response = array();
$error = FALSE;
$errorMessages = array();
$row = array();
$rows = array();
$created_at = date('Y-m-d H:i:s');


//Get Container sizes list
if($action == 'getContainerSizes'):
        
        //check user_id for user authentication
        if ( isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "" ):

            if( isDeviceIdValid($_REQUEST['device_id']) ):
                
                $result = selectqry('*', TB_CONTAINER_SIZE);
           
                if(mysqli_num_rows($result) > 0):

                    while($row = mysqli_fetch_assoc($result)):

                        $arr = array( 'id'=>$row['id'], 'size'=>$row['name'] );
                        $rows[] = $arr;

                    endwhile;

                    $response = array( 'status'=>1, 'msg'=>'Container Sizes List', 'data'=>$rows );

                else:
                    $response = array('status'=>0, 'msg'=>'No Container Size Found');
                endif;                        

           else:
                $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
            endif;

        else: 
            $response = array('status' => 0, 'msg' => 'Please provide necessary details');
        endif;

// Add Container Step One
elseif($action == 'addContainerStepOne'):
        
        //check user_id for user authentication
        if( !isEmpty($_REQUEST['user_id']) && isUserIdValid($_REQUEST['user_id']) && isDeviceIdValid($_REQUEST['device_id']) ):

                $user_id = empty($_REQUEST['user_id']) ? "" : $_REQUEST['user_id'];
                $user = fetchqry('*', TB_USERS, array('id='=>$user_id) );
                
                $country = fetchqry('*', TB_COUNTRIES, array('id='=>$user['country_id']) );
                $country_id = empty($country['id']) ? "" : $country['id'];
                
                $company = fetchqry('*', TB_COMPANIES, array('id='=>$user['company_id']) );
                $company_id = empty($company['id']) ? "" : $company['id'];
                
                $yard = fetchqry('*', TB_YARDS, array('id='=>$user['yard_id']) );
                $yard_id = empty($yard['id']) ? "" : $yard['id'];
                
                $empty_container_received = empty($_REQUEST['empty_container_received']) ? "" : $_REQUEST['empty_container_received'];
                $container_placed_yard = empty($_REQUEST['container_placed_yard']) ? "" : $_REQUEST['container_placed_yard'];
                    
                $dateDiff = getDateDifference( $empty_container_received, $container_placed_yard );
                
                //validate fieleds are blank or not
                if ( isEmpty($country_id) ):
                    $error = true;
                    $errorMessages[] = "Please select country";
                endif;
                if ( isEmpty($company_id) ):
                    $error = true;
                    $errorMessages[] = "Please select company";
                endif;
                if ( isEmpty($yard_id) ):
                    $error = true;
                    $errorMessages[] = "Please select yard";
                endif;
                if ( isEmpty($empty_container_received) ):
                    $error = true;
                    $errorMessages[] = "Please enter empty container received date";
                endif;
                if ( isEmpty($container_placed_yard) ):
                    $error = true;
                    $errorMessages[] = "Please enter container placed yard date";
                endif;
                if ( $dateDiff < 1 ):
                    $error = true;
                    $errorMessages[] = "Please enter container placed yard date";
                endif;
                if ( isEmpty($_REQUEST['gross_weight']) ):
                    $error = true;
                    $errorMessages[] = "Please enter Gross Weight";
                endif;
                if ( isEmpty($_REQUEST['tare_weight']) ):
                    $error = true;
                    $errorMessages[] = "Please enter Tare Weight";
                endif;  
                if ( isEmpty($_REQUEST['pay_load']) ):
                    $error = true;
                    $errorMessages[] = "Please enter pay load";
                endif;
                if ( isEmpty($_REQUEST['pay_load']) ):
                    if( $_REQUEST['pay_load'] > 21 && $_REQUEST['pay_load'] < 29 ):
                        $error = true;
                        $errorMessages[] = "Pay load should be between 21-29";
                    endif;                    
                endif;
                if ( isEmpty($_REQUEST['empty_depot_name_id']) ):
                    $error = true;
                    $errorMessages[] = "Please select Empty depot Name";
                endif;
                if ( isEmpty($_REQUEST['shipping_line_id']) ):
                    $error = true;
                    $errorMessages[] = "Please select Shiping Line";
                endif;
                if ( isEmpty($_REQUEST['supplier_id']) ):
                    $error = true;
                    $errorMessages[] = "Please select Shiping Id";
                endif;
                
                //Display error messages 
                if ($errorMessages):
                    $errorMessages = implode(",", $errorMessages);
                    $response = array('status' => 0, 'msg' => $errorMessages);
                else:
                    
                        //Add Container
                        $arr = array( "country_id"=>$country_id, 
                                    "company_id"=>$company_id, 
                                    "yard_id"=>$yard_id, 
                                    "container_size_id"=>$_REQUEST['container_size_id'],
                                    "empty_depot_name_id"=>$_REQUEST['empty_depot_name_id'],
                                    "shipping_line_id"=>$_REQUEST['shipping_line_id'],
                                    "supplier_id"=>$_REQUEST['supplier_id'],                            
                                    "empty_container_received"=>$empty_container_received, 
                                    "container_placed_yard"=>$container_placed_yard, 
                                    "container_number"=>$_REQUEST['container_number'],                                      
                                    "gross_weight"=>$_REQUEST['gross_weight'],                            
                                    "pay_load"=>$_REQUEST['pay_load'],
                                    "tare_weight"=>$_REQUEST['tare_weight'],
                                    "created_at"=>$created_at
                                );
                
                        $result = insertqry($arr, $table);

                        if ($result):
                            $response = array('status'=>1, 'msg'=>'Container added sucessfully');
                        else:
                            $response = array('status'=>0, 'msg'=>'Container not added please try again');
                        endif;

                endif;

        else:
            $response = array('status' => 0, 'msg' => 'Please provide necessary details or Your blocked for sometime, Please contact admin for trouble in login');
        endif;

//For Add Container Step Two
elseif ($action == "addContainerStepTwo"):

        //check user_id for user authentication
        if ( !isEmpty($_REQUEST['user_id']) && isUserIdValid($_REQUEST['user_id']) && isDeviceIdValid($_REQUEST['device_id']) ):
                    
                //validate fieleds are blank or not
                if ( isEmpty($_REQUEST['container_id']) ):
                    $error = true;
                    $errorMessages[] = "Please select Container";
                endif;
                if ( isEmpty($_FILES['image_stock_pile']) ):
                    $error = true;
                    $errorMessages[] = "Please select stock pile image";
                endif;
                if ( isEmpty($_FILES['image_empty_container']) ):
                    $error = true;
                    $errorMessages[] = "Please select empty container image";
                endif;
                if ( isEmpty($_FILES['image_container_loading']) ):
                    $error = true;
                    $errorMessages[] = "Please select container loaidng image";
                endif;
                if ( isEmpty($_FILES['image_container_seal']) ):
                    $error = true;
                    $errorMessages[] = "Please select container seal image";
                endif;
                if ( isEmpty($_FILES['image_documents']) ):
                    $error = true;
                    $errorMessages[] = "Please select documents image";
                endif;                
                
                //Display error messages 
                if ($errorMessages):
                    $errorMessages = implode(",", $errorMessages);
                    $response = array('status' => 0, 'msg' => $errorMessages);
                else:    
                    
                        //user id
                        $user_id = empty($_REQUEST['user_id']) ? "" : $_REQUEST['user_id'];
                        //Upload Image   
                        $image_stock_pile = uploadfile("image", $_FILES['image_stock_pile'], array("jpeg", "jpg", "gif", "png"));
                        $image_empty_container = uploadfile("image", $_FILES['image_empty_container'], array("jpeg", "jpg", "gif", "png"));
                        $image_container_loading = uploadfile("image", $_FILES['image_container_loading'], array("jpeg", "jpg", "gif", "png"));
                        $image_container_seal = uploadfile("image", $_FILES['image_container_seal'], array("jpeg", "jpg", "gif", "png"));
                        $image_documents = uploadfile("image", $_FILES['image_documents'], array("jpeg", "jpg", "gif", "png"));

                        $arr = array('image_stock_pile'=>$image_stock_pile, 
                                     'image_empty_container'=>$image_empty_container,
                                     'image_container_loading'=>$image_container_loading,
                                     'image_container_seal'=>$image_container_seal,
                                     'image_documents'=>$image_documents
                                    );
                        
                        $result = insertqry( $arr, TB_CONTAINER_IMAGES );

                        if ($result):                    
                            $response = array('status' => 1, 'msg' => 'Container images uploaded sucessfully');
                        else:
                            $response = array('status' => 0, 'msg' => 'Container did not images uploaded...Try Again');
                        endif;
                
                endif;
        
        else:
                $response = array('status' => 0, 'msg' => 'Please provide necessary details');
        endif;
        
       
//For Add Container Step Three
elseif ($action == "addContainerStepThree") :
        
    //check user_id for user authentication
    if ( !isEmpty($_REQUEST['user_id']) && isUserIdValid($_REQUEST['user_id']) && isDeviceIdValid($_REQUEST['device_id']) ):

            //validate fieleds are blank or not
            if ( isEmpty($_REQUEST['container_id']) ):
                $error = true;
                $errorMessages[] = "Please select Container";
            endif;
            if ( isEmpty($_REQUEST['material_code']) ):
                $error = true;
                $errorMessages[] = "Please enter material code";
            endif;
            if ( isEmpty($_REQUEST['material_description']) ):
                $error = true;
                $errorMessages[] = "Please enter materail description";
            endif;
            if ( isEmpty($_REQUEST['net_weight_supplier']) ):
                $error = true;
                $errorMessages[] = "Please enter net weight of supplier ";
            endif;
            if ( isEmpty($_REQUEST['port_of_destination']) ):
                $error = true;
                $errorMessages[] = "Please select port of destination ";
            endif;
            if ( isEmpty($_REQUEST['remarks']) ):
                $error = true;
                $errorMessages[] = "Please enter remarks ";
            endif;                

            //Display error messages 
            if ($errorMessages):
                $errorMessages = implode(",", $errorMessages);
                $response = array('status' => 0, 'msg' => $errorMessages);
            else:    

                    //user id
                    $user_id = empty($_REQUEST['user_id']) ? "" : $_REQUEST['user_id'];                
                    $seal_number = implode(',', $_REQUEST['seal_number']);

                    $arr = array('material_code'=>$_REQUEST['material_code'], 
                                 'material_description'=>$_REQUEST['material_description'],
                                 'material_quality_code'=>$_REQUEST['material_quality_code'],
                                 'net_weight_supplier'=>$_REQUEST['net_weight_supplier'],
                                 'net_weight_yard'=>$_REQUEST['net_weight_yard'],
                                 'port_of_destination'=>$_REQUEST['port_of_destination'],
                                 'seal_number'=>$seal_number,
                                 'remarks'=>$_REQUEST['remarks']
                                );

                    $result = updateqry( $arr, array('id='=>$_REQUEST['container_id']), $table );

                    if ($result):                    
                        $response = array('status' => 1, 'msg' => 'Container updated sucessfully');
                    else:
                        $response = array('status' => 0, 'msg' => 'Container did not updated... Try Again');
                    endif;

            endif;

    else:
            $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif;
        
//Get Materail codes list
elseif($action == 'getMaterailCodes'):
        
    //check user_id for user authentication
    if ( isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "" ):

        if( isDeviceIdValid($_REQUEST['device_id']) ):

            $result = selectqry( '*', TB_MATERIAL_CODE );

            if(mysqli_num_rows($result) > 0):

                while($row = mysqli_fetch_assoc($result)):

                    $arr = array( 'id'=>$row['id'], 'materail_code'=>$row['material_code'] );
                    $rows[] = $arr;

                endwhile;

                $response = array( 'status'=>1, 'msg'=>'Materail codes', 'data'=>$rows );

            else:
                $response = array('status'=>0, 'msg'=>'No codes Found');
            endif;                        

       else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
        endif;

    else: 
        $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif;    

//Get Empty Depot List
elseif($action == 'getEmptyDepotList'):
        
    //check user_id for user authentication
    if ( isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "" ):

        if( isDeviceIdValid($_REQUEST['device_id']) ):

            $result = selectqry('*', TB_EMPTY_DEPOT);

            if(mysqli_num_rows($result) > 0):

                while($row = mysqli_fetch_assoc($result)):

                    $arr = array( 'id'=>$row['id'], 'name'=>$row['name'] );
                    $rows[] = $arr;

                endwhile;

                $response = array( 'status'=>1, 'msg'=>'Empty depot List', 'data'=>$rows );

            else:
                $response = array('status'=>0, 'msg'=>'No Empty depot Found');
            endif;                        

       else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
        endif;

    else: 
        $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif;
    
//Get Container sizes list
elseif($action == 'getSupplierList'):
        
    //check user_id for user authentication
    if ( isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != "" ):

        if( isDeviceIdValid($_REQUEST['device_id']) ):

            $result = selectqry('*', TB_SUPPLIER);

            if(mysqli_num_rows($result) > 0):

                while($row = mysqli_fetch_assoc($result)):

                    $arr = array( 'id'=>$row['id'], 'country_id'=>$row['country_id'], 'supplier_name'=>$row['name'] );
                    $rows[] = $arr;

                endwhile;

                $response = array( 'status'=>1, 'msg'=>'Empty depot List', 'data'=>$rows );

            else:
                $response = array('status'=>0, 'msg'=>'No Empty depot Found');
            endif;                        

       else:
            $response = array('status' => 0, 'msg' => 'Already logged in from other device, you are loged out from previous device.');
        endif;

    else: 
        $response = array('status' => 0, 'msg' => 'Please provide necessary details');
    endif;
    
    
else:
    $response = array('status' => 0, 'msg' => 'Please provide necessary details');
endif;

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);