<?php 
	include('includes/script_top.php');	
			
	if($_SERVER["HTTP_REFERER"]==URL_BASEADMIN.INDEX_PAGE || $_SERVER["HTTP_REFERER"]==URL_BASEADMIN)
		
                $loginUser = new Login;

	if(isset($_POST['email']))
	{		
			
		if($loginUser)
		{
			$loginresult = $loginUser->checkAuthantication();
                       
			if($loginresult == 1) {
                            
				header("Location:sa_home.php");                                
                                
                        } elseif($loginresult == 2) {                      
                            
                                header("Location:ma_home.php");                               
                                
                        } elseif($loginresult == 3) {
                            
                                header("Location:ca_home.php");
                                
                        } elseif($loginresult == 4) {
                            
                                header("Location:emo_home.php");
                                
                        } elseif($loginresult == 5) {    
                            
                                header("Location:cm_home.php");
                                
                        } elseif($loginresult == 6) {
                            
                                header("Location:in_home.php");
                                
                        } elseif($loginresult == 0) {
				$_SESSION['msg']="Your Acount disable please contact to admin.|alert-info";
				header("Location:".INDEX_PAGE);
			}
			else
			{
				$_SESSION['msg']="Username or Password is wrong...Try Again.";
				header("Location:".INDEX_PAGE);
			}
		}
		else
		{
			$_SESSION['msg']="Username or Password is wrong...Try Again.";
			header("Location:".INDEX_PAGE);
		}
	}
?>