<html>
    <head>
        <title>API FOR INSPECTORS mobile application</title>
    </head>
    <body>
        <?php include('../includes/script_top.php'); ?>
        <center>
            <h3>API FOR INSPECTORS mobile application</h3>
        </center>
        <table border="1" style="width:100%; margin:0 auto;" cellspacing="1">
            <thead>
                <tr>
                    <th>API Name</th>
                    <th>Method</th>
                    <th>API Url</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Login</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/user.php?action=login&email=email&password=password</td>
                </tr>
                <tr>
                    <td>Logout</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/user.php?action=logout&user_id=user_id&device_id=device_id&email=email&password=password</td>
                </tr>
                <tr>
                    <td>Get Instructor Details</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/user.php?action=getUserDetails&user_id=user_id&device_id=device_id</td>
                </tr>
                <tr>
                    <td>Change Password</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/user.php?action=changePassword&user_id=user_id&device_id=device_id & current_password=current_password &new_password=new_password</td>
                </tr>
                

                <tr>
                    <td>Change Profile Picture</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/user.php?action=uploadUpdateImage&user_id=user_id&device_id=device_id&image=image['file']("jpeg","jpg","gif","png")</td>
                </tr>
                <tr>
                    <td>Forgot Password</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/user.php?action=forgotPassword&email=email</td>
                </tr>
                <tr>
                    <td>Edit Inspector Profile</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/user.php?action=editInspectorProfile &user_id=user_id &device_id=device_id &first_name=first_name &last_name=last_name &phone=phone &location=location &email=email &user_name=user_name</td>
                </tr>
                
                <tr>
                    <td>Get Container Sizes</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/container.php?action=getContainerSizes&user_id=user_id&device_id=device_id</td>
                </tr>
                <tr>
                    <td>Add Container Step-1</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/container.php?action=addContainerStepOne&user_id=user_id&device_id=device_id&empty_container_received=date('Y-m-d')&container_placed_yard=date('Y-m-d')&gross_weight=gross_weight&tare_weight=tare_weight&pay_load=pay_load&empty_depot_name_id=empty_depot_name_id&shipping_line_id=shipping_line_id&supplier_id=supplier_id</td>
                </tr>
                
                
                <tr>
                    <td>Add Container Step-2</td>
                    <td>POST</td>
                    <td><?php echo URL_BASE;?>json/container.php?action=addContainerStepTwo&user_id=user_id&device_id=device_id&container_id=container_id&image_stock_pile=image_stock_pile&image_empty_container=image_empty_container&image_container_loading=image_container_loading&image_container_seal=image_container_seal&image_documents=image_documents</td>
                </tr>
                

                <tr>
                    <td colspan="3"><b>You have to used the specific method described.</b></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>    




















