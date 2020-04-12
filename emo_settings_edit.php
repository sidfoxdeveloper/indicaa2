<?php
include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])) {
    ?>
    <?php
    $pagename = "EMO Country Admin Settings";
    $listpagename = EMO_SETTINGS_EDIT;
    $table = TB_SETTINGS_EMO;
    $created_at = date('Y-m-d H:i:s');
   
    if ($_REQUEST['id']) {
        
        $pagetype = "Edit";
        $data = fetchqry("*", $table, array("id=" => $_REQUEST['id']));
        
        $country_id_port_of_loading = $data['country_id_port_of_loading'];
        $port_of_loading = $data['port_of_loading'];
        $storage_id = $data['storage_id'];
        $terminal_id = $data['terminal_id'];
        $shipping_agent_forwarder = $data['shipping_agent_forwarder'];
        $name_of_transporter = $data['name_of_transporter'];
        $empty_depot_id = $data['empty_depot_id'];
        $yard_id = $data['yard_id'];
        $supplier_id = $data['supplier_id'];
        $inco_terms = $data['inco_terms'];
        $country_manager = $data['country_manager'];
        $inspector = $data['inspector'];
        $bookings = $data['bookings'];
        $created_at = date( 'd F, Y', strtotime($data['created_at']) );        
        
    } else {            
        
        $country_id_port_of_loading = $_REQUEST['country_id_port_of_loading'];
        $port_of_loading = $_REQUEST['port_of_loading'];
        $storage_id = $_REQUEST['storage_id'];
        $terminal_id = $_REQUEST['terminal_id'];
        $shipping_agent_forwarder = $_REQUEST['shipping_agent_forwarder'];
        $name_of_transporter = $_REQUEST['name_of_transporter'];
        $empty_depot_id = $_REQUEST['empty_depot_id'];
        $yard_id = $_REQUEST['yard_id'];
        $supplier_id = $_REQUEST['supplier_id'];
        $inco_terms = $_REQUEST['inco_terms'];
        $country_manager = $_REQUEST['country_manager'];
        $inspector = $_REQUEST['inspector'];
        $bookings = $_REQUEST['bookings'];
        
    }
    if (strpos($_SERVER['REQUEST_URI'], "?true") != 0) {
        
        $temp = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "?true"));
        $backurlfirstpart = substr($temp, strpos($temp, "?true"), strpos($temp, "&id"));
        $temp = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "&id") + 4);
        if (strpos($temp, "&") != 0)
            $backurllastpart = substr($temp, strpos($temp, "&"));
        $gobackurl = $backurlfirstpart . $backurllastpart;
        
    } else {
        $gobackurl = "?true";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <!-- BEGIN HEAD -->
        <head>
            <?php include('includes/head.php'); ?>              
        </head>

        <body class="customer-add-page invoice-list-page ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading"> 
            <!-- remove ks-page-header-fixed to unfix header -->
            <?php include('includes/header.php'); ?>
            <div class="ks-page-container ks-dashboard-tabbed-sidebar-fixed-tabs"> 
                 <?php include('includes/sidebar.php'); ?>
                <div class="ks-column ks-page">
                    <div class="ks-page-header">
                        <section class="ks-title">
                            <h3><?php echo $pagename; ?></h3>
                        </section>
                    </div>

                    <div class="ks-page-content">
                        <div class="ks-page-content-body">
                            <div class="ks-nav-body-wrapper">
                                <div class="container-fluid">                                    
                                    <form action="" name="mainform" id="mainform" method="post" enctype="multipart/form-data" onsubmit="return submitform();">
                                        <div class="row">
                                            <div class="col-lg-12 ks-panels-column-section">
                                                <div class="card">                                                
                                                    <div class="card-block">
                                                        <h5 class="card-title"><?php echo $pagename; ?></h5>
                                                        <div> 
                                                            
                                                            <div class="form-group row">
                                                                <label for="country_id_port_of_loading" class="col-sm-2 form-control-label">Port Of Landing</label>
                                                                <div class="col-sm-3">
                                                                    <div class="input-group">
                                                                        <select name="country_id_port_of_loading" id="country_id_port_of_loading" class="form-control">
                                                                            <option value="">Country</option>
                                                                            <?php
                                                                            $sel_contries = selectqry('*', TB_COUNTRIES, array(), ' name ASC');
                                                                            while ($crow = mysqli_fetch_assoc($sel_contries)):
                                                                                
                                                                                if( $crow['id'] == $country_id_port_of_loading ):
                                                                                    echo '<option value="'.$crow['id'].'" selected >'.$crow['name'].'</option>';
                                                                                else:
                                                                                    echo '<option value="'.$crow['id'].'">'.$crow['name'].'</option>';
                                                                                endif; 
                                                                                
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                        <input type="text" name="port_of_loading" id="port_of_loading" class="form-control" value="<?php echo $port_of_loading; ?>" placeholder="Port Of Loading" > 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="storage_id" class="col-sm-2 form-control-label">Name Of Storage</label>
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                        <select name="storage_id" id="storage_id" class="form-control">
                                                                            <option value="">Select Storage</option>
                                                                            <?php
                                                                            $sel_storages = selectqry('*', TB_STORAGES, array(), ' name ASC');
                                                                            while ($srow = mysqli_fetch_assoc($sel_storages)):
                                                                                
                                                                                if( $srow['id'] == $storage_id ):
                                                                                    echo '<option value="'.$srow['id'].'" selected >'.$srow['name'].'</option>';
                                                                                else:
                                                                                    echo '<option value="'.$srow['id'].'">'.$srow['name'].'</option>';
                                                                                endif; 
                                                                                
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="terminal_id" class="col-sm-2 form-control-label">Name Of Terminal</label>
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                        <select name="terminal_id" id="terminal_id" class="form-control">
                                                                            <option value="">Select Terminal</option>
                                                                            <?php
                                                                            $sel_terminals = selectqry('*', TB_TERMINALS, array(), ' name ASC');
                                                                            while ($trow = mysqli_fetch_assoc($sel_terminals)):
                                                                                
                                                                                if( $trow['id'] == $terminal_id ):
                                                                                    echo '<option value="'.$trow['id'].'" selected >'.$trow['name'].'</option>';
                                                                                else:
                                                                                    echo '<option value="'.$trow['id'].'">'.$trow['name'].'</option>';
                                                                                endif; 
                                                                                
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <button class="btn btn-success right" type="button" onclick="return savennew(0);">Save</button>
                                                                </div>
                                                                <div class="col-sm-6 text-right">
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
            <script>
                function chkrequired() {
                    
                    var chk = new Array();                    
                    chk['s:country_id'] = " Country";
                    chk['t:name'] = " Supplier Name";
                    
                    if (check(chk, 1))
                        document.mainform.submit();
                    
                }
            </script>
        </body>
    </html>
    <?php
    /*     * Check Page Authantication * */
} else {
    include(DIR_BASEADMIN . DIR_INCLUDES . INC_DONTACCESSMSG);
}
?>

<?php
if (isset($_POST['addnew'])) {
    
     if ($_REQUEST['id']) {
         
        $arr = array( "name"=>$_POST['name'], "country_id"=>$_POST['country_id'] );            
        $update = updateqry( $arr, array("id=" => $_REQUEST['id']), $table );        
        
    } else {
        
        $arr = array( "country_id"=>$_POST['country_id'], "name"=>$_POST['name'], "created_at"=>date('Y-m-d h:i:s') );  
        $insert = insertqry($arr, $table);
        $insertedid = getfieldmaxvalue('id', $table); 
        
    }  
    
    $updateid = ($_REQUEST['id']) ? $_REQUEST['id'] : $insertedid;

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