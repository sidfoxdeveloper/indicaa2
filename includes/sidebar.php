<?php
    $CP = substr( $_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'], "indicaa") + strlen("/indicaa") );
?>
<div class="ks-column ks-sidebar ks-info">
    <div class="ks-wrapper ks-sidebar-wrapper">
        <ul class="nav nav-pills nav-stacked">
            
            <?php if( decode($_SESSION['groupuserid']) == 1 ): ?>
            
                <li class="nav-item dropdown <?php if($CP == SA_USER_LIST || $CP == SA_USER_EDIT){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-user"></span>
                        <span>User</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_USER_LIST;?>">Users</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_USER_EDIT;?>">Add Inspector</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if($CP == SA_COMPANY_LIST || $CP == SA_COMPANY_EDIT){ echo 'open'; }?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-industry"></span>
                        <span>Company</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_COMPANY_LIST;?>">Companies</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_COMPANY_EDIT;?>">Add Company</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if($CP == SA_COUNTRY_LIST || $CP == SA_COUNTRY_EDIT){ echo 'open'; }?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-globe"></span>
                        <span>Country</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_COUNTRY_LIST;?>">Countries</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_COUNTRY_EDIT;?>">Add Country</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( $CP == SA_YARDS_LIST || $CP == SA_YARDS_EDIT ){ echo 'open'; }?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Yards</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_YARDS_LIST;?>">Yards</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_YARDS_EDIT;?>">Add Yard</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( $CP == SA_SEAL_NUMBERS_LIST || $CP == SA_SEAL_NUMBERS_EDIT ){ echo 'open'; }?>" >
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-barcode"></span>
                        <span>Seal Numbers</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_SEAL_NUMBERS_LIST;?>">Seal Number List</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_SEAL_NUMBERS_EDIT;?>">Add Seal Number</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if($CP == SA_CONTAINER_SIZE_LIST || $CP == SA_CONTAINER_SIZE_EDIT){ echo 'open'; }?>" >
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-magic"></span>
                        <span>Container Sizes List</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_CONTAINER_SIZE_LIST;?>">Container Sizes List</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_CONTAINER_SIZE_EDIT;?>">Add Container Size</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( $CP == SA_MATERIAL_CODE_LIST || $CP == SA_MATERIAL_CODE_EDIT ){ echo 'open'; }?>" >
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-barcode"></span>
                        <span>Material codes</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_MATERIAL_CODE_LIST;?>">Material Codes List</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_MATERIAL_CODE_EDIT;?>">Add Material Code</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( $CP == SA_BRANCH_LIST || $CP == SA_BRANCH_EDIT ){ echo 'open'; }?>" >
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-barcode"></span>
                        <span>Branch codes</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_BRANCH_LIST;?>">Branch Codes List</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_BRANCH_EDIT;?>">Add Branch Code</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown <?php if( $CP == SA_BASE_PORT_LIST || $CP == SA_BASE_PORT_EDIT ){ echo 'open'; }?>" >
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Base Port</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_BASE_PORT_LIST;?>">Base Port List</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_BASE_PORT_EDIT;?>">Add Base Port</a>
                    </div>
                </li>
                
        <?php 
            endif;
            if( decode($_SESSION['groupuserid']) == 4 ): ?>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo EMO_HOME; ?>">
                        <span class="ks-icon la la-dashboard"></span>
                        <span>EMO Admin Dashboard</span>
                    </a>
                </li>
                <li class="nav-item dropdown <?php if( $CP == EMO_EMPTY_DEPOT_LIST || $CP == EMO_EMPTY_DEPOT_EDIT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Empty Depot</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_EMPTY_DEPOT_LIST;?>">Empty Depots</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_EMPTY_DEPOT_EDIT;?>">Add Empty Depot</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( $CP == EMO_SUPPLIER_LIST || $CP == EMO_SUPPLIER_EDIT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Supplier</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_SUPPLIER_LIST;?>">Suppliers</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_SUPPLIER_EDIT;?>">Add Supplier</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( $CP == EMO_SHIPPING_AGENT_LIST || $CP == EMO_SHIPPING_AGENT_EDIT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Shipping Agents</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_SHIPPING_AGENT_LIST;?>">Agents</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_SHIPPING_AGENT_EDIT;?>">Add Agent</a>
                    </div>
                </li>
                
        <?php        
            endif;
            if( decode($_SESSION['groupuserid']) == 5 ): ?>
                
                <li class="nav-item">
                    <a class="nav-link" href="cm_home.php">
                        <span class="ks-icon la la-dashboard"></span>
                        <span>Country Manager Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item ">
                    <a class="nav-link " href="<?php echo URL_BASEADMIN.CM_CONTAINERS_LIST; ?>">
                        <span class="ks-icon la la-ship"></span>
                        <span>Containers</span>
                    </a>                    
                </li>
                
            <?php    
            endif;
            if( decode($_SESSION['groupuserid']) == 6 ): ?>
                
                <li class="nav-item dropdown <?php if($CP == SA_COUNTRY_LIST || $CP == SA_COUNTRY_EDIT){ echo 'open'; }?> ">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-docker"></span>
                        <span>Containers</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.IN_CONTAINER_LIST;?>">Containers List</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.IN_CONTAINER_EDIT;?>">Add Container</a>
                    </div>
                </li>
                
            <?php endif; ?>    
                
        </ul>
        <div class="ks-sidebar-extras-block">            
            <div class="ks-sidebar-copyright">© <?php echo date('Y'); ?> <?php echo BASSOCCIATES; ?></div>
        </div>
    </div>
</div>