<?php

?>

<div class="content-wrapper">
    <div class="header">
        <h3 class="des_titulo">Cadastrar</h3>
    </div>

    <main>
        <form action="" id="frm_usuario">

            <div class="form-control">
                <label for="des_nome" class="lb_nome">Nome</label>
                <input type="text" id="des_nome" name="des_nome" />
            </div>

            <div class="form-control">
                <label for="des_email" class="lb_email">E-mail</label>
                <input type="email" id="des_email" name="des_nome" />
            </div>

            <div class="form-control">
                <label for="pwd_senha" class="lb_senha">Senha</label>
                <input type="password" id="pwd_senha" name="des_nome" />
            </div>

            <div class="form-control">
                <label for="conf_pwd_senha" class="lb_conf_senha">Senha</label>
                <input type="password" id="conf_pwd_senha" name="des_nome" />
            </div>

            <div class="form-control">
                <label for="cod_indicao" class="lb_indicacao">Foi indicado por alguém?</label>
                <select name="cod_indicao" id="cod_indicao" class="slc_indicacao">
                </select>
            </div>
        
            <div class="button-group">
                <a href="#" class="btn btn-outback btn_cadastrar">Cadastrar</a>
                <a href="#" class="btn btn-outback btn_cancelar">Cancelar</a>
            </div>
        </form>
    </main>

    <div class="footer"></div>
</div>