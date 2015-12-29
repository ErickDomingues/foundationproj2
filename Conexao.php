<?php

function conexaoDB(){
    try{
        $config = include "./config.php";
        
        if(!isset($config['db'])){
        throw new \InvalidArgumentException("Configuração de banco de dados não existe!");  
        }
        
        $host = (isset($config['db']['host']))?$config['db']['host']:null;
        $database = (isset($config['db']['database']))?$config['db']['database']:null;
        $user = (isset($config['db']['user']))?$config['db']['user']:null;
        $password = (isset($config['db']['password']))?$config['db']['password']:null;
        
        return new \PDO("mysql:host={$host};dbname={$database}",$user,$password);
        
    }catch (\PDOException $e){
        echo $e->getMessage()."\n";
        echo $e->getTraceAsString()."\n";
    }
}
