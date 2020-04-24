<?php 
    include('includes/script_top.php'); 

    $pagename = "Country Manager Settings";
    $listpagename = CM_SETTINGS_EDIT;
    $editpagename = CM_SETTINGS_EDIT;
    
    $table = TB_NOTIFICATIONS;
    
    /** On Delete Action **/
    if ($delete['id']) {
         //Unlink image       
        $data = fetchqry("*", $table, array("id="=>$delete['id']));
        //$image = $data['image'];
        //deletefile($image);
    }

    $Limit = DEFAULT_LIMIT;
    $qry = "select c.* from " . $table . " as c ";
    $qry .= " LEFT JOIN `".TB_USERS."` as u ON u.id=c.user_id";
    $qry .= " where 1 ";
    
    /** For Search **/
    if( !isEmpty($_REQUEST['search_text']) ):
        $qry .= "AND";
        $qry .= " (c.`title` LIKE '%".$_REQUEST['search_text']."%'  ";        
    endif;
    
    if( !isEmpty($_REQUEST['filter_date']) ):
        $qry .= "AND";
        $date = date('Y-m-d', strtotime($_REQUEST['filter_date']) );
        $qry .= " c.created_at <= '".$date."' ";
    endif;
    
    if( !isEmpty($_REQUEST['inspector_id']) ):
        $qry .= "AND";
        $qry .= " c.user_id = '".$_REQUEST['inspector_id']."' ";
    endif;

    /** For Group By * */
    $qry .= " group by c.id ";

    /** For Ordering * */
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
                                <div class="ks-dashboard-tabbed-sidebar-widgets">
                                    <!-- Filters -->
                                    <form action="" method="get">
                                        <div class="row" >
                                                <div class="col-sm-2">
                                                    <h5 class="ks-main-title">NOTIFICATION</h5>
                                                </div>
                                                <div class="col-sm-2">
                                                    <h5 class="text-right ks-main-title">Filter By</h5>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" name="search_text" id="search_text" class="form-control" value="<?php echo $_REQUEST['search_text']; ?>" placeholder="Search" > 
                                                </div>
                                                <div class="col-sm-2">
                                                    <?php 
                                                    if( !isEmpty($_REQUEST['filter_date']) ):
                                                        $filter_date = date( 'Y-m-d', strtotime($_REQUEST['filter_date']) );
                                                    endif;
                                                    ?>
                                                    <input type="date" name="filter_date" id="filter_date" class="calendar form-control" value="<?php echo $filter_date; ?>" placeholder="Date" > 
                                                </div>
                                                <div class="col-sm-2">
                                                    <?php
                                                    $sel_users = selectqry('*', TB_USERS, array('users_groups_id='=>'6'), " `first_name` ASC ");
                                                    ?>
                                                    <select name="inspector_id" id="inspector_id" class="form-control">
                                                        <option>Inspector</option>
                                                        <?php
                                                        while($row = mysqli_fetch_assoc($sel_users)):
                                                            if( $_REQUEST['inspector_id'] == $row['id'] ):
                                                                $selected = "selected";
                                                            else:
                                                                $selected = "";
                                                            endif;
                                                            
                                                            echo '<option value='.$row['id'].' '.$selected.' >'.$row['first_name'] .' '.$row['last_name'].'</option>';

                                                        endwhile;
                                                        ?>
                                                    </select>
                                                </div>                                        
                                                <div class="col-sm-1">
                                                    <input type="submit" value="Filter" />
                                                </div>
                                        </div>
                                    </form>    
                                    <!-- Filters -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card ks-card-widget ks-widget-table">
                                                <div class="card-block">
                                                    <table class="table ks-payment-table-invoicing">
                                                        <tbody>
                                                            <tr>
                                                                <th width="1">#</th>
                                                                <th>Date</th>
                                                                <th>Title</th>
                                                                <th>Description</th>
                                                                <th width="5%"></th>
                                                            </tr>
                                                            <?php
                                                            if (mysqli_num_rows($sel) > 0) {
                                                                $n = ($page - 1) * $Limit;
                                                                while ($row = mysqli_fetch_assoc($sel)) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $i + 1; ?></td>
                                                                        <td><?php echo date( 'd/m/Y', strtotime($row['created_at']) );?></td>
                                                                        <td><?php echo $row['title']; ?></td>
                                                                        <td><?php echo $row['description']; ?></td>                          
                                                                        <td><?php echo date( 'H:i', strtotime($row['created_at']) );?></td>
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
        <script src="<?php echo URL_BASEADMIN; ?>libs/d3/d3.min.js"></script>
        <script src="<?php echo URL_BASEADMIN; ?>libs/c3js/c3.min.js"></script>
        <script src="<?php echo URL_BASEADMIN; ?>libs/noty/noty.min.js"></script>
        <script src="<?php echo URL_BASEADMIN; ?>libs/maplace/maplace.min.js"></script>
       
    </body>
</html>