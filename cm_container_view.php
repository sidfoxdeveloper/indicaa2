<?php
include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])) { ?>
    <?php
    $pagename = "Container";
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
    
    $empty_depot = fetchqry('*', TB_EMPTY_DEPOT, array('id='=>$empty_depot_name_id) );
    $empty_depot_name = $empty_depot['name'];
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
                                                                <label for="status" class="col-sm-2 form-control-label">Status</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                            if($status == 'draft'):
                                                                                echo '<button class="btn btn-default" >Draft</button';
                                                                            elseif($status == 'pending_upload'):    
                                                                                echo '<button class="btn btn-primary" >Pending Upload</button>';
                                                                            elseif($status == 'not_verified_by_country_manager'):    
                                                                                echo '<button class="btn btn-danger" >Not verified</button>';
                                                                            elseif($status == 'verified_by_country_manager'):        
                                                                                echo '<button class="btn btn-success" >Verified</button>';
                                                                            endif;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            
                                                            <div class="form-group row">
                                                                <label for="country_id" class="col-sm-2 form-control-label">Country</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $sel_contries = fetchqry('*', TB_COUNTRIES, array('id='=>$country_id));
                                                                        echo $sel_contries['name'];
                                                                        ?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="company_id" class="col-sm-2 form-control-label">Company</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $qCom = mysqli_query($con, "SELECT * FROM `".TB_COMPANIES."` WHERE id='".$company_id."' ");
                                                                        $company = mysqli_fetch_assoc($qCom);                                                                       
                                                                        echo $company['name'];                                                                        
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="yard_id" class="col-sm-2 form-control-label">Yard</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $qYard = mysqli_query($con, "SELECT * FROM `".TB_YARDS."` WHERE id='".$yard_id."' ");
                                                                        $yard = mysqli_fetch_assoc($qYard);                                                                       
                                                                        echo $yard['name'];                                                                        
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="empty_container_received" class="col-sm-2 form-control-label">Empty Container Received At</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">                         
                                                                        <?php echo date('d M,Y', strtotime($empty_container_received));?>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="container_placed_yard" class="col-sm-2 form-control-label">Container Placed Yard At</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo date('d M,Y', strtotime($container_placed_yard));?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="container_number" class="col-sm-2 form-control-label">Container Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $container_number; ?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="container_size_id" class="col-sm-2 form-control-label">Container Size</label>
                                                                <div class="col-sm-10">
                                                                    <div class="">
                                                                        <?php
                                                                        $qcSize = mysqli_query($con, "SELECT * FROM `".TB_CONTAINER_SIZE."` WHERE id='".$container_size_id."' ");
                                                                        $size = mysqli_fetch_assoc($qcSize);                                                                       
                                                                        echo $size['name'];                                                                        
                                                                        ?>                                                                      
                                                                    </div>
                                                                </div>
                                                            </div>                       
                                                            <div class="form-group row">
                                                                <label for="tare_weight" class="col-sm-2 form-control-label">Tare Weight</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $tare_weight; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="gross_weight" class="col-sm-2 form-control-label">Gross Weight</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $gross_weight; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="net_weight" class="col-sm-2 form-control-label">Net Weight</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $net_weight; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="net_weight_supplier" class="col-sm-2 form-control-label">Net Weight Supplier</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $net_weight_supplier; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="net_weight_yard" class="col-sm-2 form-control-label">Net Weight Yard</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $net_weight_yard; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="pay_load" class="col-sm-2 form-control-label">Pay Load</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $pay_load; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="empty_depot_name_id" class="col-sm-2 form-control-label">Empty Depot Name</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $empty_depot_name; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="material_code" class="col-sm-2 form-control-label">Material Code</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $material_code; ?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="material_description" class="col-sm-2 form-control-label">Material Description</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $material_description; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="material_quality_code" class="col-sm-2 form-control-label">Material Quantity Code</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $material_quality_code; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shipping_line_id" class="col-sm-2 form-control-label">Shipping Line</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $shipping_line = fetchqry('*', TB_SHIPPING_LINE, array('id='=>$shipping_line_id)  );
                                                                        echo $shipping_line['name'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="supplier" class="col-sm-2 form-control-label">Supplier</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $supplier = fetchqry('*', TB_SUPPLIER, array('id='=>$shipping_line_id)  );
                                                                        echo $supplier['name'];
                                                                        ?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="seal_number" class="col-sm-2 form-control-label">Seal Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $seal_number_id = explode(',', $seal_number);                                                                        
                                                                        foreach($seal_number_id as $sn):
                                                                            echo $sn;
                                                                            $seal_number = fetchqry( '*', TB_SEAL_NUMBERS, array('id='=>$sn)  );
                                                                            echo $seal_number['seal_number'].', ';
                                                                        endforeach;                                                                        
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="yard" class="col-sm-2 form-control-label">Yard</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $yard = fetchqry('*', TB_YARDS, array('id='=>$yard_id)  );
                                                                        echo $yard['name'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group row">
                                                                <label for="branch_code" class="col-sm-2 form-control-label">Branch Code</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                            $branch_codes = explode(',', $branch_code_id);
                                                                            
                                                                            foreach ($branch_codes as $row):
                                                                                $i = 0;
                                                                                $row1 = fetchqry('*', TB_BARCODES, array('id='=>$row) );
                                                                                echo $row1['name'].'<br>';
                                                                                $i = $i+1;
                                                                            endforeach;                                                                            
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shipping_agent" class="col-sm-2 form-control-label">Shipping Agent</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $shipping_agent = fetchqry('*', TB_SHIPPING_AGENT, array('id='=>$shipping_agent_id)  );
                                                                        echo $shipping_agent['name'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="transporter" class="col-sm-2 form-control-label">Transpoter</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        echo $transporter;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shipped_to_storage" class="col-sm-2 form-control-label">Shipping to Storage</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo date('d M, Y', strtotime($shipped_to_storage));?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shifted_to_terminal" class="col-sm-2 form-control-label">Shifted To Terminal</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo date('d M, Y', strtotime($shipped_to_storage));?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="terminal" class="col-sm-2 form-control-label">Terminal</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $terminal;?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="shifted_to_port" class="col-sm-2 form-control-label">Shifted To Port</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo date('d M, Y', strtotime($shifted_to_port));?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="port_of_loading" class="col-sm-2 form-control-label">Port Of Loading</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $port_of_loading; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="grn_number" class="col-sm-2 form-control-label">Grn Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $grn_number; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="grn_date" class="col-sm-2 form-control-label">Grn Date</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo date('d M, Y', strtotime($grn_date));?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="base_port_used_for_freight_costing" class="col-sm-2 form-control-label">Based Port Used For Freight Costing</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $base_port_used_for_freight_costing; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="ls_number" class="col-sm-2 form-control-label">Ls Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $ls_number; ?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="vo_number" class="col-sm-2 form-control-label">Vo Number</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <?php echo $vo_number; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">                                                            
                                                                <label class="col-sm-2 form-control-label">Stock Pile</label>
                                                                <div class="col-sm-10">                                                            	
                                                                    <div class="input-group">
                                                                        <a href="<?php echo URL_BASE . DIR_UPLOADS . $image_stock_pile; ?>"  target="_blank" rel="viewimage"><img src="<?php echo URL_BASE . DIR_UPLOADS . $image_stock_pile; ?>" width="100"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">                                                            
                                                                <label class="col-sm-2 form-control-label">Empty Container</label>
                                                                <div class="col-sm-10">                                                            	
                                                                    <div class="input-group">
                                                                        <a href="<?php echo URL_BASE . DIR_UPLOADS . $image_empty_container; ?>"  target="_blank" rel="viewimage"><img src="<?php echo URL_BASE . DIR_UPLOADS . $image_empty_container; ?>" width="100"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">                                                            
                                                                <label class="col-sm-2 form-control-label">Container Loading</label>
                                                                <div class="col-sm-10">                                                            	
                                                                    <div class="input-group">
                                                                        <a href="<?php echo URL_BASE . DIR_UPLOADS . $image_container_loading; ?>"  target="_blank" rel="viewimage"><img src="<?php echo URL_BASE . DIR_UPLOADS . $image_container_loading; ?>" width="100"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">                                                            
                                                                <label class="col-sm-2 form-control-label">Container Seal</label>
                                                                <div class="col-sm-10">                                                            	
                                                                    <div class="input-group">
                                                                        <a href="<?php echo URL_BASE . DIR_UPLOADS . $image_container_seal; ?>"  target="_blank" rel="viewimage"><img src="<?php echo URL_BASE . DIR_UPLOADS . $image_container_seal; ?>" width="100"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">                                                            
                                                                <label class="col-sm-2 form-control-label">Documents</label>
                                                                <div class="col-sm-10">                                                            	
                                                                    <div class="input-group">
                                                                        <a href="<?php echo URL_BASE . DIR_UPLOADS . $image_documents; ?>"  target="_blank" rel="viewimage"><img src="<?php echo URL_BASE . DIR_UPLOADS . $image_documents;?>" width="100"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                                                                        
                                                            <div class="form-group row">
                                                                <div class="col-sm-6"></div>
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
            
        </body>
    </html>
    <?php
    /** Check Page Authantication **/
} else {
    include(DIR_BASEADMIN . DIR_INCLUDES . INC_DONTACCESSMSG);
}
    
if (isset($_POST['addnew'])) {
    
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