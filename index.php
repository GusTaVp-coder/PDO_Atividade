<?php
require_once 'classe-aluno.php';

$a = new Aluno("escola", "localhost", "root", "");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo.css" type="text/css">
    <title>Cadastro Aluno</title>
</head>
<body>
    <?php
    if(isset($_POST['nome']))
    {
        if(isset($_GET['matricula_up']) && !empty($_GET['matricula_up']))
        {
            $matricula_update = addslashes($_GET['matricula_up']);
            $nome = addslashes($_POST['nome']);
            $turma = addslashes($_POST['turma']);
            $telefone = addslashes($_POST['telefone']);
            if(!empty($nome) && !empty($turma) && !empty($telefone))
            {
                if(!$a->atualizarDadosAluno($matricula_update, $nome, $turma, $telefone))
                {
                    ?>
                <div class="aviso">
                    <img src="aviso.png">
                    <h4>Falha ao enviar os dados</h4>
                </div>
                <?php
                }
                else
                {
                    header("location: index.php");
                }
            }
            else{
                ?>
                <div class="aviso">
                    <img src="aviso.png">
                    <h4>Preencha todos os campos</h4>
                </div>
                <?php
            }

        }
        else{
            
            $nome = addslashes($_POST['nome']);
            $turma = addslashes($_POST['turma']);
            $telefone = addslashes($_POST['telefone']);
            if(!empty($nome) && !empty($turma) && !empty($telefone))
            {
                if(!$a->cadastrarAluno($nome, $turma, $telefone))
                {
                    ?>
                <div class="aviso">
                    <img src="aviso.png">
                    <h4>Telefone já cadastrado</h4>
                </div>
                <?php
                }
            }
            else{
                ?>
                <div class="aviso">
                    <img src="aviso.png">
                    <h4>Preencha todos os campos</h4>
                </div>
                <?php
            }
        }
    }

    ?>

    <?php
    if(isset($_GET['matricula_up']))
    {
        $matricula_update = addslashes($_GET['matricula_up']);
        $res = $a->buscarDadosAluno($matricula_update);
    }

    ?>

    <section id="esquerda">
        <form method="POST">
            <h2>CADASTRAR ALUNO</h2>
            <label for="nome">Nome</label >
            <input type="text" name="nome" id="nome"
            value="<?php if(isset($res)){echo $res['nome'];} ?>">
            <label for="turma">Turma</label >
            <input type="text" name="turma" id="turma"
            value="<?php if(isset($res)){echo $res['turma'];} ?>">
            <label for="telefone">Telefone</label >
            <input type="text" name="telefone" id="telefone"
            value="<?php if(isset($res)){echo $res['telefone'];} ?>">
            <input type="submit" 
            value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}  ?>">

        </form>
    </section>
    <section id="direita">
        <table>
            <tr id="titulo">
                <td>Nome</td>
                <td>Turma</td>
                <td colspan="2">Telefone</td>
            </tr>
        <?php
            $dados = $a->buscarDados();
            if(count($dados) > 0)
            {
                for ($i=0; $i < count($dados); $i++) 
                { 
                    echo "<tr>";
                    foreach ($dados[$i] as $key => $value) 
                    {
                        if($key != "matricula")
                        {
                            echo "<td>".$value."</td>";
                        }
                    }
                    ?>
                    <td>
                        <a href="index.php?matricula_up=<?php echo $dados[$i]['matricula'];?>">Editar</a>
                        <a href="index.php?matricula=<?php echo $dados[$i]['matricula'];?>">Excluir</a>
                    </td>
                    <?php
                    echo "</tr>";
                }
                
            }
            else
            {
            ?>
            </tr>
        </table>
                <div class="aviso">
                    <h4>Não há alunos cadastrados</h4>
                </div>
                <?php
            }
        ?>
    </section>
</body>
</html>

<?php
    if(isset($_GET['matricula']))
    {
        $matricula_aluno = addslashes($_GET['matricula']);
        $a->excluirAluno($matricula_aluno);
        header("location: index.php");
    }

?>