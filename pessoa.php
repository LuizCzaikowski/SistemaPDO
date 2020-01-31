<?php

Class Pessoa{

    private $pdo;

    public function __construct($dbname, $host, $user, $senha)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,
            $senha);
        } catch (PDOException $e){
            echo "Erro com banco de dados: ".$e->getMessage();
            exit();
        }
        catch (Exception $e){
            echo "Erro: ".$e->getMessage();
            exit();
        }
    }

    public function buscarDados() 
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT nome,email FROM pessoa ORDER BY nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function cadastrarPessoa($nome, $email, $telefone, $data_nasc, 
                                    $endereco)
    {
        $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
        $cmd->bindValue(":e",$email);
        $cmd->execute();
        if ($cmd->rowCount() > 0)
        {
            return false;
        } else {

            $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome, email, 
            telefone, data_nasc, endereco) 
            VALUES (:n, :e, :t, :d, :en)");
            $cmd->bindValue(":n",$nome);
            $cmd->bindValue(":e",$email);
            $cmd->bindValue(":t",$telefone);
            $cmd->bindValue(":d",$data_nasc);
            $cmd->bindValue(":en",$endereco);
            $cmd->execute();
            return true;
        }
    }
}
