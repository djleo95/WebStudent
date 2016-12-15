<?php //session_start();?>
<!doctype html>
<html>
<head>
	
	<title>Trang web tin chi</title>
		
	<?php 
		if (!isset($_SESSION["loggedin"])){
			
		}
	
	?>
	
	<title><?php echo $page_title; ?></title>
	<meta charset="utf-8"> 
	<meta name="keywords" content="<?php echo $page_keywords; ?>" />
	<meta name="description" content="<?php echo $page_description; ?>" />
	


	<!--XEM LAỊ CHỖ href -->
	<link rel="stylesheet" type="text/css" href="/css/style.css" />	
	<!--<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />-->
	<link rel="stylesheet" 	href="/css/ui-lightness/jquery-ui-1.10.2.custom.css" />
	<!--<link rel="stylesheet" 	href="css/jmetro/jquery-ui-1.10.2.custom.css" /> -->
    
</head>
<body>
	<div id="pageWrapper">
		<div id="bk">
				<img src="/images/bk.png" width="950" height="150">
		</div> <!-- End of header -->
		
		<div id="nav">
			<div id ="menu">
					<a href="?c=dangki">Đăng Kí|</a>
					<a href="#">Sửa Đăng Kí|</a>
					<a href="#">Thông Tin Khóa Học|</a>
					<a href="#">Danh Sách Đăng Kí |</a>
			</div>
			<div  id="login" >
				<?php 
					// lấy cookie đăng nhập tự động
					if (isset($_SESSION["loggedin"])){
						echo "Xin chào ". $_SESSION["username"];
						echo "| <a href='login.php?logout' id='aLogout'>Thoát</a>";	
					}else {
						
						//echo "<a href='login.php'>Đăng nhập</a>";
					}
				?>
			</div>
		</div>  <!--End of Navigation menu --> 
		
		<div id="contentWrapper" > 
				
