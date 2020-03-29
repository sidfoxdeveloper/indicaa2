<?php
	include('script_top.php'); 	
        
	if($_REQUEST['ptype']=='edit')
	{
		if($_REQUEST['type']=='removeimage')
		{
			$name = $_REQUEST['name']; 
			deletefile($name);
			deleteqry(TB_PROPERTY_IMAGES,array("property_id="=>$_REQUEST['sid'],"image="=>$name));
		}
	}
        
?>