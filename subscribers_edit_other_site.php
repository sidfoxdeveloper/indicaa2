<?php
    include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])) {
    ?>
    <?php
    $pagename = "Subscribers";
    $listpagename = SUBSCRIBERS_LIST;
    $table = TB_SUBSCRIBERS;
    $created_at = date('Y-m-d h:i:s');
    
    if ($_REQUEST['id']) {
        
        $pagetype = "Edit";
        $data = fetchqry("*", $table, array("id="=>$_REQUEST['id']));
        $email = $data['email'];
        $first_name = $data['first_name'];
        $sur_name = $data['sur_name'];
        $address = $data['address'];
        $birth_date  = $data['birth_date'];
        $mobile_number  = $data['mobile_number'];
        $notes  = $data['notes'];        
        
    } else {
        $pagetype = "New";
        $email = $_REQUEST['email'];
        $first_name = $_REQUEST['first_name'];
        $sur_name = $_REQUEST['sur_name'];
        $address = $_REQUEST['address'];
        $birth_date  = $_REQUEST['birth_date'];
        $mobile_number  = $_REQUEST['mobile_number'];
        $notes  = $_REQUEST['notes']; 
    }
    if (strpos($_SERVER['REQUEST_URI'], "?true") != 0) {
        $temp = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "?true"));
        $backurlfirstpart = substr($temp, strpos($temp, "?true"), strpos($temp, "&id"));
        $temp = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "&id") + 4);
        if (strpos($temp, "&") != 0)
            $backurllastpart = substr($temp, strpos($temp, "&"));
        $gobackurl = $backurlfirstpart . $backurllastpart;
    }else {
        $gobackurl = "?true";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <!-- BEGIN HEAD -->
        <head>
            <?php include('includes/head.php'); ?>  
            
            <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>libs/prism/prism.css"> <!-- original -->
            <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>libs/flatpickr/flatpickr.min.css"> <!-- original -->
            <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>assets/styles/libs/flatpickr/flatpickr.min.css"> <!-- customization -->
            <!--  jQuery -->
            <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

            <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
            <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

            <!-- Bootstrap Date-Picker Plugin -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
            
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
                                                                <label for="first_name" class="col-sm-2 form-control-label">First Name</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">                                                               
                                                                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $first_name; ?>" /> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="sur_name" class="col-sm-2 form-control-label">Surname</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">                                                               
                                                                        <input type="text" name="sur_name" id="sur_name" class="form-control" value="<?php echo $sur_name; ?>" /> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="email" class="col-sm-2 form-control-label">Email</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">                                                               
                                                                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>" /> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="birth_date" class="col-sm-2 form-control-label">Birthdate</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">  
                                                                        <?php
                                                                            if(isEmpty($birth_date)){
                                                                                $birth_date = date('Y-m-d');
                                                                            }
                                                                            $o_birth_date = new DateTime($birth_date);
                                                                        ?>
                                                                        <input type="text" class="form-control calendar" name="birth_date" id="birth_date" data-enable-time="false" data-no-calendar="false" value="<?php echo $o_birth_date->format('Y-m-d'); ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="mobile_number" class="col-sm-2 form-control-label">Mobile Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">                                                               
                                                                        <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="<?php echo $mobile_number; ?>" /> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="address" class="col-sm-2 form-control-label">Address</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group"> 
                                                                        <textarea id="address" name="address"><?php echo $address; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                            
                                                            <div class="form-group row">
                                                                <label for="notes" class="col-sm-2 form-control-label">Notes</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group"> 
                                                                        <textarea id="notes" name="notes"><?php echo $notes; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <button class="btn btn-success right" type="button" onclick="return savennew(0);" id="save_data" style="text-align:center;">Save</button>
                                                                </div>
                                                                <div class="col-sm-4" style="text-align: center;"></div>
                                                                <div class="col-sm-4 text-right">
                                                                    <a class="btn btn-danger right" href="<?php echo URL_BASEADMIN . $listpagename . $gobackurl; ?>">Back</a>
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
            <script src="<?php echo URL_BASEADMIN; ?>libs/flatpickr/flatpickr.min.js"></script>
            <script src="<?php echo URL_BASEADMIN; ?>libs/prism/prism.js"></script>
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
        chk['t:email'] = "email";
        if (check(chk, 1))
            document.mainform.submit();
        
    }

    CKEDITOR.replace('address', {toolbar: 'Basic', height: 150});
    CKEDITOR.replace('notes', {toolbar: 'Basic', height: 150});
    
    //Date and Time Picker  
    $(".calendar").flatpickr();
    
    
</script>
<?php
if (isset($_POST['addnew'])) {
                        
        $arr = array("email"=>$_POST['email'], "first_name"=>$_POST['first_name'],"sur_name"=>$_POST['sur_name'], "address"=>trim($_POST['address']), 
                "birth_date"=>$_POST['birth_date'], "mobile_number"=>$_POST['mobile_number'], "notes"=>$_POST['notes'], "created_at"=>$created_at );                
  
        if ($_REQUEST['id']) {                           

            $update = updateqry($arr, array("id=" => $_REQUEST['id']), $table);
        } else {

                $insert = insertqry($arr, $table);
                $insertedid = getfieldmaxvalue('id', $table);
                  
        }

        $updateid = ($_REQUEST['id']) ? $_REQUEST['id'] : $insertedid;
 
        if ($update || $insert){
                      $_SESSION['msg'] = 'Action performed successfully.|alert-success';
        }    
        else{
                $_SESSION['msg'] = 'Action not performed successfully.|alert-error';
        }    
    
        if ($_POST['addnew'] == 1)
            header("Location:" . $_SERVER['PHP_SELF'] . $gobackurl . '&id=' . $updateid);
        else if ($_POST['addnew'] == 2)
            header("Location:" . $_SERVER['PHP_SELF']);
        else
            header("Location:" . $listpagename . $gobackurl);
}
?>
