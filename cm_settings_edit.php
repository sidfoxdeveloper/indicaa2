<?php include('includes/script_top.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->
    <head>
        <?php include('includes/head.php'); ?>    
        <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>assets/fonts/kosmo/styles.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>assets/fonts/weather/css/weather-icons.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>libs/c3js/c3.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>libs/noty/noty.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>assets/styles/widgets/payment.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>assets/styles/widgets/panels.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>assets/styles/dashboard/tabbed-sidebar.min.css">
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
                            <h3 class="ks-main-title">Country Manager Settings</h3>
                        </div>
                    </section>
                </div>
                <div class="ks-page-content">
                    <div class="ks-page-content-body">
                        <div class="ks-dashboard-tabbed-sidebar">
                            <!-- START: ks-dashboard-tabbed -->    
                            <div class="ks-dashboard-tabbed-sidebar-widgets"></div>
                            <!-- END: ks-dashboard-tabbed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/script_bottom.php'); ?>
        <script src="<?php echo URL_BASEADMIN; ?>libs/d3/d3.min.js"></script>
        <script src="<?php echo URL_BASEADMIN; ?>libs/c3js/c3.min.js"></script>
        <script src="<?php echo URL_BASEADMIN; ?>libs/noty/noty.min.js"></script>
        <script src="<?php echo URL_BASEADMIN; ?>libs/maplace/maplace.min.js"></script>
       
    </body>
</html>