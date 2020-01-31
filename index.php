<?php
require_once 'pessoa.php';
$p = new Pessoa("CRUDPDO","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Cadastro Pessoa</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php
        if (isset($_POST['nome']))
        {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $telefone = addslashes($_POST['telefone']);
            $data_nasc = addslashes($_POST['data_nasc']);
            $endereco = addslashes($_POST['endereco']);
            if (!empty($nome) && !empty($email) && !empty($telefone)){

                if($p->cadastrarPessoa($nome, $email, $telefone, $data_nasc, 
                $endereco))
                {
                    ?>
                    <div class="aviso">
                        <img src="ok.jpg">
                        <h4>Cadastrado realizado com sucesso</h4>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="aviso">
                        <img src="aviso.png">
                        <h4>Email já cadastrado!</h4>
                    </div>
                    <?php
                }

            } else {
                ?>
                <div class="aviso">
                    <img src="aviso.png">
                    <h4>Favor preencher os campos obrigatórios: NOME - EMAIL - 
                    TELEFONE</h4>
                </div>
                <?php
            }
        }
    ?>
    <section id="esquerda">
        <form method="POST">
            <h2>CADASTRAR PESSOA</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone">
            <label for="data_nasc">Data de Nascimento</label>
            <input type="date" name="data_nasc" id="data_nasc">
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco">
            <input type="submit" value="Cadastrar">
        </form>
    </section>
    <section id="direita">
        <table>
            <tr id="titulo">
                    <td>NOME</td>
                    <td colspan="2">EMAIL</td>
                </tr>
                <?php
                    $dados = $p->buscarDados();
                    if (count($dados) > 0)
                    {
                        for ($i=0; $i < count($dados); $i++){
                            echo "<tr>";
                            foreach ($dados[$i] as $k => $v){
                                
                                if ($k != "id")
                                {
                                    echo "<td>".$v."</td>";
                                }
                            }
        
                            echo "</tr>";
                        }
                    } else {
                      
                    }
                ?>
            </table>        
    </section>
</body>
</html>