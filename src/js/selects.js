
async function LoadingDadosSelectUsuario(parametro) {

    await $.ajax({
        url: '/./src/requisicoes/usuario/listar_usuarios.php',
        method: 'POST',
        'data': `parametro=${parametro}`,
        beforeSend: () => {

        }
    }).done( (data) => {

        let response;
        let select = document.querySelector( parametro ? "#cod_indicacao" : '#cod_usuario' );

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
