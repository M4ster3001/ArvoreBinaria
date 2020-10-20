<?php
    class Uteis {
        
        function mask( $val, $mask ) {
            $maskared = '';
            $k = 0;
            for( $i = 0; $i<=strlen( $mask )-1; $i++ ) {
                if( $mask[$i] == '#' )
                {
                    if( isset( $val[$k] ) )
                    $maskared .= $val[$k++];
                }
                else
                {
                    if( isset( $mask[$i] ) )
                    $maskared .= $mask[$i];
                }
            }
            return $maskared;
    }

    
    function formata_data( $data )
    {

        $retorno = substr( $data,8,2 ).'/'.substr( $data,5,2 ).'/'.substr( $data,0,4 );

        return $retorno;
    }

    function formata_data_banco( $data )
    {


        $retorno = str_replace( '/','',( trim( addslashes( $data ) ) ) );
        $retorno = !empty( $retorno ) ? substr( $retorno,4,4 ).'-'.substr( $retorno,2,2 ).'-'.substr( $retorno,0,2 ) : '';		 
            
        return $retorno;
    }

    function formata_datahora( $data )
    {

        if ( $data == '0000-00-00 00:00:00' )
            $retorno = NULL;

        else if ( substr( $data,11,8 ) == '00:00:00' )
            $retorno = substr( $data,8,2 ).'/'.substr( $data,5,2 ).'/'.substr( $data,0,4 );

        else
            $retorno = substr( $data,8,2 ).'/'.substr( $data,5,2 ).'/'.substr( $data,0,4 ).' '.substr( $data,11,2 ).':'.substr( $data,14,2 );

        return $retorno;
    }

    function formata_datahoramin( $data ) {
        
        $retorno = date( 'd/m/Y H:i:s', strtotime( $data ) );  
        
        return $retorno;
        
    }

    function formata_datahora_banco( $data )
    {

        if ( ( $data==NULL ) || ( $data=='00/00/0000 00:00' ) )
        {
            $dataf = NULL;
        }
        else
        {
            $dataf = isset( $data ) ? str_replace( array( ' ','/',':' ) , array( '','','' ) , ( trim( addslashes( $data ) ) ) ) : '';
            $dataf = !empty( $dataf ) ? substr( $dataf,4,4 ).'-'.substr( $dataf,2,2 ).'-'.substr( $dataf,0,2 ).' '.substr( $dataf,8,2 ).':'.substr( $dataf,10,2 ).':00' : '';
        }

        return $dataf;
    }
}