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
    
    $des_nome = ( isset( $_POST['des_nome'] ) ? trim( addslashes( $_POST['des_nome'] ) ) : NULL );
    $des_email = ( isset( $_POST['des_email'] ) ? filter_var( trim( addslashes( $_POST['des_email'] ) ), FILTER_SANITIZE_EMAIL ) : NULL );
    $pwd_password = ( isset( $_POST['pwd_senha'] ) ? trim( addslashes( $_POST['pwd_senha'] ) ) : NULL );
    $cod_usuario_indicacao = ( isset( $_POST['cod_indicacao'] ) ? filter_var( trim( addslashes( $_POST['cod_indicacao'] ) ), FILTER_SANITIZE_NUMBER_INT ) : NULL );

    $dados = array(
        'des_nome' => $des_nome,
        'des_email' => $des_email,
        'pwd_senha' => sha1($pwd_password)
    );
    $cod_usuario = $usuarios->SalvarUsuario($dados);

    $cod_indicacao = 0;

    if( !empty($cod_usuario_indicacao) ) {
        
        $dados_indicacao = array(
            'cod_usuario_primario'=> $cod_usuario_indicacao,
            'cod_usuario_secundario'=> $cod_usuario
        );
        $cod_indicacao = $usuarios->SalvarIndicacao($dados_indicacao);
    }

    if( $cod_usuario > 0 || $cod_indicacao > 0) {

        $retorno['success'] = true;
        $retorno['cod_usuario'] = $cod_usuario;
    } else {

        $retorno['success'] = false;
        $retorno['message'] = 'Falha ao salvar o usuário';
    }

    echo json_encode($retorno);
}
?>