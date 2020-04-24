<?php
include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])) { ?>
    <?php
    $pagename = "Container";
    $editpagename = EMO_CONTAINER_ONE_EDIT;
    $listpagename = EMO_CONTAINER_TWO_EDIT.'?true&id='.$_REQUEST['id'];
    $table = TB_CONTAINERS;
    $created_at = date('Y-m-d H:i:s');
    
    if ($_REQUEST['id']) {
        
        $pagetype = "Edit";
        $data = fetchqry("*", $table, array("id=" => $_REQUEST['id']));
       
        $container_id = $_REQUEST['id'];
        $country_id = $data['country_id'];
        $company_id = $data['company_id'];
        $yard_id = $data['yard_id'];
        $empty_container_received = $data['empty_container_received'];
        $container_placed_yard = $data['container_placed_yard'];
        $container_number = $data['container_number'];
        $container_size_id = $data['container_size_id'];
        $branch_code_id = $data['branch_code_id'];
        $shipping_agent_id = $data['shipping_agent_id'];
        $tare_weight = $data['tare_weight'];
        $gross_weight = $data['gross_weight'];
        //$net_weight = $data['net_weight'];
        $net_weight_supplier = $data['net_weight_supplier'];
        $net_weight_yard = $data['net_weight_yard'];
        $pay_load = $data['pay_load'];
        $empty_depot_name_id = $data['empty_depot_name_id'];
        $material_code_id = $data['material_code_id'];
        $material_description = $data['material_description'];
        $material_quality_code = $data['material_quality_code'];
        $shipping_line_id = $data['shipping_line_id'];
        $supplier_id = $data['supplier_id'];
        $seal_number_id = $data['seal_number_id'];
                
        $created_at = date( 'd F, Y', strtotime($data['created_at']) );
        
    } else {
        
        $container_id = $_REQUEST['id'];
        $country_id = $_POST['country_id'];
        $company_id = $_POST['company_id'];
        $yard_id = $_POST['yard_id'];
        $empty_container_received = $_POST['empty_container_received'];
        $container_placed_yard = $_POST['container_placed_yard'];
        $container_number = $_POST['container_number'];
        $container_size_id = $_POST['container_size_id'];
        $branch_code_id = $_POST['branch_code_id'];
        $shipping_agent_id = $_POST['shipping_agent_id'];
        $tare_weight = $_POST['tare_weight'];
        $gross_weight = $_POST['gross_weight'];
        //$net_weight = $_POST['net_weight'];
        $net_weight_supplier = $_POST['net_weight_supplier'];
        $net_weight_yard = $_POST['net_weight_yard'];
        $pay_load = $_POST['pay_load'];
        $empty_depot_name_id = $_POST['empty_depot_name_id'];
        $material_code_id = $_POST['material_code_id'];
        $material_description = $_POST['material_description'];
        $material_quality_code = $_POST['material_quality_code'];
        $shipping_line_id = $_POST['shipping_line_id'];
        $supplier_id = $_POST['supplier_id'];
        $seal_number_id = $_POST['seal_number_id'];
        
    }
    
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
            <style>
                tr > :first-child{
                    width: 25%;
                }
                .dark{
                    background-color:#efefef !important;
                }
            </style>
            
            <link rel="stylesheet" href="<?php echo URL_BASEADMIN; ?>dropzone/dropzone.css" type="text/css" />
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
        <body class="customer-add-page invoice-list-page ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading"> 
            <!-- remove ks-page-header-fixed to unfix header -->
            <?php include('includes/header.php'); ?>
            <div class="ks-page-container ks-dashboard-tabbed-sidebar-fixed-tabs"> 
                 <?php include('includes/sidebar.php'); ?>
                <div class="ks-column ks-page">
                    <div class="ks-page-header">
                        <section class="ks-title">
                            <h3>
                                <?php //echo $pagetype . ' ' . $pagename; ?>
                                VERIFY CONTAINER &nbsp;&nbsp;&nbsp;#<?php echo $container_number;?>
                            </h3>
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
                                                        
                                                        <div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label"></label>
                                                                <div class="col-sm-4 text-center">
                                                                    <strong>By Country Manager</strong>
                                                                </div>
                                                                <div class="col-sm-4 text-center">
                                                                    <strong>By EMO</strong>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Company Name:</label>
                                                                <div class="col-sm-4">
                                                                    <div class="form-control dark">
                                                                        <?php
                                                                        $sel_company = fetchqry( '*', TB_COMPANIES, array('id='=>$company_id) );
                                                                        echo $sel_company['name'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <select name="company_id" id="company_id" class="form-control">
                                                                        <option>Select Company</option>
                                                                        <?php
                                                                        $company = selectqry( '*', TB_COMPANIES );
                                                                        while( $row = mysqli_fetch_assoc($company) ):
                                                                            if($row['id'] == $company_id):
                                                                                $selected = "selected";
                                                                            else:
                                                                                $selected = "";
                                                                            endif;
                                                                            echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].'</option>';
                                                                        endwhile;
                                                                        ?>
                                                                    </select>
                                                                </div>    
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Country / Origin:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $sel_company = fetchqry( '*', TB_COUNTRIES, array('id='=>$country_id) );
                                                                            echo '<option value="'.$sel_company['id'].'" >'.$sel_company['name'].'</option>';
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <?php
                                                                        $sel_contries = selectqry('*', TB_COUNTRIES, array(), " `name` ASC ");
                                                                        ?>
                                                                        <select name="country_id" id="country_id" class="form-control">
                                                                            <option>Select Inspector Country</option>
                                                                            <?php
                                                                            while( $row = mysqli_fetch_assoc($sel_contries) ):
                                                                                if($row['id'] == $country_id):
                                                                                    $selected = "selected";
                                                                                else:
                                                                                    $selected = "";
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>    
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Empty Container Received Date:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($empty_container_received) ); ?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="empty_container_received" id="empty_container_received" class="calendar form-control" > 
                                                                    </div>    
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Container Placed in The Yard - Date:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($container_placed_yard) ); ?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="container_placed_yard" id="container_placed_yard" class="calendar form-control" > 
                                                                    </div>    
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Name of Yard &nbsp;(Loading Site):</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $yards = fetchqry('*', TB_YARDS, array('id='=>$yard_id), " `name` ASC ");
                                                                            echo $yards['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="yard_id" id="yard_id" class="form-control">
                                                                            <option>Select Yard</option>
                                                                            <?php
                                                                            $sel_yards = selectqry('*', TB_YARDS, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($sel_yards) ):
                                                                                if($row['id'] == $yard_id):
                                                                                    $selected = "selected";
                                                                                else:
                                                                                    $selected = "";
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="container_number" class="col-sm-3 form-control-label">Container Number:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $container_number; ?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="container_number" id="container_number" class="form-control" > 
                                                                    </div>    
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="container_size" class="col-sm-3 form-control-label">Container Size:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $container_size = fetchqry('*', TB_CONTAINER_SIZE, array('id='=>$container_size_id), " `name` ASC ");
                                                                            echo $container_size['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="container_size_id" id="container_size_id" class="form-control">
                                                                            <option>Select Container Size</option>
                                                                            <?php
                                                                            $sel = selectqry('*', TB_CONTAINER_SIZE, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($sel) ):
                                                                                if($row['id'] == $container_size_id):
                                                                                    $selected = "selected";
                                                                                else:
                                                                                    $selected = "";
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>    
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="tare_weight" class="col-sm-3 form-control-label">Tare Weight (MT):</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $tare_weight;?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="tare_weight" id="tare_weight" class="form-control" > 
                                                                    </div>   
                                                                </div>
                                                                                                                
                                                                <div class="form-group row">
                                                                    <label for="net_weight_supplier" class="col-sm-3 form-control-label">Net Weight(MT) - Supplier:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $net_weight_supplier;?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="net_weight_supplier" id="net_weight_supplier" class="form-control" >
                                                                    </div>   
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="net_weight_yard" class="col-sm-3 form-control-label">Net Weight (MT) - Yard: </label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $net_weight_yard;?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="net_weight_yard" id="net_weight_yard" class="form-control" >
                                                                    </div>   
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="pay_load" class="col-sm-3 form-control-label">Pay Load (MT):</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $pay_load;?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="pay_load" id="pay_load" class="form-control" >
                                                                    </div>   
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Empty Depot Name</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $ed = fetchqry('*', TB_EMPTY_DEPOT, array('id='=>$empty_depot_name_id), " `name` ASC ");
                                                                            echo $ed['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="empty_depot_name_id" id="empty_depot_name_id" class="form-control">
                                                                            <option>Select Empty Depot</option>
                                                                            <?php
                                                                            $sel_ed = selectqry('*', TB_EMPTY_DEPOT, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($sel_ed) ):
                                                                                if($row['id'] == $empty_depot_name_id):
                                                                                    $selected = "selected";
                                                                                else:
                                                                                    $selected = "";
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Material Code</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $ed = fetchqry('*', TB_MATERIAL_CODE, array('id='=>$material_code_id), " `material_code` ASC ");
                                                                            echo $ed['material_code'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="material_code_id" id="material_code_id" class="form-control">
                                                                            <option>Select Material Code</option>
                                                                            <?php
                                                                            $sel_ed = selectqry('*', TB_MATERIAL_CODE, array(), " `material_code` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($sel_ed) ):
                                                                                if($row['id'] == $material_code_id):
                                                                                    $selected = "selected";
                                                                                else:
                                                                                    $selected = "";
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['material_code'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="material_description" class="col-sm-3 form-control-label">Material Description</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $material_description;?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <textarea id="material_description" name="material_description" class="form-control" rows="3"><?php echo $material_description; ?></textarea>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="material_quality_code" class="col-sm-3 form-control-label">Material Quality Code</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $material_quality_code;?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="material_quality_code" id="material_quality_code" class="form-control" />
                                                                    </div>   
                                                                </div>
                                                                
                                                                <div class="form-group row">
                                                                    <label for="shipping_line_id" class="col-sm-3 form-control-label">Shipping Line</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $shipping_line = fetchqry('*', TB_SHIPPING_LINE, array('id='=>$shipping_line_id) );
                                                                            echo $shipping_line['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="shipping_line_id" id="shipping_line_id" class="form-control">
                                                                            <option>Select Shipping Line</option>
                                                                            <?php
                                                                            $shipping = selectqry('*', TB_SHIPPING_LINE, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($shipping) ):
                                                                                if($row['id'] == $shipping_line_id):
                                                                                    $selected = "selected";
                                                                                else:
                                                                                    $selected = "";
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="supplier_id" class="col-sm-3 form-control-label">Supplier</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $supplier = fetchqry('*', TB_SUPPLIER, array('id='=>$supplier_id) );
                                                                            echo $supplier['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="supplier_id" id="supplier_id" class="form-control">
                                                                            <option>Select Supplier</option>
                                                                            <?php
                                                                            $supplier = selectqry('*', TB_SUPPLIER, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($supplier) ):
                                                                                if($row['id'] == $supplier_id):
                                                                                    $selected = "selected";
                                                                                else: 
                                                                                    $selected = "";
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="seal_number_id" class="col-sm-3 form-control-label">Seal Number</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $s_number = fetchqry('*', TB_SEAL_NUMBERS, array('id='=>$seal_number_id) );
                                                                            echo $s_number['seal_number'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="seal_number_id[]" id="seal_number_id" class="form-control">
                                                                            <option>Select Seal Number</option>
                                                                            <?php
                                                                            $seal = selectqry('*', TB_SEAL_NUMBERS, array(), " `seal_number` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($seal) ):
                                                                                if($row['id'] == $seal_number_id):
                                                                                    $selected = "selected";
                                                                                else:
                                                                                    $selected = "";
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['seal_number'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <a class="btn btn-success right" href="<?php echo URL_BASEADMIN . EMO_CONTAINER_LIST; ?>">Back</a>
                                                                    </div>
                                                                    <div class="col-sm-6 text-right">
                                                                        <button class="btn btn-danger right" type="button" onclick="return savennew(0);">
                                                                            Next 
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                        
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="addnew" id="addnew" value="0" />
                                                <input type="submit" style="display:none" name="hidesubmit" />                                
                                            
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php include('includes/script_bottom.php'); ?>
            <script type="text/javascript" src="<?php echo URL_BASEADMIN; ?>dropzone/dropzone.js"></script>
            <script src="<?php echo URL_BASEADMIN; ?>libs/flatpickr/flatpickr.min.js"></script>
            <script src="<?php echo URL_BASEADMIN; ?>libs/prism/prism.js"></script>
            <script> 
                function chkrequired() {
                    var chk = new Array();
                    if (check(chk, 1))
                        document.mainform.submit();
                }
                
                CKEDITOR.replace( 'material_description', {toolbar: 'Basic', height: 180} );
                
                //Date and Time Picker  
                $(".calendar").flatpickr();                                
            </script>
            
            
        </body>
    </html>
    <?php
    /** Check Page Authantication **/
} else {
    include(DIR_BASEADMIN . DIR_INCLUDES . INC_DONTACCESSMSG);
}
    
if (isset($_POST['addnew'])) {
    
    if ($_REQUEST['id']) {
      
        $arr =  array();
        
        if( !isEmpty($_POST['company_id']) ):
                $arr['company_id'] = $_POST['company_id'];
        endif;        
        if( !isEmpty($_POST['country_id']) ):
                $arr['country_id'] = $_POST['country_id'];
        endif;        
        if( !isEmpty($_POST['empty_container_received']) ):
                $arr['empty_container_received'] = $_POST['empty_container_received'];   
        endif;
        if( !isEmpty($_POST['container_placed_yard']) ):
                $arr['container_placed_yard'] = $_POST['container_placed_yard'];
        endif;
        if( !isEmpty($_POST['yard_id']) ):
                $arr['yard_id'] = $_POST['yard_id'];
        endif;
        if( !isEmpty($_POST['container_number']) ):
                $arr['container_number'] = $_POST['container_number'];
        endif;
        if( !isEmpty($_POST['container_size']) ):
                $arr['container_size'] = $_POST['container_size'];
        endif;
        if( !isEmpty($_POST['tare_weight']) ):
                $arr['tare_weight'] = $_POST['tare_weight'];
        endif;
        if( !isEmpty($_POST['net_weight_yard']) ):
                $arr['net_weight_yard'] = $_POST['net_weight_yard'];
        endif;
        if( !isEmpty($_POST['net_weight_supplier']) ):
                $arr['net_weight_supplier'] = $_POST['net_weight_supplier'];
        endif;
        if( !isEmpty($_POST['pay_load']) ):
                $arr['pay_load'] = $_POST['pay_load'];
        endif;
        if( !isEmpty($_POST['empty_depot_name_id']) ):
                $arr['empty_depot_name_id'] = $_POST['empty_depot_name_id'];
        endif;
        if( !isEmpty($_POST['material_code_id']) ):
                $arr['material_code_id'] = $_POST['material_code_id'];
        endif;
        if( !isEmpty($_POST['material_description']) ):
                $arr['material_description'] = replacequoteb($_POST['material_description']);
        endif;
        if( !isEmpty($_POST['material_quality_code']) ):
                $arr['material_quality_code'] = $_POST['material_quality_code'];
        endif;
        if( !isEmpty($_POST['shipping_line_id']) ):
                $arr['shipping_line_id'] = $_POST['shipping_line_id'];
        endif;
        if( !isEmpty($_POST['supplier_id']) ):
                $arr['supplier_id'] = $_POST['supplier_id'];
        endif;
        if( !isEmpty($_POST['seal_number_id']) ):
                $sn = implode(',', $_POST['seal_number_id']);
                $arr['seal_number_id'] = $sn;
        endif;
        if( !isEmpty($_POST['exchange_rate']) ):
                //$temp = implode(',', $_POST['exchange_rate']);
                //$arr['exchange_rate'] = $temp;
                $arr['exchange_rate'] = $_POST['exchange_rate'];
        endif;
        if( !isEmpty($_POST['branch_code_id']) ):
                $arr['branch_code_id'] = $_POST['branch_code_id'];
        endif;        
        if( !isEmpty($_POST['shipping_agent_id']) ):
                $arr['shipping_agent_id'] = $_POST['shipping_agent_id'];
        endif;
        if( !isEmpty($_POST['transporter']) ):
                $arr['transporter'] = $_POST['transporter'];
        endif;
        if( !isEmpty($_POST['shipped_to_storage']) ):
                $arr['shipped_to_storage'] = $_POST['shipped_to_storage'];
        endif;
        if( !isEmpty($_POST['storage']) ):
                $arr['storage'] = $_POST['storage'];
        endif;
        if( !isEmpty($_POST['shifted_to_terminal']) ):
                $arr['shifted_to_terminal'] = $_POST['shifted_to_terminal'];
        endif;
        if( !isEmpty($_POST['terminal']) ):
                $arr['terminal'] = $_POST['terminal'];
        endif;
        if( !isEmpty($_POST['shifted_to_port']) ):
                $arr['shifted_to_port'] = $_POST['shifted_to_port'];
        endif;
        if( !isEmpty($_POST['port_of_loading']) ):
                $arr['port_of_loading'] = $_POST['port_of_loading'];
        endif;
        if( !isEmpty($_POST['grn_number']) ):
                $arr['grn_number'] = $_POST['grn_number'];
        endif;
        if( !isEmpty($_POST['grn_date']) ):
                $arr['grn_date'] = $_POST['grn_date'];
        endif;
        if( !isEmpty($_POST['base_port_used_for_freight_costing']) ):
                $arr['base_port_used_for_freight_costing'] = $_POST['base_port_used_for_freight_costing'];
        endif;
        if( !isEmpty($_POST['ls_number']) ):
                $arr['ls_number'] = $_POST['ls_number'];
        endif;
        if( !isEmpty($_POST['vo_number']) ):
                $arr['vo_number'] = $_POST['vo_number'];
        endif;
        if( !isEmpty($_POST['status']) ):
                $arr['status'] = $_POST['status'];
        endif;
                
        if( count($arr) > 0 ):
            $update = updateqry($arr, array("id=" => $_REQUEST['id']), $table);
        endif;
        
                       
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