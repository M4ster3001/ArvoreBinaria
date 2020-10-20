<?php
date_default_timezone_set( 'America/Sao_Paulo' );
Class Erros {
	
	function mapErrorCode( $code ) {
		$error = $log = NULL;
		switch ( $code ) {
			case E_PARSE:
			case E_ERROR:
			case E_CORE_ERROR:
			case E_COMPILE_ERROR:
			case E_USER_ERROR:
				$error = 'Fatal Error';
				$log = LOG_ERR;
				break;
			case E_WARNING:
			case E_USER_WARNING:
			case E_COMPILE_WARNING:
			case E_RECOVERABLE_ERROR:
				$error = 'Warning';
				$log = LOG_WARNING;
				break;
			case E_NOTICE:
			case E_USER_NOTICE:
				$error = 'Notice';
				$log = LOG_NOTICE;
				break;
			case E_STRICT:
				$error = 'Strict';
				$log = LOG_NOTICE;
				break;
			case E_DEPRECATED:
			case E_USER_DEPRECATED:
				$error = 'Deprecated';
				$log = LOG_NOTICE;
				break;
			default :
				break;
		}
		return array( $error, $log );
	}

	function handleError( $code, $description, $file = NULL, $line = NULL, $context = NULL ) {
		$displayErrors = ini_get( "display_errors" );
		$displayErrors = strtolower( $displayErrors );
		if ( error_reporting( ) === 0 || $displayErrors === "on" ) {
			return false;
		}
		list( $error, $log ) = $this->mapErrorCode( $code );
		$data = array( 
			'level' => $log,
			'code' => $code,
			'error' => $error,
			'description' => $description,
			'file' => $file,
			'line' => $line,
			'path' => $file,
			'message' => $error . ' ( ' . $code . ' ): ' . $description . ' in [' . $file . ', line ' . $line . ']',
			'dat_evento' => date( 'd-m-Y H:i:s' )
		 );
		$this->msgErro( $data['message'], $data['description'] );
	}

	function msgErro( $dados, $teste ) {
		if( !isset( $_COOKIE['zerar'] )  ) {
			setcookie( 'zerar', 1, ( time( ) + 600 ) );
			if( isset( $_SESSION['poker']['mensagens'] )  ) {
				unset( $_SESSION['poker']['mensagens'] );
			}
		}
		if( !isset( $_SESSION['poker']['mensagens'] )  ) {
			$_SESSION['poker']['mensagens'] = '';
		}
		$jatem = 0;
		if( !empty( $_SESSION['poker']['mensagens'] )  ) {
			$checar = explode( ', ',$_SESSION['poker']['mensagens'] );
			for( $i=0;$i<count( $checar );$i++ ) {
				//echo "Teste $i".$checar[$i]."<br />";
				if( $checar[$i] == $teste ) {
					$jatem = 1;
				}
			}
		}
		if( $jatem == 0 ) {
			$i = $_SESSION['poker']['mensagens'];
			$_SESSION['poker']['mensagens'] .= $teste.', ';
			$chat_id = "396074366";
			$token = "1250497161:AAEjCsgZVVjsO7hwB2RSUAcX_OmLS9PkUMI";
			$msg = ( empty( $_SESSION['poker']['cod_clube'] ) ? '' : 'Clube: '.$_SESSION['poker']['cod_clube'] ).' - '.$dados;
			$curl = curl_init( );
			curl_setopt( $curl, CURLOPT_URL, "https://api.telegram.org/bot$token/" );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $curl, CURLOPT_POST, true );
			$parametros = array( 'method'=> 'sendMessage', 'chat_id'=> $chat_id, 'text'=> $msg );
			curl_setopt( $curl, CURLOPT_POSTFIELDS, $parametros );
			$enviar = curl_exec( $curl );
			curl_close( $curl );
		}
	}
	
}
?>