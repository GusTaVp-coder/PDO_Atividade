<?php

//---------------CONEXÃO----------------------
try {
    $pdo = new PDO("mysql:dbname=escola;host=localhost","root", "");

} catch (PDOException $th) {
    echo "Erro com o banco de dados: " . $th;
}
catch (Exception $th) {
    echo "Erro com o banco de dados: " . $th;
}

//---------------INSERT----------------------
//---Forma 1----
// $res = $pdo->prepare("INSERT INTO aluno(nome, turma, telefone) 
// VALUES (:n, :t, :tel)");
// $res->bindValue(":n", "Roberta");
// $res->bindValue(":t", "1");
// $res->bindValue(":tel", "22894002");
// $res->execute();

//---Forma 2----
// $pdo->query("INSERT INTO aluno(nome, turma, telefone) 
// VALUES ('Paulo', '2', '123321123')");

//-----------------DELETE-------------
//---Forma 1----
// $cmd = $pdo->prepare("DELETE FROM aluno WHERE matricula = :matricula");
// $matricula = 3;
// $cmd->bindValue(":matricula", $matricula);
// $cmd->execute();

//---Forma 2----
// $cdm = $pdo->query("DELETE FROM aluno WHERE matricula = '2'");

//-----------------UPDATE-------------
//---Forma 1----
// $cmd = $pdo->prepare("UPDATE aluno SET turma = :t WHERE matricula = :m");
// $cmd->bindValue(":m", "1");
// $cmd->bindValue(":t", '1');
// $cmd->execute();

//Forma 2---
// $res = $pdo->query("UPDATE aluno SET turma = '4' WHERE matricula = '1'");

//-------------------SELECT-------------------
// $cmd = $pdo->prepare("SELECT * FROM aluno");
// $cmd->execute();
// $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// print_r($result);
// echo '</pre>';
// foreach ($result as $key => $value)
// {
//     echo $key . ": " . $value . "<br>";
// }
