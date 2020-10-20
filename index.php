
<?php 
	
	session_start();
	ob_start();
	
	if(empty($_SESSION['sistema']['token_access'])){
		$_SESSION['sistema']['token_access'] = sha1(time().rand(0, 999));
	}
	
	$act = explode('/', $_SERVER['REQUEST_URI']);

	require( './src/config/geral.php' );
	require_once('./src/classes/DatabaseClass.php');
	$database = new Database;
	
	$p = '';
	$m = '';
	$classe = '';
	
	if(isset($act[1]) && !empty($act[1])){ $p = $act[1]; }
	if(isset($act[2]) && !empty($act[2])){ $m = $act[2]; }
	
	include('header.php');
	
	if(!empty($p) && $p == 'inicio'){
		
		require('src/classes/'.ucfirst($p).'.class.php');
		$classe = ucfirst($p);
		$$p = new $classe();
			include "contents/$p.php";
			
	}else if(!empty($p) && empty($m)){

		require('src/classes/'.ucfirst($p).'.class.php');
		$classe = ucfirst($p);
		$$p = new $classe();
		include "contents/$p/$p.php";
		
	}else if(!empty($p) && !empty($m)){

			require('src/classes/'.ucfirst($p).'.class.php');
			$classe = ucfirst($p);
			$$p = new $classe();
			include "contents/$p/$m.php";
			
	}else{

		include '404.php';
	}
	
	include('footer.php');
		
?>	

