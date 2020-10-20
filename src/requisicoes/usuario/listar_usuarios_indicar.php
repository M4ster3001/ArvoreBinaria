<?php

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $retorno = [];

    require_once( '../../config/geral.php' );
    require_once( '../../classes/DatabaseClass.php' );
    $database = new Database();

    require_once( '../../classes/Usuarios.class.php' );
    $usuarios = new Usuarios();

    require_once( '../../classes/Erros.class.php' );
	$err = new Erros( );
    set_error_handler( array( $err, "handleError" ) );

    $lst_usuario = $usuarios->ListarUsuariosIndicar();

    if( $lst_usuario ) {

        $retorno['success'] = true;
        $retorno['dados'] = $lst_usuario;
    } else {

        $retorno['success'] = false;
        $retorno['message'] = 'Falha ao salvar o usuário';
    }

    echo json_encode($retorno);
}
?>