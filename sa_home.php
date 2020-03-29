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
                            <h3 class="ks-main-title">Super Admin Dashboard</h3>
                        </div>
                        <!--<button class="btn btn-secondary-outline ks-light ks-no-text ks-tabbed-sidebar-navigation-block-toggle" data-block-toggle=".ks-dashboard-tabbed-sidebar-sidebar">
                            <span class="ks-icon la la-bars"></span>
                        </button>-->
                    </section>
                </div>
                <div class="ks-page-content">
                    <div class="ks-page-content-body">
                        <div class="ks-dashboard-tabbed-sidebar">
                            <!-- START: ks-dashboard-tabbed -->    
                            <div class="ks-dashboard-tabbed-sidebar-widgets">
                                
                                <?php /* ?>
                                <div class="row">
                                    <div class="col-xl-3">
                                        <a href="<?php echo URL_BASEADMIN.'user_list.php';?>" title="Users">
                                            <div class="card ks-card-widget ks-widget-payment-total-amount ks-pink-light ">
                                                <h5 class="card-header">Shifters </h5>
                                                <div class="card-block">
                                                    <div class="ks-payment-total-amount-item-icon-block">
                                                        <span class="la la-user ks-icon"></span>
                                                    </div>
                                                    <div class="ks-payment-total-amount-item-body">
                                                        <div class="ks-payment-total-amount-item-amount">
                                                            <span class="ks-amount"><?php echo $activeShifters; ?></span>
                                                        </div>                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </a>    
                                    </div>
                                    <div class="col-xl-3">
                                        <a href="<?php echo URL_BASEADMIN.'job_list.php';?>" title="Jobs">
                                            <div class="card ks-card-widget ks-widget-payment-total-amount ks-green-light">
                                                <h5 class="card-header">Jobs</h5>
                                                <div class="card-block">
                                                    <div class="ks-payment-total-amount-item-icon-block">
                                                        <span class="la la-file-o ks-icon"></span>
                                                    </div>
                                                    <div class="ks-payment-total-amount-item-body">
                                                        <div class="ks-payment-total-amount-item-amount">
                                                            <span class="ks-amount"><?php echo $activeJobs;?></span>
                                                        </div>                                                 
                                                    </div>
                                                </div>
                                            </div>
                                        </a>    
                                    </div>
                                    <div class="col-xl-3">
                                        <a href="#" title="Leads">
                                            <div class="card ks-card-widget ks-widget-payment-total-amount ks-orange-light">
                                                <h5 class="card-header">Leads</h5>
                                                <div class="card-block">
                                                    <div class="ks-payment-total-amount-item-icon-block">
                                                        <span class="la la-rocket ks-icon"></span>
                                                    </div>
                                                    <div class="ks-payment-total-amount-item-body">
                                                        <div class="ks-payment-total-amount-item-amount">
                                                            <span class="ks-amount"><?php echo $activeLeads;?></span>
                                                        </div>                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </a>    
                                    </div>
                                    <div class="col-xl-3">
                                        <a href="<?php echo URL_BASEADMIN.'categories_list.php';?>" title="Categories">
                                            <div class="card ks-card-widget ks-widget-payment-total-amount ks-purple-light">
                                                <h5 class="card-header">Job Categories</h5>
                                                <div class="card-block">
                                                    <div class="ks-payment-total-amount-item-icon-block">
                                                        <span class="la la-sitemap ks-icon"></span>
                                                    </div>
                                                    <div class="ks-payment-total-amount-item-body">
                                                        <div class="ks-payment-total-amount-item-amount">
                                                            <span class="ks-amount"><?php echo $activeCategory;?></span>
                                                        </div>                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </a>    
                                    </div>
                                </div>
                                <?php */ ?>
                                
                            </div>
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