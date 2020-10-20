$(document).ready(function(){
    LoadingDadosSelect();
})

async function LoadingDadosSelect() {

    await $.ajax({
        url: '/./src/requisicoes/usuario/listar_usuarios_indicar.php',
        method: 'POST',
        beforeSend: () => {

        }
    }).done( (data) => {

        let response;
        let select = document.querySelector("#cod_indicacao");

        if( JSON.parse(data) ) { response = JSON.parse(data); } else { response = data; } 

        if( response['success'] === false ) {

            $(".alert-message").attr( 'class', 'alert-message alert-danger' );
            $(".alert-message").html( '<span class="mdi mdi-close-octagon md-20"></span><label>' + response['message'] + '</label>' );                   
            
        } else if( response['success'] === true ) {

            $("#cod_indicacao options").remove();
            
            for( let i = 0; i < response['dados'].length; i++ ) {

                let newOption = new Option( response['dados'][i]['des_nome'], response['dados'][i]['cod_usuario'] );
                select.add( newOption );
            }

        }

        $(".alert-message").fadeIn();
        $(".alert-message").delay( 5000 ).fadeOut();
    })
}

async function CadastrarNovoUsuario() {

    let form_data = $("#frm_usuario").serialize();

    await $.ajax({
        url: '/./src/requisicoes/usuario/cadastrar_usuario.php',
        method: 'POST',
        'data': form_data,
        beforeSend: () => {

        }
    }).done( (data) => {

        let response;
        if( JSON.parse(data) ) { response = JSON.parse(data); } else { response = data; } 

        if( response['success'] === false ) {

            $(".alert-message").attr( 'class', 'alert-message alert-danger' );
            $(".alert-message").html( '<span class="mdi mdi-close-octagon md-20"></span><label>' + response['message'] + '</label>' );                   
            
        } else if( response['success'] === true ) {
            
            $(".alert-message").attr( 'class', 'alert-message alert-success' );
            $(".alert-message").html( '<span class="mdi mdi-shield-check-outline md-20"></span><label>' + 'Sucesso ao logar' + '</label>' );
            $(".login-form")[0].reset();

        }

        $(".alert-message").fadeIn();
        $(".alert-message").delay( 5000 ).fadeOut();
    })
}

function ChecarSenha() {

    let senha = $("#pwd_senha").val();
    let conf_senha = $("#conf_pwd_senha").val();

    if( senha != "" && conf_senha != "") {
        if( senha != conf_senha ) {

            $(".alert-message").attr( 'class', 'alert-message alert-danger' );
            $(".alert-message").html( '<span class="mdi mdi-close-octagon md-20"></span><label>As senhas devem ser iguais</label>' );

            $(".alert-message").fadeIn();
            
            $("#btnCadastrar").attr('disabled', true);
        } else {

            $(".alert-message").hide();

            $("#btnCadastrar").attr('disabled', false);
        }
        
        $(".alert-message").delay( 5000 ).fadeOut();
    }
}

$("#btnCancelar").on("click", function() {
    $("#frm_usuario")[0].reset();
})