<?php
//Conexao
try {
    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost","root","");
}
catch (PDOException $e) {
    echo "Erro com banco de dados: ".$e->getMessage();
}
catch (Exception $e) {
    echo "Erro genérico: ".$e->getMessage();
}
//insert
$res = $pdo->prepare("INSERT INTO pessoa(nome, email, telefone, data_nasc, endereco) VALUES
(:n, :e, :t, :d, :en)");

$res->bindValue(":n","Luiz");
$res->bindValue(":e","luiz@hotmail.com");
$res->bindValue(":t","00000000");
$res->bindValue(":d","2020/01/30");
$res->bindValue(":en","Rua Maracana");
$res->execute();
//delete
$cmd = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
$id = 2;
$cmd->bindValue(":id",$id);
$cmd->execute();

//update
$cmd = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");
$cmd->bindValue(":e","Luiz-234@hotmail.com");
$cmd->bindValue(":id",1);
$cmd->execute();

$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$cmd->bindValue(":id",1);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);

foreach ($resultado as $key => $value) {
    echo $key.": ".$value."<br>";
}
