<?php
require_once 'class/conn.class.php';

class Query extends Conn
{
    /*
     * METODO DE CADASTRO NO BANCO
     */
    public static function Insert($Tabela, array $Dados)
    {
        foreach ($Dados as $key => $valuesKey) {
            if (! is_array($valuesKey)) {
                $Dados[$key] = addslashes($valuesKey);
                if($Dados[$key]==''){
                    unset($Dados[$key]);
                }else{
                    if (preg_match("/!!/", $Dados[$key])){
                        $Dados[$key]=str_replace("!!", "'", $Dados[$key]);
                    }
                }
            }
        }
        $Campos = implode(' ,', array_keys($Dados));
        $Valores = "'" . implode("','", array_values($Dados)) . "'";
        //RETIRA AS ASPAS DOS CAMPOS MARCADOS POR "|"
        $Valores=str_replace("'|",'',$Valores);
        $Valores=str_replace("|'",'',$Valores);
       
        $SqlInsert = "INSERT INTO {$Tabela}({$Campos}) VALUES({$Valores})";
            
        $SqlInsertExe = mysqli_query(Conn::Conexao(), $SqlInsert);
        if (mysqli_errno(Conn::Conexao())!=0){
            $erro='Erro número: '. mysqli_errno(Conn::Conexao()) . " Mensagem: " . mysqli_error(Conn::Conexao())." SQL: ".$SqlInsert;
            throw new Exception($erro,mysqli_errno(Conn::Conexao()));
            
        }
        if ($SqlInsertExe) {
            //return $SqlInsertExe;
            $idInserido=mysqli_insert_id(Conn::Conexao());
            if ($idInserido!=0){
                return $idInserido;
            }else{
                return $SqlInsertExe;   
            }
        }else{
            throw new Exception('NÃO FOI POSSÍVEL INCLUIR UM OU MAIS REGISTROS',1);
        }
    }
    
    /*
     * METODO DE LISTAGEM NO BANCO
     */
    public static function Select($Tabela, $Condicao = NULL)
    {
        
        $SqlRead = "SELECT * FROM {$Tabela} {$Condicao}";
        $SqlReadExe = mysqli_query(Conn::Conexao(), $SqlRead);
        if (mysqli_errno(Conn::Conexao())!=0){
            if (mysqli_errno(Conn::Conexao())!=0){
                $erro='Erro número: '. mysqli_errno(Conn::Conexao()) . " Mensagem: " . mysqli_error(Conn::Conexao())." SQL: ".$SqlRead;
                throw new Exception($erro,mysqli_errno(Conn::Conexao()));
                
            }
        }
        $QtdCampos = mysqli_num_fields($SqlReadExe);
        $ResultadoSql = '';
        
        for ($z = 0; $z < $QtdCampos; $z ++) {
            // Armazena o metadado(Objeto descritivo do campo) na variável NomeColunas
            $NomeColunas = mysqli_fetch_field_direct($SqlReadExe, $z);
            // Lê o metadados armazenado pegando apenas o nome da coluna
            $Names[$z] = $NomeColunas->name;
        }
        // Executa até o ultimo gegistro em mysqli_fetch_assoc($SqlReadExe) armazenado em $result
        for ($w = 0; $Result = mysqli_fetch_assoc($SqlReadExe); $w ++) {
            // executa até a ultima coluna
            for ($a = 0; $a < $QtdCampos; $a ++) {
                // Armazena o valor do campo adquirido em result através do array $names na matriz $ResultadoSql
                $ResultadoSql[$w][$Names[$a]] = $Result[$Names[$a]];
            }
        }
         //echo var_dump($ResultadoSql);
        return $ResultadoSql;
    }
    
    /*
     * METODO DE LISTAGEM libre NO BANCO
     */
    public static function QueryLivre( $Seleção)
    {
        $SqlRead = "{$Seleção}";
        $SqlReadExe = mysqli_query(Conn::Conexao(), $SqlRead);
        if (mysqli_errno(Conn::Conexao())!=0){
            $erro='Erro número: '. mysqli_errno(Conn::Conexao()) . " Mensagem: " . mysqli_error(Conn::Conexao())." SQL: ".$SqlRead;
            throw new Exception($erro,mysqli_errno(Conn::Conexao()));
            
        }
        
        if (strtoupper(substr($SqlRead,0,6))=='SELECT'){
            $QtdCampos = mysqli_num_fields($SqlReadExe);
            $ResultadoSql="";
            for ($z = 0; $z < $QtdCampos; $z ++) {
                // Armazena o metadado(Objeto descritivo do campo) na variável NomeColunas
                $NomeColunas = mysqli_fetch_field_direct($SqlReadExe, $z);
                // Lê o metadados armazenado pegando apenas o nome da coluna
                $Names[$z] = $NomeColunas->name;
            }
            // Executa até o ultimo gegistro em mysqli_fetch_assoc($SqlReadExe) armazenado em $result
            for ($w = 0; $Result = mysqli_fetch_assoc($SqlReadExe); $w ++) {
                // executa até a ultima coluna
                for ($a = 0; $a < $QtdCampos; $a ++) {
                    // Armazena o valor do campo adquirido em result através do array $names na matriz $ResultadoSql
                    $ResultadoSql[$w][$Names[$a]] = $Result[$Names[$a]];
                }
            }
            return $ResultadoSql;
        }else{
            return $SqlReadExe;
        }
        
    }
    
