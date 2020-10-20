<?php

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $retorno = [];

    require_once( '../../config/geral.php' );
    require_once( '../../classes/DatabaseClass.php' );
    $database = new Database();

    require_once( '../../classes/Pontos.class.php' );
    $pontos = new Pontos();

    require_once( '../../classes/Erros.class.php' );
	$err = new Erros( );
    set_error_handler( array( $err, "handleError" ) );
    

    $vlr_pontos = ( isset( $_POST['vlr_pontos'] ) ? filter_var( trim( addslashes( $_POST['vlr_pontos'] ) ), FILTER_SANITIZE_NUMBER_INT ) : NULL );
    $cod_usuario = ( isset( $_POST['cod_usuario'] ) ? filter_var( trim( addslashes( $_POST['cod_usuario'] ) ), FILTER_SANITIZE_NUMBER_INT ) : NULL );

    $dados = array(
        'cod_usuario' => $cod_usuario,
        'vlr_pontos' => $vlr_pontos,
    );
    $cod_ponto = $pontos->SalvarPontos($dados);

    if( $cod_ponto > 0) {

        $retorno['success'] = true;
        $retorno['cod_usuario'] = $cod_usuario;
    } else {

        $retorno['success'] = false;
        $retorno['message'] = 'Falha ao salvar os pontos';
    }

    echo json_encode($retorno);
}
?>