<?php
include_once './Conexao.php';

class Usuario {

    private $usuario;
    private $senha;
    private $email;

    public function __construct(\PDO $db = null) {
        
        if ($db === null) {
            try {
                $db =  conexaoDB();
            } catch (\PDOException $e) {
                If ($e->getCode() === 1045) {
                    echo "Usuário incorreto";
                }
            }
        }
        $this->db = $db;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEmail() {
        return $this->email;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    public function find($id) {
        $query = 'select * from usuarios where id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function logar($usuario,$senha) {
        $query = 'select * from usuarios where usuario = :usuario';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->execute();
        if($stmt->rowCount()!==0){
            
            $dados = $stmt->fetch(PDO::FETCH_NAMED);
            echo password_verify($senha, $dados['senha']);
            if(password_verify($senha, $dados['senha'])){
                echo 'passou2';
            $_SESSION['login']=$stmt->fetch(PDO::FETCH_NAMED);
            return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function listar() {
        $query = 'select * from usuarios';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }

    public function inserir() {
        $query = "insert into usuarios(usuario,email,senha) values(:usuario,:email,:senha);";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':usuario', $this->getUsuario());
        $stmt->bindValue(':email', $this->getEmail());
        $stmt->bindValue(':senha', $this->getSenha());
        if ($stmt->execute()) {
            return "Usuário " . $this->getUsuario() . " incluso com sucesso<br>";
        } else {
            return "Não foi possível incluir o Usuário<br>";
        }
    }

    public function alterar($id, $usuario, $email, $senha) {
        $query = "update usuarios set usuario=:usuario,email=:email,senha=:senha where id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":usuario", $usuario);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);

        if ($stmt->execute()) {
            return "Atualização efetuada com sucesso<br>";
        } else {
            return "Não foi possível atualizar o cadastro<br>";
        }
    }

    public function deletar($id) {
        $query = " delete from usuarios where id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            return "Usuário id=" . $id . " Excluído com sucesso<br>";
        } else {
            return "Não foi possível excluir o Cliente<br>";
        }
    }

}
