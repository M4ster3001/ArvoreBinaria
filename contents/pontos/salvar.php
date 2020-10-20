<?php

?>

<div class="content">
    <div class="content-wrapper">
        <div class="header">
            <h3 class="des_titulo">Pontos</h3>
        </div>

        <main>
            <form id="frm_acrescentar_pontos" onsubmit="return false;" method="POST" enctype="multipart/form-data">

                <div class="form-control">
                    <label for="cod_usuario" class="lb_usuario">Usuário</label>
                    <select name="cod_usuario" id="cod_usuario" class="slc_usuario">
                        <option value="">Selecione um usuário</option>
                    </select>
                </div>

                <div class="form-control">
                    <label for="vlr_pontos" class="lb_pontos">Pontos</label>
                    <input type="number" id="vlr_pontos" name="vlr_pontos" min="1" max="9999" />
                </div>
            
                <div class="button-group">
                    <a href="#" class="btn btn-outback btn_cadastrar" id="btnCadastrar" onclick="CadastraPontosUsuario()">Cadastrar</a>
                    <a href="#" class="btn btn-outback btn_cancelar" id="btnCancelar">Cancelar</a>
                </div>
            </form>
        </main>

        <div class="footer"></div>
    </div>
</div>
