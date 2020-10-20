<?php

?>

<div class="content-wrapper">
    <div class="header">
        <h3 class="des_titulo">Cadastrar</h3>
    </div>

    <div class="alert-message"></div>

    <main>
        <form id="frm_usuario" onsubmit="return false;" method="POST" enctype="multipart/form-data">

            <div class="form-control">
                <label for="des_nome" class="lb_nome">Nome</label>
                <input type="text" id="des_nome" name="des_nome" />
            </div>

            <div class="form-control">
                <label for="des_email" class="lb_email">E-mail</label>
                <input type="email" id="des_email" name="des_email" />
            </div>

            <div class="form-control">
                <label for="pwd_senha" class="lb_senha">Senha</label>
                <input type="password" id="pwd_senha" name="pwd_senha" onchange="ChecarSenha()" />
            </div>

            <div class="form-control">
                <label for="conf_pwd_senha" class="lb_conf_senha">Confirmar a senha</label>
                <input type="password" id="conf_pwd_senha" name="conf_pwd_senha" onchange="ChecarSenha()" />
            </div>

            <div class="form-control">
                <label for="cod_indicacao" class="lb_indicacao">Foi indicado por alguém?</label>
                <select name="cod_indicacao" id="cod_indicacao" class="slc_indicacao">
                    <option value="">Selecione se foi indicado</option>
                </select>
            </div>
        
            <div class="button-group">
                <a href="#" class="btn btn-outback btn_cadastrar" id="btnCadastrar" onclick="CadastrarNovoUsuario()">Cadastrar</a>
                <a href="#" class="btn btn-outback btn_cancelar" id="btnCancelar">Cancelar</a>
            </div>
        </form>
    </main>

    <div class="footer"></div>
</div>
