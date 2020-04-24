<?php
include('includes/script_top.php');

if ($permission['view']) {
   
    $pagename = "Cost";
    $listpagename = EMO_COST_LIST;
    $table = TB_COST;
    
    /** On Delete Action **/
    if ($delete['id']) {
         //Unlink image       
        $data = fetchqry("*", $table, array("id="=>$delete['id']));
    }

    $Limit = DEFAULT_LIMIT;
    $qry = "select c.* from " . $table . " as c ";
    $qry .= " where 1 ";
    
    /** For Group By **/
    $qry .= " group by c.id ";

    /** For Ordering **/
    $qry .= " order by c.id DESC ";

    $page = $_REQUEST['page'];
    $sel = mysqli_query($con, $qry);
    if ($page == "")
        $page = 1;
    $NumberOfResults = mysqli_num_rows($sel);
    $NumberOfPages = ceil($NumberOfResults / $Limit);
    $sel = mysqli_query($con, $qry . " LIMIT " . ($page - 1) * $Limit . ",$Limit");
    $display = mysqli_num_rows($sel);
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <!-- BEGIN HEAD -->
        <head>
             <?php include('includes/head.php'); ?> 
            
            <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>libs/prism/prism.css"> <!-- original -->
            <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>libs/flatpickr/flatpickr.min.css"> <!-- original -->
            <link rel="stylesheet" type="text/css" href="<?php echo URL_BASEADMIN; ?>assets/styles/libs/flatpickr/flatpickr.min.css"> <!-- customization -->
            <!--  jQuery -->
            <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

            <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
            <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

            <!-- Bootstrap Date-Picker Plugin -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>  
        </head>
        <body class="ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading"> 
            <!-- remove ks-page-header-fixed to unfix header -->
            <?php include('includes/header.php'); ?>
            <div class="ks-page-container ks-dashboard-tabbed-sidebar-fixed-tabs"> 
                <?php include('includes/sidebar.php'); ?>  
                <div class="ks-column ks-page">
                    <div class="ks-page-content">
                        <div class="ks-page-content-body">
                            <div class="ks-dashboard-tabbed-sidebar">
                                <div class="ks-dashboard-tabbed-sidebar-widgets">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card ks-card-widget ks-widget-table">
                                                <div class="card-block">
                                                    <table class="table ks-payment-table-invoicing">
                                                        <tbody>
                                                            <tr>
                                                                <th width="1">#</th>
                                                                <th>Date</th>
                                                                <th>Container No.</th>
                                                                <th>Supplier</th>
                                                                <th>Yard</th>
                                                                <th>Inspector</th>
                                                                <th>Status</th>
                                                                <th width="5%">Action</th>
                                                            </tr>
                                                            <?php
                                                            if (mysqli_num_rows($sel) > 0) {
                                                                $n = ($page - 1) * $Limit;
                                                                while ($row = mysqli_fetch_assoc($sel)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $i + 1; ?></td>
                                                                        <td><?php echo $row['container_number']; ?></td>
                                                                        <td>
                                                                            <?php
                                                                            $srow = fetchqry('*', TB_SUPPLIER, array('id='=>$row['supplier_id']) );
                                                                            echo $srow['name'];
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            $yrow = fetchqry('*', TB_YARDS, array('id='=>$row['yard_id']) );
                                                                            echo $yrow['name'];
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $ins = fetchqry( '*', TB_USERS, array('id='=>$row['user_id']) );
                                                                                echo $ins['first_name'].' '.$ins['last_name']; 
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $status = $row['status'];
                                                                                if($status == 'draft'):
                                                                                    echo '<button class="btn btn-default btn-lg col-sm-6" >Draft</button';
                                                                                elseif($status == 'pending_upload'):    
                                                                                    echo '<button class="btn btn-primary btn-lg col-sm-6" >Pending Upload</button>';
                                                                                elseif($status == 'not_verified_by_country_manager'):    
                                                                                    echo '<button class="btn btn-danger btn-lg col-sm-6" >Not verified</button>';
                                                                                elseif($status == 'verified_by_country_manager'):        
                                                                                    echo '<button class="btn btn-success btn-lg col-sm-6" >Verified</button>';
                                                                                endif;
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="<?php echo URL_BASEADMIN . $viewpagename . $paginationback . '&id=' . $row['id'] . '&page=' . $page; ?>" class="btn btn-default btn-sm" title="View" >View</a>   
                                                                            <?php if($permission['edit']) { ?><a href="<?php echo URL_BASEADMIN . $editpagename . $paginationback . '&id=' . $row['id'] . '&page=' . $page; ?>" class="btn btn-primary btn-sm" title="Update" >Update</a><?php } ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
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
            <script src="<?php echo URL_BASEADMIN; ?>libs/flatpickr/flatpickr.min.js"></script>
            <script src="<?php echo URL_BASEADMIN; ?>libs/prism/prism.js"></script>
            <script>
                //Date and Time Picker  
                $(".calendar").flatpickr();
            </script>
        </body>
    </html>
    <?php
    /** Check Page Authantication **/
}
else {
    include(DIR_BASEADMIN . DIR_INCLUDES . INC_DONTACCESSMSG);
}
?>