<?php

    $retorno = [];

    require_once( '../../config/geral.php' );
    require_once( '../../classes/DatabaseClass.php' );
    $database = new Database();

    require_once( '../../classes/Pontos.class.php' );
    $pontos = new Pontos();

    require_once( '../../classes/Erros.class.php' );
	$err = new Erros( );
    set_error_handler( array( $err, "handleError" ) );
    
    $lst_usuarios = $pontos->ListarUsuariosInd();
    $cod_ponto = $pontos->ListarPontosUsuario($cod_usuario);

    foreach( $lst_usuarios as $usuario ) {

        $total_pontos = $pontos->SomaPontos($usuario['cod_usuario']);
        
    }

    echo json_encode($retorno);

?>