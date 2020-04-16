<?php
include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])) { ?>
    <?php
    $pagename = "Container";
    $editpagename = EMO_CONTAINER_EDIT;
    $listpagename = EMO_CONTAINER_LIST;
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
        $net_weight = $data['net_weight'];
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
        $exchange_rate= $data['exchange_rate'];
        $transporter = $data['transporter'];
        $shipped_to_storage = $data['shipped_to_storage'];
        $storage = $data['storage'];
        $shifted_to_terminal = $data['shifted_to_terminal'];
        $shipped_to_terminal = $data['shipped_to_terminal'];
        $terminal = $data['terminal'];
        $shifted_to_port = $data['shifted_to_port'];
        $port_of_loading = $data['port_of_loading'];
        $grn_number = $data['grn_number'];
        $grn_date = $data['grn_date'];
        $base_port_used_for_freight_costing = $data['base_port_used_for_freight_costing'];
        $ls_number = $data['ls_number'];
        $vo_number = $data['vo_number'];
        $status_super_admin = $data['status_super_admin'];
        $status = $data['status'];
        $vessel_name = $data['vessel_name'];
        $voyage = $data['voyage'];
        $sob_date = $data['sob_date'];
        $bli_date = $data['bli_date'];
        $original_bl_number = $data['original_bl_number'];
        $ho_order_number = $data['ho_order_number'];
        $ex_yard_price = $data['ex_yard_price'];
        $cnf1 = $data['cnf1'];
        $cnf2 = $data['cnf2'];
        $cnf3 = $data['cnf3'];
        $fob1 = $data['fob1'];
        $fob2 = $data['fob2'];
        $fob3 = $data['fob3'];
        $fca1 = $data['fca1'];
        $fca2 = $data['fca2'];
        $fca3 = $data['fca3'];        
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
        $net_weight = $_POST['net_weight'];
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
        $exchange_rate= $_POST['exchange_rate'];
        $transporter = $_POST['transporter'];
        $shipped_to_storage = $_POST['shipped_to_storage'];
        $storage = $_POST['storage'];
        $shifted_to_terminal = $_POST['shifted_to_terminal'];
        $shipped_to_terminal = $_POST['shipped_to_terminal'];
        $terminal = $_POST['terminal'];
        $shifted_to_port = $_POST['shifted_to_port'];
        $port_of_loading = $_POST['port_of_loading'];
        $grn_number = $_POST['grn_number'];
        $grn_date = $_POST['grn_date'];
        $base_port_used_for_freight_costing = $_POST['base_port_used_for_freight_costing'];
        $ls_number = $_POST['ls_number'];
        $vo_number = $_POST['vo_number'];
        $status_super_admin = $_POST['status_super_admin'];
        $status = $_POST['status'];
        $vessel_name = $_POST['vessel_name'];
        $voyage = $_POST['voyage'];
        $sob_date = $_POST['sob_date'];
        $bli_date = $_POST['bli_date'];
        $original_bl_number = $_POST['original_bl_number'];
        $ho_order_number = $_POST['ho_order_number'];
        $ex_yard_price = $_POST['ex_yard_price'];
        $cnf1 = $_POST['cnf1'];
        $cnf2 = $_POST['cnf2'];
        $cnf3 = $_POST['cnf3'];
        $fob1 = $_POST['fob1'];
        $fob2 = $_POST['fob2'];
        $fob3 = $_POST['fob3'];
        $fca1 = $_POST['fca1'];
        $fca2 = $_POST['fca2'];
        $fca3 = $_POST['fca3'];
        
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
                                                                    <strong>Verified by COUNTRY MANAGER</strong>
                                                                </div>
                                                                <div class="col-sm-4 text-center">
                                                                    <strong>Modification by EMO</strong>
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
                                                                    <label for="tare_weight" class="col-sm-3 form-control-label">Tare Weight(MT):</label>
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
                                                                    <label for="net_weight" class="col-sm-3 form-control-label">Net. Weight &nbsp;(MT) - Supplier:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $net_weight;?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="net_weight" id="net_weight" class="form-control" >
                                                                    </div>   
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="net_weight_supplier" class="col-sm-3 form-control-label">Net Weight Supplier &nbsp;(MT) - Yard:</label>
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
                                                                    <label for="pay_load" class="col-sm-3 form-control-label">Pay Load &nbsp;(MT):</label>
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
                                                                    <label for="" class="col-sm-3 form-control-label">Empty Depot Name:</label>
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
                                                                    <label for="" class="col-sm-3 form-control-label">Material Code:</label>
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
                                                                    <label for="material_description" class="col-sm-3 form-control-label">Material Description:</label>
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
                                                                    <label for="material_quality_code" class="col-sm-3 form-control-label">Material Quality Code:</label>
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
                                                                    <label for="shipping_line_id" class="col-sm-3 form-control-label">Shipping Line:</label>
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
                                                                    <label for="supplier_id" class="col-sm-3 form-control-label">Supplier:</label>
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
                                                                    <label for="seal_number_id" class="col-sm-3 form-control-label">Seal Number:</label>
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
                                                       
                                                                <!-- 1  Multiple-image_stock_pile images upload -->
                                                                <div class="form-group row">
                                                                    <label for="select_image_stock_pile" class="col-sm-3 form-control-label">Stock Pile Image:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="mydropzone_stock_pile mydropzone">
                                                                            <?php
                                                                            $selimages_stock_pile = selectqry( '*', TB_CONTAINER_IMAGES, array("container_id="=>$_REQUEST['id'], "image_status="=>"image_stock_pile") );
                                                                            if( mysqli_num_rows($selimages_stock_pile) > 0):
                                                                                $n = 0;
                                                                                while ($resimages = mysqli_fetch_array($selimages_stock_pile)) {
                                                                                    if( !isEmpty($resimages['image']) ):
                                                                                    ?>
                                                                                        <div class="dz-preview dz-processing dz-image-preview dz-success" id="<?php echo 'img_stock_pile' . $n; ?>">
                                                                                            <div class="dz-details">                            
                                                                                                <div data-dz-size="" class="dz-size"><?php echo filesizeformat(DIR_BASE.DIR_UPLOADS . $resimages['image'], 'MB'); ?></div>    
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>                          														                            
                                                                                            <a href="javascript:undefined;" class="dz-remove dz-removeuploaded" image_status="<?php echo $resimages['image_status'];?>" imgname="<?php echo $resimages['image']; ?>" imgboxid="<?php echo 'img' . $n; ?>">Remove file</a>
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <a class="btn btn-primary btn-small fl" id="select_image_stock_pile" href="javascript:">
                                                                                <i class="la la-cloud-upload ks-icon"></i>
                                                                                <span class="ks-text"></span>Choose file
                                                                            </a>
                                                                            <input type="hidden" name="images_stock_pile" id="images_stock_pile" value="" />
                                                                        </div>
                                                                    </div>   
                                                                </div>                                                            
                                                                <!-- 2  Multiple: images_empty_container -->
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Empty Container Images:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="mydropzone_empty_container mydropzone">
                                                                            <?php
                                                                            $sel_images_empty_container = selectqry( '*', TB_CONTAINER_IMAGES, array("container_id="=>$_REQUEST['id'], "image_status="=>"image_empty_container") );
                                                                            if( mysqli_num_rows($sel_images_empty_container) > 0):
                                                                                $n = 0;
                                                                                while ($resimages = mysqli_fetch_array($sel_images_empty_container)) {
                                                                                    if( !isEmpty($resimages['image']) ):
                                                                                    ?>
                                                                                        <div class="dz-preview dz-processing dz-image-preview dz-success" id="<?php echo 'img' . $n; ?>">
                                                                                            <div class="dz-details">
                                                                                                <div data-dz-size="" class="dz-size"><?php echo filesizeformat(DIR_BASE.DIR_UPLOADS . $resimages['image'], 'MB'); ?></div>    
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>
                                                                                            <a href="javascript:undefined;" class="dz-remove dz-removeuploaded" image_status="<?php echo $resimages['image_status'];?>" imgname="<?php echo $resimages['image']; ?>" imgboxid="<?php echo 'img' . $n; ?>">Remove file</a>
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <a class="btn btn-primary btn-small fl" id="select_image_empty_container" href="javascript:">
                                                                                <i class="la la-cloud-upload ks-icon"></i>
                                                                                <span class="ks-text"></span>Choose file
                                                                            </a>
                                                                            <input type="hidden" name="images_empty_container" id="images_empty_container" value="" />
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                                
                                                                <!-- 3 Multiple: images_container_loading -->
                                                                <div class="form-group row">
                                                                    <label for="images_container_loading" class="col-sm-3 form-control-label">Container Loading Image:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="mydropzone_container_loading mydropzone">
                                                                            <?php
                                                                            $sel_images_container_loading = selectqry( '*', TB_CONTAINER_IMAGES, array("container_id="=>$_REQUEST['id'], "image_status="=>"image_container_loading") );
                                                                            if( mysqli_num_rows($sel_images_container_loading) > 0):
                                                                                $n = 0;
                                                                                while ($resimages = mysqli_fetch_array($sel_images_container_loading)) {
                                                                                    if( !isEmpty($resimages['image']) ):
                                                                                    ?>
                                                                                        <div class="dz-preview dz-processing dz-image-preview dz-success" id="<?php echo 'img' . $n; ?>">
                                                                                            <div class="dz-details">
                                                                                                <div data-dz-size="" class="dz-size"><?php echo filesizeformat(DIR_BASE.DIR_UPLOADS . $resimages['image'], 'MB'); ?></div>    
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>
                                                                                            <a href="javascript:undefined;" class="dz-remove dz-removeuploaded" image_status="<?php echo $resimages['image_status'];?>" imgname="<?php echo $resimages['image']; ?>" imgboxid="<?php echo 'img' . $n; ?>">Remove file</a>
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <a class="btn btn-primary btn-small fl" id="select_images_container_loading" href="javascript:">
                                                                                <i class="la la-cloud-upload ks-icon"></i>
                                                                                <span class="ks-text"></span>Choose file
                                                                            </a>
                                                                            <input type="hidden" name="images_container_loading" id="images_container_loading" value="" />
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                                
                                                                <!-- 4 Multiple: images_container_seal -->
                                                                <div class="form-group row">
                                                                    <label for="images_container_seal" class="col-sm-3 form-control-label">Container Seal Image:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="mydropzone_container_seal mydropzone">
                                                                            <?php
                                                                            $sel_images_container_seal = selectqry( '*', TB_CONTAINER_IMAGES, array("container_id="=>$_REQUEST['id'], "image_status="=>"image_container_seal") );
                                                                            if( mysqli_num_rows($sel_images_container_seal) > 0):
                                                                                $n = 0;
                                                                                while ($resimages = mysqli_fetch_array($sel_images_container_seal)) {
                                                                                    if( !isEmpty($resimages['image']) ):
                                                                                    ?>
                                                                                        <div class="dz-preview dz-processing dz-image-preview dz-success" id="<?php echo 'img' . $n; ?>">
                                                                                            <div class="dz-details">
                                                                                                <div data-dz-size="" class="dz-size"><?php echo filesizeformat(DIR_BASE.DIR_UPLOADS . $resimages['image'], 'MB'); ?></div>
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>
                                                                                            <a href="javascript:undefined;" class="dz-remove dz-removeuploaded" image_status="<?php echo $resimages['image_status'];?>" imgname="<?php echo $resimages['image']; ?>" imgboxid="<?php echo 'img' . $n; ?>">Remove file</a>
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <a class="btn btn-primary btn-small fl" id="select_images_container_seal" href="javascript:">
                                                                                <i class="la la-cloud-upload ks-icon"></i>
                                                                                <span class="ks-text"></span>Choose file
                                                                            </a>
                                                                            <input type="hidden" name="images_container_seal" id="images_container_seal" value="" />
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                                
                                                                <!-- 5 Multiple: images_documents -->
                                                                <div class="form-group row">
                                                                    <label for="images_documents" class="col-sm-3 form-control-label">Container Document Image:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="mydropzone_images_documents mydropzone">
                                                                            <?php
                                                                            $sel_images_documents = selectqry( '*', TB_CONTAINER_IMAGES, array("container_id="=>$_REQUEST['id'], "image_status="=>"image_documents") );
                                                                            if( mysqli_num_rows($sel_images_documents) > 0):
                                                                                $n = 0;
                                                                                while ($resimages = mysqli_fetch_array($sel_images_documents)) {
                                                                                    if( !isEmpty($resimages['image']) ):
                                                                                    ?>
                                                                                        <div class="dz-preview dz-processing dz-image-preview dz-success" id="<?php echo 'img' . $n; ?>">
                                                                                            <div class="dz-details">
                                                                                                <div data-dz-size="" class="dz-size"><?php echo filesizeformat(DIR_BASE.DIR_UPLOADS . $resimages['image'], 'MB'); ?></div>
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>
                                                                                            <a href="javascript:undefined;" class="dz-remove dz-removeuploaded" image_status="<?php echo $resimages['image_status'];?>" imgname="<?php echo $resimages['image']; ?>" imgboxid="<?php echo 'img' . $n; ?>">Remove file</a>
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <a class="btn btn-primary btn-small fl" id="select_images_documents" href="javascript:">
                                                                                <i class="la la-cloud-upload ks-icon"></i>
                                                                                <span class="ks-text"></span>Choose file
                                                                            </a>
                                                                            <input type="hidden" name="images_documents" id="images_documents" value="" />
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="exchange_rate" class="col-sm-3 form-control-label">Exchange Rate:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" style="text-transform:capitalize;" >
                                                                            <?php echo $exchange_rate; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="exchange_rate" id="exchange_rate" class="form-control">
                                                                            <option value="master" <?php if($exchange_rate == 'master'){ echo 'selected'; } ?> >Master</option>
                                                                            <option value="optional" <?php if($exchange_rate == 'optional'){ echo 'selected'; } ?> >Optional</option>                                                                            
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="branch_code_id" class="col-sm-3 form-control-label">Branch Code:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $branch_code = fetchqry('*', TB_BRANCH_CODE, array('id='=>$branch_code_id) );
                                                                            echo $branch_code['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="branch_code_id" id="branch_code_id" class="form-control">
                                                                            <option>Select Branch Code</option>
                                                                            <?php
                                                                            $branch_code = selectqry('*', TB_BRANCH_CODE, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($branch_code) ):
                                                                                if($row['id'] == $branch_code_id):
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
                                                                    <label for="shipping_agent_id" class="col-sm-3 form-control-label">Shipping Agent:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $shipping_agent = fetchqry('*', TB_SHIPPING_AGENT, array('id='=>$shipping_agent_id) );
                                                                            echo $shipping_agent['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="shipping_agent_id" id="shipping_agent_id" class="form-control">
                                                                            <option>Select Shipping Agent</option>
                                                                            <?php
                                                                            $shipping_agent = selectqry('*', TB_SHIPPING_AGENT, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($shipping_agent) ):
                                                                                if($row['id'] == $shipping_agent_id):
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
                                                                    <label for="transporter" class="col-sm-3 form-control-label">Transporter:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" style="text-transform:capitalize;" >
                                                                            <?php echo $transporter; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="transporter" id="transporter" class="form-control">
                                                                            <option>Select Transporter</option>
                                                                            <option value="yes" <?php if($transporter == 'Yes'){ echo 'selected'; } ?> >Yes</option>
                                                                            <option value="no" <?php if($transporter == 'No'){ echo 'selected'; } ?> >No</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="shipped_to_storage" class="col-sm-3 form-control-label">Shifted To Storage:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($shipped_to_storage) ); ?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="shipped_to_storage" id="shipped_to_storage" class="calendar form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="storage" class="col-sm-3 form-control-label">Storage:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $storage; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="storage" id="storage" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="shifted_to_terminal" class="col-sm-3 form-control-label">Shifted To Terminal:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($shifted_to_terminal) ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="shifted_to_terminal" id="shifted_to_terminal" class="calendar form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="terminal" class="col-sm-3 form-control-label">Terminal:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $terminal; ?>                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="terminal" id="terminal" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="shifted_to_port" class="col-sm-3 form-control-label">Shifted To Port:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($shifted_to_port) ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="shifted_to_port" id="shifted_to_port" class="calendar form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="port_of_loading" class="col-sm-3 form-control-label">Port Of Loading:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $port_of_loading; ?>                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="port_of_loading" id="port_of_loading" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="grn_number" class="col-sm-3 form-control-label">Grn Number:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $grn_number; ?>                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="grn_number" id="grn_number" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="grn_date" class="col-sm-3 form-control-label">GRN Date:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($grn_date) ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="grn_date" id="grn_date" class="calendar form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                
                                                                <div class="form-group row">
                                                                    <label for="base_port_used_for_freight_costing" class="col-sm-3 form-control-label">Base Port Used For Freight Costing:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $tmp = fetchqry( '*', TB_BASE_PORT_USED_FOR_FREIGHT_COSTING, array('id='=>$base_port_used_for_freight_costing) );
                                                                            echo $tmp['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="base_port_used_for_freight_costing" id="base_port_used_for_freight_costing" class="form-control">
                                                                            <option>Select Base Port For Freight Costing</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_BASE_PORT_USED_FOR_FREIGHT_COSTING, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($base_port_used_for_freight_costing == $row['id']):
                                                                                    $selected = 'selected';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                        
                                                                <div class="form-group row">
                                                                    <label for="ls_number" class="col-sm-3 form-control-label">LS Number:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $ls_number; ?>                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="ls_number" id="ls_number" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="vo_number" class="col-sm-3 form-control-label">VO Number:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $vo_number; ?>                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="vo_number" id="vo_number" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                                                                                
                                                                <div class="form-group row">
                                                                    <label for="status" class="col-sm-3 form-control-label">Status:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            if($status == 'draft'):
                                                                                echo 'Draft';
                                                                            elseif($status == 'pending_upload'):
                                                                                echo 'Pendign Upload';
                                                                            elseif($status == 'verified_by_country_manager'):    
                                                                                echo 'Verified';
                                                                            elseif($status == 'not_verified_by_country_manager'):        
                                                                                echo 'Not Verified';
                                                                            endif;                                                                            
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="status" id="status" class="form-control">
                                                                            <option>Select Status</option>
                                                                            <option <?php if($status == 'verified_by_country_manager'){ echo 'selected'; } ?> value="verified_by_country_manager">Verified</option>
                                                                            <option <?php if($status == 'not_verified_by_country_manager'){ echo 'selected'; } ?> value="not_verified_by_country_manager">Not Verified</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="vessel_name" class="col-sm-3 form-control-label">Vessel Name:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $vessel_name; ?>                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="vessel_name" id="vessel_name" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="voyage" class="col-sm-3 form-control-label">Voyage:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $voyage; ?>                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="voyage" id="voyage" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="sob_date" class="col-sm-3 form-control-label">SOB Date:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $sob_date; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="sob_date" id="sob_date" class="calendar form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="bli_date" class="col-sm-3 form-control-label">BLI Date:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $bli_date; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="bli_date" id="bli_date" class="calendar form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="original_bl_number" class="col-sm-3 form-control-label">Original BL Number:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $original_bl_number; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="original_bl_number" id="original_bl_number" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="ho_order_number" class="col-sm-3 form-control-label">HO Order Number:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $ho_order_number; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="ho_order_number" id="ho_order_number" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="ex_yard_price" class="col-sm-3 form-control-label">EX Yard Price:</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $ex_yard_price; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="ex_yard_price" id="ex_yard_price" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <!-- CNF -->
                                                                <div class="form-group row">
                                                                    <label for="cnf1" class="col-sm-3 form-control-label">CNF:</label>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$cnf1) );
                                                                            echo $tmp['name']; 
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$cnf2) );
                                                                            echo $tmp['name']; 
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$cnf3) );
                                                                            echo $tmp['name']; 
                                                                            ?>
                                                                        </div>
                                                                    </div>                                                                    
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-1">
                                                                        <select name="cnf1" id="" class="form-control">
                                                                            <option>select</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_CURRENCY, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($cnf1 == $row['id']):
                                                                                    $selected = 'selected';
                                                                                else : 
                                                                                    $selected = '';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].' ('.$row['symbol'].')</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <select name="cnf2" id="" class="form-control">
                                                                            <option>select</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_CURRENCY, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($cnf2 == $row['id']):
                                                                                    $selected = 'selected';
                                                                                else : 
                                                                                    $selected = '';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].' ('.$row['symbol'].')</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <select name="cnf3" id="" class="form-control">
                                                                            <option>select</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_CURRENCY, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($cnf3 == $row['id']):
                                                                                    $selected = 'selected';
                                                                                else : 
                                                                                    $selected = '';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].' ('.$row['symbol'].')</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>                                                                    
                                                                </div>
                                                                
                                                                <!-- FOB -->
                                                                <div class="form-group row">
                                                                    <label for="fob1" class="col-sm-3 form-control-label">FOB:</label>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fob1) );
                                                                            echo $tmp['name']; 
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fob2) );
                                                                            echo $tmp['name']; 
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fob3) );
                                                                            echo $tmp['name']; 
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-1">
                                                                        <select name="fob1" id="" class="form-control">
                                                                            <option>select</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_CURRENCY, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($fob1 == $row['id']):
                                                                                    $selected = 'selected';
                                                                                else : 
                                                                                    $selected = '';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].' ('.$row['symbol'].')</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <select name="fob2" id="" class="form-control">
                                                                            <option>select</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_CURRENCY, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($fob2 == $row['id']):
                                                                                    $selected = 'selected';
                                                                                else : 
                                                                                    $selected = '';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].' ('.$row['symbol'].')</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <select name="fob3" id="" class="form-control">
                                                                            <option>select</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_CURRENCY, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($fob3 == $row['id']):
                                                                                    $selected = 'selected';
                                                                                else : 
                                                                                    $selected = '';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].' ('.$row['symbol'].')</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- FCA -->
                                                                <div class="form-group row">
                                                                    <label for="fca1" class="col-sm-3 form-control-label">FCA:</label>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fca1) );
                                                                            echo $tmp['name']; 
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fca2) );
                                                                            echo $tmp['name']; 
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <div class="form-control dark" >
                                                                            <?php 
                                                                            $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fca3) );
                                                                            echo $tmp['name']; 
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-1">
                                                                        <select name="fca1" id="" class="form-control">
                                                                            <option>select</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_CURRENCY, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($fca1 == $row['id']):
                                                                                    $selected = 'selected';
                                                                                else : 
                                                                                    $selected = '';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].' ('.$row['symbol'].')</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <select name="fca2" id="" class="form-control">
                                                                            <option>select</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_CURRENCY, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($fca2 == $row['id']):
                                                                                    $selected = 'selected';
                                                                                else : 
                                                                                    $selected = '';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].' ('.$row['symbol'].')</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <select name="fca3" id="" class="form-control">
                                                                            <option>select</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_CURRENCY, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                if($fca3 == $row['id']):
                                                                                    $selected = 'selected';
                                                                                else : 
                                                                                    $selected = '';
                                                                                endif;
                                                                                echo '<option value="'.$row['id'].'" '.$selected.' >'.$row['name'].' ('.$row['symbol'].')</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
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

                //image_stock_pile
                $("#select_image_stock_pile").dropzone({        
                        url: "<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-upload.php",
                        paramName: "myfile",
                        uploadMultiple: true,
                        maxFilesize: 5, //MB
                        addRemoveLinks: true,
                        acceptedFiles: 'image/*',
                        previewsContainer: '.mydropzone_stock_pile',
                        accept: function (file, done)
                        {
                            done(); // to allow process
                            var filestr = $("#images_stock_pile").val();
                            if (filestr != '')
                                filestr = filestr + '::' + file.name;
                            else
                                filestr = file.name;
                            $("#images_stock_pile").val(filestr);
                        },
                        removedfile: function (file)
                        {
                            $.post('<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-remove.php?file=' + file.name, function (retdata) {
                                var _ref;
                                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                            });
                        }
                });
                //select_image_empty_container
                $("#select_image_empty_container").dropzone({        
                        url: "<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-upload.php",
                        paramName: "myfile",
                        uploadMultiple: true,
                        maxFilesize: 5, //MB
                        addRemoveLinks: true,
                        acceptedFiles: 'image/*',
                        previewsContainer: '.mydropzone_empty_container',
                        accept: function (file, done)
                        {
                            done(); // to allow process
                            var filestr = $("#images_empty_container").val();
                            if (filestr != '')
                                filestr = filestr + '::' + file.name;
                            else
                                filestr = file.name;
                            $("#images_empty_container").val(filestr);
                        },
                        removedfile: function (file)
                        {
                            $.post('<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-remove.php?file=' + file.name, function (retdata) {
                                var _ref;
                                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                            });
                        }
                });
                //select_images_container_loading
                $("#select_images_container_loading").dropzone({        
                        url: "<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-upload.php",
                        paramName: "myfile",
                        uploadMultiple: true,
                        maxFilesize: 5, //MB
                        addRemoveLinks: true,
                        acceptedFiles: 'image/*',
                        previewsContainer: '.mydropzone_container_loading',
                        accept: function (file, done)
                        {
                            done(); // to allow process
                            var filestr = $("#images_container_loading").val();
                            if (filestr != '')
                                filestr = filestr + '::' + file.name;
                            else
                                filestr = file.name;
                            $("#images_container_loading").val(filestr);
                        },
                        removedfile: function (file)
                        {
                            $.post('<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-remove.php?file=' + file.name, function (retdata) {
                                var _ref;
                                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                            });
                        }
                });
                //select_images_container_seal
                $("#select_images_container_seal").dropzone({        
                        url: "<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-upload.php",
                        paramName: "myfile",
                        uploadMultiple: true,
                        maxFilesize: 5, //MB
                        addRemoveLinks: true,
                        acceptedFiles: 'image/*',
                        previewsContainer: '.mydropzone_container_seal',
                        accept: function (file, done)
                        {
                            done(); // to allow process
                            var filestr = $("#images_container_seal").val();
                            if (filestr != '')
                                filestr = filestr + '::' + file.name;
                            else
                                filestr = file.name;
                            $("#images_container_seal").val(filestr);
                        },
                        removedfile: function (file)
                        {
                            $.post('<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-remove.php?file=' + file.name, function (retdata) {
                                var _ref;
                                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                            });
                        }
                });
                //select_images_documents
                $("#select_images_documents").dropzone({        
                        url: "<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-upload.php",
                        paramName: "myfile",
                        uploadMultiple: true,
                        maxFilesize: 5, //MB
                        addRemoveLinks: true,
                        acceptedFiles: 'image/*',
                        previewsContainer: '.mydropzone_images_documents',
                        accept: function (file, done)
                        {
                            done(); // to allow process
                            var filestr = $("#images_documents").val();
                            if (filestr != '')
                                filestr = filestr + '::' + file.name;
                            else
                                filestr = file.name;
                            $("#images_documents").val(filestr);
                        },
                        removedfile: function (file)
                        {
                            $.post('<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>dz-remove.php?file=' + file.name, function (retdata) {
                                var _ref;
                                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                            });
                        }
                });
                
                //Remove image
                $(".dz-removeuploaded").click(function () {
                    var myobj = $(this);
                    $.post('<?php echo URL_BASEADMIN . DIR_INCLUDES; ?>container_ajax.php?ptype=edit&type=removeimage&image_status=' + myobj.attr('image_status') + '&sid=<?php echo $_REQUEST['id']; ?>&name=' + myobj.attr('imgname'), function (retdata) {
                        var box = myobj.attr('imgboxid');
                        $('#' + box).remove();
                    });
                });
                $('a[rel=viewimage]').fancybox({
                    buttons: [
                        'close'
                    ],
                });                
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
        if( !isEmpty($_POST['net_weight']) ):
                $arr['net_weight'] = $_POST['net_weight'];
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
                $temp = implode(',', $_POST['exchange_rate']);
                $arr['exchange_rate'] = $temp;
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
        if( !isEmpty($_POST['vessel_name']) ):
                $arr['vessel_name'] = $_POST['vessel_name'];
        endif;
        if( !isEmpty($_POST['voyage']) ):
                $arr['voyage'] = $_POST['voyage'];
        endif;
        if( !isEmpty($_POST['bli_date']) ):
                $arr['bli_date'] = $_POST['bli_date'];
        endif;
        if( !isEmpty($_POST['sob_date']) ):
                $arr['sob_date'] = $_POST['sob_date'];
        endif;
        if( !isEmpty($_POST['original_bl_number']) ):
                $arr['original_bl_number'] = $_POST['original_bl_number'];
        endif;
        if( !isEmpty($_POST['ho_order_number']) ):
                $arr['ho_order_number'] = $_POST['ho_order_number'];
        endif;
        if( !isEmpty($_POST['ex_yard_price']) ):
                $arr['ex_yard_price'] = $_POST['ex_yard_price'];
        endif;
        if( !isEmpty($_POST['cnf1']) ):
                $arr['cnf1'] = $_POST['cnf1'];
        endif;
        if( !isEmpty($_POST['cnf2']) ):
                $arr['cnf2'] = $_POST['cnf2'];
        endif;
        if( !isEmpty($_POST['cnf3']) ):
                $arr['cnf3'] = $_POST['cnf3'];
        endif;
        if( !isEmpty($_POST['fob1']) ):
                $arr['fob1'] = $_POST['fob1'];
        endif;
        if( !isEmpty($_POST['fob2']) ):
                $arr['fob2'] = $_POST['fob2'];
        endif;
        if( !isEmpty($_POST['fob3']) ):
                $arr['fob3'] = $_POST['fob3'];
        endif;
        if( !isEmpty($_POST['fca1']) ):
                $arr['fca1'] = $_POST['fca1'];
        endif;
        if( !isEmpty($_POST['fca2']) ):
                $arr['fca2'] = $_POST['fca2'];
        endif;
        if( !isEmpty($_POST['fca3']) ):
                $arr['fca3'] = $_POST['fca3'];
        endif;
        
                
        if( count($arr) > 0 ):
            $update = updateqry($arr, array("id=" => $_REQUEST['id']), $table);
        endif;
        
                       
    } 
    
    $updateid = ($_REQUEST['id']) ? $_REQUEST['id'] : $insertedid;
        
    /* For Insert Images for stock pile */
    $tmpimages = explode('::', $_POST['images_stock_pile']);
        if (count($tmpimages) > 0)
            $images_stock_pile = movetmpfiles($tmpimages);
        
    if (count($images_stock_pile) > 0) {
        foreach ($images_stock_pile as $key => $val) {
            insertqry(array("container_id"=>$updateid, "image"=>$val, "image_status"=>'image_stock_pile'), TB_CONTAINER_IMAGES);
        }
    }
    
    /* For Insert images_empty_container */
    $tmpimages = explode('::', $_POST['images_empty_container']);
        if (count($tmpimages) > 0)
            $images_empty_container = movetmpfiles($tmpimages);
        
    if (count($images_empty_container) > 0) {
        foreach ($images_empty_container as $key => $val) {
            insertqry(array("container_id"=>$updateid, "image"=>$val, "image_status"=>'image_empty_container'), TB_CONTAINER_IMAGES);
        }
    }
    
    /* For Insert select_images_container_loading */
    $tmpimages = explode('::', $_POST['images_container_loading']);
        if (count($tmpimages) > 0)
            $images_container_loading = movetmpfiles($tmpimages);
        
    if (count($images_container_loading) > 0) {
        foreach ($images_container_loading as $key => $val) {
            insertqry(array("container_id"=>$updateid, "image"=>$val, "image_status"=>'image_container_loading'), TB_CONTAINER_IMAGES);
        }
    }
    
    /* For Insert images_container_seal */
    $tmpimages = explode('::', $_POST['images_container_seal']);
        if (count($tmpimages) > 0)
            $images_container_seal = movetmpfiles($tmpimages);
        
    if (count($images_container_seal) > 0) {
        foreach ($images_container_seal as $key => $val) {
            insertqry(array("container_id"=>$updateid, "image"=>$val, "image_status"=>'image_container_seal'), TB_CONTAINER_IMAGES);
        }
    }
    
    /* For Insert select_images_documents */
    $tmpimages = explode('::', $_POST['images_documents']);
        if (count($tmpimages) > 0)
            $images_documents = movetmpfiles($tmpimages);
        
    if (count($images_documents) > 0) {
        foreach ($images_documents as $key => $val) {
            insertqry(array("container_id"=>$updateid, "image"=>$val, "image_status"=>'image_documents'), TB_CONTAINER_IMAGES);
        }
    }
        

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