    /*
     * METODO DE ATUALIZAÇÃO NO BANCO DE DADOS
     */
    public static function Update($Tabela, array $Campos, $Condicao = NULL)
    {
        foreach ($Campos as $KeyDados => $ValuesKeysDados) {
            if (! is_array($ValuesKeysDados)) {
                $Campos[$KeyDados] = addslashes($ValuesKeysDados);
//                 if($Campos[$KeyDados]==''){
//                     unset($Campos[$KeyDados]);
//                 }
            }
        }
        
        foreach ($Campos as $Keys => $ValueKeys) {
            
            $Dados[] = "$Keys = '$ValueKeys'";
        }
        $Dados = implode(" , ", $Dados);
        $Dados=str_replace("''",'null',$Dados);
        $SqlUpdate = "UPDATE {$Tabela} SET {$Dados} {$Condicao} ";
        $SqlUpdateExe = mysqli_query(Conn::Conexao(), $SqlUpdate);
        if (mysqli_errno(Conn::Conexao())!=0){
            $erro='Erro número: '. mysqli_errno(Conn::Conexao()) . " Mensagem: " . mysqli_error(Conn::Conexao())." SQL: ".$SqlUpdate;
            throw new Exception($erro,mysqli_errno(Conn::Conexao()));
            
        }
        if ($SqlUpdateExe) {
            return $SqlUpdateExe;
        }else{
            throw new Exception('NÃO FOI POSSÍVEL ATUALIZAR UM OU MAIS O REGISTROS');
        }
    }
    
    
    /*
     * METODO EXCLUSÃO DO BANCO
     */
    public static function Delete($Tabela, $Condicao)
    {
        $SqlDelete = "DELETE FROM {$Tabela} {$Condicao}";
        $SqlDeleteExe = mysqli_query(Conn::Conexao(), $SqlDelete);
        if (mysqli_errno(Conn::Conexao())!=0){
            $erro='Erro número: '. mysqli_errno(Conn::Conexao()) . " Mensagem: " . mysqli_error(Conn::Conexao())." SQL: ".$SqlDelete;
            throw new Exception($erro,mysqli_errno(Conn::Conexao()));
            
        }
        if ($SqlDeleteExe) {
            return $SqlDeleteExe;
        }else{
            throw new Exception('NÃO FOI POSSÍVEL EXCLUIR O REGISTRO');
        }
    }
    
    public static function setLog($codTabela,$contrato, $organizacao, $usuario, $acao, $descricao, $data)
    {
        if ($descricao!=""){
            $SqlInsert = "INSERT INTO bf_logs(TBL_ST_CODIGO_LOG,CTO_IN_CODIGO_LOG,PRS_IN_CODORG_LOG,USR_IN_CODIGO_LOG,LOG_ST_ACAO,LOG_ST_DESCRICAO,LOG_DT_DTINC) 
                            VALUES('{$codTabela}',{$contrato},{$organizacao},{$usuario},'{$acao}','{$descricao}','{$data}')";
        
            $SqlInsertExe = mysqli_query(Conn::Conexao(), $SqlInsert);
            if (mysqli_errno(Conn::Conexao())!=0){
                $erro='Erro número: '. mysqli_errno(Conn::Conexao()) . " Mensagem: " . mysqli_error(Conn::Conexao())." SQL: ".$SqlInsert;
                throw new Exception($erro,mysqli_errno(Conn::Conexao()));
                
            }
            if ($SqlInsertExe) {
                    return $SqlInsertExe;
                    
            }else{
                throw new Exception('NÃO FOI POSSÍVEL GRAVAR O LOG DA AÇÃO NO BANCO DE DADOS');
            }
        }
    }
    
    public static function setError($contrato, $organizacao, $usuario,$arquivo,$linha,$codErro,$mensagem,$data)
    {
        $mensagem = addslashes($mensagem);
        $SqlInsert = "INSERT INTO bf_erros(CTO_IN_CODIGO_ERR,PRS_IN_CODORG_ERR,USR_IN_CODIGO_ERR,ERR_ST_ARQUIVO,ERR_IN_LINHA,ERR_IN_CODERRO,ERR_ST_MENSAGEM,ERR_DT_DTINC)
        VALUES({$contrato},{$organizacao},{$usuario},'{$arquivo}',{$linha},{$codErro},'{$mensagem}','{$data}')";

        $SqlInsertExe = mysqli_query(Conn::Conexao(), $SqlInsert);
        if (mysqli_errno(Conn::Conexao())!=0){
            $erro='Erro número: '. mysqli_errno(Conn::Conexao()) . " Mensagem: " . mysqli_error(Conn::Conexao())." SQL: ".$SqlInsert;
            throw new Exception($erro,mysqli_errno(Conn::Conexao()));
            
        }
        if ($SqlInsertExe) {
        return $SqlInsertExe;

        }else{
        throw new Exception('NÃO FOI POSSÍVEL GRAVAR O LOG DA AÇÃO NO BANCO DE DADOS');
        }
    }
}
?>