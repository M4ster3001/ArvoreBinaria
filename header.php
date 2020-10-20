<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>

    <link href="/./src/styles/global.css" rel="stylesheet" type="text/css" />
    <link href="/./src/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="/./src/plugins/materialdesignicon/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />

    <?php

        if( $p == 'usuarios' & $m == 'salvar' ) {

            echo '<link href="/./src/styles/cadastro.css" rel="stylesheet" type="text/css" />';
        } else if( $p == 'pontos' & $m == 'salvar' ) {

            echo '<link href="/./src/styles/pontos.css" rel="stylesheet" type="text/css" />';
        } else if( $p == 'login' ) {

            echo '<link href="/./src/styles/login.css" rel="stylesheet" type="text/css" />';
        }

    ?>  

    <div class="header">
        <div class="content-header">
            <div class="logo"> </div>
            <div class="menu">
                <a class="btn btn-outback btn-green" href="/usuarios/salvar/">Usuarios</a>
                <a class="btn btn-outback btn-purple" href="/pontos/salvar/">Pontos</a>
                <a class="btn btn-outback btn-purple" href="/pontos/listar/">Listar Pontos</a>
            </div>
            <div class="opc">
                <a href="#">Logout</a>
            </div>
        </div>
    </div>

    </head>

    <body>
    
        <div class="alert-message display-hide"></div>