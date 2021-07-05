<?php

if(!empty($_POST)){
    
    $nome = $_POST["nome"];    
    $email = $_POST["email"];    
    $mensagem = $_POST["mensagem"];

    # Insert no banco de dados
    $stmt = $conn->prepare("INSERT INTO contato (nome, email, mensagem) VALUES (:nome, :email, :mensagem)");

    $bind_param = ["nome" => $nome, "email" => $email,"mensagem" => $mensagem];

    try {
        $conn->beginTransaction();
        $stmt->execute($bind_param);
        echo '<div class="msg-cadastro-contato msg-cadastro-sucesso">Registro ' . $conn->lastInsertId() . ' inserido no banco!</div>';
        $conn->commit();
    } catch(PDOExecption $e) {
        $conn->rollback();
        echo '<div class="msg-cadastro-contato msg-cadastro-erro">Erro ao inserir registro no banco: ' . $e->getMessage() . '</div>';
    }

}

?>
