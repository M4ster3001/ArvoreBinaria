<?php

    class Pontos extends Database {

        function SalvarPontos( $dados ) {
            $retorno = "";

            if( empty($dados['cod_ponto']) ) {
                $retorno = $this->inserir( 'tb_pontos', $dados );
            } else {
                $retorno = $this->alterar( 'tb_pontos', $dados, array( 'cod_ponto'=> $dados['cod_ponto'] ) );
            }

            return $retorno;
        }

        function ListarUsuariosPontos() {

            return $this->seleciona('tb_vw_pontos_usuario', array('des_nome', 'cod_usuario', 'vlr_pontos'), NULL, NULL, 'des_nome ASC');
        }

        function SomaPontos($cod_usuario) {

            return $this->seleciona('tb_vw_pontos', array('vlr_pontos_esquerdo', 'vlr_pontos_direito'), array('cod_usuario_primario'=>$cod_usuario));
        }
    }

?>