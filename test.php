<?php
include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$user['id']) || ($permission['edit'] && $user['id'])) {
    
    $pagename = "EMO Settings";
    $listpagename = EMO_SETTINGS_EDIT;
    $table = TB_USERS;

    $pagetype = "Edit";
    $data = fetchqry("*", $table, array("id=" => $user['id']));
    
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $phone = $data['phone'];
    $address = $data['address'];
    $image = $data['image'];
    $email = $data['email'];
    
    if (strpos($_SERVER['REQUEST_URI'], "?true") != 0) {
        $temp = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "?true"));
        $backurlfirstpart = substr($temp, strpos($temp, "?true"), strpos($temp, "&id"));
        $temp = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "&id") + 4);
        if (strpos($temp, "&") != 0)
            $backurllastpart = substr($temp, strpos($temp, "&"));
        $gobackurl = $backurlfirstpart . $backurllastpart;
    }
    else {
        $gobackurl = "?true";
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <!-- BEGIN HEAD -->
        <head>
            <?php include('includes/head.php'); ?>  
        </head>

        <body class="customer-add-page invoice-list-page ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading"> <!-- remove ks-page-header-fixed to unfix header -->
            <?php include('includes/header.php'); ?>
            <div class="ks-page-container ks-dashboard-tabbed-sidebar-fixed-tabs"> 
             <?php include('includes/sidebar.php'); ?>
                <div class="ks-column ks-page">
                    <div class="ks-page-header">
                        <section class="ks-title">
                            <h3><?php echo $pagetype . ' ' . $pagename; ?></h3>
                        </section>
                    </div>    
                    <div class="ks-page-content">
                        <div class="ks-page-content-body">
                            <div class="ks-nav-body-wrapper">
                                <div class="container-fluid">
                                    <form action="" name="mainform" id="mainform" method="post" enctype="multipart/form-data" onsubmit="return submitform();">
                                        <div class="row">
                                            <div class="col-lg-10 ks-panels-column-section">
                                                <div class="card">                                                
                                                    <div class="card-block">
                                                        <h5 class="card-title"><?php echo $pagename; ?></h5>
                                                        <div>
                                                           
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-2 form-control-label">First Name</label>
                                                                <div class="col-sm-3">
                                                                    <div class="input-group">                                                               
                                                                        <input type="text" id="first_name" name="first_name"  class="form-control" value="<?php echo $first_name; ?>" placeholder="First">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="input-group">                                                               
                                                                        <input type="text" id="last_name" name="last_name"  class="form-control" value="<?php echo $last_name; ?>" placeholder="Last">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="phone" class="col-sm-2 form-control-label">Phone</label>
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">                                                               
                                                                        <input type="text" id="phone" name="phone"  class="form-control" value="<?php echo $phone; ?>" placeholder="Phone">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Thumbnail-image upload -->
                                                            <div class="form-group row">
                                                                <label for="imagetrigger" class="col-sm-2 form-control-label">Profile Pic</label>
                                                                <div class="col-sm-3">
                                                                    <div class="input-group file-group">
                                                                        <button id="imagetrigger" class="btn btn-primary" type="button">
                                                                            <span class="la la-cloud-upload ks-icon"></span>
                                                                            <span class="ks-text">Choose file</span>                                                                    
                                                                        </button>         
                                                                        <span id="imagefilename" class="filepath"></span>                        
                                                                        <input type="file" name="image" id="image" value="" accept="image/*" style="display:none;" />
                                                                        <input type="hidden" name="himage" id="himage" value="<?php echo $image; ?>" />
                                                                    </div>
                                                                    <div class="input-group"><small>(Size: W 730px X  H 486px)</small></div>
                                                                </div>
                                                                <?php if( !empty($image) ){ ?>
                                                                        <div class="col-sm-5">
                                                                            <img src="<?php echo URL_BASE.DIR_UPLOADS.$image; ?>" width="100" />
                                                                        </div>
                                                                <?php }?> 
                                                            </div>
                                                                                                              
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <button class="btn btn-success right" type="button" onclick="return savennew(0);">Save</button>
                                                                </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <a class="btn btn-danger right" href="<?php echo URL_BASEADMIN . EMO_HOME; ?>">Back</a>
                                                                </div> 
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>                                        
                                                <input type="hidden" name="addnew" id="addnew" value="0" />
                                                <input type="submit" style="display:none" name="hidesubmit" />                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    <?php include('includes/script_bottom.php'); ?>
        </body>
    </html>
    <?php
    /*     * Check Page Authantication * */
} else {
    include(DIR_BASEADMIN . DIR_INCLUDES . INC_DONTACCESSMSG);
}
?>
<script type="text/javascript">
    function chkrequired() {
        var chk = new Array();
                chk['t:first_name'] = "first Name.";
                //chk['s:users_groups_id'] = "User Group.";
                //chk['e:email'] = "E-mail.";
                //chk['t:existemail:email'] = "Another E-mail.";
                //chk['p:password'] = "Password.";
        if (check(chk, 1))
            document.mainform.submit();
    }
    $('#imagetrigger').click(function (e) {
        $('#image').trigger('click');
    });    
    $('#image').on('change', function () {
        $('#imagefilename').html($(this).val());
    });
</script>
<?php
if (isset($_POST['addnew'])) {
    
     /** Check Unique Fields * */
     /*
        $checkduplicate = getrows('*', $table, array("email=" => $_POST['email'], "id!=" => $user['id']));
        if ($checkduplicate > 0) {
            $_SESSION['msg'] = 'Email already exist please use another Email.';
            header("Location:" . $_SERVER['REQUEST_URI']);
            exit();
        }
    */
    
    $image = uploadfile("image", $image, array("jpeg", "jpg", "gif", "png")); 

    $arr = array( "first_name"=>$_POST['first_name'], "last_name"=>$_POST['last_name'], "image"=>$image, "phone"=>$_POST['phone'] );
    
    if ($user['id']) {
        
        $update = updateqry( $arr, array("id=" => $user['id']), $table );
        
        if ($update) {
            updateqry(array("rootwaysusername" => encode($_POST['email'])), array("rootwaysusername=" => $_SESSION['rootwaysusername']), TB_USERS_LOGINS);
            $_SESSION['rootwaysusername'] = encode($_POST['email']);
        }
    
    } 

    $updateid = ($user['id']) ? $user['id'] : $insertedid;

    if ($update || $insert)
        $_SESSION['msg'] = 'Action performed successfully.|alert-success';
    else
        $_SESSION['msg'] = 'Action not performed successfully.|alert-error';

    if ($_POST['addnew'] == 1)
        header("Location:" . $_SERVER['PHP_SELF'] . $gobackurl . '&id=' . $updateid);
    else if ($_POST['addnew'] == 2)
        header("Location:" . $_SERVER['PHP_SELF']);
    else
        header("Location:" . $listpagename . $gobackurl);
}
?>