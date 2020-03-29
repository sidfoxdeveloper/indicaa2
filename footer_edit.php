<?php 
include('includes/script_top.php');
?>
<?php	
    if(($permission['add'] && !$_REQUEST['id']) || ($permission['edit'] && $_REQUEST['id'])){
?>
<?php
	$pagename = "Footer Settings";
	$listpagename = FOOTER_EDIT;
	$table = TB_FOOTER;
	
        $pagetype = "Edit";
        $data=fetchqry("*", $table, array("id="=>1));
        $title = $data['title'];
        $phone = $data['phone'];
        $address = $data['address'];
        $description = $data['description'];
        	
	if(strpos($_SERVER['REQUEST_URI'], "?true")!=0)
	{
		$temp = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "?true"));
		$backurlfirstpart = substr($temp, strpos($temp, "?true"),strpos($temp, "&id"));
		$temp = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "&id")+4);
		if(strpos($temp, "&")!=0)
			$backurllastpart = substr($temp,strpos($temp, "&"));
		$gobackurl = $backurlfirstpart.$backurllastpart;
	}
	else
	{
		$gobackurl = "?true";
	}
?>

<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <?php include('includes/head.php'); ?>  
</head>

<body class="customer-add-page invoice-list-page ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading"> <!-- remove ks-page-header-fixed to unfix header -->
	<?php include('includes/header.php'); ?>
    <div class="ks-page-container ks-dashboard-tabbed-sidebar-fixed-tabs"> 
	    <?php include('includes/sidebar.php'); ?>
        <div class="ks-column ks-page">
            <div class="ks-page-header">
                <section class="ks-title">
                    <h3><?php echo $pagetype.' '.$pagename; ?></h3>
                </section>
            </div>
    
            <div class="ks-page-content">
                <div class="ks-page-content-body">
                    <div class="ks-nav-body-wrapper">
                        <div class="container-fluid">
                            <form action="" name="mainform" id="mainform" method="post" enctype="multipart/form-data" onsubmit="return submitform();">
                                <div class="row">
                                    <div class="col-lg-8 ks-panels-column-section">                                                                                                                             
                                        <div class="card">                                                
                                            <div class="card-block">
                                            	<h5 class="card-title"><?php echo 'Footer Fields'; ?></h5>
                                                <div>                                                    
                                                    <div class="form-group row">
                                                        <label for="description" class="col-sm-2 form-control-label">About Company</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group">
                                                                <textarea name="description" id="description" class="form-control" rows="5" value="<?php echo $description; ?>"><?php echo $description; ?></textarea>                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="phone" class="col-sm-2 form-control-label">Phone</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group">
                                                                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>" />                                                                 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="address" class="col-sm-2 form-control-label">Address</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group">
                                                                <input type="text" name="address" id="address" class="form-control" value="<?php echo $address; ?>" />                                                                 
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                        
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-success right" type="button" onclick="return savennew(0);">Save</button>
                                                        </div>
                                                        <div class="col-sm-6 text-right">
                                                            <a class="btn btn-danger right" href="<?php echo URL_BASEADMIN.HOME_PAGE;?>">Back</a>
                                                        </div> 
                                                    </div>                                                
                                                </div>
                                            </div>
                                        </div>                                        
                                        <input type="hidden" name="addnew" id="addnew" value="0" />
                                        <input type="submit" style="display:none" name="hidesubmit" />                                
                                    </div>
                                </div>
                            </form>
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
else
{
    include(DIR_BASEADMIN.DIR_INCLUDES.INC_DONTACCESSMSG);
}
?>
<script type="text/javascript">
    function chkrequired(){
        document.mainform.submit();
    }
    CKEDITOR.replace('description', {toolbar: 'Basic', height: 200});   
</script>
<?php

if(isset($_POST['addnew'])){	
	
    $array = array( "phone"=>$_POST['phone'], "address"=>$_POST['address'], "description"=>replacequoteb($_POST['description']) );
    $update = updateqry($array, array("id=" => $_REQUEST['id']), $table);
    $updateid = ($_REQUEST['id']) ? $_REQUEST['id'] : $insertedid;	

    if($update || $insert)
            $_SESSION['msg']='Action performed successfully.|alert-success';
    else
            $_SESSION['msg']='Action not performed successfully.|alert-error';		

    header("Location:".$_SERVER['PHP_SELF'].$gobackurl.'&id='.$updateid);
        	
}
?>