$(document).ready(function(){
    LoadingDadosSelectUsuario('');
})


async function CadastraPontosUsuario() {

    let form_data = $("#frm_acrescentar_pontos").serialize();

    if( $("#cod_usuario option:selected").val() > 0 ) {
      
        await $.ajax({
            url: '/./src/requisicoes/pontos/cadastrar_pontos.php',
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
                $(".alert-message").html( '<span class="mdi mdi-shield-check-outline md-20"></span><label>' + 'Sucesso ao salvar os pontos' + '</label>' );
                $("#frm_acrescentar_pontos")[0].reset();

            }
            
            $(".alert-message").delay( 5000 ).fadeOut();
        })

    } else {

        $(".alert-message").fadeIn();
        $(".alert-message").attr( 'class', 'alert-message alert-danger' );
        $(".alert-message").html( '<span class="mdi mdi-close-octagon md-20"></span><label>Selecione um usuário</label>' );          
        $(".alert-message").delay( 5000 ).fadeOut();
    }
}

$("#btnCancelar").on("click", function() {
    $("#frm_acrescentar_pontos")[0].reset();
})