<?php
include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])) { ?>
    <?php
    $pagename = "User";
    $listpagename = SA_USER_LIST;
    $table = TB_USERS;
    $created_at = date('Y-m-d H:i:s');
    
    if ($_REQUEST['id']) {
        
        $pagetype = "Edit";
        $data = fetchqry("*", $table, array("id=" => $_REQUEST['id']));
        $country_id = $data['country_id'];
        $company_id = $data['company_id'];
        $yard_id = $data['yard_id'];
        $empty_container_received = $data['empty_container_received'];
        $container_placed_yard = $data['container_placed_yard'];
        $container_number = $data['container_number'];
        $container_size = $data['container_size'];
        $tare_weight = $data['tare_weight'];
        $gross_weight = $data['gross_weight'];
        $net_weight = $data['net_weight'];
        $net_weight_supplier = $data['net_weight_supplier'];
        $net_weight_yard = $data['net_weight_yard'];
        $pay_load = $data['pay_load'];
        $empty_depot_name = $data['empty_depot_name'];
        $material_code = $data['material_code'];
        $material_description = $data['material_description'];
        $material_quality_code = $data['material_quality_code'];
        $shipping_line = $data['shipping_line'];
        $supplier = $data['supplier'];
        $seal_number = $data['seal_number'];
        $exchange_rate= $data['exchange_rate'];
        $branch_code = $data['branch_code'];
        $shipping_agent = $data['shipping_agent'];
        $transporter = $data['transporter'];
        $shipped_to_storage = $data['shipped_to_storage'];
        $storage = $data['storage'];
        $shifted_to_terminal = $data['shifted_to_terminal'];
        $terminal = $data['terminal'];
        $shifted_to_port = $data['shifted_to_port'];
        $port_of_loading = $data['port_of_loading'];
        $grn_number = $data['grn_number'];
        $grn_date = $data['grn_date'];
        $base_port_used_for_freight_costing = $data['base_port_used_for_freight_costing'];
        $ls_number = $data['ls_number'];
        $vo_number = $data['vo_number'];
        $status_super_admin = $data['status_super_admin'];
        $vessel_name = $data['vessel_name'];
        $voyage = $data['voyage'];
        $sob_date = $data['sob_date'];
        $bli_number = $data['bli_number'];
        $original_bl_number = $data['original_bl_number'];
        $ho_order_number = $data['ho_order_number'];
        $ex_yard_price = $data['ex_yard_price'];
        $cnf = $data['cnf'];
        $fob = $data['fob'];
        $fca = $data['fca'];
        $created_at = date( 'd F, Y', strtotime($data['created_at']) );        
        
    } else {
        
        $country_id = $_REQUEST['country_id'];
        $company_id = $_REQUEST['company_id'];
        $yard_id = $_REQUEST['yard_id'];
        $empty_container_received = $_REQUEST['empty_container_received'];
        $container_placed_yard = $_REQUEST['container_placed_yard'];
        $container_number = $_REQUEST['container_number'];
        $container_size = $_REQUEST['container_size'];
        $tare_weight = $_REQUEST['tare_weight'];
        $gross_weight = $_REQUEST['gross_weight'];
        $net_weight = $_REQUEST['net_weight'];
        $net_weight_supplier = $_REQUEST['net_weight_supplier'];
        $net_weight_yard = $_REQUEST['net_weight_yard'];
        $pay_load = $_REQUEST['pay_load'];
        $empty_depot_name = $_REQUEST['empty_depot_name'];
        $material_code = $_REQUEST['material_code'];
        $material_description = $_REQUEST['material_description'];
        $material_quality_code = $_REQUEST['material_quality_code'];
        $shipping_line = $_REQUEST['shipping_line'];
        $supplier = $_REQUEST['supplier'];
        $seal_number = $_REQUEST['seal_number'];
        $exchange_rate= $_REQUEST['exchange_rate'];
        $branch_code = $_REQUEST['branch_code'];
        $shipping_agent = $_REQUEST['shipping_agent'];
        $transporter = $_REQUEST['transporter'];
        $shipped_to_storage = $_REQUEST['shipped_to_storage'];
        $storage = $_REQUEST['storage'];
        $shifted_to_terminal = $_REQUEST['shifted_to_terminal'];
        $terminal = $_REQUEST['terminal'];
        $shifted_to_port = $_REQUEST['shifted_to_port'];
        $port_of_loading = $_REQUEST['port_of_loading'];
        $grn_number = $_REQUEST['grn_number'];
        $grn_date = $_REQUEST['grn_date'];
        $base_port_used_for_freight_costing = $_REQUEST['base_port_used_for_freight_costing'];
        $ls_number = $_REQUEST['ls_number'];
        $vo_number = $_REQUEST['vo_number'];
        $status_super_admin = $_REQUEST['status_super_admin'];
        $vessel_name = $_REQUEST['vessel_name'];
        $voyage = $_REQUEST['voyage'];
        $sob_date = $_REQUEST['sob_date'];
        $bli_number = $_REQUEST['bli_number'];
        $original_bl_number = $_REQUEST['original_bl_number'];
        $ho_order_number = $_REQUEST['ho_order_number'];
        $ex_yard_price = $_REQUEST['ex_yard_price'];
        $cnf = $_REQUEST['cnf'];
        $fob = $_REQUEST['fob'];
        $fca = $_REQUEST['fca'];
        
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
            </style>
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
                                                                <label for="country_id" class="col-sm-2 form-control-label">Country</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $sel_contries = selectqry('*', TB_COUNTRIES, array(), " `name` ASC ");
                                                                        ?>
                                                                        <select name="country_id" id="country_id" class="form-control">
                                                                            <option value="">Select Inspector Country</option>
                                                                            <?php
                                                                            while( $row = mysqli_fetch_assoc($sel_contries) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="company_id" class="col-sm-2 form-control-label">Company</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $sel_contries = selectqry('*', TB_COMPANIES, array(), " `name` ASC ");
                                                                        ?>
                                                                        <select name="company_id" id="company_id" class="form-control">
                                                                            <option value="">Select Inspector Country</option>
                                                                            <?php
                                                                            while( $row = mysqli_fetch_assoc($sel_contries) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="yard_id" class="col-sm-2 form-control-label">Yard</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $sel_yards = selectqry('*', TB_YARDS, array(), " `name` ASC ");
                                                                        ?>
                                                                        <select name="yard_id" id="yard_id" class="form-control">
                                                                            <option value="">Select Yard</option>
                                                                            <?php
                                                                            while( $row = mysqli_fetch_assoc($sel_yards) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="empty_container_received" class="col-sm-2 form-control-label">Empty Container Received At</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">                         
                                                                        <input type="text" name="empty_container_received" id="empty_container_received" class="form-control" value="<?php echo $empty_container_received; ?>" > 
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="container_placed_yard" class="col-sm-2 form-control-label">Container Placed Yard At</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="container_placed_yard" id="container_placed_yard" class="form-control" value="<?php echo $container_placed_yard; ?>" > 
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="container_number" class="col-sm-2 form-control-label">Container Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="container_number" id="container_number" class="form-control" value="<?php echo $container_number; ?>" > 
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="container_size" class="col-sm-2 form-control-label">Container Size</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="container_size" id="container_size" class="form-control" value="<?php echo $container_size; ?>" > 
                                                                    </div>
                                                                </div>
                                                            </div>                                                           
                                                            <div class="form-group row">
                                                                <label for="tare_weight" class="col-sm-2 form-control-label">Tare Weight</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="tare_weight" id="tare_weight" class="form-control" value="<?php echo $tare_weight; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="gross_weight" class="col-sm-2 form-control-label">Gross Weight</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="gross_weight" id="gross_weight" class="form-control" value="<?php echo $gross_weight; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="net_weight" class="col-sm-2 form-control-label">Net Weight</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="net_weight" id="net_weight" class="form-control" value="<?php echo $net_weight; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="net_weight_supplier" class="col-sm-2 form-control-label">Net Weight Supplier</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="net_weight_supplier" id="net_weight_supplier" class="form-control" value="<?php echo $net_weight_supplier; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="net_weight_yard" class="col-sm-2 form-control-label">Net Weight Yard</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="net_weight_yard" id="net_weight_yard" class="form-control" value="<?php echo $net_weight_yard; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="pay_load" class="col-sm-2 form-control-label">Pay Load</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="pay_load" id="pay_load" class="form-control" value="<?php echo $pay_load; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="empty_depot_name" class="col-sm-2 form-control-label">Empty Depot Name</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="empty_depot_name" id="empty_depot_name" class="form-control" value="<?php echo $empty_depot_name; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="material_code" class="col-sm-2 form-control-label">Material Code</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="material_code" id="material_code" class="form-control" value="<?php echo $material_code; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="material_description" class="col-sm-2 form-control-label">Material Description</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <textarea id="material_description" name="material_description" class="form-control" rows="3"><?php echo $material_description; ?></textarea>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="material_quality_code" class="col-sm-2 form-control-label">Material Quantity Code</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="material_quality_code" id="material_quality_code" class="form-control" value="<?php echo $material_quality_code; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shipping_line" class="col-sm-2 form-control-label">Shipping Line</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="shipping_line" id="shipping_line" class="form-control" value="<?php echo $shipping_line; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="supplier" class="col-sm-2 form-control-label">Supplier</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="supplier" id="supplier" class="form-control" value="<?php echo $supplier; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="seal_number" class="col-sm-2 form-control-label">Seal Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="seal_number" id="seal_number" class="form-control" value="<?php echo $seal_number; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="exchange_rate" class="col-sm-2 form-control-label">Exchange Rate</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $sel_yards = selectqry('*', TB_YARDS, array(), " `name` ASC ");
                                                                        ?>
                                                                        <select name="yard_id" id="yard_id" class="form-control">
                                                                            <option value="">Select Yard</option>
                                                                            <?php
                                                                            while( $row = mysqli_fetch_assoc($sel_yards) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>                                                                 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php
                                                            $sel_yards = selectqry('*', TB_YARDS, array(), " `name` ASC ");
                                                            ?>
                                                            <select name="yard_id" id="yard_id" class="form-control">
                                                                <option value="">Select Yard</option>
                                                                <?php
                                                                while( $row = mysqli_fetch_assoc($sel_yards) ):
                                                                    echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                endwhile;
                                                                ?>
                                                            </select>
                                                            
                                                            <div class="form-group row">
                                                                <label for="branch_code" class="col-sm-2 form-control-label">Branch Code</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="branch_code" id="branch_code" class="form-control" value="<?php echo $branch_code; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shipping_agent" class="col-sm-2 form-control-label">Shipping Agent</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="shipping_agent" id="shipping_agent" class="form-control" value="<?php echo $shipping_agent; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="transporter" class="col-sm-2 form-control-label">Transpoter</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="transporter" id="transporter" class="form-control" value="<?php echo $transporter; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shipped_to_storage" class="col-sm-2 form-control-label">Shipping to Storage</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="shipped_to_storage" id="shipped_to_storage" class="form-control" value="<?php echo $shipped_to_storage; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shifted_to_terminal" class="col-sm-2 form-control-label">Shifted To Terminal</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="shifted_to_terminal" id="shifted_to_terminal" class="form-control" value="<?php echo $shifted_to_terminal; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="terminal" class="col-sm-2 form-control-label">Terminal</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="terminal" id="terminal" class="form-control" value="<?php echo $terminal; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shifted_to_port" class="col-sm-2 form-control-label">Shifted To Port</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="shifted_to_port" id="shifted_to_port" class="form-control" value="<?php echo $shifted_to_port; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="port_of_loading" class="col-sm-2 form-control-label">Port Of Loading</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="port_of_loading" id="port_of_loading" class="form-control" value="<?php echo $port_of_loading; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="grn_number" class="col-sm-2 form-control-label">Grn Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="grn_number" id="grn_number" class="form-control" value="<?php echo $grn_number; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="grn_date" class="col-sm-2 form-control-label">Grn Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="grn_date" id="grn_date" class="form-control" value="<?php echo $grn_date; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="base_port_used_for_freight_costing" class="col-sm-2 form-control-label">Based Port Used For Freight Costing</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="base_port_used_for_freight_costing" id="base_port_used_for_freight_costing" class="form-control" value="<?php echo $base_port_used_for_freight_costing; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="ls_number" class="col-sm-2 form-control-label">Ls Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="ls_number" id="ls_number" class="form-control" value="<?php echo $ls_number; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="vo_number" class="col-sm-2 form-control-label">Vo Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="vo_number" id="vo_number" class="form-control" value="<?php echo $vo_number; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="status_super_admin" class="col-sm-2 form-control-label">Super Admin Status</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="text" name="status_super_admin" id="status_super_admin" class="form-control" value="<?php echo $status_super_admin; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="imagetrigger" class="col-sm-2 form-control-label">Image</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group file-group">
                                                                        <button id="imagetrigger" class="btn btn-primary" type="button">
                                                                            <span class="la la-cloud-upload ks-icon"></span>
                                                                            <span class="ks-text">Choose file</span>                                                                    
                                                                        </button>
                                                                        <span id="imagefilename" class="filepath"></span>                       
                                                                        <input type="file" name="image" id="image" value="" accept="image/*" style="display:none;" />                             
                                                                        <input type="hidden" name="himage" id="himage" value="<?php echo $image; ?>" />
                                                                    </div>
                                                                    <div class="input-group"><small>(Size: W 1770px X  H 853px)</small></div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            if ($image) {
                                                                ?>
                                                                <div class="form-group row">                                                            
                                                                    <label class="col-sm-2 form-control-label">&nbsp;</label>
                                                                    <div class="col-sm-10">                                                            	
                                                                        <div class="input-group">
                                                                            <a href="<?php echo URL_BASE . DIR_UPLOADS . $image; ?>" rel="viewimage"><img src="<?php echo URL_BASE . DIR_UPLOADS . $image; ?>" width="100"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                            
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
                    chk['s:country_id'] = "Country.";
                    chk['s:company_id'] = "Company.";
                    chk['s:yard_id'] = "Yard.";
                    chk['t:container_number'] = "Container Number.";
                    
                    if (check(chk, 1))
                        document.mainform.submit();                    
                    
                }                
                CKEDITOR.replace( 'material_description', {toolbar: 'Basic', height: 180} );
                $('#imagetrigger').click(function (e) {
                    $('#image').trigger('click');
                });
                $('#image').on('change', function () {
                    $('#imagefilename').html($(this).val());
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
    
    $image = uploadfile("image", $image, array("jpeg", "jpg", "gif", "png"));
    
    if ($_REQUEST['id']) {
        
        $arr = array(
            "users_groups_id"=>$_POST['users_groups_id'], 
            "first_name"=>$_POST['first_name'],
            "last_name"=>$_POST['last_name'],
            "phone"=>$_POST['phone'], 
            "location"=>replacequoteb($_POST['location']),
            "image"=>$image, 
            "status"=>$_POST['status'],
            "app_access_days"=>$_POST['app_access_days']              
        );    
        
        $update = updateqry($arr, array("id=" => $_REQUEST['id']), $table);        
        
    } else {
        
        $dQry = " SELECT id,email FROM ".$table." WHERE `email`='".$_REQUEST['email']."' OR `user_name`='".$_REQUEST['user_name']."' ";
        $dRes = mysqli_query($con, $dQry);
        
        if( mysqli_num_rows($dRes) ):
            
                $_SESSION['msg'] = 'User already registered, Plese try with another email and username |alert-error';    
                die;
        else:
            
            $arr = array(
                "users_groups_id"=>$_POST['users_groups_id'], 
                "user_name"=>$_POST['user_name'], 
                "first_name"=>$_POST['first_name'],
                "last_name"=>$_POST['last_name'],
                "email"=>$_POST['email'], 
                "password"=>encode($_POST['password']),
                "phone"=>$_POST['phone'], 
                "location"=>replacequoteb($_POST['location']),
                "image"=>$image, 
                "status"=>$_POST['status'],
                "app_access_days"=>$_POST['app_access_days'],
                "created_at"=>date('Y-m-d h:i:s')
            );  
        
            $insert = insertqry($arr, $table);
            $insertedid = getfieldmaxvalue('id', $table); 
                
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

?>