<?php
	require_once 'query.class.php';
	class Ferramenta extends Query{
	
		public static function FormatDate($Data){
		    
	        if($Data=="" || is_null($Data)){
	            $getData="";
	        }else{
    			$DataForm = explode("/", $Data);
    			$Ano = $DataForm['2'];
    			$Mes = $DataForm['1'];
    			$Dia = $DataForm['0'];
    			
    			$getData = $Ano.'-'.$Mes.'-'.$Dia;
		    }
                return $getData;
			
		}
		
		public static function FormatData($Data){
		    if($Data=="" || is_null($Data)){
		        $DataForm="";
		    }else{
			    $DataForm = date('d/m/Y', strtotime($Data));
		    }
			return $DataForm;
		}
		
		public static function getDados($Tabela, $Id, $CampoPegar = NULL, $CampoBuscar = NULL,$CodContrato=NULL,$filial=NULL){
        	$GetId = addslashes($Id);
        	$Query = new Query();
        	$where="";
        	if (!is_null($CodContrato)){
            	$where=" AND CTO_IN_CODIGO_".substr($CampoBuscar, 0,3)."=".$CodContrato;
        	}
        	if (!is_null($filial)){
            	$where=$where." AND PRS_IN_CODORG_".substr($CampoBuscar, 0,3)."=".$filial;
        	}
        	$readGetDados = $Query->Select($Tabela, "WHERE {$CampoPegar} = '".$GetId."'".$where);
        	
        	if($readGetDados){
        		foreach ($readGetDados as $readGetDadosView){
        			return  $readGetDadosView[$CampoBuscar];
        		}
        	}
		}
		
		public static function getNomeCampo($Campo){
	       $Ferramenta = new Ferramenta();
		   return $Ferramenta->getDados('bf_colunas', $Campo, 'CPO_ST_COLUNA', 'CPO_ST_CAMPO');
		}
		
		public static function getTamanhoCampo($Campo){
		    $Ferramenta = new Ferramenta();
		    return $Ferramenta->getDados('bf_colunas', $Campo, 'CPO_ST_COLUNA', 'CPO_IN_TAMANHO');
		}
		
		public static function getCompCampos($Antes, $Depois){
		    $Ferramenta = new Ferramenta();
		    //Armazena em um array os campos alterados
		    $diferencas = array_diff($Depois, $Antes);
		    $qtdeReg=count($diferencas);

		    $CamposAlterados = "";
            for ($i = 0;$i< $qtdeReg; $i++){
                $CamposAlterados = $CamposAlterados. "".$Ferramenta->getNomeCampo(key($diferencas)). " de '" . $Antes[key($diferencas)]. "' para '" . $Depois[key($diferencas)]. "', ";
                if ($i< $qtdeReg){
                next($diferencas);
                }
            }
            
            if ($CamposAlterados != ""){
                return "Alterações(". $CamposAlterados.")";
                
            }
		}
		
		public static function getDadosEstrutura($Reduzido,$Tipo,$Padrao,$CodContrato){
		    $Query = new Query();
		    if ($Reduzido=="" || $Padrao==""){
		        return "";
		    }else{
    		    $readGetDados = $Query->Select('bf_estruturas', "WHERE ETT_IN_REDUZIDO = ".$Reduzido
    		        ." AND PAD_IN_CODIGO_ETT=".$Padrao." AND PAD_ST_TIPO_ETT='".$Tipo."' AND CTO_IN_CODIGO_ETT=".$CodContrato);
    		    if($readGetDados){
    		        foreach ($readGetDados as $readGetDadosView){
    		            return  $readGetDadosView['ETT_ST_DESCRICAO'];
    		        }
    		    }
		    }
		}
		
		public static function MoneyFormat($Money){
			$RetornoMoney = number_format($Money,2,",",".");
			return $RetornoMoney;
		}
		
		public static function StrMoney($Money){
 			$Money = str_replace('.', '', $Money);
			$RetornoMoney = str_replace(',', '.', $Money);
			return $RetornoMoney;
		}
		
		
		function get_post_action($name)
		{
		    $params = func_get_args();
		
		    foreach ($params as $name) {
		        if (isset($_POST[$name])) {
		            return $name;
		            unset($_POST[$name]);
		        }
		    }
		}
		
		function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
		{
		    // Caracteres de cada tipo
		    $lmin = 'abcdefghijklmnopqrstuvwxyz';
		    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $num = '1234567890';
		    $simb = '!@#$%*-';
		
		    // Variáveis internas
		    $retorno = '';
		    $caracteres = '';
		
		    // Agrupamos todos os caracteres que poderão ser utilizados
		    $caracteres .= $lmin;
		    if ($maiusculas) $caracteres .= $lmai;
		    if ($numeros) $caracteres .= $num;
		    if ($simbolos) $caracteres .= $simb;
		
		    // Calculamos o total de caracteres possíveis
		    $len = strlen($caracteres);
		
		    for ($n = 1; $n <= $tamanho; $n++) {
		        // Criamos um número aleatório de 1 até $len para pegar um dos caracteres
		        $rand = mt_rand(1, $len);
		        // Concatenamos um dos caracteres na variável $retorno
		        $retorno .= $caracteres[$rand-1];
		    }
		
		    return $retorno;
		}
		
	}
	
	
?>