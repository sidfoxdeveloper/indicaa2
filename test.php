<li class="nav-item dropdown <?php if( $CP == EMO_PORT_OF_LOADING_LIST || $CP == EMO_PORT_OF_LOADING_EDIT ){ echo 'open'; } ?>">
    <a class="nav-link dropdown-toggle" href="#">
        <span class="ks-icon la la-ship"></span>
        <span>Port of Loading</span>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_PORT_OF_LOADING_LIST;?>">Ports of Loading</a>
        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_PORT_OF_LOADING_EDIT;?>">Add Loading Port</a>
    </div>
</li>
<li class="nav-item dropdown <?php if( $CP == EMO_STORAGE_LIST || $CP == EMO_STORAGE_EDIT ){ echo 'open'; } ?>">
    <a class="nav-link dropdown-toggle" href="#">
        <span class="ks-icon la la-ship"></span>
        <span>Storages</span>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_STORAGE_LIST;?>">Storages</a>
        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_STORAGE_EDIT;?>">Add Storage</a>
    </div>
</li>
<li class="nav-item dropdown <?php if( $CP == EMO_TERMINAL_LIST || $CP == EMO_TERMINAL_EDIT ){ echo 'open'; } ?>">
    <a class="nav-link dropdown-toggle" href="#">
        <span class="ks-icon la la-ship"></span>
        <span>Terminals</span>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_PORT_OF_LOADING_LIST;?>">Ports of Loading</a>
        <a class="dropdown-item" href="<?php echo URL_BASEADMIN.EMO_PORT_OF_LOADING_EDIT;?>">Add Loading Port</a>
    </div>
</li>