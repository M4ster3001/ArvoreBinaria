<?php

    class Usuarios extends Database {

        function SalvarUsuario( $dados ) {
            $retorno = "";

            if( empty($dados['cod_usuario']) ) {
                $retorno = $this->inserir( 'tb_usuarios', $dados );
            } else {
                $retorno = $this->alterar( 'tb_usuarios', $dados, array( 'cod_usuario'=> $dados['cod_usuario'] ) );
            }

            return $retorno;
        }

        function SalvarIndicacao( $dados ) {
            $retorno = "";

            $retorno = $this->procedure( "proc_i_indicacao(" . $dados['cod_usuario_primario'] . ", " . $dados['cod_usuario_secundario'] . ")" );

            return $retorno;
        }

        function ListarUsuariosIndicar() {

            return $this->seleciona('tb_vw_usuarios_indica', array('*'));
        }

        function ListarUsuarios() {

            return $this->seleciona('tb_usuarios', array('des_nome', 'cod_usuario'), NULL, NULL, 'des_nome ASC');
        }
    }

?>