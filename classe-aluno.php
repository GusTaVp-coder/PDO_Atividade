<?php

Class Aluno{

    private $pdo;

    public function __construct($dbname, $host, $user, $pass)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$pass);
        } catch (PDOException $th) {
            echo "Erro com banco de dados: " . $th;
        } catch (Exception $th)
        {
            echo "Erro genérico: " . $th;
        }
    }

    //FUNÇÃO PARA BUSCAR OS DADOS E COLOCARA NA TABELA DO LADO DIREITO DA TELA
    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM aluno ORDER BY turma");

        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    //BUSCAR DADOS POR NOME
    public function buscarDadosPorNome($nome)
        {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM aluno WHERE turma = :n");
        $cmd->bindValue(":n", $nome);
        $cmd->execute();
        
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    //FUNÇÃO PARA CADASTRAR ALUNO
    public function cadastrarAluno($nome, $turma, $telefone)
    {
            $cmd = $this->pdo->prepare("INSERT INTO aluno(nome, turma, telefone)
            VALUES (:n, :t, :tel)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $turma);
            $cmd->bindValue(":tel", $telefone);
            $cmd->execute();
            return true;
    }

    public function excluirAluno($matricula)
    {
        $cmd = $this->pdo->prepare("DELETE FROM aluno WHERE matricula = :m");
        $cmd->bindValue(":m", $matricula);
        $cmd->execute();
    }

//BUSCAR DADOS DE UMA PESSOA

    public function buscarDadosAluno($matricula)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM aluno WHERE matricula = :m");
        $cmd->bindValue(":m", $matricula);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }


//ATUALIZAR DADOS DE UM ALUNO


    public function atualizarDadosAluno($matricula, $nome, $turma, $telefone)
    {
            $cmd = $this->pdo->prepare("UPDATE aluno SET nome = :n, turma = :t, telefone = :tel WHERE matricula = :m");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $turma);
            $cmd->bindValue(":tel", $telefone);
            $cmd->bindValue(":m", $matricula);
            $cmd->execute();
            return true;      
    }
}