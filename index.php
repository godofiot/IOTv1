<?php
/*** PREVENT THE PAGE FROM BEING CACHED BY THE WEB BROWSER ***/header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require_once("wp-authenticate.php");

/*** REQUIRE USER AUTHENTICATION ***/login();

/*** RETRIEVE LOGGED IN USER INFORMATION ***/$user = wp_get_current_user();

?>

<?php 
	
    $current_user = wp_get_current_user();
    /**
     * @example Safe usage: $current_user = wp_get_current_user();
     * if ( !($current_user instanceof WP_User) )
     *     return;
     */
    echo 'Username: ' . $current_user->user_login . '<br />';
    echo 'User email: ' . $current_user->user_email . '<br />';
	echo 'subscriberid: ' . $current_user->subscriberid . '<br />';
    echo 'User first name: ' . $current_user->user_firstname . '<br />';
    echo 'User last name: ' . $current_user->user_lastname . '<br />';
    echo 'User display name: ' . $current_user->display_name . '<br />';
    echo 'User ID: ' . $current_user->ID . '<br />';	
	
	//$mydb = new wpdb( 'je542vplx41rzipd', 'cuv2p39psoa3jwyx', 'godofiot_devicelist', 'localhost' );
	//$checkQuery = $mydb->query('SELECT * FROM tbl_devices WHERE id = 1');
	
	$subscriberid = $current_user->subscriberid;
	$user_login = $current_user->user_login;
	echo $user_login;
	//check if subscriberid of current user is filled
	if(empty($subscriberid)){		
		//if filled do this
		//insert new id					
		
		$d=date("d");
		$m=date("m");
		$y=date("Y");
		$t=time();
		$dmt=$d+$m+$y+$t;    
		$ran= rand(0,10000000);
		$dmtran= $dmt+$ran;
		$un=  uniqid();
		$dmtun = $dmt.$un;
		$mdun = md5($dmtran.$un);
		$newsubscriberid  ='s'; // if you want sort length code.
		$newsubscriberid .=substr($mdun, 15); // if you want sort length code.
		//return $mdun;
		//return $subscriberid;
			
		
		$wpdb->query("UPDATE $wpdb->users SET subscriberid = '$newsubscriberid' WHERE user_login = '$user_login'");	
			
		/*
		if (!file_exists("/home/godofiot/public_html/control-panel/subscribers/$newsubscriberid.php")) { 
		//copy("/home/pfes/public_html/vsadnik/subscribers/subscriber.template", "/home/pfes/public_html/vsadnik/subscribers/$subscriberid.php");
		$file_data = '<?php $subscriberid = "'.$newsubscriberid.'"; ?>'; //"Stuff you want to add\n";
		$file_data .= file_get_contents("/home/godofiot/public_html/control-panel/subscribers/subscriber.template");
		file_put_contents("/home/godofiot/public_html/control-panel/subscribers/$newsubscriberid.php", $file_data);
		}//
		*/
		//header("location:http://www.internetofthingsbuilder.com/control-panel/subscriber.php");		
		
	}
	else {
		//open personalize user page		
		//header("location:http://www.internetofthingsbuilder.com/control-panel/subscriber.php");		
		//exit();
	}
	
	
	
	
	//if not filled do this
	
	
	
	
	
	
	
	
	
?>






<!DOCTYPE html>
<html lang="en">
<head>
   <title>Login</title>
</head>
<body>
<p>Welcome <?php echo $current_user->user_firstname . " " . $current_user->user_lastname; ?></p>
<p>subscriber id is  <?php echo $subscriberid; ?></p>



<p><a href="http://www.internetofthingsbuilder.com/logout/">Click here to log out</a></p>
<p><a href="http://www.internetofthingsbuilder.com/wp-admin">My Dashboard</a></p>
<p><a href="http://www.internetofthingsbuilder.com/control-panel/subscriber.php">Control My Boards</a></p>
<p><a href="http://www.internetofthingsbuilder.com">Home</a></p>
</body>
</html>