<?php

include('includes/script_top.php');

    $pagename = "Archieve";
    $editpagename = CM_CONTAINERS_LIST;
    $listpagename = CM_CONTAINERS_LIST;
    $table = TB_CONTAINER_ARCHIEVE;
    $created_at = date('Y-m-d H:i:s');
    
    if ($_REQUEST['id']) {
        
        $pagetype = "Edit";
        $data = fetchqry("*", TB_CONTAINERS, array("id="=>$_REQUEST['id']));
        $containerImage = fetchqry("*", TB_CONTAINER_IMAGES, array("container_id="=>$_REQUEST['id']));
        
        $image_stock_pile = empty($containerImage['image_stock_pile']) ? "not-available.png" : $containerImage['image_stock_pile'];
        $image_empty_container = empty($containerImage['image_empty_container']) ? "not-available.png" : $containerImage['image_empty_container'];
        $image_container_loading = empty($containerImage['image_container_loading']) ? "not-available.png" : $containerImage['image_container_loading'];
        $image_container_seal = empty($containerImage['image_container_seal']) ? "not-available.png" : $containerImage['image_container_seal'];
        $image_documents = empty($containerImage['image_documents']) ? "not-available.png" : $containerImage['image_documents'];
        
        $user_id = $data['user_id'];
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
        $port_of_destination = $data['port_of_destination'];
        $pay_load = $data['pay_load'];
        $empty_depot_name_id = $data['empty_depot_name_id'];
        $material_code_id = $data['material_code_id'];
        $material_description = $data['material_description'];
        $material_quality_code = $data['material_quality_code'];
        $shipping_line_id = $data['shipping_line_id'];
        $supplier = $data['supplier'];
        $seal_number = $data['seal_number'];
        $remarks = $data['remarks'];
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
        $created_at = date('Y-m-d H:i:s');
        
        //Add Container
        $arr = array( 
                    "container_id"=>$_REQUEST['id'],
                    "user_id"=>$user_id,
                    "country_id"=>$country_id, 
                    "company_id"=>$company_id, 
                    "yard_id"=>$yard_id, 
                    "container_size_id"=>$container_size_id,
                    "empty_depot_name_id"=>$empty_depot_name_id,
                    "shipping_line_id"=>$shipping_line_id,
                    "supplier_id"=>$supplier_id,
                    "branch_code_id"=>$branch_code_id,
                    "shipping_agent_id"=>$shipping_agent_id,
                    "empty_container_received"=>$empty_container_received,
                    "container_placed_yard"=>$container_placed_yard,                             
                    "container_number"=>$container_number, 
                    "tare_weight"=>$tare_weight,
                    "gross_weight"=>$gross_weight,                                      
                    "net_weight"=>$net_weight,
                    "net_weight_supplier"=>$net_weight_supplier,
                    "net_weight_yard"=>$net_weight_yard,
                    "port_of_destination"=>$port_of_destination,
                    "pay_load"=>$pay_load,
                    "material_code_id"=>$material_code_id,
                    "material_description"=>$material_description,
                    "material_quality_code"=>$material_quality_code,
                    "seal_number"=>$seal_number,
                    "remarks"=>$remarks,
                    "exchange_rate"=>$exchange_rate,
                    "transporter"=>$transporter,
                    "shipped_to_storage"=>$shipped_to_storage,
                    "storage"=>$storage,
                    "shifted_to_terminal"=>$shifted_to_terminal,
                    "terminal"=>$terminal,
                    "shifted_to_port"=>$shifted_to_port,
                    "port_of_loading"=>$port_of_loading,
                    "grn_number"=>$grn_number,
                    "grn_date"=>$grn_date,
                    "base_port_used_for_freight_costing"=>$base_port_used_for_freight_costing,
                    "ls_number"=>$ls_number,
                    "vo_number"=>$vo_number,
                    "status_super_admin"=>$status_super_admin,
                    "status"=>$status,
                    "vessel_name"=>$vessel_name,
                    "voyage"=>$voyage,
                    "sob_date"=>$sob_date,
                    "bli_number"=>$bli_number,
                    "original_bl_number"=>$original_bl_number,
                    "ho_order_number"=>$ho_order_number,
                    "ex_yard_price"=>$ex_yard_price,
                    "cnf"=>$cnf,
                    "fob"=>$fob,
                    "fca"=>$fca,
                    'image_stock_pile'=>$image_stock_pile, 
                    'image_empty_container'=>$image_empty_container,
                    'image_container_loading'=>$image_container_loading,
                    'image_container_seal'=>$image_container_seal,
                    'image_documents'=>$image_documents,
                    "created_at"=>date('Y-m-d h:i:s')
                );
        
        $insert = insertqry($arr, $table);
        
    }
    
    
    if ( $insert )
        $_SESSION['msg'] = 'Action performed successfully.|alert-success';
    else
        $_SESSION['msg'] = 'Action not performed successfully.|alert-error';

    if ($_POST['addnew'] == 1)
        header("Location:" . $_SERVER['PHP_SELF'] . $gobackurl . '&id=' . $updateid);
    else if ($_POST['addnew'] == 2)
        header("Location:" . $_SERVER['PHP_SELF']);
    else
        header("Location:" . $listpagename . $gobackurl);
    


?>