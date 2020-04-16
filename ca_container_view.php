<?php
include('includes/script_top.php');
?>
<?php
if (($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])) { ?>
    <?php
    $pagename = "Container Details";
    $listpagename = CA_CONTAINER_LIST;
    $table = TB_CONTAINERS;
    $created_at = date('Y-m-d H:i:s');
    
    if ($_REQUEST['id']) {
        
        $pagetype = "View";
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
                                            <div class="col-lg-12 ks-panels-column-section">
                                                <div class="card">                                                
                                                    <div class="card-block">
                                                        <h5 class="card-title"><?php echo $pagename; ?></h5>
                                                        <div>
                                                            
                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3 form-control-label">Status</label>
                                                                <div class="col-sm-9">
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
                                                                <label for="country_id" class="col-sm-3 form-control-label">Country / Origin</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $sel_contries = fetchqry('*', TB_COUNTRIES, array('id='=>$country_id));
                                                                        echo $sel_contries['name'];
                                                                        ?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group row">
                                                                <label for="company_id" class="col-sm-3 form-control-label">Company</label>
                                                                <div class="col-sm-9">
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
                                                                <label for="" class="col-sm-3 form-control-label">Empty Container Received date</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <?php echo date( 'd M, Y', strtotime($empty_container_received) ); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Container Placed Yard At</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <?php echo date( 'd M, Y', strtotime($container_placed_yard) ); ?>                                                                            
                                                                    </div>
                                                                </div>                                                 
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Name of Yard(Loading Site)</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <?php
                                                                        $yards = fetchqry('*', TB_YARDS, array('id='=>$yard_id), " `name` ASC ");
                                                                        echo $yards['name'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Container Number</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group" >
                                                                        <?php echo $container_number; ?>                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Container Size</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <?php 
                                                                        $container_size = fetchqry('*', TB_CONTAINER_SIZE, array('id='=>$container_size_id), " `name` ASC ");
                                                                        echo $container_size['name'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Tare Weight</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group" >
                                                                        <?php echo $tare_weight;?>                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Net Weight</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group" >
                                                                        <?php echo $net_weight;?>                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Net Weight Supplier</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group" >
                                                                        <?php echo $net_weight_supplier;?>                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Pay Load</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group" >
                                                                        <?php echo $pay_load;?>                                                                            
                                                                    </div>
                                                                </div>                                                                   
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Empty Depot Name</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group" >
                                                                        <?php
                                                                        $ed = fetchqry('*', TB_EMPTY_DEPOT, array('id='=>$empty_depot_name_id), " `name` ASC ");
                                                                        echo $ed['name'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Material Code</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group" >
                                                                        <?php
                                                                        $ed = fetchqry('*', TB_MATERIAL_CODE, array('id='=>$material_code_id), " `material_code` ASC ");
                                                                        echo $ed['material_code'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Material Description</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group" >
                                                                        <?php echo $material_description;?>                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>                                                        
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Material Quality Code</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group" >
                                                                        <?php echo $material_quality_code;?>                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Shipping Line</label>
                                                                <div class="col-sm-4">
                                                                    <div class="input-group" >
                                                                        <?php
                                                                        $shipping_line = fetchqry('*', TB_SHIPPING_LINE, array('id='=>$shipping_line_id) );
                                                                        echo $shipping_line['name'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="supplier_id" class="col-sm-3 form-control-label">Supplier</label>
                                                                <div class="col-sm-4">
                                                                    <div class="input-group" >
                                                                        <?php
                                                                        $supplier = fetchqry('*', TB_SUPPLIER, array('id='=>$supplier_id) );
                                                                        echo $supplier['name'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group row">
                                                                <label for="" class="col-sm-3 form-control-label">Seal Number</label>
                                                                <div class="col-sm-4">
                                                                    <div class="input-group" >
                                                                        <?php
                                                                        $s_number = fetchqry('*', TB_SEAL_NUMBERS, array('id='=>$seal_number_id) );
                                                                        echo $s_number['seal_number'];
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       
                                                                <!-- 1  Multiple-image_stock_pile images upload -->
                                                                <div class="form-group row">
                                                                    <label for="select_image_stock_pile" class="col-sm-3 form-control-label">Stock Pile Image</label>
                                                                    <div class="col-sm-9">
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
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>                          														                            
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                          
                                                                <!-- 2  Multiple: images_empty_container -->
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Empty Container Images</label>
                                                                    <div class="col-sm-9">
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
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                                
                                                                <!-- 3 Multiple: images_container_loading -->
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Container Loading Image</label>
                                                                    <div class="col-sm-9">
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
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- 4 Multiple: images_container_seal -->
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Container Seal Image</label>
                                                                    <div class="col-sm-9">
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
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- 5 Multiple: images_documents -->
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Container Document Image</label>
                                                                    <div class="col-sm-9">
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
                                                                                                <img data-dz-thumbnail="" src="<?php echo URL_BASE.DIR_UPLOADS.$resimages['image']; ?>" width="40" height="40">
                                                                                            </div>
                                                                                        </div>
                                                                                     <?php
                                                                                    endif;
                                                                                    $n++;
                                                                                 }
                                                                            endif;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Exchange Rate</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group" style="text-transform:capitalize;" >
                                                                            <?php echo $exchange_rate; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Branch Code</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php
                                                                            $branch_code = fetchqry('*', TB_BRANCH_CODE, array('id='=>$branch_code_id) );
                                                                            echo $branch_code['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Shipping Agent</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php
                                                                            $shipping_agent = fetchqry('*', TB_SHIPPING_AGENT, array('id='=>$shipping_agent_id) );
                                                                            echo $shipping_agent['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Transporter</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group" style="text-transform:capitalize;">
                                                                            <?php echo $transporter; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Shifted To Storage</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo date( 'd M, Y', strtotime($shipped_to_storage) ); ?>                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="storage" class="col-sm-3 form-control-label">Storage</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $storage; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Shifted To Terminal</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo date( 'd M, Y', strtotime($shifted_to_terminal) ); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Terminal</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $terminal; ?>                        
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Shifted To Port</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo date( 'd M, Y', strtotime($shifted_to_port) ); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Port Of Loading</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $port_of_loading; ?>                        
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Grn Number</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $grn_number; ?>                        
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">GRN Date</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo date( 'd M, Y', strtotime($grn_date) ); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Base Port Used For Freight Costing</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group" >
                                                                            <?php
                                                                            $tmp = fetchqry( '*', TB_BASE_PORT_USED_FOR_FREIGHT_COSTING, array('id='=>$base_port_used_for_freight_costing) );
                                                                            echo $tmp['name'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">LS Number</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $ls_number; ?>                        
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">VO Number</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $vo_number; ?>                        
                                                                        </div>
                                                                    </div>
                                                                </div>                                                                                                                
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Status</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
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
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Vessel Name</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $vessel_name; ?>                        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Voyage</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $voyage; ?>                        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">SOB Date</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $sob_date; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">BLI Date</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $bli_date; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">Original BL Number</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $original_bl_number; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">HO Order Number</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $ho_order_number; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="" class="col-sm-3 form-control-label">EX Yard Price</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            <?php echo $ex_yard_price; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        
                                                            <!-- CNF -->
                                                            <div class="form-group row">
                                                                <label for="cnf1" class="col-sm-3 form-control-label">CNF</label>
                                                                <div class="col-sm-2">
                                                                    <div class="form-control dark" >
                                                                        <?php 
                                                                        $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$cnf1) );
                                                                        echo $tmp['name'].' ('.$tmp['symbol'].')';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="form-control dark" >
                                                                        <?php 
                                                                        $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$cnf2) );
                                                                        echo $tmp['name'].' ('.$tmp['symbol'].')';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="form-control dark" >
                                                                        <?php 
                                                                        $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$cnf3) );
                                                                        echo $tmp['name'].' ('.$tmp['symbol'].')'; 
                                                                        ?>
                                                                    </div>
                                                                </div>                                                              
                                                            </div>
                                                                
                                                            <!-- FOB -->
                                                            <div class="form-group row">
                                                                <label for="fob1" class="col-sm-3 form-control-label">FOB</label>
                                                                <div class="col-sm-2">
                                                                    <div class="form-control dark" >
                                                                        <?php 
                                                                        $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fob1) );
                                                                        echo $tmp['name'].' ('.$tmp['symbol'].')';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="form-control dark" >
                                                                        <?php 
                                                                        $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fob2) );
                                                                        echo $tmp['name'].' ('.$tmp['symbol'].')';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="form-control dark" >
                                                                        <?php 
                                                                        $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fob3) );
                                                                        echo $tmp['name'].' ('.$tmp['symbol'].')';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                            <!-- FCA -->
                                                            <div class="form-group row">
                                                                <label for="fca1" class="col-sm-3 form-control-label">FCA</label>
                                                                <div class="col-sm-2">
                                                                    <div class="form-control dark" >
                                                                        <?php 
                                                                        $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fca1) );
                                                                        echo $tmp['name'].' ('.$tmp['symbol'].')'; 
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="form-control dark" >
                                                                        <?php 
                                                                        $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fca2) );
                                                                        echo $tmp['name'].' ('.$tmp['symbol'].')';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="form-control dark" >
                                                                        <?php 
                                                                        $tmp = fetchqry('*', TB_CURRENCY, array('id='=>$fca3) );
                                                                        echo $tmp['name'].' ('.$tmp['symbol'].')';
                                                                        ?>
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