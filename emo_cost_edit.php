<?php
include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])) {
    ?>
    <?php
    $pagename = "Cost";
    $listpagename = EMO_COST_LIST;
    $table = TB_COST;
    $created_at = date('Y-m-d H:i:s');
   
    if ($_REQUEST['id']) {
        
        $pagetype = "Edit";
        $data = fetchqry("*", $table, array("id=" => $_REQUEST['id']));
        
        $country_id = $data['country_id'];
        $ex_yard_price_1 = $data['ex_yard_price_1'];
        $currency_id_1 = $data['currency_id_1'];
        $ex_yard_price_2 = $data['ex_yard_price_2'];
        $currency_id_2 = $data['currency_id_2'];
        $ex_yard_price_3 = $data['ex_yard_price_3'];
        $currency_id_3 = $data['currency_id_3'];
        $fobing_cost = $data['fobing_cost'];
        $currency_id_4 = $data['currency_id_4'];
        $status = $data['status'];
        $created_at = date( 'd F, Y', strtotime($data['created_at']) );        
        
    } else {            
        $country_id = $_REQUEST['country_id'];
        $ex_yard_price_1 = $_REQUEST['ex_yard_price_1'];
        $currency_id_1 = $_REQUEST['currency_id_1'];
        $ex_yard_price_2 = $_REQUEST['ex_yard_price_2'];
        $currency_id_2 = $_REQUEST['currency_id_2'];
        $ex_yard_price_3 = $_REQUEST['ex_yard_price_3'];
        $currency_id_3 = $_REQUEST['currency_id_3'];
        $fobing_cost = $_REQUEST['fobing_cost'];
        $currency_id_4 = $_REQUEST['currency_id_4'];
        $status = $_REQUEST['status'];
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
                                                                <label for="country_id" class="col-sm-2 form-control-label">Select Country</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <select name="country_id" id="country_id" class="form-control">
                                                                            <option value="">Select The Country</option>
                                                                            <?php
                                                                            $sel_contries = selectqry('*', TB_COUNTRIES);
                                                                            while ($crow = mysqli_fetch_assoc($sel_contries)):
                                                                                
                                                                                $selected = "";
                                                                                if( $crow['id'] == $country_id ):
                                                                                    $selected = "selected";
                                                                                endif; 
                                                                                echo '<option value="'.$crow['id'].'" '.$selected.' >'.$crow['name'].'</option>';
                                                                                
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-2 form-control-label">Status</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">                         
                                                                        <select name="status" id="status" class="form-control">
                                                                            <option>Select Status</option>
                                                                            <option <?php if($status == 'verified'){ echo 'selected'; } ?> value="verified">Verified</option>
                                                                            <option <?php if($status == 'unverified'){ echo 'selected'; } ?> value="unverified">Unverified</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="ex_yard_price_1" class="col-sm-2 form-control-label">EX YARD PRICE</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group">                         
                                                                        <input type="text" name="ex_yard_price_1" id="ex_yard_price_1" class="form-control" value="<?php echo $ex_yard_price_1; ?>" > 
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group">                         
                                                                        <select name="currency_id_1" id="currency_id_1" class="form-control">
                                                                            <option value="">Select Currency</option>
                                                                            <?php
                                                                            $sel_currency = selectqry('*', TB_CURRENCY);
                                                                            while ($row = mysqli_fetch_assoc($sel_currency)):

                                                                                if( $row['id'] == $currency_id_1 ):
                                                                                    echo '<option value="'.$row['id'].'" selected >'.$row['name']. '(' .$row['symbol'] .')'. '</option>';
                                                                                else:
                                                                                    echo '<option value="'.$row['id'].'">'.$row['name']. '(' .$row['symbol'] .')'. '</option>';
                                                                                endif; 

                                                                            endwhile;
                                                                            ?>
                                                                        </select>    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="ex_yard_price_2" class="col-sm-2 form-control-label">EX YARD PRICE</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group">                         
                                                                        <input type="text" name="ex_yard_price_2" id="ex_yard_price_2" class="form-control" value="<?php echo $ex_yard_price_2; ?>" > 
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group">                         
                                                                        <select name="currency_id_2" id="currency_id_2" class="form-control">
                                                                            <option value="">Select Currency</option>
                                                                            <?php
                                                                            $sel_currency = selectqry('*', TB_CURRENCY);
                                                                            while ($row = mysqli_fetch_assoc($sel_currency)):

                                                                                if( $row['id'] == $currency_id_2 ):
                                                                                    echo '<option value="'.$row['id'].'" selected >'.$row['name']. '(' .$row['symbol'] .')'. '</option>';
                                                                                else:
                                                                                    echo '<option value="'.$row['id'].'">'.$row['name']. '(' .$row['symbol'] .')'. '</option>';
                                                                                endif; 

                                                                            endwhile;
                                                                            ?>
                                                                        </select>    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="ex_yard_price_3" class="col-sm-2 form-control-label">EX YARD PRICE</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group">                         
                                                                        <input type="text" name="ex_yard_price_3" id="ex_yard_price_3" class="form-control" value="<?php echo $ex_yard_price_3; ?>" > 
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group">                         
                                                                        <select name="currency_id_3" id="currency_id_3" class="form-control">
                                                                            <option value="">Select Currency</option>
                                                                            <?php
                                                                            $sel_currency = selectqry('*', TB_CURRENCY);
                                                                            while ($row = mysqli_fetch_assoc($sel_currency)):

                                                                                if( $row['id'] == $currency_id_3 ):
                                                                                    echo '<option value="'.$row['id'].'" selected >'.$row['name']. '(' .$row['symbol'] .')'. '</option>';
                                                                                else:
                                                                                    echo '<option value="'.$row['id'].'">'.$row['name']. '(' .$row['symbol'] .')'. '</option>';
                                                                                endif; 

                                                                            endwhile;
                                                                            ?>
                                                                        </select>    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="fobing_cost" class="col-sm-2 form-control-label">FOBING COST</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group">                         
                                                                        <input type="text" name="fobing_cost" id="fobing_cost" class="form-control" value="<?php echo $fobing_cost; ?>" > 
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group">                         
                                                                        <select name="currency_id_4" id="currency_id_4" class="form-control">
                                                                            <option value="">Select Currency</option>
                                                                            <?php
                                                                            $sel_currency = selectqry('*', TB_CURRENCY);
                                                                            while ($row = mysqli_fetch_assoc($sel_currency)):

                                                                                if( $row['id'] == $currency_id_4 ):
                                                                                    echo '<option value="'.$row['id'].'" selected >'.$row['name']. '(' .$row['symbol'] .')'. '</option>';
                                                                                else:
                                                                                    echo '<option value="'.$row['id'].'">'.$row['name']. '(' .$row['symbol'] .')'. '</option>';
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
                    chk['s:status'] = " Status";
                    
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
         
        $arr = array( "country_id"=>$_POST['country_id'], 
                    "ex_yard_price_1"=>$_POST['ex_yard_price_1'], "currency_id_1"=>$_POST['currency_id_1'], 
                    "ex_yard_price_2"=>$_POST['ex_yard_price_2'], "currency_id_2"=>$_POST['currency_id_2'],
                    "ex_yard_price_3"=>$_POST['ex_yard_price_3'], "currency_id_3"=>$_POST['currency_id_3'], 
                    "fobing_cost"=>$_POST['fobing_cost'], "currency_id_4"=>$_POST['currency_id_4'], 
                    "status"=>$_POST['status']
                );            
        $update = updateqry( $arr, array("id=" => $_REQUEST['id']), $table );        
        
    } else {
        
        $arr = array( "country_id"=>$_POST['country_id'], 
                    "ex_yard_price_1"=>$_POST['ex_yard_price_1'], "currency_id_1"=>$_POST['currency_id_1'], 
                    "ex_yard_price_2"=>$_POST['ex_yard_price_2'], "currency_id_2"=>$_POST['currency_id_2'],
                    "ex_yard_price_3"=>$_POST['ex_yard_price_3'], "currency_id_3"=>$_POST['currency_id_3'], 
                    "fobing_cost"=>$_POST['fobing_cost'], "currency_id_4"=>$_POST['currency_id_4'], 
                    "status"=>$_POST['status'], "created_at"=>date('Y-m-d h:i:s')
                );
        
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