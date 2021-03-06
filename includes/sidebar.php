<?php
    $CP = substr( $_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'], "indicaa") + strlen("/indicaa") );
?>
<div class="ks-column ks-sidebar ks-info">
    <div class="ks-wrapper ks-sidebar-wrapper">
        <ul class="nav nav-pills nav-stacked">
        <?php    
        /**
         * Manager 
        **/
        if( decode($_SESSION['groupuserid']) == 2 ): ?>
                
            <li class="nav-item">
               <a class="nav-link" href="<?php echo MA_HOME; ?>">
                   <span class="ks-icon la la-dashboard"></span>
                   <span>Manager Dashboard</span>
               </a>
            </li>
            
        <?php 
        endif;
        /**
         * Super Admin 
        **/
        if( decode($_SESSION['groupuserid']) == 1 ): 
        ?>
            
                <li class="nav-item dropdown <?php if($CP == SA_CONTAINER_LIST || $CP == SA_CONTAINER_EDIT){ echo 'open'; }?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-square-o"></span>
                        <span>Container</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_CONTAINER_LIST;?>">Containers</a>                        
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="<?php echo URL_BASEADMIN.SA_SETTINGS_EDIT.'?true&id=1&page=1'; ?>">
                        <span class="ks-icon la la-cog"></span>
                        <span>Settings</span>
                    </a>                    
                </li>
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
                <li class="nav-item dropdown <?php if($CP == SA_CURRENCY_LIST || $CP == SA_CURRENCY_EDIT){ echo 'open'; }?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-dollar"></span>
                        <span>Currency</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_CURRENCY_LIST;?>">Currency</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_CURRENCY_EDIT;?>">Add Currency</a>
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
                
                <li class="nav-item dropdown <?php if( $CP == SA_PORT_OF_LOADING_LIST|| $CP == SA_PORT_OF_LOADING_EDIT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Port of Loading</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_PORT_OF_LOADING_LIST;?>">Ports of Loading</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_PORT_OF_LOADING_EDIT;?>">Add Loading Port</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( $CP == SA_STORAGE_LIST || $CP == SA_STORAGE_EDIT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Storages</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_STORAGE_LIST;?>">Storages</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_STORAGE_EDIT;?>">Add Storage</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( $CP == SA_TERMINAL_LIST || $CP == SA_TERMINAL_EDIT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Terminals</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_TERMINAL_LIST;?>">Terminals</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.SA_TERMINAL_EDIT;?>">Add Terminal</a>
                    </div>
                </li>
                
         <?php
        endif;
        /**
         * Country Admin
        **/
        if( decode($_SESSION['groupuserid']) == 3 ): ?>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo CA_HOME; ?>">
                        <span class="ks-icon la la-dashboard"></span>
                        <span>Country Admin Dashboard</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="<?php echo URL_BASEADMIN.CA_CONTAINER_LIST; ?>">
                        <span class="ks-icon la la-ship"></span>
                        <span>Containers</span>
                    </a>                    
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="<?php echo URL_BASEADMIN.CA_SETTINGS_EDIT.'?true&id=1&page=1'; ?>">
                        <span class="ks-icon la la-cog"></span>
                        <span>Settings</span>
                    </a>                    
                </li>
                
        <?php
        endif;
        /**
         * EMO Admin
        **/
        if( decode($_SESSION['groupuserid']) == 4 ): ?>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo EMO_HOME; ?>">
                        <span class="ks-icon la la-dashboard"></span>
                        <span>EMO Admin Dashboard</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="<?php echo URL_BASEADMIN.EMO_CONTAINER_LIST; ?>">
                        <span class="ks-icon la la-ship"></span>
                        <span>Containers</span>
                    </a>                    
                </li>
                <li class="nav-item dropdown <?php if( $CP == EMO_COST_LIST || $CP == EMO_COST_EDIT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Cost</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_COST_LIST;?>">Costs</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_COST_EDIT;?>">Add Cost</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( $CP == EMO_PORT_LIST || $CP == EMO_PORT_EDIT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-ship"></span>
                        <span>Port</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_PORT_LIST;?>">Costs</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_PORT_EDIT;?>">Add Cost</a>
                    </div>
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
                <li class="nav-item dropdown <?php if( $CP == EMO_LR_REPORT || $CP == EMO_LCR_REPORT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-pagelines"></span>
                        <span>Reports</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_LR_REPORT;?>">LR Report</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_LCR_REPORT;?>">LCR Report</a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="<?php echo URL_BASEADMIN.EMO_SETTINGS_EDIT.'?true&id='.$user['id'].'&page=1'; ?>">
                        <span class="ks-icon la la-cog"></span>
                        <span>Settings</span>
                    </a>                    
                </li>
                
        <?php
            endif;
            /**
            * Country Manager
            **/
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
                <li class="nav-item dropdown <?php if( $CP == CM_LR_REPORT || $CP == CM_LCR_REPORT ){ echo 'open'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="ks-icon la la-pagelines"></span>
                        <span>Reports</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.CM_LR_REPORT;?>">LR Report</a>
                        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.CM_LCR_REPORT;?>">LCR Report</a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="<?php echo URL_BASEADMIN.CM_SETTINGS_EDIT; ?>">
                        <span class="ks-icon la la-cog"></span>
                        <span>Settings</span>
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