<?php
include('includes/script_top.php');

if ($permission['view']) {
   
    $pagename = "Containers";
    $listpagename = CM_CONTAINERS_LIST;
    $editpagename = CM_CONTAINER_ONE_EDIT;
    $viewpagename = CM_CONTAINER_VIEW;
    $table = TB_CONTAINERS;
    
    /** On Delete Action **/
    if ($delete['id']) {
         //Unlink image       
        $data = fetchqry("*", $table, array("id="=>$delete['id']));
        //$image = $data['image'];
        //deletefile($image);
    }

    $Limit = DEFAULT_LIMIT;
    $qry = "select c.*, s.name as supplier_name from " . $table . " as c ";
    $qry .= " LEFT JOIN `".TB_USERS."` as u ON u.id=c.user_id";
    $qry .= " LEFT JOIN `".TB_SUPPLIER."` as s ON s.id=c.supplier_id";
    
    $qry .= " where 1 ";
    
    /** For Search **/
    if( !isEmpty($_REQUEST['search_text']) ):
        $qry .= "AND";
        $qry .= " (c.`container_number` LIKE '%".$_REQUEST['search_text']."%'  ";
        $qry .= " OR s.`name` LIKE '%".$_REQUEST['search_text']."%') ";
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
                                    <!-- Filters -->
                                    <form action="" method="get">
                                        <div class="row" >
                                                <div class="col-sm-2">
                                                    <h5 class="ks-main-title">VIEW CONTAINERS</h5>
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
                                                                        <td><?php echo date( 'd/m/Y', strtotime($row['created_at']) );?></td>
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
                                                                                    echo '<button class="btn btn-default btn-sm col-sm-12" >Draft</button';
                                                                                elseif($status == 'pending_upload'):    
                                                                                    echo '<button class="btn btn-primary btn-sm col-sm-12" >Pending Upload</button>';
                                                                                elseif($status == 'not_verified_by_country_manager'):    
                                                                                    echo '<button class="btn btn-danger btn-sm col-sm-12" >Not verified</button>';
                                                                                elseif($status == 'verified_by_country_manager'):        
                                                                                    echo '<button class="btn btn-success btn-sm col-sm-12" >Verified</button>';
                                                                                endif;
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="<?php echo URL_BASEADMIN . $viewpagename . $paginationback . '&id=' . $row['id'] . '&page=' . $page; ?>" class="btn btn-default btn-sm" title="View" >View</a>   
                                                                            <?php if($permission['edit']) { ?><a href="<?php echo URL_BASEADMIN . $editpagename . $paginationback . '&id=' . $row['id'] . '&page=' . $page; ?>" class="btn btn-primary btn-sm" title="Update" >Update</a><?php } ?>   
                                                                            
                                                                            <?php
                                                                            $archieveText = '';
                                                                            $archieveUrl = '';
                                                                            $archieveClass = '';
                                                                            
                                                                            $selArchieve = selectqry( 'id', TB_CONTAINER_ARCHIEVE, array('container_id='=>$row['id']) );
                                                                            if( mysqli_num_rows($selArchieve) > 0 ): 
                                                                                $archieveUrl = '#';
                                                                                $archieveText = 'Archieved';
                                                                                $archieveClass = 'btn-success';
                                                                            else:
                                                                                $archieveUrl = 'archieve.php?true&id='.$row['id'].'&page=1';
                                                                                $archieveText = 'Archieve';
                                                                                $archieveClass = 'btn-warning';
                                                                            endif;
                                                                            ?>
                                                                            <a href="<?php echo URL_BASEADMIN . $archieveUrl; ?>" class="btn  <?php echo $archieveClass; ?>  btn-sm" title="<?php echo $archieveText; ?>" ><?php echo $archieveText; ?></a>                                                                            
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