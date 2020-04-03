<?php
include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])) { ?>
    <?php
    $pagename = "Container";
    $editpagename = CM_CONTAINER_EDIT;
    $listpagename = CM_CONTAINERS_LIST;
    $table = TB_CONTAINERS;
    $created_at = date('Y-m-d H:i:s');
    
    if ($_REQUEST['id']) {
        
        $pagetype = "Edit";
        $data = fetchqry("*", $table, array("id=" => $_REQUEST['id']));
        $containerImage = fetchqry("*", TB_CONTAINER_IMAGES, array("container_id=" => $_REQUEST['id']));
        
        $image_stock_pile = empty($containerImage['image_stock_pile']) ? "not-available.png" : $containerImage['image_stock_pile'];
        $image_empty_container = empty($containerImage['image_empty_container']) ? "not-available.png" : $containerImage['image_empty_container'];
        $image_container_loading = empty($containerImage['image_container_loading']) ? "not-available.png" : $containerImage['image_container_loading'];
        $image_container_seal = empty($containerImage['image_container_seal']) ? "not-available.png" : $containerImage['image_container_seal'];
        $image_documents = empty($containerImage['image_documents']) ? "not-available.png" : $containerImage['image_documents'];
        
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
        $material_code = $data['material_code'];
        $material_description = $data['material_description'];
        $material_quality_code = $data['material_quality_code'];
        $shipping_line_id = $data['shipping_line_id'];
        $supplier = $data['supplier'];
        $seal_number = $data['seal_number'];
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
        $bli_number = $data['bli_number'];
        $original_bl_number = $data['original_bl_number'];
        $ho_order_number = $data['ho_order_number'];
        $ex_yard_price = $data['ex_yard_price'];
        $cnf = $data['cnf'];
        $fob = $data['fob'];
        $fca = $data['fca'];
        $created_at = date( 'd F, Y', strtotime($data['created_at']) );
        
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
                                            <div class="col-lg-12 ks-panels-column-section">
                                                <div class="card">                                                
                                                    <div class="card-block">
                                                        
                                                        <div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label"></label>
                                                                <div class="col-sm-4 text-center">
                                                                    <strong>Values enter by INSPECTOR</strong>
                                                                </div>
                                                                <div class="col-sm-4 text-center">
                                                                    <strong>Modification by CM</strong>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Company</label>
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
                                                                            <option value="">Select Company</option>
                                                                            <?php
                                                                            $company = selectqry( '*', TB_COMPANIES );
                                                                            while( $row = mysqli_fetch_assoc($company) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>    
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Country / Origin</label>
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
                                                                            <option value="">Select Inspector Country</option>
                                                                            <?php
                                                                            while( $row = mysqli_fetch_assoc($sel_contries) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>    
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Empty Container Received date</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($empty_container_received) ); ?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="empty_container_received" id="empty_container_received" class="form-control" > 
                                                                    </div>    
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Container Placed Yard At</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($container_placed_yard) ); ?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="container_placed_yard" id="container_placed_yard" class="form-control" > 
                                                                    </div>    
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Name of Yard(Loading Site)</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $yards = fetchqry('*', TB_YARDS, array(), " `name` ASC ");
                                                                            echo $yards['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="yard_id" id="yard_id" class="form-control">
                                                                            <option value="">Select Yard</option>
                                                                            <?php
                                                                            $sel_yards = selectqry('*', TB_YARDS, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($sel_yards) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="container_number" class="col-sm-3 form-control-label">Container Number</label>
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
                                                                    <label for="container_size" class="col-sm-3 form-control-label">Container Size</label>
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
                                                                            <option value="">Select Container Size</option>
                                                                            <?php
                                                                            $sel = selectqry('*', TB_CONTAINER_SIZE, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($sel) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>    
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="tare_weight" class="col-sm-3 form-control-label">Tare Weight</label>
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
                                                                    <label for="net_weight" class="col-sm-3 form-control-label">Net Weight</label>
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
                                                                    <label for="net_weight_supplier" class="col-sm-3 form-control-label">Net Weight Supplier</label>
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
                                                                    <label for="pay_load" class="col-sm-3 form-control-label">Pay Load</label>
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
                                                                            $ed = fetchqry('*', TB_EMPTY_DEPOT, array(), " `name` ASC ");
                                                                            echo $ed['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="empty_depot_name_id" id="empty_depot_name_id" class="form-control">
                                                                            <option value="">Select Empty Depot</option>
                                                                            <?php
                                                                            $sel_ed = selectqry('*', TB_EMPTY_DEPOT, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($sel_ed) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
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
                                                                            $ed = fetchqry('*', TB_MATERIAL_CODE, array(), " `material_code` ASC ");
                                                                            echo $ed['material_code'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="material_code_id" id="material_code_id" class="form-control">
                                                                            <option value="">Select Material Code</option>
                                                                            <?php
                                                                            $sel_ed = selectqry('*', TB_MATERIAL_CODE, array(), " `material_code` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($sel_ed) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['material_code'].'</option>';
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
                                                                            $shipping_line = fetchqry('*', TB_SHIPPING_LINE, array() );
                                                                            echo $shipping_line['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="shipping_line_id" id="shipping_line_id" class="form-control">
                                                                            <option value="">Select Shipping Line</option>
                                                                            <?php
                                                                            $shipping = selectqry('*', TB_SHIPPING_LINE, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($shipping) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
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
                                                                            $supplier = fetchqry('*', TB_SUPPLIER, array() );
                                                                            echo $supplier['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="supplier_id" id="supplier_id" class="form-control">
                                                                            <option value="">Select Supplier</option>
                                                                            <?php
                                                                            $supplier = selectqry('*', TB_SUPPLIER, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($supplier) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="seal_number" class="col-sm-3 form-control-label">Seal Number</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            $s_number = fetchqry('*', TB_SEAL_NUMBERS, array('id='=>$seal_number) );
                                                                            echo $s_number['seal_number'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="seal_number[]" id="seal_number" class="form-control">
                                                                            <option value="">Select Seal Number</option>
                                                                            <?php
                                                                            $seal = selectqry('*', TB_SEAL_NUMBERS, array(), " `seal_number` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($seal) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['seal_number'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="image_stock_pile" class="col-sm-3 form-control-label">Stock Pile Image</label>
                                                                    <div class="col-sm-4">
                                                                        <div>
                                                                            <img src="<?php echo URL_BASE.DIR_UPLOADS.$image_stock_pile; ?>" width="50px" height="50px" />                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <button id="image_stock_pile_trigger" class="btn btn-primary" type="button">
                                                                                <span class="la la-cloud-upload ks-icon"></span>
                                                                                <span class="ks-text">Choose file</span>                                                                    
                                                                            </button>
                                                                            <span id="image_stock_pile_filename" class="filepath"></span>                       
                                                                            <input type="file" name="image_stock_pile" id="image_stock_pile" value="" accept="image/*" style="display:none;" />
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="image_empty_container" class="col-sm-3 form-control-label">Empty Container Image</label>
                                                                    <div class="col-sm-4">
                                                                        <div>
                                                                            <img src="<?php echo URL_BASE.DIR_UPLOADS.$image_empty_container; ?>" width="50px" height="50px" />                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <button id="image_empty_container_trigger" class="btn btn-primary" type="button">
                                                                                <span class="la la-cloud-upload ks-icon"></span>
                                                                                <span class="ks-text">Choose file</span>                                                                    
                                                                            </button>
                                                                            <span id="image_empty_container_filename" class="filepath"></span>                       
                                                                            <input type="file" name="image_empty_container" id="image_empty_container" value="" accept="image/*" style="display:none;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="image_container_loading" class="col-sm-3 form-control-label">Container Loading Image</label>
                                                                    <div class="col-sm-4">
                                                                        <div>
                                                                            <img src="<?php echo URL_BASE.DIR_UPLOADS.$image_container_loading; ?>" width="50px" height="50px" />                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <button id="image_container_loading_trigger" class="btn btn-primary" type="button">
                                                                                <span class="la la-cloud-upload ks-icon"></span>
                                                                                <span class="ks-text">Choose file</span>                                                                    
                                                                            </button>
                                                                            <span id="image_container_loading_filename" class="filepath"></span>                       
                                                                            <input type="file" name="image_container_loading" id="image_container_loading" value="" accept="image/*" style="display:none;" />
                                                                        </div>
                                                                    </div>   
                                                                </div>  
                                                                
                                                                <div class="form-group row">
                                                                    <label for="image_container_seal" class="col-sm-3 form-control-label">Container Seal Image</label>
                                                                    <div class="col-sm-4">
                                                                        <div>
                                                                            <img src="<?php echo URL_BASE.DIR_UPLOADS.$image_container_seal; ?>" width="50px" height="50px" />                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <button id="image_container_seal_trigger" class="btn btn-primary" type="button">
                                                                                <span class="la la-cloud-upload ks-icon"></span>
                                                                                <span class="ks-text">Choose file</span>                                                                    
                                                                            </button>
                                                                            <span id="image_container_seal_filename" class="filepath"></span>                       
                                                                            <input type="file" name="image_container_seal" id="image_container_seal" value="" accept="image/*" style="display:none;" />
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="image_documents" class="col-sm-3 form-control-label">Container Document Image</label>
                                                                    <div class="col-sm-4">
                                                                        <div>
                                                                            <img src="<?php echo URL_BASE.DIR_UPLOADS.$image_documents; ?>" width="50px" height="50px" />                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="input-group file-group">
                                                                            <button id="image_documents_trigger" class="btn btn-primary" type="button">
                                                                                <span class="la la-cloud-upload ks-icon"></span>
                                                                                <span class="ks-text">Choose file</span>                                                                    
                                                                            </button>
                                                                            <span id="image_documents_filename" class="filepath"></span>                       
                                                                            <input type="file" name="image_documents" id="image_documents" value="" accept="image/*" style="display:none;" />
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="exchange_rate" class="col-sm-3 form-control-label">Exchange Rate</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" style="text-transform:capitalize;" >
                                                                            <?php echo $exchange_rate; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="exchange_rate" id="exchange_rate" class="form-control">
                                                                            <option value="">Exchange Rate</option>
                                                                            <option value="master" >Master</option>
                                                                            <option value="optional" >Optional</option>                                                                            
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="branch_code_id" class="col-sm-3 form-control-label">Branch Code</label>
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
                                                                            <option value="">Select Branch Code</option>
                                                                            <?php
                                                                            $branch_code = selectqry('*', TB_BRANCH_CODE, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($branch_code) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="shipping_agent_id" class="col-sm-3 form-control-label">Shipping Agent</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php
                                                                            echo $shipping_agent_id;
                                                                            $shipping_agent = fetchqry('*', TB_SHIPPING_AGENT, array('id='=>$shipping_agent_id) );
                                                                            echo $shipping_agent['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="shipping_agent_id" id="shipping_agent_id" class="form-control">
                                                                            <option value="">Select Shipping Agent</option>
                                                                            <?php
                                                                            $shipping_agent = selectqry('*', TB_SHIPPING_AGENT, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($shipping_agent) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="transporter" class="col-sm-3 form-control-label">Transporter</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $transporter; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <select name="transporter" id="transporter" class="form-control">
                                                                            <option value="">Select Transporter</option>
                                                                            <option value="yes">Yes</option>
                                                                            <option value="no">No</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="shipped_to_storage" class="col-sm-3 form-control-label">Shifted To Storage</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($shipped_to_storage) ); ?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="shipped_to_storage" id="shipped_to_storage" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="storage" class="col-sm-3 form-control-label">Storage</label>
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
                                                                    <label for="shifted_to_terminal" class="col-sm-3 form-control-label">Shifted To Terminal</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($shifted_to_terminal) ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="shifted_to_terminal" id="shifted_to_terminal" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="terminal" class="col-sm-3 form-control-label">Terminal</label>
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
                                                                    <label for="shifted_to_port" class="col-sm-3 form-control-label">Shifted To Port</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($shifted_to_port) ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="shifted_to_port" id="shifted_to_port" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="port_of_loading" class="col-sm-3 form-control-label">Port Of Loading</label>
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
                                                                    <label for="grn_number" class="col-sm-3 form-control-label">Grn Number</label>
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
                                                                    <label for="grn_date" class="col-sm-3 form-control-label">GRN Date</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo date( 'd M, Y', strtotime($grn_date) ); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="grn_date" id="grn_date" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                
                                                                <div class="form-group row">
                                                                    <label for="base_port_used_for_freight_costing" class="col-sm-3 form-control-label">Shipping Agent</label>
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
                                                                            <option value="">Select Shipping Agent</option>
                                                                            <?php
                                                                            $tmp = selectqry('*', TB_BASE_PORT_USED_FOR_FREIGHT_COSTING, array(), " `name` ASC ");
                                                                            while( $row = mysqli_fetch_assoc($tmp) ):
                                                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
                                                                            endwhile;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                        
                                                                <div class="form-group row">
                                                                    <label for="ls_number" class="col-sm-3 form-control-label">LS Number</label>
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
                                                                    <label for="vo_number" class="col-sm-3 form-control-label">VO Number</label>
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
                                                                    <label for="vo_number" class="col-sm-3 form-control-label">VO Number</label>
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
                                                                    <label for="status" class="col-sm-3 form-control-label">Status</label>
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
                                                                            <option value="verified_by_country_manager">Verified</option>
                                                                            <option value="not_verified_by_country_manager">Not Verified</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="vessel_name" class="col-sm-3 form-control-label">Vessel Name</label>
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
                                                                    <label for="voyage" class="col-sm-3 form-control-label">Voyage</label>
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
                                                                    <label for="bli_number" class="col-sm-3 form-control-label">SOB Date</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $bli_number; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="bli_number" id="bli_number" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="original_bl_number" class="col-sm-3 form-control-label">Original BL Number</label>
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
                                                                    <label for="ho_order_number" class="col-sm-3 form-control-label">HO Order Number</label>
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
                                                                    <label for="ex_yard_price" class="col-sm-3 form-control-label">EX Yard Price</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $ex_yard_price; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="ex_yard_price" id="ex_yard_price" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="cnf" class="col-sm-3 form-control-label">CNF</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $cnf; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="cnf" id="cnf" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="fob" class="col-sm-3 form-control-label">FOB</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $fob; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="fob" id="fob" class="form-control" > 
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="fca" class="col-sm-3 form-control-label">FCA</label>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-control dark" >
                                                                            <?php echo $fca; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="fca" id="fca" class="form-control" > 
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
            
            <script> 
                function chkrequired() {
                    var chk = new Array();
                    if (check(chk, 1))
                        document.mainform.submit();
                }
                
                CKEDITOR.replace( 'material_description', {toolbar: 'Basic', height: 180} );
                
                $('#image_stock_pile_trigger').click(function (e) {
                    $('#image_stock_pile').trigger('click');
                });
                $('#image_stock_pile').on('change', function () {
                    $('#image_stock_pile_filename').html($(this).val());
                });
                
                $('#image_empty_container_trigger').click(function (e) {
                    $('#image_empty_container').trigger('click');
                });
                $('#image_empty_container').on('change', function () {
                    $('#image_empty_container_filename').html($(this).val());
                });
                
                $('#image_container_loading_trigger').click(function (e) {
                    $('#image_container_loading').trigger('click');
                });
                $('#image_container_loading').on('change', function () {
                    $('#image_container_loading_filename').html($(this).val());
                });
                
                $('#image_container_seal_trigger').click(function (e) {
                    $('#image_container_seal').trigger('click');
                }); 
                $('#image_container_seal').on('change', function () {
                    $('#image_container_seal_filename').html($(this).val());
                });
                
                $('#image_documents_trigger').click(function (e) {
                    $('#image_documents').trigger('click');
                });
                $('#image_documents').on('change', function () {
                    $('#image_documents_filename').html($(this).val());
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
        if( !isEmpty($_POST['seal_number']) ):
                $sn = implode(',', $_POST['seal_number']);
                $arr['seal_number'] = $sn;
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
        if( !isEmpty($_POST['']) ):
                $arr[''] = $_POST[''];
        endif;
//        if( !isEmpty($_POST['']) ):
//                $arr[''] = $_POST[''];
//        endif;
//        if( !isEmpty($_POST['']) ):
//                $arr[''] = $_POST[''];
//        endif;
//        if( !isEmpty($_POST['']) ):
//                $arr[''] = $_POST[''];
//        endif;
//        if( !isEmpty($_POST['']) ):
//                $arr[''] = $_POST[''];
//        endif;
        
        
        
        if( count($arr) > 0 ):
            $update = updateqry($arr, array("id=" => $_REQUEST['id']), $table);
        endif;
        
        // Upload Image
        $arr_img =  array();
        $image_stock_pile = uploadfile("image", $_FILES['image_stock_pile'], array("jpeg", "jpg", "gif", "png"));
        $image_empty_container = uploadfile("image", $_FILES['image_empty_container'], array("jpeg", "jpg", "gif", "png"));
        $image_container_loading = uploadfile("image", $_FILES['image_container_loading'], array("jpeg", "jpg", "gif", "png"));
        $image_container_seal = uploadfile("image", $_FILES['image_container_seal'], array("jpeg", "jpg", "gif", "png"));
        $image_documents = uploadfile("image", $_FILES['image_documents'], array("jpeg", "jpg", "gif", "png"));
        
        if( !isEmpty($image_stock_pile) ):
                $arr_img['image_stock_pile'] = $image_stock_pile;
        endif;
        if( !isEmpty($image_empty_container) ):
                $arr_img['image_empty_container'] = $image_empty_container;
        endif;
        if( !isEmpty($image_container_loading) ):
                $arr_img['image_container_loading'] = $image_container_loading;
        endif;
        if( !isEmpty($image_container_seal) ):
                $arr_img['image_container_seal'] = $image_container_seal;
        endif;
        if( !isEmpty($image_documents) ):
                $arr_img['image_documents'] = $image_documents;
        endif;
        
        if( count($arr_img) > 0 ):
            $update = updateqry( $arr_img, array("container_id=" => $_REQUEST['id']), TB_CONTAINER_IMAGES );  
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