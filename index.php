<?php

	$URIParts = explode('/', $_SERVER['REQUEST_URI']);
	$requestedPage = explode('?',$URIParts[1]);
	$requestedPage = $requestedPage[0];
	
	if(empty($requestedPage)) $requestedPage = 'index';
	
	
	switch($requestedPage){
	
		case 'ajax':
		
			if($_POST['action'] == 'webCon'){
			
				require_once('/var/www/api/index.php');
				
			}else{
			
				$ajaxHandlerPath = './ajaxHandler/'.$_POST['action'].'.class.php';
				if(file_exists($ajaxHandlerPath)){
				
					include($ajaxHandlerPath);
				
				}else{
				
					exit(json_encode(array('status' => false, 'msg' => 'Unerwarteter Fehler')));
				
				}
			
			}
			break;
	
	}
	
	
	$page = './pages/'.$requestedPage.'.php';

	if(!file_exists($page)){
	
		$page = './pages/404.php';
	
	}

?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="LePeMa" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/functions.js"></script>
		<title>Kneipen-Finder</title>
	</head>
	<body>
		<noscript><div id="noscript"><div>JavaScript muss aktiviert sein!</div></div></noscript>
		<div id="headBar">
			<a id="title" class="fll" href="/">
				<h1 class="fll">Kneipen-Finder</h1>
				<div class="clear"></div>
			</a>
			<div class="clear"></div>
		</div>
		<div id="content" class="wrapper">
			<?php require($page); ?>
		</div>
		<div id="footBar">
			<div id="socialMedia">
				<a id="facebookLink" href="#" class="footBarIcon fll"><img alt="Facebook-Logo" src="/img/icon_facebook.png" /></a>
				<a id="twitterLink" href="#" class="footBarIcon fll"><img alt="Twitter-Logo" src="/img/icon_twitter.png" /></a>
				<a id="googleLink" href="#" class="footBarIcon fll"><img alt="Google-Plus-Logo" src="/img/icon_google.png" /></a>
				<div class="clear"></div>
			</div>
		</div>
		<div id="footer">
			<a href="/contact">Kontakt</a>
			<span>|</span>	
			<a href="/privacy">Datenschutzerklärung</a>
			<span>|</span>	
			<a href="/imprint">Impressum</a>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				
			});
		</script>
	</body>
</html>