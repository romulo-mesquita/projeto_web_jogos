<?php
    if(!isset($_SESSION["nome"])){
        header('Location: ?pg=login/formulario');
    }
    $id = $_GET["id"];
        
    $stmt = $conn->prepare("DELETE FROM jogo WHERE id =".$id);   

    try {            
        $stmt->execute();
        echo '<div class="msg-cadastro-contato msg-cadastro-sucesso">jogo excluido com suscesso</div>';
        header('Location: ?pg=jogos');
    } catch(PDOExecption $e) {
        $conn->rollback();
        echo '<div class="msg-cadastro-contato msg-cadastro-erro">Erro ao excluir registro no banco: ' . $e->getMessage() . '</div>';
    }
?>