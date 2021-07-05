<?php
if(!isset($_SESSION["nome"])){
    header('Location: ?pg=login/formulario');
}
$sql = "SELECT us.id, us.nome, us.usuario,DATE_FORMAT(us.data_hora_criacao, '%d/%m/%Y %H:%i:%S') AS data_hora_criacao, DATE_FORMAT(us.data_hora_atualizacao, '%d/%m/%Y %H:%i:%S') AS data_hora_up
        FROM usuarios us
        ORDER BY us.id DESC";

$result = $conn->query($sql, PDO::FETCH_ASSOC);

$usuario = "".$_SESSION["nome"]."";
$acao = "Listagem dos usuarios";

$stmt = $conn->prepare("INSERT INTO logs (usuario, acao) VALUES (:usuario, :acao)");

$bind_param = ["usuario" => $usuario, "acao" => $acao];

try {
    $conn->beginTransaction();
    $stmt->execute($bind_param);
    
    $conn->commit();
} catch(PDOExecption $e) {
    $conn->rollback();
    echo("erro"); 
}


?>
<h1>Usuáiro cadastrados</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Login</th>
        <th>Data e Hora Criação</th>
        <th>Data e Hora Atualização</th>           
        <th>Ações</th>
    </tr>
    <?php
        while($linha = $result->fetch()){
    ?>
        <tr>
            <?php
                foreach($linha as $chave => $valor){
            ?>
                <td><?= $valor ?></td>
                
            <?php
                
                }
                $_SESSION['id'] = $linha['id'];                
            ?>
                <td><a href="?pg=cruds/alterar&id=<?= $linha['id'] ?>">Alterar</a><br><a href="?pg=cruds/excluir&id=<?= $linha['id'] ?>">Excluir</a></td>
        </tr>
    <?php
        }
    ?>
</table>

<div id="btn-limpar-sessao">
    <a href="?pg=cruds/cadastrar">Cadastrar Usuário</a>
</div>