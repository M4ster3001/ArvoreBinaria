<?php

if( $_SERVER['HTTP_HOST'] == 'localhost:8095' && 
    $_SERVER['DOCUMENT_ROOT'] == 'D:/ProjetosFora/ArvoreBinaria' )
{
    define ( 'BASE_URL', 'http://localhost:8095' );

	$config = array ( 
		'driver' => 'mysql',
		'host'	 => '127.0.0.1',
		'dbname' => 'bd_arvorebinaria',
		'user'	 => 'root',
		'pass'	 => ''
	);
}else 
{
    header( "Location: /login" );
}

?>