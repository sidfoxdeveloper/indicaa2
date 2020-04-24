<?php
include('includes/script_top.php');

if ($permission['view']) {
   
    $pagename = "Country Manager Dashboard";
    $listpagename = CM_HOME;
    $editpagename = CM_HOME;
    $table = TB_CONTAINERS;
    
    /** On Delete Action **/
    if ($delete['id']) {
        //Unlink image
    }

    $totalContainers = $containersVerified = $containerNotVerified = 0;
    
    $cRes = selectqry( 'id', $table, array() );
    $totalContainers = mysqli_num_rows($cRes);
    
    $vcRes = selectqry( 'id', $table, array('status='=>'verified_by_country_manager') );
    $containersVerified = mysqli_num_rows($vcRes);
    
    $containerNotVerified = ( $totalContainers - $containersVerified );
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <!-- BEGIN HEAD -->
        <head>
             <?php include('includes/head.php'); ?> 
        </head>
        <body class="ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading"> 
            <!-- remove ks-page-header-fixed to unfix header -->
            <?php include('includes/header.php'); ?>
            <div class="ks-page-container ks-dashboard-tabbed-sidebar-fixed-tabs"> 
                <?php include('includes/sidebar.php'); ?>  
                <div class="ks-column ks-page">
                    <div class="ks-page-header">
                        <section class="ks-title-and-subtitle">
                            <div class="ks-title-block">
                                    <h3 class="ks-main-title">Country Manager Dashboard</h3>
                            </div>
                            <div class="row">
                                <div class="ks-text-right">Containers not verified:  <strong class="btn btn-primary btn-sm"><?php echo $containerNotVerified; ?></strong> </div>                                
                            </div>
                        </section>                        
                    </div>
                    <div class="ks-page-content">
                        <div class="ks-page-content-body">
                            <div class="ks-dashboard-tabbed-sidebar">
                                <div class="ks-dashboard-tabbed-sidebar-widgets">                 
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="">
                                                <div class="card-block">
                                                        
                                                    <div class="row">
                                                        <div class="col-md-4 col-xs-12">
                                                            <div class="box-div">
                                                                <h4>Containers Not Verified</h4>
                                                                <p style="padding-bottom:35px;"><strong class="btn btn-primary btn-sm"><?php echo $containerNotVerified; ?></strong></p>
                                                                <a href="<?php echo URL_BASEADMIN.CM_CONTAINERS_LIST;?>">Containers</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-xs-12">                                                            
                                                            <div class="box-div">
                                                                <h4>Containers Verified</h4>
                                                                <p style="padding-bottom:35px;"><strong class="btn btn-primary btn-sm"><?php echo $containersVerified; ?></strong></p>
                                                                <a href="<?php echo URL_BASEADMIN.CM_CONTAINERS_LIST;?>">Containers</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-xs-12">                          
                                                            <div class="box-div">
                                                                <h4>Total Containers</h4>
                                                                <p style="padding-bottom:35px;"><strong class="btn btn-primary btn-sm"><?php echo $totalContainers; ?></strong></p>
                                                                <a href="<?php echo URL_BASEADMIN.CM_CONTAINERS_LIST;?>">Containers</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php
                                                    if ($display <= 0)
                                                        include(DIR_BASEADMIN . DIR_INCLUDES . INC_NORECORD);
                                                    ?>
                                                </div>
                                            </div>
                                            <?php include(DIR_BASEADMIN . DIR_FUNCTIONS . INC_PAGINATION); ?>
                                        </div>
                                    </div>
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
}
else {
    include(DIR_BASEADMIN . DIR_INCLUDES . INC_DONTACCESSMSG);
}
?>