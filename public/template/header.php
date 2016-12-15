<?php session_start();?>
<!doctype html>
<html>
<head>
	
	<title>Trang web tin chi</title>
		
	<?php 
		if (isset($_GET["logout"])){
			unset($_SESSION["loggedin"]);
			unset($_SESSION["username"]);
			unset($_SESSION["role"]);
		}
	
	?>
	
	<title><?php echo $page_title; ?></title>
	<meta charset="utf-8"> 
	<meta name="keywords" content="<?php echo $page_keywords; ?>" />
	<meta name="description" content="<?php echo $page_description; ?>" />
	<link rel="stylesheet" type="text/css" href="/webstudent/public/css/style.css" />	
	<!--<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />-->
	<link rel="stylesheet" 	href="/webstudent/public/css/ui-lightness/jquery-ui-1.10.2.custom.css" />
<!-- 	<link rel="stylesheet" 	href="css/jmetro/jquery-ui-1.10.2.custom.css" /> -->
    
</head>
<body>
	<div id="pageWrapper">
		<div id="bk">
				<img src="/webstudent/public/images/bk.png" width="950" height="150">
		</div> <!-- End of header -->
		
		<div id="nav"> 	 
		<div  id="login" > 
			<?php 
				// lấy cookie đăng nhập tự động
				 
				if (isset($_SESSION["loggedin"])){
					echo "Xin chào ". $_SESSION["username"];
					echo " | <a href='login.php?logout' id='aLogout'>Thoát</a>";	
				}else {
					
					//echo "<a href='login.php'>Đăng nhập</a>";
				}
			?>
		</div>
		</div> <!-- End of Navigation menu --> 
		
		<div id="contentWrapper" > 
				
