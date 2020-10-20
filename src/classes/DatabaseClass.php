<?php

class Database
{
	private $conn;
	private $dsn;
	private $base;
	private $user;
	private $pass;
	private $stringSql;
	private $st;

	function __construct( )
	{
		global $config;

		$this->dsn  = "{$config['driver']}:host={$config['host']};dbname={$config['dbname']}";
		$this->base = $config['dbname'];
		$this->user = $config['user'];
		$this->pass = $config['pass'];

		try{
			$this->conn	= new PDO( $this->dsn, $this->user, $this->pass );
			$this->conn->exec( "SET CHARACTER SET utf8" );
			$this->conn->exec( "SET time_zone='America/Sao_Paulo'" );
		}
		catch( PDOException $e )
		{
			print "Error Founds: ".$e->getMessage( ).PHP_EOL;
			
			die( );
		}

		$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	}
	
	//Envia o erro para o chat do telegram
	private function msgErro($dados, $teste){
		$chat_id = "396074366";
		$token = "1250497161:AAEjCsgZVVjsO7hwB2RSUAcX_OmLS9PkUMI";
		$msg = 'SQL: '.$dados;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://api.telegram.org/bot$token/");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		$parametros = array('method'=> 'sendMessage', 'chat_id'=>$chat_id, 'text'=>$msg);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $parametros);
		$enviar = curl_exec($curl);
		curl_close($curl);
	}
	
	function seleciona( $tabela, array $campos=NULL, $condicao=NULL, $qtd=NULL, $order=NULL)
	{
		
		if ($qtd==1) {
			$fetch = 'fetch';
			$limit = ' LIMIT 1';
		} elseif ($qtd>1) {
			$fetch = 'fetchAll';
			$limit = ' LIMIT '.$qtd;
		} else {
			$fetch = 'fetchAll';
			$limit = '';
		}
		
		$campos = ( ($campos == NULL) ? '*' : implode( ',', $campos ) );
		if(!empty($condicao)){ $condicao = ' WHERE '.$condicao; }
		if(!empty($order)){ $order = ' ORDER BY '.$order; }
		
		$this->stringSql = "SELECT $campos FROM $tabela".$condicao.$order.$limit;
		//echo $this->stringSql;
		try{

			$query = $this->conn->query( $this->stringSql )->{$fetch}( PDO::FETCH_ASSOC );
			return $query;
		}catch(PDOException $er){

			$dados = $er->errorInfo[2].'  /  '.$this->stringSql.'   /   '.( implode( ',', $condicao ) );
            $this->msgErro( $dados, $er->errorInfo[2] );
            
			return $er->errorInfo;
		}
	}
	
	function quantidade( $tabela, $campos=NULL, $condicao=NULL)
	{
		if(!empty($condicao)){ $condicao = ' WHERE '.$condicao; }
		
		$this->stringSql = "SELECT COUNT($campos) qtde FROM $tabela".$condicao;
		//echo $this->stringSql;
		try{

			return $this->conn->query( $this->stringSql )->fetch( PDO::FETCH_ASSOC );
		}catch(PDOException $er){

			$dados = $er->errorInfo[2].'  /  '.$this->stringSql.'   /   '.( implode( ',', $condicao ) );
            $this->msgErro( $dados, $er->errorInfo[2] );
            
			return $er->errorInfo;
		}
	}
	
	

	function inserir( $tabela, array $dados)
	{
		foreach ( $dados as $campo => $valor ) {
			$campos[]  = $campo;
			$valores[] = (!empty($valor) ? $valor : ($valor === 0 ? 0 : ($valor == '0' ? 0 : NULL)));
			$holders[] = '?';
        }
        
		$campos = implode(',', $campos );
		$holders = implode(',', $holders );
		$this->stringSql = "INSERT INTO $tabela( $campos ) VALUES( $holders )";
		$this->st = $this->conn->prepare( $this->stringSql );
		//print_r($valores);
		//echo $this->stringSql;
		try{			

			$this->st->execute( $valores );
			return $this->conn->lastInsertId( $tabela."_id_seq" );
		}catch(PDOException $er){

            $dados = $er->errorInfo[2].'  /  '.$this->stringSql.'   /   '.( implode( ',', $condicao ) );
            $this->msgErro( $dados, $er->errorInfo[2] );
            
            return $er->errorInfo;
		}
	}


	function alterar( $tabela, array $dados, $condicao)
	{
		foreach ( $dados as $campo => $valor ) {
			$sets[] 	= "$campo=?";
			$valores[] = (!empty($valor) ? $valor : ($valor === 0 ? 0 : ($valor == '0' ? 0 : NULL)));
        }
        
		$sets = implode( ",", $sets );
		$this->stringSql = "UPDATE $tabela SET $sets WHERE ( $condicao )";
		//echo $this->stringSql;
        $this->st = $this->conn->prepare( $this->stringSql );
        
		try{

			return $this->st->execute( $valores );
		}catch(PDOException $er){

            $dados = $er->errorInfo[2].'  /  '.$this->stringSql.'   /   '.( implode( ',', $condicao ) );
            $this->msgErro( $dados, $er->errorInfo[2] );
            
            return $er->errorInfo;
		}

	}


	function excluir( $tabela, $condicao)
	{
		$this->stringSql = "DELETE FROM $tabela WHERE ( $condicao )";
		$this->st = $this->conn->prepare( $this->stringSql );
		//echo $this->stringSql;
		try{

			return $this->st->execute( array_values( $parametros ) );
		}catch(PDOException $er){

            $dados = $er->errorInfo[2].'  /  '.$this->stringSql.'   /   '.( implode( ',', $condicao ) );
            $this->msgErro( $dados, $er->errorInfo[2] );
            
            return $er->errorInfo;
		}
	}
	
}