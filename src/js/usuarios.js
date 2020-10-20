$(document).ready(function(){
    LoadingDadosSelectUsuario('indicacao');
})

async function CadastrarNovoUsuario() {

    let form_data = $("#frm_usuario").serialize();

    if( ChecarSenha() ) {
    
        await $.ajax({
            url: '/./src/requisicoes/usuario/cadastrar_usuario.php',
            method: 'POST',
            'data': form_data,
            beforeSend: () => {
                $(".alert-message").show();
                $(".alert-message").html('<i class="fas fa-sync-alt fa-lg fa-spin fa-fw font-blue-hoki"></i> Enviando dados, aguarde...');
            }
        }).done( (data) => {

            let response;
            if( JSON.parse(data) ) { response = JSON.parse(data); } else { response = data; } 

            if( response['success'] === false ) {

                $(".alert-message").attr( 'class', 'alert-message alert-danger' );
                $(".alert-message").html( '<span class="mdi mdi-close-octagon md-20"></span><label>' + response['message'] + '</label>' );                   
                
            } else if( response['success'] === true ) {
                
                $(".alert-message").attr( 'class', 'alert-message alert-success' );
                $(".alert-message").html( '<span class="mdi mdi-shield-check-outline md-20"></span><label>' + 'Sucesso ao cadastrar o usuário' + '</label>' );
                $("#frm_usuario")[0].reset();

                LoadingDadosSelectUsuario(''); 
            }
    
            $(".alert-message").delay( 5000 ).fadeOut();
        })
        
    }
}

function ChecarSenha() {

    let senha = $("#pwd_senha").val();
    let conf_senha = $("#conf_pwd_senha").val();
    let ret = false;

    if( senha != "" && conf_senha != "") {
        if( senha != conf_senha ) {

            $(".alert-message").attr( 'class', 'alert-message alert-danger' );
            $(".alert-message").html( '<span class="mdi mdi-close-octagon md-20"></span><label>As senhas devem ser iguais</label>' );

            $(".alert-message").fadeIn();
            
            $("#btnCadastrar").attr('disabled', true);

            ret = false;
        } else {

            $(".alert-message").hide();

            $("#btnCadastrar").attr('disabled', false);

            ret = true;
        }
        
        $(".alert-message").delay( 5000 ).fadeOut();

        return ret;
    }
}

$("#btnCancelar").on("click", function() {
    $("#frm_usuario")[0].reset();
})