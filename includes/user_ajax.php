<?php
	include('script_top.php'); 	
        
	if($_REQUEST['utype']=='edit')
	{
		if($_REQUEST['type']=='removeimage')
		{
			$name = $_REQUEST['name']; 
			deletefile($name);
			deleteqry(TB_USER_IMAGES,array("user_id="=>$_REQUEST['sid'],"id="=>$_REQUEST['id']));
		}
	}
        
?>